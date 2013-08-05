<?php

include_once(ROOT . 'libs/repositories/addresses.php');

define('ROLE_ADMINISTRATOR', 0);
define('ROLE_CUSTOMER', 1);
define('ROLE_STORE', 2);

/**
 * Class User
 * Représente un utilisateur.
 */
class User
{
	private $id;
	private $role;
	private $languageCode;
	private $username;
	private $password;


	/**
	 * Initialise l'utilisateur.
	 *
	 * @param $languageCode
	 * @param $role
	 * @param $username
	 * @param $password
	 */
	function __construct($languageCode, $role, $username, $password)
	{
		$this->setLanguageCode($languageCode);
		$this->setRole($role);
		$this->setUsername($username);
		$this->setPassword($password);
	}


	/**
	 * Retourne un tableau contenant les informations de l'utilisateur.
	 *
	 * @return array|mixed
	 */
	public function getInfoArray()
	{
		return array(
			'id'           => $this->getId(),
			'role'         => $this->getRole(),
			'languageCode' => $this->getLanguageCode(),
			'username'     => $this->getUsername()
		);
	}


	/**
	 * Définit l'identifiant de l'utilisateur.
	 *
	 * @param mixed $id
	 */
	public function setId($id)
	{
		$this->id = $id;
	}


	/**
	 * Retourne l'identifiant de l'utlisateur.
	 *
	 * @return mixed
	 */
	public function getId()
	{
		return $this->id;
	}


	/**
	 * Définit le rôle de l'utilisateur.
	 *
	 * @param mixed $role
	 */
	private function setRole($role)
	{
		$this->role = $role;
	}


	/**
	 * Retourne le rôle de l'utilsateur.
	 *
	 * @return mixed
	 */
	public function getRole()
	{
		return $this->role;
	}


	/**
	 * Définit le nom d'utilisteur.
	 *
	 * @param $username
	 *
	 * @throws Exception
	 */
	private function setUsername($username)
	{
		$this->username = strtolower($username);
	}


	/**
	 * Retourne le nom d'utilisateur.
	 *
	 * @return mixed
	 */
	public function getUsername()
	{
		return $this->username;
	}


	/**
	 * Définit le password d'un utilisateur.
	 *
	 * @param mixed $password
	 */
	private function setPassword($password)
	{
		$this->password = $password;
	}


	/**
	 * Retourne le password d'un utilisateur.
	 *
	 * @return mixed
	 */
	public function getPassword()
	{
		return $this->password;
	}


	/**
	 * Définit la langue de l'utilisateur.
	 *
	 * @param mixed $code
	 */
	private function setLanguageCode($code)
	{
		$this->languageCode = strtolower($code);
	}


	/**
	 * Retourne la langue de l'utilisateur.
	 *
	 * @return mixed
	 */
	public function getLanguageCode()
	{
		return $this->languageCode;
	}


	/**
	 * Retourne l'adresse de l'utilisateur.
	 *
	 * @return Address
	 */
	public function getAddress()
	{
		return Addresses::FindByUserId($this->getId());
	}
}