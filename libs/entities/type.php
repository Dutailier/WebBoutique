<?php

define('TYPE_OTTOMAN', 5306);
define('TYPE_GLIDER', 5305);
define('TYPE_PILOW', 5804);

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
	 * @param $code
	 * @param $name
	 */
	function __construct($code, $name)
	{
		$this->setCode($code);
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
	private function setCode($code)
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
	private function setName($name)
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