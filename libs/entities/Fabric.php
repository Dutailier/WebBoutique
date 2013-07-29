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
	 * Initialise le tissu.
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
	public function setCode($code)
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
	public function setName($name)
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
	public function setGrade($grade)
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