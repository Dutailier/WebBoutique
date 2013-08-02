<?php

include_once(ROOT . 'libs/repositories/states.php');

define('CANADA_CODE', 'CA');
define('UNITED_STATES_CODE', 'US');

/**
 * Class Country
 * Représente un pays.
 */
class Country
{
	private $code;
	private $name;


	/**
	 * Initialise le pays.
	 *
	 * @param $code
	 * @param $name
	 */
	function __construct($code, $name)
	{
		$this->setCode($code);
		$this->setName($name);
	}


	/**
	 * Retourne un tableau contenant les propriétés du pays.
	 *
	 * @return array
	 */
	public function getInfoArray()
	{
		return array(
			'code' => $this->getCode(),
			'name' => $this->getName()
		);
	}


	/**
	 * Définit le code du pays.
	 *
	 * @param mixed $code
	 */
	private function setCode($code)
	{
		$this->code = $code;
	}


	/**
	 * Retourne le code du pays.
	 *
	 * @return mixed
	 */
	public function getCode()
	{
		return $this->code;
	}


	/**
	 * Définit le nom du pays.
	 *
	 * @param mixed $name
	 */
	private function setName($name)
	{
		$this->name = $name;
	}


	/**
	 * Retourne le nom du pays.
	 *
	 * @return mixed
	 */
	public function getName()
	{
		return $this->name;
	}


	/**
	 * Retourne les états ou provinces de ce pays.
	 *
	 * @return array|State
	 */
	public function getStates()
	{
		return States::filterByCountryCode($this->getCode());
	}
}