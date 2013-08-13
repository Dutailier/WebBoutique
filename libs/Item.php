<?php

include_once(ROOT . 'libs/interfaces/iitem.php');

/**
 * Class Item
 * Représente un item du panier d'achats de la Web Boutique.
 */
class Item implements IItem
{
	private $product;
	private $quantity;


	/**
	 * Initialise l'item.
	 *
	 * @param Product $product
	 */
	function __construct(Product $product)
	{
		$this->setProduct($product);
		$this->setPrice($price);
		$this->setShippingFee($shippingFee);
		$this->setQuantity($quantity);
	}


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
}