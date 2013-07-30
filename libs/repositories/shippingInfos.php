<?php

include_once(ROOT . 'libs/database.php');
include_once(ROOT . 'libs/entities/shippingInfo.php');

/**
 * Class ShippingInfos
 * Gère les méthodes manipulant l'entité ShippingInfo.
 */
class ShippingInfos
{
	/**
	 * Ajoute l'information d'expéiditon à une commande.
	 *
	 * @param ShippingInfo $shippingInfo
	 *
	 * @return ShippingInfo
	 */
	public static function Attach(ShippingInfo $shippingInfo)
	{
		$query = 'EXEC [addShippingInfo]';
		$query .= '@userId = "' . $shippingInfo->getUserId() . '", ';

		$rows = Database::Execute($query);

		return new ShippingInfo(
			$rows[0]['orderId'],
			$rows[0]['street'],
			$rows[0]['city'],
			$rows[0]['zipCode'],
			$rows[0]['stateCode']
		);
	}


	/**
	 * Retourne l'information d'expédition d'une commande.
	 *
	 * @param $id
	 *
	 * @return ShippingInfo
	 */
	public static function Find($id)
	{
		$query = 'EXEC [getShippingInfoById]';
		$query .= '@id = "' . intval($id) . '"';

		$rows = Database::Execute($query);

		return new ShippingInfo(
			$rows[0]['orderId'],
			$rows[0]['street'],
			$rows[0]['city'],
			$rows[0]['zipCode'],
			$rows[0]['stateCode']
		);
	}
}