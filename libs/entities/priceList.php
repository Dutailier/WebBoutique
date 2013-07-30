<?php


/**
 * Class PriceList
 * Représente une liste de prix.
 */
class PriceList
{
	private $code;


	/**
	 * Initialise la liste de prix.
	 *
	 * @param $code
	 */
	function __construct($code)
	{
		$this->setCode($code);
	}


	/**
	 * Retourne un tableau contenant les propriétés de la liste de prix.
	 *
	 * @return array
	 */
	public function getInfoArray()
	{
		return array(
			'code' => $this->getCode()
		);
	}


	/**
	 * Définit le code de la liste de prix.
	 *
	 * @param mixed $code
	 */
	private function setCode($code)
	{
		$this->code = $code;
	}


	/**
	 * Retourne le code de la liste de prix.
	 *
	 * @return mixed
	 */
	public function getCode()
	{
		return $this->code;
	}
}