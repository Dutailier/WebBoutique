<?php

include_once(ROOT . 'libs/repositories/users.php');

/**
 * Class Security
 * Gère les méthodes statiques relatives à la sécurité.
 */
class Security
{
	const USER_IDENTIFIER = '__USER__';


	/**
	 * Retourne vrai si la connexion de l'utilisateur réussie.
	 *
	 * @param $username
	 * @param $password
	 *
	 * @return bool
	 * @throws Exception
	 */
	public static function TryLogin($username, $password)
	{
		if (self::isAuthenticated()) {
			throw new Exception(ERROR_ALREADY_LOGIN);
		}

		$_SESSION[self::USER_IDENTIFIER] = Users::FindByUsernameAndPassword(
			$username,
			$password
		);

		return !empty($_SESSION[self::USER_IDENTIFIER]);
	}


	/**
	 * Retourne vrai si l'utilisateur s'est authentifié.
	 *
	 * @return bool
	 */
	public static function isAuthenticated()
	{
		if (session_id() == '') {
			session_start();
		}

		return !empty($_SESSION[self::USER_IDENTIFIER]);
	}


	/**
	 * Retourne l'utilisateur présentement connecté.
	 *
	 * @return mixed
	 * @throws Exception
	 */
	public static function getUserConnected()
	{
		if (!self::isAuthenticated()) {
			throw new Exception(ERROR_AUTHENTIFICATION_REQUIRED);
		}

		return $_SESSION[self::USER_IDENTIFIER];
	}


	/**
	 * Retourne le rôle de l'utilisateur connecté.
	 *
	 * @return mixed
	 */
	public static function getRole()
	{
		return self::getUserConnected()->getRole();
	}


	/**
	 * Déconnecte l'utilisateur.
	 */
	public static function Logout()
	{
		if (!self::isAuthenticated()) {
			throw new Exception(ERROR_AUTHENTIFICATION_REQUIRED);
		}

		session_destroy();
	}
}