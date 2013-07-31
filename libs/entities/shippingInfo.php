<?php

/**
 * Class ShippingInfo
 * Représente les informations d'expédition.
 */
class ShippingInfo
{
	private $orderId;
	private $street;
	private $city;
	private $zipCode;
	private $stateCode;


	/**
	 * Initialise les informations d'expédition.
	 *
	 * @param $street
	 * @param $city
	 * @param $zipCode
	 * @param $stateCode
	 */
	function __construct($street, $city, $zipCode, $stateCode)
	{
		$this->setStreet($street);
		$this->setCity($city);
		$this->setZipCode($zipCode);
		$this->setStateCode($stateCode);
	}


	/**
	 * Retourne un tableau contenant les différentes propriétés des informations d'expédtion.
	 *
	 * @return array
	 */
	public function getInfoArray()
	{
		return array(
			'orderId'   => $this->getOrderId(),
			'street'    => $this->getStreet(),
			'city'      => $this->getCity(),
			'zipCode'   => $this->getZipCode(),
			'stateCode' => $this->getStateCode()
		);
	}


	/**
	 * Définit l'identifiant de la commande des informations d'expédition.
	 *
	 * @param mixed $orderId
	 */
	public function setOrderId($orderId)
	{
		$this->orderId = $orderId;
	}


	/**
	 * Retourne l'identifiant de la commande des informations d'expédition.
	 *
	 * @return mixed
	 */
	public function getOrderId()
	{
		return $this->orderId;
	}


	/**
	 * Définit le numéro civique des informations d'expédition.
	 *
	 * @param mixed $street
	 */
	public function setStreet($street)
	{
		$this->street = $street;
	}


	/**
	 * Retourne le numéro civique des informations d'expédition.
	 *
	 * @return mixed
	 */
	public function getStreet()
	{
		return $this->street;
	}


	/**
	 * Définit la ville des informations d'expédition.
	 *
	 * @param mixed $city
	 */
	public function setCity($city)
	{
		$this->city = $city;
	}


	/**
	 * Retourne la ville des informations d'expédition.
	 *
	 * @return mixed
	 */
	public function getCity()
	{
		return $this->city;
	}


	/**
	 * Définit le code postal des informations d'expédition.
	 *
	 * @param mixed $zipCode
	 */
	public function setZipCode($zipCode)
	{
		$this->zipCode = $zipCode;
	}


	/**
	 * Retourne le code postal des informations d'expédition.
	 *
	 * @return mixed
	 */
	public function getZipCode()
	{
		return $this->zipCode;
	}


	/**
	 * Définit le code de l'état ou province des informations d'expédition.
	 *
	 * @param mixed $stateCode
	 */
	public function setStateCode($stateCode)
	{
		$this->stateCode = $stateCode;
	}


	/**
	 * Retourne le code de l'état ou province des informations d'expédition.
	 *
	 * @return mixed
	 */
	public function getStateCode()
	{
		return $this->stateCode;
	}
}