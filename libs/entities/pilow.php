<?php


/**
 * Class Pilow
 * Représente un coussin lombaire.
 */
class Pilow extends Product
{
	private $fabricCode;


	/**
	 * Initialise le coussin lombaire.
	 *
	 * @param $typeCode
	 * @param $fabricCode
	 */
	function __construct($typeCode, $fabricCode)
	{
		parent::__construct($typeCode);

		$this->setFabricCode($fabricCode);
	}


	/**
	 * Retourne un tableau contenant les propriétés du coussin lombaire.
	 *
	 * @return array
	 */
	public function getInfoArray()
	{
		return array(
			'sku'        => parent::getSku(),
			'typeCode'   => $this->getTypeCode(),
			'fabricCode' => $this->getFabricCode()
		);
	}


	/**
	 * Définit le code du tissu du coussin lombaire.
	 *
	 * @param mixed $fabricCode
	 */
	public function setFabricCode($fabricCode)
	{
		$this->fabricCode = $fabricCode;
	}


	/**
	 * Retourne le code du tissu du coussin lombaire.
	 *
	 * @return mixed
	 */
	public function getFabricCode()
	{
		return $this->fabricCode;
	}


}