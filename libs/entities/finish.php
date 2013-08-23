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
	 * Charge les définitions de classes nécessairent à l'initialisation de cet objet.
	 */
	function __autoload()
	{
	}


	/**
	 * Initialise le fini.
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
	 * Retourne un tableau contenant les propriétés du fini.
	 *
	 * @return mixed|void
	 */
	public
	function getInfoArray()
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
	private
	function setCode($code)
	{
		$this->code = $code;
	}


	/**
	 * Retourne le code du fini.
	 *
	 * @return mixed
	 */
	public
	function getCode()
	{
		return $this->code;
	}


	/**
	 * Définit le nom du fini.
	 *
	 * @param mixed $name
	 */
	private
	function setName($name)
	{
		$this->name = $name;
	}


	/**
	 * Retourne le nom du fini.
	 *
	 * @return mixed
	 */
	public
	function getName()
	{
		return $this->name;
	}


}