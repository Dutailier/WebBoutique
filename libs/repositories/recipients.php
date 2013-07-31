<?php

include_once(ROOT . 'libs/database.php');
include_once(ROOT . 'libs/entities/recipient.php');

/**
 * Class Recipients
 * Gère les méthodes manipulant l'entité Recipient.
 */
class Recipients
{
	/**
	 * Ajoute un destinateur à une commande.
	 *
	 * @param Recipient $recipient
	 *
	 * @return Recipient
	 * @throws Exception
	 */
	public static function Attach(Recipient $recipient)
	{
		$query = 'EXEC [addRecipient]';
		$query .= '@userId = "' . $recipient->getUserId() . '", ';

		$rows = Database::Execute($query);

		if (empty($rows)) {
			throw new Exception(ERROR_RECIPIENT_WASNT_ADDED);
		}

		return new Recipient(
			$rows[0]['orderId'],
			$rows[0]['languageCode'],
			$rows[0]['greeting'],
			$rows[0]['name'],
			$rows[0]['firstname'],
			$rows[0]['lastname'],
			$rows[0]['phone'],
			$rows[0]['email']
		);
	}


	/**
	 * Retourne le destinateur d'une commande.
	 *
	 * @param $id
	 *
	 * @return Recipient
	 * @throws Exception
	 */
	public static function Find($id)
	{
		$query = 'EXEC [getRecipientById]';
		$query .= '@id = "' . intval($id) . '"';

		$rows = Database::Execute($query);

		if (empty($rows)) {
			throw new Exception(ERROR_RECIPIENT_DOESNT_EXIST);
		}

		return new Recipient(
			$rows[0]['orderId'],
			$rows[0]['languageCode'],
			$rows[0]['greeting'],
			$rows[0]['name'],
			$rows[0]['firstname'],
			$rows[0]['lastname'],
			$rows[0]['phone'],
			$rows[0]['email']
		);
	}
}