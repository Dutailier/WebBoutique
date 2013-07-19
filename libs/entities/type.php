<?php

/**
 * Class Type
 * Représente un type de produit.
 */
class Type
{
	private $code;
	private $name;


	/**
	 * Initialise le type.
	 *
	 * @param $name
	 */
	function __construct($name)
	{
		$this->setName($name);
	}


	/**
	 * Retounre un tableau contenant les propriétés du type.
	 *
	 * @return array|mixed
	 */
	function getInfoArray()
	{
		return array(
			'code' => $this->getCode(),
			'name' => $this->getName()
		);
	}


	/**
	 * Définit le code du type de produit.
	 *
	 * @param mixed $code
	 */
	public function setCode($code)
	{
		$this->code = $code;
	}


	/**
	 * Retourne le code du type de produit.
	 *
	 * @return mixed
	 */
	public function getCode()
	{
		return $this->code;
	}


	/**
	 * Définit le nom du type.
	 *
	 * @param mixed $name
	 */
	public function setName($name)
	{
		$this->name = trim($name);
	}


	/**
	 * Retourne le nom du type.
	 *
	 * @return mixed
	 */
	public function getName()
	{
		return $this->name;
	}
}