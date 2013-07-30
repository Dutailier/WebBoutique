<?php

include_once(ROOT . 'libs/repositories/types.php');

/**
 * Représente un produit.
 */
abstract class Product
{
	private $sku;
	private $typeCode;


	/**
	 * Initialise le produit.
	 *
	 * @param $typeCode
	 */
	function __construct($typeCode)
	{
		$this->setTypeCode($typeCode);
	}


	/**
	 * Retourne un tableau contenant les différentes propriétés du produits.
	 */
	public function getInfoArray()
	{
		return array(
			'sku'      => $this->getSku(),
			'typeCode' => $this->getTypeCode()
		);
	}


	/**
	 * Définit le sku du produit.
	 *
	 * @param mixed $sku
	 */
	public function setSku($sku)
	{
		$this->sku = $sku;
	}


	/**
	 * Retourne le sku du produit.
	 *
	 * @return mixed
	 */
	public function getSku()
	{
		return $this->sku;
	}


	/**
	 * Définit le code du type de produit.
	 *
	 * @param mixed $typeCode
	 */
	private function setTypeCode($typeCode)
	{
		$this->typeCode = $typeCode;
	}


	/**
	 * Retourne le code du type du produit.
	 *
	 * @return mixed
	 */
	public function getTypeCode()
	{
		return $this->typeCode;
	}


	/**
	 * Retourne le type de ce produit.
	 *
	 * @return Type
	 */
	public function getType()
	{
		return Types::Find($this->getTypeCode());
	}
}