<?php

include_once(ROOT . 'libs/item.php');
include_once(ROOT . 'libs/security.php');
include_once(ROOT . 'libs/sessionCart.php');
include_once(ROOT . 'libs/repositories/orders.php');

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
		}

		$this->setUser(Security::getUserConnected());
		$this->setStatus(TRANSACTION_STATUS_OPEN);
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
	 * Change le status de la transaction.
	 * (L'utilisateur ne pourra pas poursuivre ses achats.)
	 */
	public function Checkout()
	{
		if ($this->getStatus() >= TRANSACTION_STATUS_CHECKOUT) {
			throw new Exception(ERROR_TRANSACTION_ALREADY_CHECKOUT);
		}

		foreach ($this->cart->getItems as $item) {
			$this->lines[] = new Line(
				$item->getProductSku(),
				$item->getQuantity(),
				$item->getUnitPrice(),
				$item->getGrossPrice()
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

		// Ajoute les lignes de commande.
		foreach ($this->lines as &$line) {
			$line->setOrderId($this->order->getId());
			$line = Lines::Attach($line);
		}

		$this->setStatus(TRANSACTION_STATUS_READY_TO_PAY);
		$this->Save();
	}


	/**
	 * Ajoute un item au panier d'achats de la transaction et retourne sa quantité.
	 *
	 * @param Item $item
	 *
	 * @return mixed
	 * @throws Exception
	 */
	public function AddItem(Item $item)
	{
		if ($this->getStatus() >= TRANSACTION_STATUS_CHECKOUT) {
			throw new Exception(ERROR_TRANSACTION_ALREADY_CHECKOUT);
		}

		if (!isSet($this->cart)) {
			$this->cart = new SessionCart();
		}

		$quantity = $this->cart->Add($item);
		$this->Save();

		return $quantity;
	}


	/**
	 * Retire un item du panier d'achats de la transaction et retourne sa quantité.
	 *
	 * @param Item $item
	 *
	 * @return int
	 * @throws Exception
	 */
	public function RemoveItem(Item $item)
	{
		if ($this->getStatus() >= TRANSACTION_STATUS_CHECKOUT) {
			throw new Exception(ERROR_TRANSACTION_ALREADY_CHECKOUT);
		}

		if (!isSet($this->cart)) {
			return 0;
		}

		$quantity = $this->cart->Remove($item);
		$this->Save();

		return $quantity;
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
	 * Définit le statut.
	 * (Statuts définits ci-haut.)
	 *
	 * @param $status
	 *
	 * @throws Exception
	 */
	private function setStatus($status)
	{
		if ($this->getStatus() >= $status) {
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
		if ($this->getStatus() >= TRANSACTION_STATUS_OPEN) {
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
	 * Définit les informations du destinateur.
	 *
	 * @param $greeting
	 * @param $languageCode
	 * @param $name
	 * @param $firstname
	 * @param $lastname
	 * @param $phone
	 * @param $email
	 *
	 * @throws Exception
	 */
	public function setRecipientInfo($greeting, $languageCode, $name, $firstname, $lastname, $phone, $email)
	{
		if ($this->getStatus() >= TRANSACTION_STATUS_READY_TO_PAY) {
			throw new Exception(ERROR_TRANSACTION_ALREADY_COMPLETE);
		}

		$this->recipientInfo = new RecipientInfo(
			$languageCode,
			$greeting,
			$name,
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