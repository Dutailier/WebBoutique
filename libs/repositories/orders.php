<?php

include_once(ROOT . 'libs/database.php');
include_once(ROOT . 'libs/entities/order.php');

/**
 * Class Orders
 * Gère les méthodes manipulant l'entité Order.
 */
class Orders
{
	/**
	 * Ajoute une commande à la base de données.
	 *
	 * @param Order $order
	 *
	 * @return Order
	 */
	public static function Attach(Order $order)
	{
		$query = 'EXEC [addOrder]';
		$query .= '@userId = "' . $order->getUserId() . '", ';

		$rows = Database::Execute($query);

		$order = new Order(
			$rows[0]['userId']
		);

		$order->setId($rows[0]['id']);
		$order->setRef($rows[0]['ref']);
		$order->setNumber($rows[0]['number']);
		$order->setStatus($rows[0]['status']);
		$order->setDatetime($rows[0]['datetime']);

		return $order;
	}


	/**
	 * Retourne la commande.
	 *
	 * @param $id
	 *
	 * @return Order
	 */
	public static function Find($id)
	{
		$query = 'EXEC [getOrderById]';
		$query .= '@id = "' . intval($id) . '"';

		$rows = Database::Execute($query);

		$order = new Order(
			$rows[0]['userId']
		);

		$order->setId($rows[0]['id']);
		$order->setRef($rows[0]['ref']);
		$order->setNumber($rows[0]['number']);
		$order->setStatus($rows[0]['status']);
		$order->setDatetime($rows[0]['datetime']);

		return $order;
	}
}