<?php

/**
 * Class Customer
 * Représente un consommateur.
 * (Cet object sera utiliser lors d'une publication d'une version B2C.)
 */
class Customer extends User
{
	private $greeting;
	private $firstname;
	private $lastname;
	private $phone;
	private $email;


	/**
	 * Initialise le consommateur.
	 *
	 * @param $languageCode
	 * @param $username
	 * @param $password
	 * @param $greeting
	 * @param $firstname
	 * @param $lastname
	 * @param $phone
	 * @param $email
	 */
	function __construct(
		$languageCode, $username, $password,
		$greeting, $firstname, $lastname, $phone, $email)
	{
		parent::__construct($languageCode, $username, $password);
		parent::setRole(ROLE_CUSTOMER);

		$this->setGreeting($greeting);
		$this->setFirstname($firstname);
		$this->setLastname($lastname);
		$this->setPhone($phone);
		$this->setEmail($email);
	}


	/**
	 * Retourne un tableau contenant les différentes propriétés du consommateur.
	 *
	 * @return array
	 */
	public function getInfoArray()
	{
		return array(
			'userId'       => parent::getId(),
			'languageCode' => parent::getLanguageCode(),
			'username'     => parent::getUsername(),
			'greeting'     => $this->getGreeting(),
			'firstname'    => $this->getFirstname(),
			'lastname'     => $this->getLastname(),
			'phone'        => $this->getPhone(),
			'email'        => $this->getEmail()
		);
	}


	/**
	 * Définit la salutation du consommateur (ex : M., Mme., etc...).
	 *
	 * @param mixed $greeting
	 */
	public function setGreeting($greeting)
	{
		$this->greeting = $greeting;
	}


	/**
	 * Retourne la salutation du consommateur (ex : M., Mme., etc...).
	 *
	 * @return mixed
	 */
	public function getGreeting()
	{
		return $this->greeting;
	}


	/**
	 * Définit le prénom du consommateur.
	 *
	 * @param mixed $firstname
	 */
	public function setFirstname($firstname)
	{
		$this->firstname = $firstname;
	}


	/**
	 * Retourne le prénom du consommateur.
	 *
	 * @return mixed
	 */
	public function getFirstname()
	{
		return $this->firstname;
	}


	/**
	 * Définit le nom de famille du consommateur.
	 *
	 * @param mixed $lastname
	 */
	public function setLastname($lastname)
	{
		$this->lastname = $lastname;
	}


	/**
	 * Retourne le nom de famille du consommateur.
	 *
	 * @return mixed
	 */
	public function getLastname()
	{
		return $this->lastname;
	}


	/**
	 * Définit le numéro de téléphone du consommateur.
	 *
	 * @param mixed $phone
	 */
	public function setPhone($phone)
	{
		$this->phone = $phone;
	}


	/**
	 * Retourne le numéro de téléphone du consommateur.
	 *
	 * @return mixed
	 */
	public function getPhone()
	{
		return $this->phone;
	}


	/**
	 * Définit l'adresse courriel du consommateur.
	 *
	 * @param mixed $email
	 */
	public function setEmail($email)
	{
		$this->email = $email;
	}


	/**
	 * Retourne l'adresse courriel du consommateur.
	 *
	 * @return mixed
	 */
	public function getEmail()
	{
		return $this->email;
	}


}