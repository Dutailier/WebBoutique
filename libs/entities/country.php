<?php

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
	 * @param $name
	 */
	function __construct($name)
	{
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
	public function setCode($code)
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
	public function setName($name)
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
}