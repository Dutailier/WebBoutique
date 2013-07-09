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
		$query = 'EXEC [addUser]';
		$query .= '@username = "' . $user->getUsername() . '", ';
		$query .= '@password = "' . $user->getPassword() . '", ';
		$query .= '@languageId = "' . $user->getLanguageId() . '"';

		$rows = Database::Execute($query);

		if (empty($rows)) {
			throw new Exception('The user wasn\'t added.');
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
	 * @return User
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

		$user = new User(
			$rows[0]['username'],
			$rows[0]['password'],
			$rows[0]['languageId']
		);
		$user->setId($rows[0]['id']);

		return $user;
	}


	/**
	 * Retourne un utilisateur.
	 *
	 * @param $id
	 *
	 * @return User
	 * @throws Exception
	 */
	public static function Find($id)
	{
		$query = 'EXEC [getUserById]';
		$query .= '@id = "' . intval($id) . '"';

		$rows = Database::Execute($query);

		if (empty($rows)) {
			throw new Exception('No user found.');
		}

		$user = new User(
			$rows[0]['username'],
			$rows[0]['password'],
			$rows[0]['languageId']
		);
		$user->setId($rows[0]['id']);

		return $user;
	}
}