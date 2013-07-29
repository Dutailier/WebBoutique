<?php

include_once(ROOT . 'libs/repositories/states.php');

/**
 * Class Address
 * Représente une adresse.
 */
class Address
{
	private $userId;
	private $stateCode;
	private $street;
	private $city;
	private $zipCode;


	/**
	 * Initialise l'adresse.
	 *
	 * @param $userId
	 * @param $stateCode
	 * @param $street
	 * @param $city
	 * @param $zipCode
	 */
	function __construct($userId, $stateCode, $street, $city, $zipCode)
	{
		$this->setUserId($userId);
		$this->setStateCode($stateCode);
		$this->setStreet($street);
		$this->setCity($city);
		$this->setZipCode($zipCode);
	}


	/**
	 * Retourne un tableau contenant les différentes propriétés de l'adresse.
	 *
	 * @return array
	 */
	function getInfoArray()
	{
		return array(
			'userIdd'   => $this->getUserId(),
			'stateCode' => $this->getStateCode(),
			'street'    => $this->getStreet(),
			'city'      => $this->getCity(),
			'zipCode'   => $this->getZipCode()
		);
	}


	/**
	 * Définit l'identifiant de l'adresse.
	 *
	 * @param mixed $id
	 */
	public function setUserId($id)
	{
		$this->userId = $id;
	}


	/**
	 * Retourne l'identifiant de l'adresse.
	 *
	 * @return mixed
	 */
	public function getUserId()
	{
		return $this->userId;
	}


	/**
	 * Définit le code de l'état ou province de l'adresse.
	 *
	 * @param mixed $stateCode
	 */
	public function setStateCode($stateCode)
	{
		$this->stateCode = $stateCode;
	}


	/**
	 * Retourne le code de l'état ou province de l'adresse.
	 *
	 * @return mixed
	 */
	public function getStateCode()
	{
		return $this->stateCode;
	}


	/**
	 * Définit le numéro civique de l'adresse.
	 *
	 * @param mixed $street
	 */
	public function setStreet($street)
	{
		$this->street = $street;
	}


	/**
	 * Retourne le numéro civique de l'adresse.
	 *
	 * @return mixed
	 */
	public function getStreet()
	{
		return $this->street;
	}


	/**
	 * Définit la ville de l'adresse.
	 *
	 * @param mixed $city
	 */
	public function setCity($city)
	{
		$this->city = $city;
	}


	/**
	 * Retourne la ville de l'adresse.
	 *
	 * @return mixed
	 */
	public function getCity()
	{
		return $this->city;
	}


	/**
	 * Définit le code postal de l'adresse.
	 *
	 * @param mixed $zipCode
	 */
	public function setZipCode($zipCode)
	{
		$this->zipCode = $zipCode;
	}


	/**
	 * Retourne le code postal de l'adresse.
	 *
	 * @return mixed
	 */
	public function getZipCode()
	{
		return $this->zipCode;
	}


	/**
	 * Retourne l'état ou province de l'adresse.
	 *
	 * @return State
	 */
	public function getState()
	{
		return States::find($this->getStateCode());
	}
}