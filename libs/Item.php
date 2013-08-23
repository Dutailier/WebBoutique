<?php

include_once(DIR . 'libs/interfaces/iitem.php');

/**
 * Class Item
 * Représente un item du panier d'achats de la Web Boutique.
 */
class Item implements IItem
{
	private $product;
	private $quantity;


	/**
	 * Charge les définitions de classes nécessairent à l'initialisation de cet objet.
	 */
	function __autoload()
	{
	}


	/**
	 * Initialise l'item.
	 *
	 * @param Product $product
	 * @param         $quantity
	 */
	function __construct(Product $product, $quantity = 1)
	{
		$this->setProduct($product);
		$this->setQuantity($quantity);
	}


	/**
	 * Retourne un tableau contenant les propriétés de l'item.
	 *
	 * @return array
	 */
	public function getInfoArray()
	{
		return array_merge(
			$this->getProduct()->getInfoArray(),
			array(
				'model'            => $this->getProduct()->getModel()->getInfoArray(),
				'quantity'         => $this->getQuantity(),
				'totalPrice'       => $this->getTotalPrice(),
				'totalShippingFee' => $this->getTotalShippingFee()
			)
		);
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
		return $this->quantity;
	}


	/**
	 * Définit la quantité.
	 *
	 * @param $quantity
	 *
	 * @return mixed|void
	 */
	public function setQuantity($quantity)
	{
		$this->quantity = $quantity;
	}


	/**
	 * Retourne le prix total des produits.
	 *
	 * @return mixed
	 */
	public function getTotalPrice()
	{
		return $this->getQuantity() * $this->getProduct()->getPrice();
	}


	/**
	 * Retourne les frais totaux d'expédition.
	 *
	 * @return mixed
	 */
	public function getTotalShippingFee()
	{
		return $this->getQuantity() * $this->getProduct()->getShippingFee();
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