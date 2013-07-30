<?php

include_once(ROOT . 'libs/language.php');
include_once(ROOT . 'libs/database.php');
include_once(ROOT . 'libs/entities/user.php');

include_once(Language::getLanguageFile());

/**
 * Class Users
 * Gère les différentes méthodes manipulant l'entité user.
 */
class Users
{
	/**
	 * Ajoute un utilisateur à la base de données.
	 *
	 * @param User $user
	 *
	 * @return User
	 * @throws Exception
	 */
	public static function Attach(User $user)
	{
		// TODO : Implémenter la procédure stockée.
		$query = 'EXEC [addUser]';
		$query .= '@languageCode = "' . $user->getLanguageCode() . '", ';
		$query .= '@role = "' . $user->getRole() . '", ';
		$query .= '@username = "' . $user->getUsername() . '", ';
		$query .= '@password = "' . $user->getPassword() . '"';

		$rows = Database::Execute($query);

		if (empty($rows)) {
			throw new Exception(ERROR_USER_WASNT_ADDED);
		}

		$user->setId($rows[0]['id']);

		return $user;
	}


	/**
	 * Retourne l'utilisateur.
	 *
	 * @param $id
	 *
	 * @return Customer|Store|User
	 * @throws Exception
	 */
	public static function Find($id)
	{
		$query = 'EXEC [getUserById]';
		$query .= '@id = "' . intval($id) . '"';

		$rows = Database::Execute($query);

		if (empty($rows)) {
			throw new Exception(ERROR_USER_DOESNT_EXIST);
		}

		$user = null;
		switch ($rows[0]['role']) {
			case ROLE_ADMINISTRATOR:
				$user = new User (
					$rows[0]['LanguageCode'],
					$rows[0]['username'],
					$rows[0]['password']
				);
				break;

			case ROLE_CUSTOMER:
				$user = new Customer (
					$rows[0]['LanguageCode'],
					$rows[0]['username'],
					$rows[0]['password'],
					$rows[0]['greeting'],
					$rows[0]['firstname'],
					$rows[0]['lastname'],
					$rows[0]['phone'],
					$rows[0]['email']
				);
				break;

			case ROLE_STORE:
				$user = new Store (
					$rows[0]['LanguageCode'],
					$rows[0]['username'],
					$rows[0]['password'],
					$rows[0]['ref'],
					$rows[0]['name'],
					$rows[0]['phone'],
					$rows[0]['email'],
					$rows[0]['emailRep'],
					$rows[0]['emailAgent']
				);
				break;

			default:
				// TODO : Implémenter l'erreur.
				throw new Exception(ERROR_ROLE_INVALID);
		}

		$user->setId($rows[0]['id']);

		return $user;
	}


	/**
	 * Atheutifie l'utilisateur.
	 *
	 * @param $username
	 * @param $password
	 *
	 * @return Customer|Store|User
	 * @throws Exception
	 */
	public static function FindByUsernameAndPassword($username, $password)
	{
		$query = 'EXEC [getUserByUsernameAndPassword]';
		$query .= '@username = "' . $username . '", ';
		$query .= '@password = "' . $password . '"';

		$rows = Database::Execute($query);

		if (empty($rows)) {
			throw new Exception(ERROR_CREDENTIELS_INCORRECT);
		}

		$user = null;
		switch ($rows[0]['role']) {
			case ROLE_ADMINISTRATOR:
				$user = new User (
					$rows[0]['LanguageCode'],
					$rows[0]['username'],
					$rows[0]['password']
				);
				break;

			case ROLE_CUSTOMER:
				$user = new Customer (
					$rows[0]['LanguageCode'],
					$rows[0]['username'],
					$rows[0]['password'],
					$rows[0]['greeting'],
					$rows[0]['firstname'],
					$rows[0]['lastname'],
					$rows[0]['phone'],
					$rows[0]['email']
				);
				break;

			case ROLE_STORE:
				$user = new Store (
					$rows[0]['LanguageCode'],
					$rows[0]['username'],
					$rows[0]['password'],
					$rows[0]['ref'],
					$rows[0]['name'],
					$rows[0]['phone'],
					$rows[0]['email'],
					$rows[0]['emailRep'],
					$rows[0]['emailAgent']
				);
				break;

			default:
				// TODO : Implémenter l'erreur.
				throw new Exception(ERROR_ROLE_INVALID);
		}

		$user->setId($rows[0]['id']);

		return $user;
	}
}