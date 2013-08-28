<?php

define('ORDER_STATUS_CANCELED', -1);
define('ORDER_STATUS_NOT_SEND', 0);
define('ORDER_STATUS_PENDING', 1);
define('ORDER_STATUS_IN_PROCESS', 2);
define('ORDER_STATUS_SHIPPED', 3);
define('ORDER_STATUS_DELIVERED', 4);

/**
 * Class Order
 * Représente une commande.
 */
class Order
{
	private $id;
	private $ref;
	private $number;
	private $userId;
	private $status;
	private $datetime;


	/**
	 * Charge les définitions de classes nécessairent à l'initialisation de cet objet.
	 */
	function __autoload()
	{
	}


	/**
	 * Initialise la commande.
	 *
	 * @param $userId
	 */
	function __construct($userId)
	{
		$this->setUserId($userId);

		// Initialise le statut à : "Non envoyée", car pour l'instant,
		// la commande n'est sauvegardée qu'en session.
		$this->setStatus(ORDER_STATUS_NOT_SEND);
	}


	/**
	 * Retourne un tableau contenant les différentes propriétés de la commande.
	 *
	 * @return array
	 */
	public function getInfoArray()
	{
		return array(
			'id'       => $this->getId(),
			'ref'      => $this->getRef(),
			'number'   => $this->getNumber(),
			'userId'   => $this->getUserId(),
			'status'   => $this->getStatus(),
			'datetime' => $this->getDatetime()
		);
	}


	/**
	 * Définit l'identifiant de la commande.
	 *
	 * @param mixed $id
	 */
	public function setId($id)
	{
		$this->id = $id;
	}


	/**
	 * Retourne l'identifiant de la commande.
	 *
	 * @return mixed
	 */
	public function getId()
	{
		return $this->id;
	}


	/**
	 * Définit la référence (Dutailier) de la commande.
	 *
	 * @param mixed $ref
	 */
	public function setRef($ref)
	{
		$this->ref = $ref;
	}


	/**
	 * Retourne la référence (Dutailier) de la commande.
	 *
	 * @return mixed
	 */
	public function getRef()
	{
		return $this->ref;
	}


	/**
	 * Définit le numéro de la commande (ex : WEB10000000).
	 *
	 * @param mixed $number
	 */
	public function setNumber($number)
	{
		$this->number = $number;
	}


	/**
	 * Retourne le numéro de la commande (ex : WEB10000000).
	 *
	 * @return mixed
	 */
	public function getNumber()
	{
		return $this->number;
	}


	/**
	 * Définit l'identifiant de l'auteur de la commande.
	 *
	 * @param mixed $userId
	 */
	public function setUserId($userId)
	{
		$this->userId = $userId;
	}


	/**
	 * Retourne l'identifiant de l'auteur de la commande.
	 *
	 * @return mixed
	 */
	public function getUserId()
	{
		return $this->userId;
	}


	/**
	 * Définit le statut de la commande.
	 *
	 * @param mixed $status
	 */
	public function setStatus($status)
	{
		$this->status = $status;
	}


	/**
	 * Retourne le statut de la commande.
	 *
	 * @return mixed
	 */
	public function getStatus()
	{
		return $this->status;
	}


	/**
	 * Définit le moment de la création de la commande.
	 * (Les status sont définis ci-haut.)
	 *
	 * @param mixed $creationDate
	 */
	public function setDatetime($creationDate)
	{
		$this->datetime = $creationDate;
	}


	/**
	 * Retourne le moment de la création de la commande.
	 *(Les status sont définis ci-haut.)
	 *
	 * @return mixed
	 */
	public function getDatetime()
	{
		return $this->datetime;
	}


	/**
	 * Retourne les commentaires de cette commande.
	 *
	 * @return array
	 */
	public function getComments()
	{
		include_once(DIR . 'libs/repositories/comments.php');

		return Comments::FilterByOrderId($this->getId());
	}


	/**
	 * Retourne les entrées du journal d'évènements de cette commande.
	 *
	 * @return array
	 */
	public function getLogs()
	{
		include_once(DIR . 'libs/repositories/logs.php');

		return Logs::FilterByOrderId($this->getId());
	}


	/**
	 * Retourne l'auteur de la commande.
	 *
	 * @return User
	 */
	public function getUser()
	{
		include_once(DIR . 'libs/repositories/users.php');

		return Users::Find($this->getUserId());
	}


	/**
	 * Retourne le destinateur de la commande.
	 *
	 * @return RecipientInfo
	 */
	public function getRecipientInfo()
	{
		include_once(DIR . 'libs/repositories/recipientInfos.php');

		return RecipientInfos::Find($this->getUserId());
	}


	/**
	 * Retourne l'informations d'expédition de la commande.
	 *
	 * @return ShippingInfo
	 */
	public function getShippingInfo()
	{
		include_once(DIR . 'libs/repositories/shippingInfos.php');

		return ShippingInfos::Find($this->getUserId());
	}


	/**
	 * Retourne le sous-total de la commande.
	 *
	 * @return int
	 */
	public function getSubTotal()
	{
		$subTotal = 0;

		include_once(DIR . 'libs/repositories/lines.php');

		$lines = Lines::FilterByOrderId($this->getId());

		foreach ($lines as $line) {
			$subtotal += $line->getTotalPrice();
		}

		return $subTotal;
	}


	/**
	 * Retourne le totals des frais d'expédition.
	 *
	 * @return int
	 */
	public function getTotalShippingFee()
	{
		$totalShippingFee = 0;

		include_once(DIR . 'libs/repositories/lines.php');

		$lines = Lines::FilterByOrderId($this->getId());

		foreach ($lines as $line) {
			$totalShippingFee += $line->getTotalShippingFee();
		}

		return $totalShippingFee;
	}


	/**
	 * Retourne le total de la commande.
	 *
	 * @return int
	 */
	public function getTotal()
	{
		return $this->getSubTotal() + $this->getTotalShippingFee();
	}
}