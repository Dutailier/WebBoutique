<?php

include_once(ROOT . 'libs/language.php');
include_once(ROOT . 'libs/database.php');
include_once(ROOT . 'libs/entities/type.php');

include_once(Language::getLanguageFile());

/**
 * Class Users
 * Gère les différentes méthodes manipulant l'entité type.
 */
class Types
{
	/**
	 * Retourne un type de produit.
	 *
	 * @param $id
	 *
	 * @return Type
	 * @throws Exception
	 */
	public static function Find($id)
	{
		$query = 'EXEC [getTypeByIdAndLanguageCode]';
		$query .= '@id = "' . intval($id) . '", ';
		$query .= '@languageCode = "' . Language::getCurrent() . '"';

		$rows = Database::Execute($query);

		if (empty($rows)) {
			throw new Exception(ERROR_TYPE_DOESNT_EXIST);
		}

		$type = new Type(
			$rows[0]['name']
		);
		$type->setId($rows[0]['id']);

		return $type;
	}


	/**
	 * Retourne tous les types disponibles pour un utilisateur.
	 *
	 * @param $userId
	 *
	 * @return array
	 */
	public static function All($userId)
	{
		$query = 'EXEC [getTypesByUserIdAndLanguageCode]';
		$query .= '@userId = "' . intval($userId) . '", ';
		$query .= '@languageCode = "' . Language::getCurrent() . '"';

		$rows = Database::Execute($query);

		$types = array();
		foreach ($rows as $row) {

			$type = new Type(
				$row['name']
			);
			$type->setId($row['id']);

			$types[] = $type;
		}

		return $types;
	}
}