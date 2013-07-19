<?php

/**
 * Class Piping
 * Représente un passepoil.
 */
class Piping
{
	private $code;
	private $name;


	/**
	 * Initialise le passepoil.
	 *
	 * @param $name
	 */
	function __construct($name)
	{
		$this->setName = trim($name);
	}


	/**
	 * Retourne un tableau contenant les propriétés du passepoil.
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
	 * Définit le code du passepoil.
	 *
	 * @param mixed $code
	 */
	public function setCode($code)
	{
		$this->code = $code;
	}


	/**
	 * Retourne le code du passepoil.
	 *
	 * @return mixed
	 */
	public function getCode()
	{
		return $this->code;
	}


	/**
	 * Définit le nom du passepoil.
	 *
	 * @param mixed $name
	 */
	public function setName($name)
	{
		$this->name = $name;
	}


	/**
	 * Retourne le nom du passepoil.
	 *
	 * @return mixed
	 */
	public function getName()
	{
		return $this->name;
	}


}