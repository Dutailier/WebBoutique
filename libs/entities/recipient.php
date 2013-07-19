<?php

/**
 * Class Recipient
 * Représente le destinateur d'une commande.
 */
class Recipient
{
	private $orderId;
	private $languageCode;
	private $greeting;
	private $name;
	private $firstname;
	private $lastname;
	private $phone;
	private $email;


	/**
	 * Initialise le destinateur de la commande.
	 *
	 * @param $orderId
	 * @param $languageCode
	 * @param $greeting
	 * @param $name
	 * @param $firstname
	 * @param $lastname
	 * @param $phone
	 * @param $email
	 */
	function __construct($orderId, $languageCode, $greeting, $name, $firstname, $lastname, $phone, $email)
	{
		$this->setOrderId($orderId);
		$this->setLanguageCode($lastname);
		$this->setGreeting($greeting);
		$this->setName($name);
		$this->setFirstname($firstname);
		$this->setLastname($lastname);
		$this->setPhone($phone);
		$this->setEmail($email);
	}


	/**
	 * Retourne un tableau contenant les différentes propriétés du destinateur d'une commande.
	 *
	 * @return array
	 */
	public function getInfoArray()
	{
		return array(
			'orderId'      => $this->getOrderId(),
			'languageCode' => $this->getLanguageCode(),
			'greeting'     => $this->getGreeting(),
			'name'         => $this->getName(),
			'firstname'    => $this->getFirstname(),
			'lastname'     => $this->getLastname(),
			'phone'        => $this->getPhone(),
			'email'        => $this->getEmail()
		);
	}


	/**
	 * Définit l'identifiant de la commande du destinateur.
	 *
	 * @param mixed $orderId
	 */
	public function setOrderId($orderId)
	{
		$this->orderId = $orderId;
	}


	/**
	 * Retourne l'identifiant de la commande du destinateur.
	 *
	 * @return mixed
	 */
	public function getOrderId()
	{
		return $this->orderId;
	}


	/**
	 * Définit le code de la langue du destinateur.
	 *
	 * @param mixed $languageCode
	 */
	public function setLanguageCode($languageCode)
	{
		$this->languageCode = $languageCode;
	}


	/**
	 * Retourne le code de la langue du destinateur.
	 *
	 * @return mixed
	 */
	public function getLanguageCode()
	{
		return $this->languageCode;
	}


	/**
	 * Définit la salution du destinateur.
	 *
	 * @param mixed $greeting
	 */
	public function setGreeting($greeting)
	{
		$this->greeting = $greeting;
	}


	/**
	 * Retourne la salutation du destinateur.
	 *
	 * @return mixed
	 */
	public function getGreeting()
	{
		return $this->greeting;
	}


	/**
	 * Définit le nom du destinateur.
	 * (Applicable si le destinateur est un commerçant.)
	 *
	 * @param mixed $name
	 */
	public function setName($name)
	{
		$this->name = $name;
	}


	/**
	 * Retourne le nom du destinateur.
	 * (Applicable si le destinateur est un commerçant.)
	 *
	 * @return mixed
	 */
	public function getName()
	{
		return $this->name;
	}


	/**
	 * Définit le prénom du destinateur.
	 *
	 * @param mixed $firstname
	 */
	public function setFirstname($firstname)
	{
		$this->firstname = $firstname;
	}


	/**
	 * Retourne le prénom du destinateur.
	 *
	 * @return mixed
	 */
	public function getFirstname()
	{
		return $this->firstname;
	}


	/**
	 * Définit le nom de famille du destinateur.
	 *
	 * @param mixed $lastname
	 */
	public function setLastname($lastname)
	{
		$this->lastname = $lastname;
	}


	/**
	 * Retourne le nom de famille du destinateur.
	 *
	 * @return mixed
	 */
	public function getLastname()
	{
		return $this->lastname;
	}


	/**
	 * Définit le numéro de téléphone du destinateur.
	 *
	 * @param mixed $phone
	 */
	public function setPhone($phone)
	{
		$this->phone = $phone;
	}


	/**
	 * Retourne le numéro de téléphone du destinateur.
	 *
	 * @return mixed
	 */
	public function getPhone()
	{
		return $this->phone;
	}


	/**
	 * Définit l'adresse courriel du destinateur.
	 *
	 * @param mixed $email
	 */
	public function setEmail($email)
	{
		$this->email = $email;
	}


	/**
	 * Retourne l'adresse courriel du destinateur.
	 *
	 * @return mixed
	 */
	public function getEmail()
	{
		return $this->email;
	}
}