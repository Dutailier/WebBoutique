<?php

include_once(ROOT . 'libs/database.php');
include_once(ROOT . 'libs/entities/log.php');

/**
 * Class Logs
 * Gère les différentes méthodes manipulant l'entité Log.
 */
class Logs
{
	/**
	 * Retourne le entrée du journal d'évènements.
	 *
	 * @param $id
	 *
	 * @return Log
	 * @throws Exception
	 */
	public static function Find($id)
	{
		$query = 'EXEC [getLogById]';
		$query .= '@id = "' . intval($id) . '"';

		$rows = Database::Execute($query);

		if (empty($rows)) {
			throw new Exception(ERROR_LOG_DOESNT_EXIST);
		}

		return new Log(
			$rows[0]['id'],
			$rows[0]['userId'],
			$rows[0]['orderId'],
			$rows[0]['eventId'],
			$rows[0]['datetime']
		);
	}


	/**
	 * Retourne les entrées du journal d'évènements d'une commande.
	 *
	 * @param $orderId
	 *
	 * @return array
	 */
	public static function FilterByOrderId($orderId)
	{
		$query = 'EXEC [getLogsByOrderId]';
		$query .= '@orderId = "' . intval($orderId) . '"';

		$rows = Database::Execute($query);

		$logs = array();
		foreach ($rows as $row) {
			$logs[] = new Log(
				$row['id'],
				$row['userId'],
				$row['orderId'],
				$row['eventId'],
				$row['datetime']
			);
		}

		return $logs;
	}
}