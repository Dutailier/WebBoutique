<?php

include_once(ROOT . 'libs/repositories/roles.php');

/**
 * Class User
 * Représente un utilisateur.
 */
class User
{
	private $id;

	private $username;
	private $password;
	private $languageCode;


	/**
	 * Initialise l'utilisateur.
	 *
	 * @param $languageCode
	 * @param $username
	 * @param $password
	 */
	function __construct($languageCode, $username, $password)
	{
		$this->setLanguageCode($languageCode);
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
	 * Retourne le nom d'utilisateur.
	 *
	 * @return mixed
	 */
	public function getUsername()
	{
		return $this->username;
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
		if (strlen($username) > 50) {
			throw new Exception(ERROR_USERNAME_INVALID);
		}

		$this->username = strtolower($username);
	}


	/**
	 * Définit le password d'un utilisateur.
	 *
	 * @param mixed $password
	 */
	public function setPassword($password)
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
	public function setLanguageCode($code)
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
	 * Retourne les rôles de l'utilisateur.
	 *
	 * @return array
	 */
	public function getRoles()
	{
		return Roles::FilterByUserId($this->getId());
	}
}