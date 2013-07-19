<?php

/**
 * Class Finish
 * Représente un fini.
 */
class Finish
{
	private $code;
	private $name;


	/**
	 * Initialise le fini.
	 *
	 * @param $name
	 */
	function __construct($name)
	{
		$this->setName = trim($name);
	}


	/**
	 * Retourne un tableau contenant les propriétés du fini.
	 *
	 * @return mixed|void
	 */
	public function getInfoArray()
	{
		return array(
			'code' => $this->getCode(),
			'name' => $this->getName()
		);
	}


	/**
	 * Définit le code du fini.
	 *
	 * @param mixed $code
	 */
	public function setCode($code)
	{
		$this->code = $code;
	}


	/**
	 * Retourne le code du fini.
	 *
	 * @return mixed
	 */
	public function getCode()
	{
		return $this->code;
	}


	/**
	 * Définit le nom du fini.
	 *
	 * @param mixed $name
	 */
	public function setName($name)
	{
		$this->name = $name;
	}


	/**
	 * Retourne le nom du fini.
	 *
	 * @return mixed
	 */
	public function getName()
	{
		return $this->name;
	}


}