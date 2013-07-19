<?php

class Product
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
	public function setTypeCode($typeCode)
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
}