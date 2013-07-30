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
	 * @param $code
	 * @param $name
	 */
	function __construct($code, $name)
	{
		$this->setCode($code);
		$this->setName($name);
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
	private function setCode($code)
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
	private function setName($name)
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