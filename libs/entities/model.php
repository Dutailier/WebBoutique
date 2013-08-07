<?php

/**
 * Class Model
 * Représente un modèle de produit.
 */
class Model
{
	private $code;
	private $typeCode;
	private $name;
	private $description;


	/**
	 * Initialise le modèle.
	 *
	 * @param      $code
	 * @param      $name
	 * @param null $description
	 */
	function __construct($code, $name, $description = null)
	{
		$this->setCode($code);
		$this->setName($name);
		$this->setDescription($description);
	}


	/**
	 * Retourne un tableau contenant les propriétés du modèle.
	 *
	 * @return mixed|void
	 */
	public function getInfoArray()
	{
		return array(
			'code'        => $this->getCode(),
			'typeCode'    => $this->getTypeCode(),
			'name'        => $this->getName(),
			'description' => $this->getDescription()
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
	 * Définit le code du type du modèle.
	 *
	 * @param mixed $typeCode
	 */
	public function setTypeCode($typeCode)
	{
		$this->typeCode = $typeCode;
	}


	/**
	 * Retourne le code du type du modèle.
	 *
	 * @return mixed
	 */
	public function getTypeCode()
	{
		return $this->typeCode;
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


	/**
	 * Définit la description du modèle.
	 *
	 * @param mixed $description
	 */
	public function setDescription($description)
	{
		$this->description = $description;
	}


	/**
	 * Retourne la description du modèle.
	 *
	 * @return mixed
	 */
	public function getDescription()
	{
		return $this->description;
	}
}