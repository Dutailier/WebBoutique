<?php

include_once(ROOT . 'libs/entity.php');

/**
 * Class Type
 * Représente un type de produit.
 */
class Type extends Entity
{
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
	function getArray()
	{
		return array(
			'id'   => $this->getId(),
			'name' => $this->getName()
		);
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