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

		if (isSet($_SESSION[self::CART_IDENTIFIER])) {
			$this->Copy(unserialize($_SESSION[self::CART_IDENTIFIER]));

		} else {
			$this->items = array();
		}
	}


	/**
	 * Copie le contenu d'un autre panier d'achats.
	 *
	 * @param ICart $cart Le panier d'achats à copier.
	 *
	 * @return void
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
	 * @param IItem $item     L'item à ajouté au panier d'achats.
	 * @param int   $quantity Quantité à ajoutée (défaut = 1).
	 *
	 * @return IItem L'item ayant été ajouté.
	 */
	public function Add(IItem $item, $quantity = 1)
	{
		$index = $this->getIndexOfItem($item);

		if ($index == NOT_FOUND) {
			$this->items[] = $item->setQuantity($quantity);

		} else {
			$item = $this->items[$index];
			$item = $item->setQuantity($item->getQuantity() + $quantity);
		}

		$this->Save();

		return $item;
	}


	/**
	 * Retire un item du panier d'achats.
	 *
	 * @param IItem $item     L'item à retirer du panier d'achats.
	 * @param int   $quantity Quantité à retirée.
	 *
	 * @throws Exception Une exception sera levé si l'item n'est pas contenu dans le panier d'achats.
	 * @return IItem L'item ayant été ajouté au panier d'achats.
	 */
	public function Remove(IItem $item, $quantity = 1)
	{
		$index = $this->getIndexOfItem($item);

		if ($index == NOT_FOUND) {
			throw new Exception(ERROR_ITEM_DOESNT_EXIST);

		} else {
			$item = $this->items[$index];

			if (($quantity = $item->getQuantity() - $quantity) > 0) {
				$item = $item->setQuantity($quantity);

			} else {
				unset($this->items[$index]);
			}
		}

		$this->Save();

		return $item;
	}


	/**
	 * Retourne la quantité de l'item contenue dans le panier d'achats.
	 *
	 * @param IItem $item L'item.
	 *
	 * @return int La quantité de l'item.
	 */
	public function getQuantity(IItem $item)
	{
		$index = $this->getIndexOfItem($item);

		if ($index == NOT_FOUND) {
			return 0; // N'est pas contenu dans le panier d'achats.

		} else {
			$item = $this->items[$index];

			return $item->getQuantity();
		}
	}


	/**
	 * Définit la quantité contenue dans le panier d'achats de l'item.
	 *
	 * @remark Peut être appelée pour ajouter un item d'une quantité supérieure à un.
	 *
	 * @param IItem $item     L'item à modifié.
	 * @param int   $quantity Quantité à inscrire.
	 *
	 * @return IItem L'item ayant été modifié.
	 */
	public function setQuantity(IItem $item, $quantity)
	{
		$item->setQuantity($quantity);

		$index = $this->getIndexOfItem($item);

		if ($index == NOT_FOUND) {

			if ($quantity > 0) {
				$this->items[] = $item;
			}

		} else {

			if ($quantity > 0) {
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
	 * Retourne un tableau fixe de tous les items contenus dans le panier d'achats.
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
	 * @param IItem $item1
	 *
	 * @return int
	 */
	private function getIndexOfItem(IItem $item1)
	{
		foreach ($this->items as $index => $item2) {
			if ($item1->Equals($item2)) {
				return (int)$index;
			}
		}

		return NOT_FOUND;
	}
}
