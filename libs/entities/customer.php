<?php

/**
 * Class Customer
 * Représente un consommateur.
 * (Cet object sera utiliser lors d'une publication d'une version B2C.)
 */
class Customer extends User
{
	const REGEX_EMAIL = '/[A-Z0-9._%-]+@[A-Z0-9.-]+\.[A-Z]{2,4}/i';
	const REGEX_PHONE = '/^[1]?[.-]?[0-9]{3}[.-]?[0-9]{3}[.-]?[0-9]{4}$/';

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
		parent::__construct($languageCode, ROLE_CUSTOMER, $username, $password);

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
		return array_merge(
			parent::getInfoArray(),
			array(
				'greeting'  => $this->getGreeting(),
				'firstname' => $this->getFirstname(),
				'lastname'  => $this->getLastname(),
				'phone'     => $this->getPhone(),
				'email'     => $this->getEmail()
			)
		);
	}


	/**
	 * Définit la salutation du consommateur (ex : M., Mme., etc...).
	 *
	 * @param mixed $greeting
	 */
	private function setGreeting($greeting)
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
	private function setFirstname($firstname)
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
	private function setLastname($lastname)
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
	 * @param $phone
	 *
	 * @throws Exception
	 */
	private function setPhone($phone)
	{
		if (!preg_match(self::REGEX_PHONE, $phone)) {
			throw new Exception(ERROR_STORE_PHONE_INVALID);
		}

		$phone = preg_replace('/\D/', '', $phone);
		$phone = strlen($phone) == 10 ? 1 + $phone : $phone;

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
	 * @param $email
	 *
	 * @throws Exception
	 */
	private function setEmail($email)
	{
		if (!preg_match(self::REGEX_EMAIL, $email)) {
			throw new Exception(ERROR_STORE_EMAIL_INVALID);
		}

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