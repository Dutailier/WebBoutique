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
	private $eventId;
	private $datetime;


	/**
	 * Initialise l'enregistrement du journal d'évènements.
	 *
	 * @param $id
	 * @param $orderId
	 * @param $userId
	 * @param $eventId
	 * @param $datetime
	 */
	function __construct($id, $orderId, $userId, $eventId, $datetime)
	{
		$this->setId($id);
		$this->setOrderId($orderId);
		$this->setUserId($userId);
		$this->setEventId($eventId);
		$this->setDatetime($datetime);
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
			'eventId'  => $this->getEventId(),
			'datetime' => $this->getDatetime()
		);
	}


	/**
	 * Définit l'identifiant de l'enregistrement du journal d'évènements.
	 *
	 * @param mixed $id
	 */
	private function setId($id)
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
	private function setOrderId($orderId)
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
	private function setUserId($userId)
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
	 * Définit l'identifiant de l'évènement de l'enregistrement du journal d'évènements.
	 *
	 * @param mixed $event
	 */
	private function setEventId($event)
	{
		$this->eventId = $event;
	}


	/**
	 * Retourne l'identifiant de l'évènement de l'enregistrement du journal d'évènements.
	 *
	 * @return mixed
	 */
	public function getEventId()
	{
		return $this->eventId;
	}


	/**
	 * Définit le moment de création de l'enregistrement du journal d'évènements.
	 *
	 * @param mixed $datetime
	 */
	private function setDatetime($datetime)
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