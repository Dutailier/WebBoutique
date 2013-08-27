<?php

/**
 * Class ShippingInfo
 * Représente les informations d'expédition.
 */
class ShippingInfo
{
	const REGEX_ZIP_CODE_CA = '/^[a-z][0-9][a-z](\s)?[0-9][a-z][0-9]$/i';
	const REGEX_ZIP_CODE_US = '/^[0-9]{5}$/';

	private $orderId;
	private $street;
	private $city;
	private $zipCode;
	private $stateCode;


	/**
	 * Charge les définitions de classes nécessairent à l'initialisation de cet objet.
	 */
	function __autoload()
	{

	}


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
		$this->setStateCode($stateCode);
		$this->setZipCode($zipCode);
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
		include_once(DIR . 'libs/entities/country.php');
		include_once(DIR . 'libs/repositories/states.php');

		switch (States::find($this->getStateCode())->getCountryCode()) {
			case CANADA_CODE :
				if (!preg_match(self::REGEX_ZIP_CODE_CA, $zipCode)) {
					throw new Exception(ERROR_ADDRESS_ZIP_CODE_CA_INVALID);
				}

				$this->zipCode = preg_replace('/\s/', '', $zipCode);
				break;

			case UNITED_STATES_CODE:
				if (!preg_match(self::REGEX_ZIP_CODE_US, $zipCode)) {
					throw new Exception(ERROR_ADDRESS_ZIP_CODE_US_INVALID);
				}

				$this->zipCode = $zipCode;
				break;
		}
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