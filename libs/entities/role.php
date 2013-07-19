<?php

/**
 * Class Role
 * Représente un rôle.
 */
class Role
{
	private $id;
	private $name;


	/**
	 * Constructeur par défaut.
	 *
	 * @param $name
	 */
	function __construct($name)
	{
		$$this->setName($name);
	}


	/**
	 * Retourne un tableau contenant les propriétés de l'objet.
	 *
	 * @return array
	 */
	public function getInfoArray()
	{
		return array(
			'id'   => $this->getId(),
			'name' => $this->getName()
		);
	}


	/**
	 * Définit l'identifiant du rôle.
	 *
	 * @param mixed $id
	 */
	public function setId($id)
	{
		$this->id = $id;
	}


	/**
	 * Retourne l'identifiant du rôle.
	 *
	 * @return mixed
	 */
	public function getId()
	{
		return $this->id;
	}


	/**
	 * Retourne le nom du rôle.
	 *
	 * @return string
	 */
	public function getName()
	{
		return $this->name;
	}


	/**
	 * Définit le nom du rôle.
	 *
	 * @param string $name
	 */
	public function setName($name)
	{
		$this->name = trim($name);
	}
}