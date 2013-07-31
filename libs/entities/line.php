<?php

include_once(ROOT . 'libs/repositories/order.php');
include_once(ROOT . 'libs/repositories/products.php');

/**
 * Class Line
 * Représente une ligne de commande.
 */
class Line
{
	private $id;
	private $orderId;
	private $productSku;
	private $quantity;
	private $unitPrice;
	private $grossPrice;


	/**
	 * Initialise la ligne de commande.
	 *
	 * @param $productSku
	 * @param $quantity
	 * @param $unitPrice
	 * @param $grossPrice
	 */
	public function __construct($productSku, $quantity, $unitPrice, $grossPrice)
	{
		$this->setProductSku($productSku);
		$this->setQuantity($quantity);
		$this->setUnitPrice($unitPrice);
		$this->setGrossPrice($grossPrice);
	}


	/**
	 * Retourne un tableau contenant les propriétés de la ligne de commande.
	 *
	 * @return array
	 */
	public function getInfoArray()
	{
		return array(
			'id'         => $this->getId(),
			'orderId'    => $this->getOrderId(),
			'productSku' => $this->getProductSku(),
			'quantity'   => $this->getQuantity(),
			'unitPrice'  => $this->getUnitPrice(),
			'grossPrice' => $this->getGrossPrice()
		);
	}


	/**
	 * Définit l'identifiant de la ligne de commande.
	 *
	 * @param mixed $id
	 */
	public function setId($id)
	{
		$this->id = $id;
	}


	/**
	 * Retourne l'identifiant de la ligne de commande.
	 *
	 * @return mixed
	 */
	public function getId()
	{
		return $this->id;
	}


	/**
	 * Définit l'identifiant de la commande de la ligne.
	 *
	 * @param mixed $orderId
	 */
	public function setOrderId($orderId)
	{
		$this->orderId = $orderId;
	}


	/**
	 * Retourne l'identifiant de la commande de la ligne.
	 *
	 * @return mixed
	 */
	public function getOrderId()
	{
		return $this->orderId;
	}


	/**
	 * Définit le SKU du produit de la ligne de commande.
	 *
	 * @param mixed $productSku
	 */
	private function setProductSku($productSku)
	{
		$this->productSku = $productSku;
	}


	/**
	 * Retourne le SKU du produit de la ligne de commande.
	 *
	 * @return mixed
	 */
	public function getProductSku()
	{
		return $this->productSku;
	}


	/**
	 * Définit la quantité du produit de la ligne de commande.
	 *
	 * @param mixed $quantity
	 */
	private function setQuantity($quantity)
	{
		$this->quantity = $quantity;
	}


	/**
	 * Retourne la quantité du produit de la ligne de commande.
	 *
	 * @return mixed
	 */
	public function getQuantity()
	{
		return $this->quantity;
	}


	/**
	 * Définit le prix unitaire du produit de la ligne de commande.
	 *
	 * @param mixed $unitPrice
	 */
	private function setUnitPrice($unitPrice)
	{
		$this->unitPrice = $unitPrice;
	}


	/**
	 * Retourne le prix unitaire du produit de la ligne de commande.
	 *
	 * @return mixed
	 */
	public function getUnitPrice()
	{
		return $this->unitPrice;
	}


	/**
	 * Définit le prix d'ensemble du produit de la ligne de commande.
	 *
	 * @param mixed $grossPrice
	 */
	private function setGrossPrice($grossPrice)
	{
		$this->grossPrice = $grossPrice;
	}


	/**
	 * Retourne le prix d'ensemble du produit de la ligne de commande.
	 *
	 * @return mixed
	 */
	public function getGrossPrice()
	{
		return $this->grossPrice;
	}


	/**
	 * Retourne la commande de la ligne.
	 *
	 * @return Order
	 */
	public function getOrder()
	{
		return Orders::Find($this->getOrderId());
	}


	/**
	 * Retourne le produit de la ligne.
	 *
	 * @return Glider|Ottoman|Pilow
	 */
	public function getProduct()
	{
		return Products::Find($this->getProductSku());
	}
}