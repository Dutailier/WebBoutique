<?php

define('LANGUAGE_FRENCH', 'FR');
define('LANGUAGE_ENGLISH', 'EN');

/**
 * Class Language
 * Représente une langue.
 */
class Language
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
	 * Initialise la langue.
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
	 * Retourne un tableau contenant les proprités de la langue.
	 *
	 * @return array
	 */
	function getInfoArray()
	{
		return array(
			'code' => $this->getCode(),
			'name' => $this->getName()
		);
	}


	/**
	 * Définit le code de la langue.
	 *
	 * @param mixed $code
	 */
	private function setCode($code)
	{
		$this->code = $code;
	}


	/**
	 * Retourne le code de la langue.
	 *
	 * @return mixed
	 */
	public function getCode()
	{
		return $this->code;
	}


	/**
	 * Définit le nom de la langue.
	 *
	 * @param mixed $name
	 */
	private function setName($name)
	{
		$this->name = $name;
	}


	/**
	 * Retourne le nom de la langue.
	 *
	 * @return mixed
	 */
	public function getName()
	{
		return $this->name;
	}


}