<?php


/**
 * Class Address
 * Représente une adresse.
 */
class Address
{
	const REGEX_ZIP_CODE_CA = '/^[a-z][0-9][a-z](\s)?[0-9][a-z][0-9]$/i';
	const REGEX_ZIP_CODE_US = '/^[0-9]{5}$/';

	private $userId;
	private $stateCode;
	private $street;
	private $city;
	private $zipCode;


	/**
	 * Charge les définitions de classes nécessairent à l'initialisation de cet objet.
	 */
	function __autoload()
	{
	}


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
			'userId'    => $this->getUserId(),
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
	private function setUserId($id)
	{
		$this->userId = intval($id);
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
	 * @param $zipCode
	 *
	 * @throws Exception
	 */
	public function setZipCode($zipCode)
	{
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
		include_once(DIR . 'libs/repositories/states.php');

		return States::find($this->getStateCode());
	}
}