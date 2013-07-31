<?php

include_once(ROOT . 'libs/interfaces/iitem.php');

/**
 * Class Item
 * Représente un item du panier d'achats de la Web Boutique.
 */
class Item implements IItem
{
	private $quantity;
	private $product;
	private $unitPrice;
	private $grossPrice;


	/**
	 * Retourne vrai si l'objet passé est égale à l'objet courant.
	 *
	 * @param $object
	 *
	 * @return mixed
	 */
	public function Equals($object)
	{
		return
			$object instanceof self &&
			$object->product->getSku() == $this->product->getSku();
	}


	/**
	 * Retourne la quantité.
	 *
	 * @return mixed
	 */
	public function getQuantity()
	{
		return $this->getQuantity();
	}


	/**
	 * Définit la quantité.
	 *
	 * @param $quantity
	 *
	 * @return mixed|void
	 * @throws Exception
	 */
	public function setQuantity($quantity)
	{
		if (($quantity = intval($quantity)) < 0) {
			throw new Exception(ERROR_POSITIVE_QUANTITY_REQUIRED);
		}

		$this->quantity = $quantity;
	}


	/**
	 * Définit le produit.
	 *
	 * @param mixed $product
	 */
	public function setProduct(Product $product)
	{
		$this->product = $product;
	}


	/**
	 * Retourne le produit.
	 *
	 * @return mixed
	 */
	public function getProduct()
	{
		return $this->product;
	}


	/**
	 * Définit le prix à l'unité du produit.
	 *
	 * @param mixed $unitPrice
	 */
	public function setUnitPrice($unitPrice)
	{
		$this->unitPrice = $unitPrice;
	}


	/**
	 * Retourne le prix à l'unité du produit.
	 *
	 * @return mixed
	 */
	public function getUnitPrice()
	{
		return $this->unitPrice;
	}


	/**
	 * Définit le prix d'ensemble.
	 *
	 * @param mixed $grossPrice
	 */
	public function setGrossPrice($grossPrice)
	{
		$this->grossPrice = $grossPrice;
	}


	/**
	 * Retourne le prix d'ensemble.
	 *
	 * @return mixed
	 */
	public function getGrossPrice()
	{
		return isSet($this->grossPrice) ?
			$this->grossPrice : $this->quantity * $this->unitPrice;
	}


}