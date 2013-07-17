<?php

include_once(ROOT . 'libs/language.php');
include_once(ROOT . 'libs/repositories/users.php');
include_once(ROOT . 'libs/repositories/roles.php');

/**
 * Class Security
 * Gère les méthodes statiques relatives à la sécurité.
 */
class Security
{
	const USER_IDENTIFIER = '_USER_';


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

		$_SESSION[self::USER_IDENTIFIER] = Users::FindByUsernameAndPassword($username, $password);
		$_SESSION[Language::LANGUAGE_IDENTITIFER] = self::getUserConnected()->getLanguageCode();

		return !empty($_SESSION[self::USER_IDENTIFIER]);
	}


	/**
	 * Ajoute un utilisateur à un rôle.
	 *
	 * @param User $user
	 * @param      $name
	 *
	 * @throws Exception
	 */
	public static function addUserToRoleName(User $user, $name)
	{
		if (!$user->isAttached()) {
			throw new Exception(ERROR_USER_DOESNT_EXIST);
		}

		Roles::addUserToRoleName($user, $name);
	}


	/**
	 * Retourne vrai si l'utilisateur détient se rôle.
	 *
	 * @param $name
	 *
	 * @return bool
	 * @throws Exception
	 */
	public static function isInRoleName($name)
	{
		if (!self::isAuthenticated()) {
			throw new Exception(ERROR_AUTHENTIFICATION_REQUIRED);
		}

		$user = self::getUserConnected();

		return self::UserIsInRoleName($user, $name);
	}


	/**
	 * Retourne vrai si l'utilisateur détient le rôle.
	 *
	 * @param User $user
	 * @param      $name
	 *
	 * @return bool
	 */
	public static function UserIsInRoleName(User $user, $name)
	{
		foreach ($user->getRoles() as $role) {
			if (strtolower($role->getName()) == strtolower($name)) {
				return true;
			}
		}

		return false;
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