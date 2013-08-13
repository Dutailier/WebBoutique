<?php

include_once(ROOT . 'libs/repositories/types.php');

/**
 * Représente un produit.
 */
abstract class Product
{
	private $sku;
	private $typeCode;
	private $imageName;
	private $price;


	/**
	 * Initialise le produit.
	 *
	 * @param $typeCode
	 * @param $imageName
	 * @param $price
	 */
	function __construct($typeCode, $imageName, $price)
	{
		$this->setTypeCode($typeCode);
		$this->setImageName($imageName);
		$this->setPrice($price);
	}


	/**
	 * Retourne un tableau contenant les différentes propriétés du produits.
	 */
	public function getInfoArray()
	{
		return array(
			'sku'       => $this->getSku(),
			'typeCode'  => $this->getTypeCode(),
			'imageName' => $this->getImageName(),
			'price'     => $this->getPrice()
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
	 * Définit le nom du fichier image du produit.
	 *
	 * @param mixed $imageName
	 */
	public function setImageName($imageName)
	{
		$this->imageName = $imageName;
	}


	/**
	 * Retourne le nom du fichier image du produit.
	 *
	 * @return mixed
	 */
	public function getImageName()
	{
		return $this->imageName;
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


	/**
	 * Définit le prix du produit.
	 *
	 * @param mixed $price
	 */
	public function setPrice($price)
	{
		$this->price = $price;
	}


	/**
	 * Retourne le prix du produit.
	 *
	 * @return mixed
	 */
	public function getPrice()
	{
		return $this->price;
	}
}