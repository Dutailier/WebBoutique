<?php

include_once(ROOT . 'libs/localisation.php');
include_once(ROOT . 'libs/database.php');
include_once(ROOT . 'libs/entities/store.php');

include_once(Localisation::getLanguageFile());

/**
 * Class Stores
 * Gère les méthodes manipulant l'entité Store.
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
		$query = 'EXEC [getStoreByRef]';
		$query .= '@ref = \'' . $ref . '\'';

		$rows = Database::ODBCExecute($query);

		if (empty($rows)) {
			throw new Exception(ERROR_STORE_DOESNT_EXIST);
		}

		$store = new Store(
			$rows[0]['languageCode'],
			$rows[0]['username'],
			$rows[0]['password'],
			$rows[0]['ref'],
			$rows[0]['name'],
			$rows[0]['phone'],
			$rows[0]['email'],
			$rows[0]['emailRep'],
			$rows[0]['emailAgent']
		);
		$store->setId($rows[0]['id']);
		$store->setMaxAmountByOrder($rows[0]['maxAmountByOrder']);
		$store->setMaxAmountByDay($rows[0]['maxAmountByDay']);
		$store->setMaxAmountByMonth($rows[0]['maxAmountByMonth']);

		return $store;
	}


	/**
	 * Retourne tous les commerçants.
	 */
	public static function All()
	{
		$query = 'EXEC [getStores]';

		$rows = Database::ODBCExecute($query);

		$stores = array();
		foreach ($rows as $row) {
			$store = new Store(
				$row['languageCode'],
				$row['username'],
				$row['password'],
				$row['ref'],
				$row['name'],
				$row['phone'],
				$row['email'],
				$row['emailRep'],
				$row['emailAgent']
			);
			$store->setId($row['id']);
			$store->setMaxAmountByOrder($row['maxAmountByOrder']);
			$store->setMaxAmountByDay($row['maxAmountByDay']);
			$store->setMaxAmountByMonth($row['maxAmountByMonth']);

			$stores[] = $store;
		}

		return $stores;
	}
}