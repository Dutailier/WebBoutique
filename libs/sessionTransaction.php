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
		$this->setStatus(TRANSACTION_STATUS_OPEN);
		$this->setUser(Security::getUserConnected());
	}


	/**
	 * Change le status de la transaction.
	 * (L'utilisateur ne pourra pas poursuivre ses achats.)
	 */
	public function Checkout()
	{
		foreach ($this->cart->getItems as $item) {
			$this->lines[] = new Line(
				$item->getProductSku(),
				$item->getQuantity(),
				$item->getUnitPrice(),
				$item->getGrossPrice()
			);
		}

		$this->setStatus(TRANSACTION_STATUS_CHECKOUT);
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
	}


	/**
	 * Ajoute un item au panier d'achats de la transaction et retourne sa quantité.
	 *
	 * @param Item $item
	 *
	 * @return mixed
	 */
	public function AddItem(Item $item)
	{
		if (!isSet($this->cart)) {
			$this->cart = new SessionCart();
		}

		return $this->cart->Add($item);
	}


	/**
	 * Retire un item du panier d'achats de la transaction et retourne sa quantité.
	 *
	 * @param Item $item
	 *
	 * @return int
	 */
	public function RemoveItem(Item $item)
	{
		return isSet($this->cart) ?
			$this->cart->Remove($item) : 0;
	}


	/**
	 * Vide le panier d'achats.
	 */
	public function ClearCart()
	{
		$this->cart->Clear();
	}


	/**
	 * Définit le statut.
	 * (Statuts définits ci-haut.)
	 *
	 * @param mixed $status
	 */
	private function setStatus($status)
	{
		$this->status = $status;
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
	 * @param mixed $user
	 */
	private function setUser($user)
	{
		$this->user = $user;
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
	 */
	private function setOrder($userId)
	{
		$this->order = new Order (
			$userId
		);
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
	 * @param $languageCode
	 * @param $greeting
	 * @param $name
	 * @param $firstname
	 * @param $lastname
	 * @param $phone
	 * @param $email
	 */
	public function setRecipientInfo($greeting, $languageCode, $name, $firstname, $lastname, $phone, $email)
	{
		$this->recipientInfo = new RecipientInfo(
			$languageCode,
			$greeting,
			$name,
			$firstname,
			$lastname,
			$phone,
			$email
		);
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
	 */
	public function setShippingInfo($street, $city, $zipCode, $stateCode)
	{
		$this->shippingInfo = new ShippingInfo(
			$street,
			$city,
			$zipCode,
			$stateCode
		);
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