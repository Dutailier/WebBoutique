<?php

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
	private $unitShippingFee;


	/**
	 * Charge les définitions de classes nécessairent à l'initialisation de cet objet.
	 */
	function __autoload()
	{
	}


	/**
	 * Initialise la ligne de commande.
	 *
	 * @param $productSku
	 * @param $unitPrice
	 * @param $unitShippingFee
	 * @param $quantity
	 */
	public function __construct($productSku, $unitPrice, $unitShippingFee, $quantity)
	{
		$this->setProductSku($productSku);
		$this->setUnitPrice($unitPrice);
		$this->setUnitShippingFee($unitShippingFee);
		$this->setQuantity($quantity);
	}


	/**
	 * Retourne un tableau contenant les propriétés de la ligne de commande.
	 *
	 * @return array
	 */
	public function getInfoArray()
	{
		return array(
			'id'               => $this->getId(),
			'orderId'          => $this->getOrderId(),
			'productSku'       => $this->getProductSku(),
			'quantity'         => $this->getQuantity(),
			'unitPrice'        => $this->getUnitPrice(),
			'unitShippingFee'  => $this->getUnitShippingFee(),
			'totalPrice'       => $this->getTotalPrice(),
			'totalShippingFee' => $this->getTotalShippingFee()
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
	 * Définit la valeur de la propriété nommée unitShippingFee.
	 *
	 * @param mixed $unitShippingFee
	 */
	public function setUnitShippingFee($unitShippingFee)
	{
		$this->unitShippingFee = $unitShippingFee;
	}


	/**
	 * Retourne la valeur de la propriété nommée unitShippingFee.
	 *
	 * @return mixed
	 */
	public function getUnitShippingFee()
	{
		return $this->unitShippingFee;
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
	 * Retourne la commande de la ligne.
	 *
	 * @return Order
	 */
	public function getOrder()
	{
		include_once(DIR . 'libs/repositories/orders.php');

		return Orders::Find($this->getOrderId());
	}


	/**
	 * Retourne le produit de la ligne.
	 *
	 * @return Glider|Ottoman|Pilow
	 */
	public function getProduct()
	{
		include_once(DIR . 'libs/repositories/products.php');

		$order = $this->getOrder();

		return Products::Find(
			$this->getProductSku(),
			$order->getUserId()
		);
	}
}