<?php

include_once(ROOT . 'libs/database.php');
include_once(ROOT . 'libs/entities/role.php');

/**
 * Class Roles
 * Gère les différentes méthodes manipulant l'entité rôle.
 */
class Roles
{
	/**
	 * Retourne les rôles détenues par un utilisateur.
	 *
	 * @param $id
	 *
	 * @return array
	 */
	public static function FilterByUserId($id)
	{
		$query = 'EXEC [getRolesByUserId]';
		$query .= '@userId = "' . intval($id) . '"';

		$rows = Database::Execute($query);

		$roles = array();
		foreach ($rows as $row) {

			$role = new Role(
				$row['name']
			);
			$role->setId($row['id']);

			$roles[] = $role;
		}

		return $roles;
	}


	/**
	 * Ajoute un utilisteur à un rôle.
	 *
	 * @param User $user
	 * @param      $name
	 */
	public static function addUserToRoleName(User $user, $name)
	{
		$query = 'EXEC [addUserIdToRoleName]';
		$query .= '@userId = "' . $user->getId() . '", ';
		$query .= '@roleName = "' . strtolower($name) . '"';

		Database::Execute($query);
	}
}