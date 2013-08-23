<?php

/**
 * Représente un produit.
 */
abstract class Product
{
	private $sku;
	private $typeCode;
	private $imageName;
	private $price;
	private $shippingFee;


	/**
	 * Charge les définitions de classes nécessairent à l'initialisation de cet objet.
	 */
	function __autoload()
	{
	}


	/**
	 * Initialise le produit.
	 *
	 * @param $typeCode
	 * @param $imageName
	 * @param $price
	 * @param $shippingFee
	 */
	function __construct($typeCode, $imageName, $price, $shippingFee)
	{
		$this->setTypeCode($typeCode);
		$this->setImageName($imageName);
		$this->setPrice($price);
		$this->setShippingFee($shippingFee);
	}


	/**
	 * Retourne un tableau contenant les différentes propriétés du produits.
	 */
	public function getInfoArray()
	{
		return array(
			'sku'         => $this->getSku(),
			'typeCode'    => $this->getTypeCode(),
			'imageName'   => $this->getImageName(),
			'price'       => $this->getPrice(),
			'shippingFee' => $this->getShippingFee()
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


	/**
	 * Définit les frais d'expédition.
	 *
	 * @param mixed $shippingFee
	 */
	public function setShippingFee($shippingFee)
	{
		$this->shippingFee = $shippingFee;
	}


	/**
	 * Retourne les frais d'expédition.
	 *
	 * @return mixed
	 */
	public function getShippingFee()
	{
		return $this->shippingFee;
	}


	/**
	 * Retourne le type de ce produit.
	 *
	 * @return Type
	 */
	public function getType()
	{
		include_once(DIR . 'libs/repositories/types.php');

		return Types::Find($this->getTypeCode());
	}
}