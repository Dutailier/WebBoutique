<?php

include_once(DIR . 'libs/item.php');
include_once(DIR . 'libs/security.php');
include_once(DIR . 'libs/sessionCart.php');
include_once(DIR . 'libs/repositories/lines.php');
include_once(DIR . 'libs/repositories/orders.php');
include_once(DIR . 'libs/repositories/products.php');
include_once(DIR . 'libs/repositories/recipientInfos.php');
include_once(DIR . 'libs/repositories/shippingInfos.php');

define('TRANSACTION_STATUS_OPEN', 0); // L'utilisateur peut configurer différents produits.
define('TRANSACTION_STATUS_CHECKOUT', 1); // L'utilisateur à complété ses achats.
define('TRANSACTION_STATUS_FINALIZED', 2); // Les informations ont été remplis.
define('TRANSACTION_STATUS_CONFIRMED', 3); // L'utilisateur a terminé de magasiner et est prêt à payer.

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
	private $subTotal;
	private $totalShippingFee;


	/**
	 * Charge les définitions de classes nécessairent à l'initialisation de cet objet.
	 */
	function __autoload()
	{
	}


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

		$this->cart = new SessionCart();
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
			'address'       => $this->getUser()->getAddress()->getInfoArray(),
			'recipientInfo' => $this->getRecipientInfo()->getInfoArray(),
			'shippingInfo'  => $this->getShippingInfo()->getInfoArray(),
			'summary'       => array(
				'subTotal'         => $this->getSubTotal(),
				'totalShippingFee' => $this->getTotalShippingFee()
			)
		);

		foreach ($this->getLines() as $line) {
			$product = Products::Find(
				$line->getProductSku(),
				$this->getUser()->getId()
			);

			$infos['lines'][] = array_merge(
				$line->getInfoArray(),
				array(
					'product' => array_merge(
						$product->getInfoArray(),
						array(
							'model' => $product->getModel()->getInfoArray()
						))
				));
		}

		if ($this->getStatus() >= TRANSACTION_STATUS_CONFIRMED) {
			$infos['order'] = $this->getOrder()->getInfoArray();
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
		$this->status           = $transaction->status;
		$this->user             = $transaction->user;
		$this->cart             = $transaction->cart;
		$this->order            = $transaction->order;
		$this->lines            = $transaction->lines;
		$this->recipientInfo    = $transaction->recipientInfo;
		$this->shippingInfo     = $transaction->shippingInfo;
		$this->subTotal         = $transaction->getSubTotal();
		$this->totalShippingFee = $transaction->getTotalShippingFee();
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
		$this->cart->Clear();
		$this->Cancel();
	}


	/**
	 * Change le status de la transaction.
	 * ( Les achats seront fixés et ne pourront plus être changés.)
	 */
	public function Checkout()
	{
		if ($this->getStatus() != TRANSACTION_STATUS_OPEN) {
			throw new Exception(ERROR_TRANSACTION_REQUIRED_STATUS_OPEN);
		}

		$items = $this->getItems();

		if (empty($items)) {
			throw new Exception(ERROR_TRANSACITON_NO_PRODUCT);
		}

		$this->subTotal         = 0;
		$this->totalShippingFee = 0;

		foreach ($items as $item) {
			$this->subTotal += $item->getTotalPrice();
			$this->totalShippingFee += $item->getTotalShippingFee();
		}

		if (($this->subTotal + $this->totalShippingFee) > TOTAL_PRICE_MAX) {
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
	 * Finalise la transaction.
	 *
	 * @throws Exception
	 */
	public function Finalize()
	{
		if ($this->getStatus() != TRANSACTION_STATUS_CHECKOUT) {
			throw new Exception(ERROR_TRANSACTION_REQUIRED_STATUS_CHECKOUT);
		}

		if (empty($this->recipientInfo)) {
			throw new Exception(ERROR_TRANSACTION_REQUIRED_RECIPIENT_INFO);
		}

		if (empty($this->shippingInfo)) {
			throw new Exception(ERROR_TRANSACTION_REQUIRED_SHIPPING_INFO);
		}

		$this->setStatus(TRANSACTION_STATUS_FINALIZED);
		$this->Save();
	}


	/**
	 * Confirme la transaction.
	 * - Ajoute la commande à la base de données.
	 * - Ajoute les informations du destinateur à la base de données.
	 * - Ajoute les informations d'expédition à la base de données.
	 * - Ajoute les lignes de commande à la base de données.
	 */
	public function Confirm()
	{
		if ($this->getStatus() != TRANSACTION_STATUS_FINALIZED) {
			throw new Exception(ERROR_TRANSACTION_REQUIRED_STATUS_FINALIZED);
		}

		// Crée et ajoute la commande à la base de données.
		$this->order = Orders::Attach(new Order(
				$this->user->getId()
			)
		);

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

		$this->createFile(); // Création du fichier texte de la commande.
		$this->setStatus(TRANSACTION_STATUS_CONFIRMED);
		$this->Save();
	}


	/**
	 * Crée le fichier texte qui sera transmit au système 1010.
	 * Le format du fichier ainsi créé est définit par le système 1010. Surtout,
	 * ne pas modifier celui-ci.
	 *
	 * @throws Exception
	 */
	private function createFile()
	{
		$filename = ORDER_FILE_PATH . $this->order->getNumber() . ".txt";

		// Ouverture ou création du fichier texte.
		$file = fopen($filename, 'w');

		if (empty($file)) {
			throw new Exception(ERROR_TRANSACTION_FILE_CANNOT_OPEN);
		}

		$user          = & $this->user;
		$order         = & $this->order;
		$recipientInfo = & $this->recipientInfo;
		$shippingInfo  = & $this->shippingInfo;
		$line          = & $this->lines[0];
		$product       = $line->getProduct();

		$text = // Première ligne du fichier.
			$user->getRef() . "\t" . //.................................. Référence 1010 du commerçant.
			$order->getNumber() . "\t" . //.............................. Numéro de commande.
			$user->getEmail() . "\t" . //................................ Adresse courriel du commerçant.
			$recipientInfo->getFullName() . "\t" . //.................... Nom complet (incluant la salutation) du consommateur.
			$recipientInfo->getPhone() . "\t" . //....................... Numéro de téléphone du consommateur.
			$shippingInfo->getStreet() . "\t\t" . //..................... Adresse civique du consommateur.
			$shippingInfo->getCity() . "\t" . //......................... Ville du consommateur.
			$shippingInfo->getStateCode() . "\t" . //.................... État ou province du consommateur.
			$shippingInfo->getZipCode() . "\t" . //...................... Code postal du consommateur.
			$line->getProductSku() . "\t" . //........................... Numéro de produit commandé.
			$line->getQuantity() . "\t" . //............................. Quantity du produit commandé.
			number_format($line->getUnitPrice(), 2) . "\t" . //.......... Prix unitaire du produit commandé.
			SHIPPING_CODE . "\t" . //.................................... Code d"expédition (frais divers).
			number_format($order->getTotalShippingFee(), 2) . "\t" . //.. Total des frais d"expédition.
			(method_exists($product, 'getPipingCode') ? //............... Si n'est pas un coussin lombaire.
				$product->getPipingCode() : '') . "\r\n"; //............. Code du fini du produit commandé.

		for ($i = 1; $i < count($this->lines); $i++) {
			$line    = & $this->lines[$i];
			$product = $line->getProduct();

			$text .= // Autres lignes du fichier.
				$user->getRef() . "\t" . //................................. Référence 1010 du commerçant.
				$order->getNumber() . "\t" . //............................. Numéro de commande.
				$user->getEmail() . "\t" . //............................... Adresse courriel du commerçant.
				$recipientInfo->getFullName() . "\t" . //................... Nom complet (incluant la salutation) du consommateur.
				$recipientInfo->getPhone() . "\t" . //...................... Numéro de téléphone du consommateur.
				$shippingInfo->getStreet() . "\t\t" . //.................... Adresse civique du consommateur.
				$shippingInfo->getCity() . "\t" . //........................ Ville du consommateur.
				$shippingInfo->getStateCode() . "\t" . //................... État ou province du consommateur.
				$shippingInfo->getZipCode() . "\t" . //..................... Code postal du consommateur.
				$line->getProductSku() . "\t" . //.......................... Numéro de produit commandé.
				$line->getQuantity() . "\t" . //............................ Quantity du produit commandé.
				number_format($line->getUnitPrice(), 2) . "\t" . //......... Prix unitaire du produit commandé.
				SHIPPING_CODE . "\t" . //................................... Code d"expédition (frais divers).
				number_format($line->getTotalShippingFee(), 2) . "\t" . //.. Total des frais d"expédition.
				(method_exists($product, 'getPipingCode') ? //............... Si n'est pas un coussin lombaire.
					$product->getPipingCode() : '') . "\r\n"; //............ Code du fini du produit commandé.
		}

		// Écriture du texte dans le fichier et sa fermeture.
		fwrite($file, $text);
		fclose($file);
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
		if ($this->getStatus() != TRANSACTION_STATUS_OPEN) {
			throw new Exception(ERROR_TRANSACTION_REQUIRED_STATUS_OPEN);
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
		if ($this->getStatus() != TRANSACTION_STATUS_OPEN) {
			throw new Exception(ERROR_TRANSACTION_REQUIRED_STATUS_OPEN);
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
		if ($this->getStatus() != TRANSACTION_STATUS_OPEN) {
			throw new Exception(ERROR_TRANSACTION_REQUIRED_STATUS_OPEN);
		}

		$this->cart->Clear();
		$this->Save();
	}


	/**
	 * Retourne la liste des produits contenu dans le panier d'achats.
	 *
	 * @return array
	 * @throws Exception
	 */
	public function getItems()
	{
		if ($this->getStatus() != TRANSACTION_STATUS_OPEN) {
			throw new Exception(ERROR_TRANSACTION_REQUIRED_STATUS_OPEN);
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
		if ($this->getStatus() != TRANSACTION_STATUS_OPEN) {
			throw new Exception(ERROR_TRANSACTION_REQUIRED_STATUS_OPEN);
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
		if ($this->getStatus() != TRANSACTION_STATUS_CHECKOUT) {
			throw new Exception(ERROR_TRANSACTION_REQUIRED_STATUS_CHECKOUT);
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
		if ($this->getStatus() != TRANSACTION_STATUS_CHECKOUT) {
			throw new Exception(ERROR_TRANSACTION_REQUIRED_STATUS_CHECKOUT);
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
		if ($this->getStatus() != TRANSACTION_STATUS_CHECKOUT) {
			throw new Exception(ERROR_TRANSACTION_REQUIRED_STATUS_CHECKOUT);
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


	/**
	 * Retourne la valeur de la propriété nommée subTotal.
	 *
	 * @return mixed
	 */
	public function getSubTotal()
	{
		return $this->subTotal;
	}


	/**
	 * Retourne la valeur de la propriété nommée totalShippingFee.
	 *
	 * @return mixed
	 */
	public function getTotalShippingFee()
	{
		return $this->totalShippingFee;
	}
}