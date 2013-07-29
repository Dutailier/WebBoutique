<?php

include_once(ROOT . 'libs/repositories/comments.php');

/**
 * Class Comment
 * Représente un commentaire.
 */
class Comment
{
	private $id;
	private $userId;
	private $orderId;
	private $datetime;
	private $text;
	private $commentId;


	/**
	 * Initialise le commantaire.
	 *
	 * @param      $userId
	 * @param      $orderId
	 * @param      $text
	 * @param null $commentId
	 */
	function __construct($userId, $orderId, $text, $commentId = null)
	{
		$this->setUserId($userId);
		$this->setOrderId($orderId);
		$this->setText($text);
		$this->setCommentId($commentId);
	}


	/**
	 * Retourne un tableau contenant les propriétés du commentaire.
	 *
	 * @return array
	 */
	public function getInfoArray()
	{
		return array(
			'id'       => $this->getId(),
			'userId'   => $this->getId(),
			'orderId'  => $this->getOrderId(),
			'datetime' => $this->getDatetime(),
			'text'     => $this->getText()
		);
	}


	/**
	 * Définit l'identifiant du commentaire.
	 *
	 * @param mixed $id
	 */
	public function setId($id)
	{
		$this->id = $id;
	}


	/**
	 * Retourne l'identifiant du commentaire.
	 *
	 * @return mixed
	 */
	public function getId()
	{
		return $this->id;
	}


	/**
	 * Définit l'identifiant de l'auteur du commentaire.
	 *
	 * @param mixed $userId
	 */
	public function setUserId($userId)
	{
		$this->userId = $userId;
	}


	/**
	 * Retourne l'identifiant de l'auteur du commentaire.
	 *
	 * @return mixed
	 */
	public function getUserId()
	{
		return $this->userId;
	}


	/**
	 * Définit l'identifiant de la commande liée au commentaire.
	 *
	 * @param mixed $orderId
	 */
	public function setOrderId($orderId)
	{
		$this->orderId = $orderId;
	}


	/**
	 * Retourne l'identifiant de la commande liée au commentaire.
	 *
	 * @return mixed
	 */
	public function getOrderId()
	{
		return $this->orderId;
	}


	/**
	 * Définit le moment de création du commentaire.
	 *
	 * @param mixed $datetime
	 */
	public function setDatetime($datetime)
	{
		$this->datetime = $datetime;
	}


	/**
	 * Retourne le moment de création du commentaire.
	 *
	 * @return mixed
	 */
	public function getDatetime()
	{
		return $this->datetime;
	}


	/**
	 * Définit le message du commentaire.
	 *
	 * @param mixed $text
	 */
	public function setText($text)
	{
		$this->text = $text;
	}


	/**
	 * Retourne le message du commentaire.
	 *
	 * @return mixed
	 */
	public function getText()
	{
		return $this->text;
	}


	/**
	 * Définit l'identifiant du commentaire auquel ce commentaire répond.
	 *
	 * @param mixed $commentId
	 */
	public function setCommentId($commentId)
	{
		$this->commentId = $commentId;
	}


	/**
	 * Retourne l'identifiant du commentaire auquel ce commentaire répond.
	 *
	 * @return mixed
	 */
	public function getCommentId()
	{
		return $this->commentId;
	}


	/**
	 * Retourne le commentaire auquel ce commentaire répond.
	 *
	 * @return State
	 */
	public function getQuestion()
	{
		return States::find($this->getCommentId());
	}


	/**
	 * Retourne les commentaires répondant à ce commentaire.
	 *
	 * @return array
	 */
	public function getAnswers()
	{
		return Comments::FilterByCommentId($this->getId());
	}
}