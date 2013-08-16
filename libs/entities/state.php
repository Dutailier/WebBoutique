<?php

include_once(ROOT . 'libs/repositories/countries.php');

/**
 * Class State
 * Représente un état ou une province d'un pays.
 */
class State
{
	private $code;
	private $name;
	private $countryCode;


	/**
	 * Initialise l'état ou la province.
	 *
	 * @param $code
	 * @param $countryCode
	 * @param $name
	 */
	function __construct($code, $countryCode, $name)
	{
		$this->setCode($code);
		$this->setCountryCode($countryCode);
		$this->setName($name);
	}


	/**
	 * Retourne un tableau contenant les propriétés de l'état ou province.
	 *
	 * @return array
	 */
	public function getInfoArray()
	{
		return array(
			'code'        => $this->getCode(),
			'countryCode' => $this->getCountryCode(),
			'name'        => $this->getName()
		);
	}


	/**
	 * Définit le code de l'état ou de la province.
	 *
	 * @param mixed $code
	 */
	private function setCode($code)
	{
		$this->code = $code;
	}


	/**
	 * Retourne le code de l'état ou de la province.
	 *
	 * @return mixed
	 */
	public function getCode()
	{
		return $this->code;
	}


	/**
	 * Définit le code du pays de cet état ou de cette province.
	 *
	 * @param mixed $countryCode
	 */
	private function setCountryCode($countryCode)
	{
		$this->countryCode = $countryCode;
	}


	/**
	 * Retourne le code du pays de cet état ou de cette province.
	 *
	 * @return mixed
	 */
	public function getCountryCode()
	{
		return $this->countryCode;
	}


	/**
	 * Définit le nom de l'état ou de la province.
	 *
	 * @param mixed $name
	 */
	private function setName($name)
	{
		$this->name = $name;
	}


	/**
	 * Retourne le nom de l'état ou de la province.
	 *
	 * @return mixed
	 */
	public function getName()
	{
		return $this->name;
	}


	/**
	 * Retourne le pays de cet état ou de cette province.
	 *
	 * @return Country
	 */
	public function getCountry()
	{
		return Countries::Find($this->getCountryCode());
	}

}