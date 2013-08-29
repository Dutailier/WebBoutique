<?php

include_once(DIR . 'libs/database.php');

/**
 * Class Email
 * Gère les différentes méthodes permettant d'envoyer des courriels.
 */
class Email
{
	/**
	 * Envoie un courriel de confirmation de la commande.
	 *
	 * @param $orderId
	 * @param $email
	 */
	public static function sendOrderConfirmation($orderId, $email)
	{
		$query = 'EXEC [dbo].[sendOrderConfirmationEmail]';
		$query .= '@orderId = \'' . $orderId . '\', ';
		$query .= '@email = \'' . $email . '\'';

		Database::ODBCExecute($query);
	}


	/**
	 * Envoie un courriel de confirmation de la modification du mot de passe du commerçant.
	 *
	 * @param $ref
	 * @param $password
	 */
	public static function sendStoreConfirmation($ref, $password)
	{
		$query = 'EXEC [dbo].[sendStoreConfirmationEmail]';
		$query .= '@orderId = \'' . $ref . '\', ';
		$query .= '@email = \'' . $password . '\'';

		Database::ODBCExecute($query);
	}
}
