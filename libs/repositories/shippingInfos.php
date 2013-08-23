<?php

include_once(DIR . 'libs/database.php');
include_once(DIR . 'libs/entities/shippingInfo.php');

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
	 * @throws Exception
	 */
	public static function Attach(ShippingInfo $shippingInfo)
	{
		$query = 'EXEC [addShippingInfo]';
		$query .= '@orderId = \'' . $shippingInfo->getOrderId() . '\', ';
		$query .= '@street = \'' . $shippingInfo->getStreet() . '\', ';
		$query .= '@city = \'' . $shippingInfo->getCity() . '\', ';
		$query .= '@zipCode = \'' . $shippingInfo->getZipCode() . '\', ';
		$query .= '@stateCode = \'' . $shippingInfo->getStateCode() . '\'';

		$rows = Database::ODBCExecute($query);

		if (empty($rows)) {
			throw new Exception(ERROR_SHIPPING_INFO_WASNT_ADDED);
		}

		return $shippingInfo;
	}


	/**
	 * Retourne l'information d'expédition d'une commande.
	 *
	 * @param $id
	 *
	 * @return ShippingInfo
	 * @throws Exception
	 */
	public static function Find($id)
	{
		$query = 'EXEC [getShippingInfoById]';
		$query .= '@id = \'' . intval($id) . '\'';

		$rows = Database::ODBCExecute($query);

		if (empty($row)) {
			throw new Exception(ERROR_SHIPPING_INFO_DOESNT_EXIST);
		}

		return new ShippingInfo(
			$rows[0]['orderId'],
			$rows[0]['street'],
			$rows[0]['city'],
			$rows[0]['zipCode'],
			$rows[0]['stateCode']
		);
	}
}