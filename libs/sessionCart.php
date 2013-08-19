<?php

include_once(ROOT . 'libs/interfaces/icart.php');
include_once(ROOT . 'libs/interfaces/iitem.php');

define('NOT_FOUND', -1);

/**
 * Class Cart
 * Représente un panier d'achats contenu en session.
 */
final class SessionCart implements ICart
{
	const CART_IDENTIFIER = '__CART__';

	private $items;


	/**
	 * Initialise le panier d'achats.
	 */
	public function __construct()
	{
		if (session_id() == '') {
			session_start();
		}

		$this->items = array();

		if (isSet($_SESSION[self::CART_IDENTIFIER])) {
			$this->Copy(unserialize($_SESSION[self::CART_IDENTIFIER]));
		}
	}


	/**
	 * Copie le contenu d'un autre panier d'achats.
	 *
	 * @param ICart $cart
	 *
	 * @return mixed|void
	 */
	public function Copy(ICart $cart)
	{
		$this->items = $cart->getItems();
	}


	/**
	 * Sauvegarde le panier d'achats.
	 */
	public function Save()
	{
		$_SESSION[self::CART_IDENTIFIER] = serialize($this);
	}


	/**
	 * Ajoute un item au panier d'achats.
	 *
	 * @param IItem $item
	 *
	 * @return mixed
	 */
	public function Add(IItem $item)
	{
		$index = $this->getIndexOfItem($item);

		if ($index == NOT_FOUND) {
			$this->items[] = $item;

		} else {
			$item = $this->items[$index];
			$item = $item->setQuantity($item->getQuantity() + 1);
		}

		return $item;
	}


	/**
	 * Retire un item du panier d'achats.
	 * Retourne la quantité de l'item contenue dans le panier d'achats.
	 *
	 * @param IItem $item
	 *
	 * @return mixed
	 * @throws Exception
	 */
	public function Remove(IItem $item)
	{
		$quantity = $item->setQuantity($item->getQuantity() - 1);
		$index    = $this->getIndexOfItem($item);

		if ($index == NOT_FOUND) {
			throw new Exception(ERROR_ITEM_DOESNT_EXIST);

		} else {
			if ($quantity != 0) {
				$this->items[$index] = $item;

			} else {
				unset($this->items[$index]);
			}
		}

		return $item;
	}


	/**
	 * Retourne la quantité de l'item contenue dans le panier d'achats.
	 *
	 * @param IItem $item
	 *
	 * @return int
	 */
	public function getQuantity(IItem $item)
	{
		$index = $this->getIndexOfItem($item);

		if ($index == NOT_FOUND) {
			return 0;

		} else {
			return $this->items[$index]->getQuantity();
		}
	}


	/**
	 * Définit la quantité contenue dans le panier d'achats de l'item.
	 * Peut être appelé pour ajouter un item d'une quantité supérieure à un.
	 *
	 * @param IItem $item
	 * @param       $quantity
	 *
	 * @return mixed
	 */
	public function setQuantity(IItem $item, $quantity)
	{
		$item->setQuantity($quantity);

		$index = $this->getIndexOfItem($item);

		// Si l'item n'est pas trouvé et qui quantité positive est inscrite,
		// on ajoute l'item au panier.
		if ($index == NOT_FOUND && $quantity != 0) {
			$this->items[] = $item;

			// Si l'item est trouvé, modifie sa quantité ou le supprime si
			// celle-ci est nulle.
		} else if ($index != NOT_FOUND) {
			if ($quantity != 0) {
				$this->items[$index] = $item;

			} else {
				unset($this->items[$index]);
			}
		}

		$this->Save();

		return $item;
	}


	/**
	 * Retourne vrai si le panier d'achats ne contient aucun item.
	 *
	 * @return bool
	 */
	public function isEmpty()
	{
		return empty($this->items);
	}


	/**
	 * Retourne un tableau fixe de tous les items.
	 * dans le panier d'achats.
	 *
	 * @return array
	 */
	public function getItems()
	{
		return $this->items;
	}


	/**
	 * Vide le panier d'achats.
	 */
	public function Clear()
	{
		$this->items = array();
		$this->Save();
	}


	/**
	 * Retourne l'index de l'item trouvé sinon retourne NOT_FOUND.
	 *
	 * @param IItem $item
	 *
	 * @return int
	 */
	private function getIndexOfItem(IItem $item)
	{
		foreach ($this->items as $index => $value) {
			if ($item->Equals($value)) {
				return (int)$index;
			}
		}

		return NOT_FOUND;
	}
}
