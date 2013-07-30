<?php

/**
 * Class Store
 * Représente un commerçant.
 */
class Store extends User
{
	private $ref;
	private $name;
	private $phone;
	private $email;
	private $emailRep;
	private $emailAgent;


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
		return array(
			'userId'       => parent::getId(),
			'languageCode' => parent::getLanguageCode(),
			'username'     => parent::getUsername(),
			'ref'          => $this->getRef(),
			'name'         => $this->getName(),
			'phone'        => $this->getPhone(),
			'email'        => $this->getEmail(),
			'emailRep'     => $this->getEmailRep(),
			'emailAgent'   => $this->getEmailAgent()
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
	 * @param mixed $phone
	 */
	private function setPhone($phone)
	{
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
	 * @param mixed $email
	 */
	private function setEmail($email)
	{
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
	 * @param mixed $emailRep
	 */
	private function setEmailRep($emailRep)
	{
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
	 * @param mixed $emailAgent
	 */
	private function setEmailAgent($emailAgent)
	{
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


}