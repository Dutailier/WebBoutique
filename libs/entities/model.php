<?php

/**
 * Class Model
 * Représente un modèle de produit.
 */
class Model
{
	private $code;
	private $name;


	/**
	 * Initialise le modèle.
	 *
	 * @param $name
	 */
	function __construct($name)
	{
		$this->setName = trim($name);
	}


	/**
	 * Retourne un tableau contenant les propriétés du modèle.
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
	 * Définit le code du modèle.
	 *
	 * @param mixed $code
	 */
	public function setCode($code)
	{
		$this->code = $code;
	}


	/**
	 * Retourne le code du modèle.
	 *
	 * @return mixed
	 */
	public function getCode()
	{
		return $this->code;
	}


	/**
	 * Définit le nom du modèle.
	 *
	 * @param mixed $name
	 */
	public function setName($name)
	{
		$this->name = $name;
	}


	/**
	 * Retourne le nom du modèle.
	 *
	 * @return mixed
	 */
	public function getName()
	{
		return $this->name;
	}
}