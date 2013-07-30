<?php

include_once(ROOT . 'libs/repositories/logs.php');
include_once(ROOT . 'libs/repositories/users.php');
include_once(ROOT . 'libs/repositories/comments.php');

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
			'userId'   => $this->getNumber(),
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
		return Comments::FilterByOrderId($this->getId());
	}


	/**
	 * Retourne les entrées du journal d'évènements de cette commande.
	 *
	 * @return array
	 */
	public function getLogs()
	{
		return Logs::FilterByOrderId($this->getId());
	}


	/**
	 * Retourne l'auteur de la commande.
	 *
	 * @return User
	 */
	public function getUser()
	{
		return Users::Find($this->getUserId());
	}
}