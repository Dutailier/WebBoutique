<?php

include_once(ROOT . 'libs/database.php');
include_once(ROOT . 'libs/entities/recipientInfo.php');

/**
 * Class RecipientInfos
 * Gère les méthodes manipulant l'entité RecipientInfo.
 */
class RecipientInfos
{
	/**
	 * Ajoute un destinateur à une commande.
	 *
	 * @param RecipientInfo $recipient
	 *
	 * @return RecipientInfo
	 * @throws Exception
	 */
	public static function Attach(RecipientInfo $recipient)
	{
		$query = 'EXEC [addRecipient]';
		$query .= '@userId = "' . $recipient->getUserId() . '", ';

		$rows = Database::Execute($query);

		if (empty($rows)) {
			throw new Exception(ERROR_RECIPIENT_WASNT_ADDED);
		}

		return new RecipientInfo(
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
	 * @return RecipientInfo
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

		return new RecipientInfo(
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