<?php

/**
 * Class Store
 * Représente un commerçant.
 */
class Store extends User
{
	const REGEX_EMAIL = '/[A-Z0-9._%-]+@[A-Z0-9.-]+\.[A-Z]{2,4}/i';
	const REGEX_PHONE = '/^1?[-.\s]?\(?([0-9]{3})\)?[-.\s]?([0-9]{3})[-.\s]?([0-9]{4})$/';

	private $ref;
	private $name;
	private $phone;
	private $email;
	private $emailRep;
	private $emailAgent;
	private $maxAmountByOrder;
	private $maxAmountByDay;
	private $maxAmoutByMonth;


	/**
	 * Charge les définitions de classes nécessairent à l'initialisation de cet objet.
	 */
	function __autoload()
	{
		include_once(DIR . 'libs/entities/user.php');
	}


	/**
	 * Initialise un commerçant.
	 *
	 * @param $languageCode
	 * @param $username
	 * @param $password
	 * @param $ref
	 * @param $name
	 * @param $phone
	 * @param $email
	 * @param $emailRep
	 * @param $emailAgent
	 */
	function __construct(
		$languageCode, $username, $password,
		$ref, $name, $phone, $email, $emailRep, $emailAgent)
	{
		parent::__construct($languageCode, ROLE_STORE, $username, $password);

		$this->setRef($ref);
		$this->setName($name);
		$this->setPhone($phone);
		$this->setEmail($email);
		$this->setEmailRep($emailRep);
		$this->setEmailAgent($emailAgent);
	}


	/**
	 * Retourne un tableau contenant les différentes propriétés du commerçant.
	 *
	 * @return array
	 */
	public function getInfoArray()
	{
		return array_merge(
			parent::getInfoArray(),
			array(
				'ref'        => $this->getRef(),
				'name'       => $this->getName(),
				'phone'      => $this->getPhone(),
				'email'      => $this->getEmail(),
				'emailRep'   => $this->getEmailRep(),
				'emailAgent' => $this->getEmailAgent(),
			)
		);
	}


	/**
	 * Définit la référence (Dutailier) du commerçant.
	 *
	 * @param mixed $ref
	 */
	private function setRef($ref)
	{
		$this->ref = $ref;
	}


	/**
	 * Retourne la référence (Dutailier) du commerçant.
	 *
	 * @return mixed
	 */
	public function getRef()
	{
		return $this->ref;
	}


	/**
	 * Définit le nom du commerçant.
	 *
	 * @param mixed $name
	 */
	private function setName($name)
	{
		$this->name = $name;
	}


	/**
	 * Retourne le nom du commerçant.
	 *
	 * @return mixed
	 */
	public function getName()
	{
		return $this->name;
	}


	/**
	 * Définit le numéro de téléphone du commerçant.
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
	 * Retourne le numéro de téléphone du commerçant.
	 *
	 * @return mixed
	 */
	public function getPhone()
	{
		return $this->phone;
	}


	/**
	 * Définit l'adresse courriel du commerçant.
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
	 * Retourne l'adresse courriel du commerçant.
	 *
	 * @return mixed
	 */
	public function getEmail()
	{
		return $this->email;
	}


	/**
	 * Définit l'adresse courriel du réprensentant (Dutailier) du commerçant.
	 *
	 * @param $emailRep
	 *
	 * @throws Exception
	 */
	private function setEmailRep($emailRep)
	{
		if (!preg_match(self::REGEX_EMAIL, $emailRep)) {
			throw new Exception(ERROR_STORE_EMAIL_REP_INVALID);
		}

		$this->emailRep = $emailRep;
	}


	/**
	 * Retourne l'adresse courriel du représentant (Dutailier) du commerçant.
	 *
	 * @return mixed
	 */
	public function getEmailRep()
	{
		return $this->emailRep;
	}


	/**
	 * Définit l'adresse courriel de l'agent (Dutailier) du commerçant.
	 *
	 * @param $emailAgent
	 *
	 * @throws Exception
	 */
	private function setEmailAgent($emailAgent)
	{
		if (!preg_match(self::REGEX_EMAIL, $emailAgent)) {
			throw new Exception(ERROR_STORE_EMAIL_AGENT_INVALID);
		}

		$this->emailAgent = $emailAgent;
	}


	/**
	 * Retourne l'adresse courriel de l'agent (Dutailier) du commerçant.
	 *
	 * @return mixed
	 */
	public function getEmailAgent()
	{
		return $this->emailAgent;
	}


	/**
	 * Définit la valeur de la propriété nommée maxAmountByOrder.
	 *
	 * @param mixed $maxAmountByOrder
	 */
	public function setMaxAmountByOrder($maxAmountByOrder)
	{
		$this->maxAmountByOrder = $maxAmountByOrder;
	}


	/**
	 * Retourne la valeur de la propriété nommée maxAmountByOrder.
	 *
	 * @return mixed
	 */
	public function getMaxAmountByOrder()
	{
		return $this->maxAmountByOrder;
	}


	/**
	 * Définit la valeur de la propriété nommée maxAmountByDay.
	 *
	 * @param mixed $maxAmountByDay
	 */
	public function setMaxAmountByDay($maxAmountByDay)
	{
		$this->maxAmountByDay = $maxAmountByDay;
	}


	/**
	 * Retourne la valeur de la propriété nommée maxAmountByDay.
	 *
	 * @return mixed
	 */
	public function getMaxAmountByDay()
	{
		return $this->maxAmountByDay;
	}


	/**
	 * Définit la valeur de la propriété nommée maxAmoutByMonth.
	 *
	 * @param mixed $maxAmoutByMonth
	 */
	public function setMaxAmountByMonth($maxAmoutByMonth)
	{
		$this->maxAmoutByMonth = $maxAmoutByMonth;
	}


	/**
	 * Retourne la valeur de la propriété nommée maxAmoutByMonth.
	 *
	 * @return mixed
	 */
	public function getMaxAmoutByMonth()
	{
		return $this->maxAmoutByMonth;
	}
}