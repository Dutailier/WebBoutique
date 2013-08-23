<?php

/**
 * Class Fabric
 * Représente un tissu.
 */
class Fabric
{
	private $code;
	private $name;
	private $grade;


	/**
	 * Charge les définitions de classes nécessairent à l'initialisation de cet objet.
	 */
	function __autoload()
	{

	}


	/**
	 * Initialise le tissu.
	 *
	 * @param $code
	 * @param $grade
	 * @param $name
	 */
	function __construct($code, $name, $grade)
	{
		$this->setCode($code);
		$this->setName($name);
		$this->setGrade($grade);
	}


	/**
	 * Retourne un tableau contenant les propriétés du tissu.
	 *
	 * @return mixed|void
	 */
	public function getInfoArray()
	{
		return array(
			'code'  => $this->getCode(),
			'name'  => $this->getName(),
			'grade' => $this->getGrade()
		);
	}


	/**
	 * Définit le code du tissu.
	 *
	 * @param mixed $code
	 */
	private function setCode($code)
	{
		$this->code = $code;
	}


	/**
	 * Retourne le code du tissu.
	 *
	 * @return mixed
	 */
	public function getCode()
	{
		return $this->code;
	}


	/**
	 * Définit le nom du tissu.
	 *
	 * @param mixed $name
	 */
	private function setName($name)
	{
		$this->name = $name;
	}


	/**
	 * Retourne le nom du tissu.
	 *
	 * @return mixed
	 */
	public function getName()
	{
		return $this->name;
	}


	/**
	 * Définit le grade du tissu.
	 *
	 * @param mixed $grade
	 */
	private function setGrade($grade)
	{
		$this->grade = $grade;
	}


	/**
	 * Retourne le grade du tissu.
	 *
	 * @return mixed
	 */
	public function getGrade()
	{
		return $this->grade;
	}
}