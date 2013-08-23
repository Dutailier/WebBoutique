<?php

include_once(DIR . 'libs/database.php');
include_once(DIR . 'libs/entities/address.php');

/**
 * Class Addresses
 * Gère les différentes méthodes manipulant l'entité Address.
 */
class Addresses
{
	/**
	 * Ajoute une adresse à la base de données.
	 *
	 * @param Address $address
	 *
	 * @return Address
	 * @throws Exception
	 */
	public static function Attach(Address $address)
	{
		$query = 'EXEC [addAddress]';
		$query .= '@userId = \'' . $address->getUserId() . '\', ';
		$query .= '@street = \'' . $address->getStreet() . '\', ';
		$query .= '@city = \'' . $address->getCity() . '\', ';
		$query .= '@zipCode = \'' . $address->getZipCode() . '\', ';
		$query .= '@stateCode = \'' . $address->getStateCode() . '\'';

		$rows = Database::ODBCExecute($query);

		if (empty($rows)) {
			throw new Exception(ERROR_ADDRESS_WASNT_ADDED);
		}

		return $address;
	}


	/**
	 * Retourne l'adresse unique de l'utilisateur.
	 *
	 * @param $userId
	 *
	 * @return Address
	 * @throws Exception
	 */
	public static function FindByUserId($userId)
	{
		$query = 'EXEC [getAddressByUserId]';
		$query .= '@userId = \'' . $userId . '\'';

		$rows = Database::ODBCExecute($query);

		if (empty($rows)) {
			throw new Exception(ERROR_ADDRESS_DOESNT_EXIST);
		}

		return new Address(
			$rows[0]['userId'],
			$rows[0]['stateCode'],
			$rows[0]['street'],
			$rows[0]['city'],
			$rows[0]['zipCode']
		);
	}
}