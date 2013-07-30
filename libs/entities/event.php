<?php

/**
 * Class Event
 * Représente un évènement du journal d'évènements.
 */
class Event
{
	private $id;
	private $name;
	private $description;


	/**
	 * Initialise l'évènement.
	 *
	 * @param $id
	 * @param $name
	 * @param $description
	 */
	public function __construct($id, $name, $description)
	{
		$this->setId($id);
		$this->setName($name);
		$this->setDescription($description);
	}


	/**
	 * Retourne un tableau contenant les propriétés de l'évènement.
	 *
	 * @return array
	 */
	public function getInfoArray()
	{
		return array(
			'id'          => $this->getId(),
			'name'        => $this->getName(),
			'description' => $this->getDescription()
		);
	}


	/**
	 * Définit l'identifiant de l'évènement.
	 *
	 * @param mixed $id
	 */
	private function setId($id)
	{
		$this->id = $id;
	}


	/**
	 * Retourne l'identifiant de l'évènement.
	 *
	 * @return mixed
	 */
	public function getId()
	{
		return $this->id;
	}


	/**
	 * Définit le nom de l'évènement.
	 *
	 * @param mixed $name
	 */
	private function setName($name)
	{
		$this->name = $name;
	}


	/**
	 * Retourne le nom de l'évènement.
	 *
	 * @return mixed
	 */
	public function getName()
	{
		return $this->name;
	}


	/**
	 * Définit la description de l'évènement.
	 *
	 * @param mixed $description
	 */
	private function setDescription($description)
	{
		$this->description = $description;
	}


	/**
	 * Retourne la description de l'évènement.
	 *
	 * @return mixed
	 */
	public function getDescription()
	{
		return $this->description;
	}


}