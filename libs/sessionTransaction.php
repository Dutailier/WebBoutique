<?php

include_once(ROOT . 'libs/item.php');
include_once(ROOT . 'libs/security.php');
include_once(ROOT . 'libs/sessionCart.php');
include_once(ROOT . 'libs/repositories/lines.php');
include_once(ROOT . 'libs/repositories/orders.php');
include_once(ROOT . 'libs/repositories/products.php');

define('TRANSACTION_STATUS_OPEN', 0); // L'utilisateur peut configurer différents produits.
define('TRANSACTION_STATUS_CHECKOUT', 1); // L'utilisateur à complété ses achats.
define('TRANSACTION_STATUS_READY_TO_PAY', 2); // L'utilisateur a terminé de magasiner et est prêt à payer.
define('TRANSACTION_STATUS_PAYMENT_IS_COMPLETE', 3); // La paiement est complété, une confirmation peut être affichée.

/**
 * Class SessionTransaction
 * Représente une transaction sauvegarder en session.
 * Gère les étapes d'une transaction.
 */
class SessionTransaction
{
	const TRANSACTION_IDENTIFIER = '__TRANSACTION__';

	private $status;
	private $user;
	private $cart;
	private $order;
	private $lines;
	private $recipientInfo;
	private $shippingInfo;


	/**
	 * Initialise la transasction.
	 */
	public function __construct()
	{
		if (session_id() == '') {
			session_start();
		}

		if (isSet($_SESSION[self::TRANSACTION_IDENTIFIER])) {
			$this->Copy(unserialize($_SESSION[self::TRANSACTION_IDENTIFIER]));

		} else {
			$this->setUser(Security::getUserConnected());
			$this->setStatus(TRANSACTION_STATUS_OPEN);
		}
	}


	/**
	 * Retourne un tableau contenant les propriétés de la transaction.
	 *
	 * @return array
	 */
	public function getInfoArray()
	{
		$infos = array(
			'status'        => $this->getStatus(),
			'user'          => $this->getUser()->getInfoArray(),
			'order'         => $this->getOrder()->getInfoArray(),
			'recipientInfo' => $this->getRecipientInfo()->getInfoArray(),
			'shippingInfo'  => $this->getShippingInfo()->getInfoArray()
		);

		foreach ($this->getLines() as $line) {
			$info['lines'][] = $line->getInfoArray();
		}

		return $infos;
	}


	/**
	 * Copie la transaction.
	 *
	 * @param SessionTransaction $transaction
	 */
	public function Copy(SessionTransaction $transaction)
	{
		$this->status        = $transaction->status;
		$this->user          = $transaction->user;
		$this->cart          = $transaction->cart;
		$this->order         = $transaction->order;
		$this->lines         = $transaction->lines;
		$this->recipientInfo = $transaction->recipientInfo;
		$this->shippingInfo  = $transaction->shippingInfo;
	}


	/**
	 * Sauvegarde la transaction en session.
	 */
	public function Save()
	{
		$_SESSION[self::TRANSACTION_IDENTIFIER] = serialize($this);
	}


	/**
	 * Annule la transaction.
	 */
	public function Cancel()
	{
		unset($_SESSION[self::TRANSACTION_IDENTIFIER]);
	}


	/**
	 * Ferme la transaction afin de pouvoir en créer une nouvelle.
	 */
	public function Close()
	{
		$this->ClearCart();
		$this->Cancel();
	}


	/**
	 * Change le status de la transaction.
	 * ( Les achats seront fixés et ne pourront plus être changés.)
	 */
	public function Checkout()
	{
		if ($this->getStatus() >= TRANSACTION_STATUS_CHECKOUT) {
			throw new Exception(ERROR_TRANSACTION_ALREADY_CHECKOUT);
		}

		$items = $this->getItems();

		if (empty($items)) {
			throw new Exception(ERROR_TRANSACITON_NO_PRODUCT);
		}

		$subTotal      = 0;
		$totalShipping = 0;

		foreach ($items as $item) {
			$subTotal += $item->getTotalPrice();
			$totalShipping += $item->getTotalShippingFee();
		}

		if (($subTotal + $totalShipping) > TOTAL_PRICE_MAX) {
			throw new Exception(ERROR_TRANSACTION_TOTAL_PRICE_MAX);
		}

		foreach ($items as $item) {
			$product = $item->getProduct();

			$this->lines[] = new Line(
				$product->getSku(),
				$product->getPrice(),
				$product->getShippingFee(),
				$item->getQuantity()
			);
		}

		$this->setStatus(TRANSACTION_STATUS_CHECKOUT);
		$this->Save();
	}


	/**
	 * Exécute la transaction.
	 * - Ajoute la commande à la base de données.
	 * - Ajoute les informations du destinateur à la base de données.
	 * - Ajoute les informations d'expédition à la base de données.
	 * - Ajoute les lignes de commande à la base de données.
	 */
	public function ReadyToPay()
	{
		if ($this->getStatus() >= TRANSACTION_STATUS_READY_TO_PAY) {
			throw new Exception(ERROR_TRANSACTION_ALREADY_COMPLETE);
		}

		// Définit la commande
		$this->setOrder($this->user->getId());

		// Ajoute la commande à la base de données.
		$this->order = Orders::Attach($this->order);

		// Ajoute les informations du destinateur à la base de données.
		$this->recipientInfo->setOrderId($this->order->getId());
		$this->recipientInfo = RecipientInfos::Attach($this->recipientInfo);

		// Ajoute les informations d'expédition à la base de données.
		$this->shippingInfo->setOrderId($this->order->getId());
		$this->shippingInfo = ShippingInfos::Attach($this->shippingInfo);

		// Ajoute les lignes de commande à la base de données.
		foreach ($this->lines as &$line) {
			$line->setOrderId($this->order->getId());
			$line = Lines::Attach($line);
		}

		$this->setStatus(TRANSACTION_STATUS_READY_TO_PAY);
		$this->Save();
	}


	/**
	 * Ajoute un produit au panier d'achats de la transaction.
	 *
	 * @param $sku
	 *
	 * @return mixed
	 * @throws Exception
	 */
	public function addProductToCart($sku)
	{
		if ($this->getStatus() >= TRANSACTION_STATUS_CHECKOUT) {
			throw new Exception(ERROR_TRANSACTION_ALREADY_CHECKOUT);
		}

		if (!isSet($this->cart)) {
			$this->cart = new SessionCart();
		}

		$product = Products::Find($sku, $this->getUser()->getId());
		$item    = new Item($product);

		$item = $this->cart->Add($item);
		$this->Save();

		return $item;
	}


	/**
	 * Définit la quantité d'un produit contenu dans le panier d'achats.
	 *
	 * @param $sku
	 * @param $quantity
	 *
	 * @return mixed
	 * @throws Exception
	 */
	public function setQuantityOfProduct($sku, $quantity)
	{
		if ($this->getStatus() >= TRANSACTION_STATUS_CHECKOUT) {
			throw new Exception(ERROR_TRANSACTION_ALREADY_CHECKOUT);
		}

		if (!isSet($this->cart)) {
			$this->cart = new SessionCart();
		}

		$product = Products::Find($sku, $this->getUser()->getId());
		$item    = new Item($product);

		$item = $this->cart->setQuantity($item, $quantity);

		$this->Save();

		return $item;
	}


	/**
	 * Vide le panier d'achats.
	 *
	 * @throws Exception
	 */
	public function ClearCart()
	{
		if ($this->getStatus() >= TRANSACTION_STATUS_CHECKOUT) {
			throw new Exception(ERROR_TRANSACTION_ALREADY_CHECKOUT);
		}

		$this->cart->Clear();
		$this->Save();
	}


	/**
	 * Retourne la liste des produits contenu dans le panier d'achats.
	 *
	 * @return array
	 */
	public function getItems()
	{
		if (!isSet($this->cart)) {
			$this->cart = new SessionCart();
		}

		return $this->cart->getItems();
	}


	/**
	 * Définit le statut.
	 * (Statuts définits ci-haut.)
	 *
	 * @param $status
	 *
	 * @throws Exception
	 */
	private function setStatus($status)
	{
		if ($this->getStatus() > $status) {
			throw new Exception(ERROR_TRANSACTION_STATUS_INVALID);
		}

		$this->status = $status;
		$this->Save();
	}


	/**
	 * Retourne le statut.
	 * (Statuts définits ci-haut.)
	 *
	 * @return mixed
	 */
	public function getStatus()
	{
		return $this->status;
	}


	/**
	 * Définit l'utilisateur qui passe la commande.
	 *
	 * @param $user
	 *
	 * @throws Exception
	 */
	private function setUser($user)
	{
		if ($this->getStatus() > TRANSACTION_STATUS_OPEN) {
			throw new Exception(ERROR_TRANSACTION_ALREADY_OPEN);
		}

		$this->user = $user;
		$this->Save();
	}


	/**
	 * Retourne l'utilisateur qui passe la commande.
	 *
	 * @return mixed
	 */
	public function getUser()
	{
		return $this->user;
	}


	/**
	 * Définit la commande.
	 *
	 * @param $userId
	 *
	 * @throws Exception
	 */
	private function setOrder($userId)
	{
		if ($this->getStatus() >= TRANSACTION_STATUS_READY_TO_PAY) {
			throw new Exception(ERROR_TRANSACTION_ALREADY_COMPLETE);
		}

		$this->order = new Order (
			$userId
		);

		$this->Save();
	}


	/**
	 * Retourne la commande.
	 *
	 * @return mixed
	 */
	public function getOrder()
	{
		return $this->order;
	}


	/**
	 * Retourne les lignes de commande de la transaction.
	 *
	 * @return mixed
	 */
	public function getLines()
	{
		return $this->lines;
	}


	/**
	 * Définit les informations du destinateur si c'est un commerçant.
	 *
	 * @param $languageCode
	 * @param $name
	 * @param $phone
	 * @param $email
	 *
	 * @throws Exception
	 */
	public function setStoreInfo($languageCode, $name, $phone, $email)
	{
		if ($this->getStatus() >= TRANSACTION_STATUS_READY_TO_PAY) {
			throw new Exception(ERROR_TRANSACTION_ALREADY_COMPLETE);
		}

		$this->recipientInfo = new RecipientInfo(
			$languageCode,
			null,
			$name,
			null,
			null,
			$phone,
			$email
		);

		$this->Save();
	}


	/**
	 * Définit les informations du destinateur si c'est un consommateur.
	 *
	 * @param $languageCode
	 * @param $greeting
	 * @param $firstname
	 * @param $lastname
	 * @param $phone
	 * @param $email
	 *
	 * @throws Exception
	 */
	public function setCustomerInfo($languageCode, $greeting, $firstname, $lastname, $phone, $email)
	{
		if ($this->getStatus() >= TRANSACTION_STATUS_READY_TO_PAY) {
			throw new Exception(ERROR_TRANSACTION_ALREADY_COMPLETE);
		}

		$this->recipientInfo = new RecipientInfo(
			$languageCode,
			$greeting,
			null,
			$firstname,
			$lastname,
			$phone,
			$email
		);

		$this->Save();
	}


	/**
	 * Retourne les informations du destinateur.
	 *
	 * @return mixed
	 */
	public function getRecipientInfo()
	{
		return $this->recipientInfo;
	}


	/**
	 * Définit les informations d'expédition.
	 *
	 * @param $street
	 * @param $city
	 * @param $zipCode
	 * @param $stateCode
	 *
	 * @throws Exception
	 */
	public function setShippingInfo($street, $city, $zipCode, $stateCode)
	{
		if ($this->getStatus() >= TRANSACTION_STATUS_READY_TO_PAY) {
			throw new Exception(ERROR_TRANSACTION_ALREADY_COMPLETE);
		}

		$this->shippingInfo = new ShippingInfo(
			$street,
			$city,
			$zipCode,
			$stateCode
		);

		$this->Save();
	}


	/**
	 * Retourne les informations d'expédition.
	 *
	 * @return mixed
	 */
	public function getShippingInfo()
	{
		return $this->shippingInfo;
	}
}