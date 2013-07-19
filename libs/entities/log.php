<?php

/**
 * Class Log
 * Représente un enregistrement dans le journal d'évènements.
 */
class Log
{
	private $id;
	private $orderId;
	private $userId;
	private $event;
	private $datetime;


	/**
	 * Initialise l'enregistrement du journal d'évènements.
	 *
	 * @param $orderId
	 * @param $userId
	 * @param $event
	 */
	function __construct($orderId, $userId, $event)
	{
		$this->setOrderId($orderId);
		$this->setUserId($userId);
		$this->setEvent($event);
	}


	/**
	 * Retourne un tableau contenant les différentes propriétés
	 * d'un enregistrement du journal d'évènements.
	 *
	 * @return array
	 */
	public function getInfoArray()
	{
		return array(
			'id'       => $this->getId(),
			'orderId'  => $this->getOrderId(),
			'userId'   => $this->getUserId(),
			'event'    => $this->getEvent(),
			'datetime' => $this->getDatetime()
		);
	}


	/**
	 * Définit l'identifiant de l'enregistrement du journal d'évènements.
	 *
	 * @param mixed $id
	 */
	public function setId($id)
	{
		$this->id = $id;
	}


	/**
	 * Retourne l'identifiant de l'enregistrement du journal d'évènements.
	 *
	 * @return mixed
	 */
	public function getId()
	{
		return $this->id;
	}


	/**
	 * Définit l'identifiant de la commande de l'enregistrement du journal d'évènements.
	 *
	 * @param mixed $orderId
	 */
	public function setOrderId($orderId)
	{
		$this->orderId = $orderId;
	}


	/**
	 * Retourne l'identifiant de la commande de l'enregistrement du journal d'évènements.
	 *
	 * @return mixed
	 */
	public function getOrderId()
	{
		return $this->orderId;
	}


	/**
	 * Définit l'identifiant de l'auteur de l'enregistrement du journal d'évènements.
	 *
	 * @param mixed $userId
	 */
	public function setUserId($userId)
	{
		$this->userId = $userId;
	}


	/**
	 * Retourne l'identifiant de l'auteur de l'enregistrement du journal d'évènements.
	 *
	 * @return mixed
	 */
	public function getUserId()
	{
		return $this->userId;
	}


	/**
	 * Définit l'évènement de l'enregistrement du journal d'évènements.
	 *
	 * @param mixed $event
	 */
	public function setEvent($event)
	{
		$this->event = $event;
	}


	/**
	 * Retourne l'évènement de l'enregistrement du journal d'évènements.
	 *
	 * @return mixed
	 */
	public function getEvent()
	{
		return $this->event;
	}


	/**
	 * Définit le moment de création de l'enregistrement du journal d'évènements.
	 *
	 * @param mixed $datetime
	 */
	public function setDatetime($datetime)
	{
		$this->datetime = $datetime;
	}


	/**
	 * Retourne le moment de création de l'enregistrement du journal d'évènements.
	 *
	 * @return mixed
	 */
	public function getDatetime()
	{
		return $this->datetime;
	}
}