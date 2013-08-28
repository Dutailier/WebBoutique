<?php

/**
 * Class RecipientInfo
 * Représente le destinateur d'une commande.
 */
class RecipientInfo
{
	const REGEX_EMAIL = '/[A-Z0-9._%-]+@[A-Z0-9.-]+\.[A-Z]{2,4}/i';
	const REGEX_PHONE = '/^1?[-.\s]?\(?([0-9]{3})\)?[-.\s]?([0-9]{3})[-.\s]?([0-9]{4})$/';

	private $orderId;
	private $languageCode;
	private $greeting;
	private $name;
	private $firstname;
	private $lastname;
	private $phone;
	private $email;


	/**
	 * Charge les définitions de classes nécessairent à l'initialisation de cet objet.
	 */
	function __autoload()
	{

	}


	/**
	 * Initialise le destinateur de la commande.
	 *
	 * @param $languageCode
	 * @param $greeting
	 * @param $name
	 * @param $firstname
	 * @param $lastname
	 * @param $phone
	 * @param $email
	 */
	function __construct($languageCode, $greeting, $name, $firstname, $lastname, $phone, $email)
	{
		$this->setLanguageCode($languageCode);
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
	 * Définit le numéro de téléphone du destinataire.
	 *
	 * @param $phone
	 *
	 * @throws Exception
	 */
	public function setPhone($phone)
	{
		if (!preg_match(self::REGEX_PHONE, $phone)) {
			throw new Exception(ERROR_RECIPIENT_PHONE_INVALID);
		}

		$phone = preg_replace('/\D/', '', $phone);
		$phone = strlen($phone) == 10 ? 1 . $phone : $phone;

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
	 * Définit l'adresse courriel du destinataire.
	 *
	 * @param $email
	 *
	 * @throws Exception
	 */
	public function setEmail($email)
	{
		if (!preg_match(self::REGEX_EMAIL, $email)) {
			throw new Exception(ERROR_RECIPIENT_EMAIL_INVALID);
		}

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


	/**
	 * Retourne le nom du consommateur.
	 *
	 * @return string
	 */
	public function getFullName()
	{
		return
			$this->getGreeting() . ' ' .
			$this->getFirstname() . ' ' .
			$this->getLastname();
	}
}