<?php

include_once(ROOT . 'libs/database.php');
include_once(ROOT . 'libs/entities/store.php');
include_once(ROOT . 'libs/repositories/users.php');

/**
 * class Store
 * Gère les différentes méthodes manipulant l'entité Store.
 */
class Stores
{
	/**
	 * Retourne le commerçant.
	 *
	 * @param $ref
	 *
	 * @return Store
	 * @throws Exception
	 */
	public static function Find($ref)
	{
		// TODO : Implémenter la procédure stockée.
		$query = 'EXEC [getStoreByRef]';
		$query .= '@ref = "' . intval($ref) . '"';

		$rows = Database::Execute($query);

		if (empty($rows)) {
			throw new Exception(ERROR_STORE_DOESNT_EXIST);
		}

		$user = Users::Find($rows[0]['userId']);

		$store = new Store (
			$user->getLanguageCode(),
			$user->getUsername(),
			$user->getPassword(),
			$rows[0]['ref'],
			$rows[0]['name'],
			$rows[0]['phone'],
			$rows[0]['email'],
			$rows[0]['emailRep'],
			$rows[0]['emailAgent']
		);
		$store->setId($user->getId());

		return $store;
	}
}