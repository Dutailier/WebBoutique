<?php

include_once(ROOT . 'libs/language.php');
include_once(ROOT . 'libs/database.php');
include_once(ROOT . 'libs/entities/type.php');

include_once(Language::getLanguageFile());

/**
 * Class Types
 * Gère les différentes méthodes manipulant l'entité Type.
 */
class Types
{
	/**
	 * Retourne un type de produit.
	 *
	 * @param $code
	 *
	 * @return Type
	 * @throws Exception
	 */
	public static function Find($code)
	{
		$query = 'EXEC [getTypeByCode]';
		$query .= '@code = "' . intval($code) . '", ';
		$query .= '@languageCode = "' . Language::getCurrent() . '"';

		$rows = Database::Execute($query);

		if (empty($rows)) {
			throw new Exception(ERROR_TYPE_DOESNT_EXIST);
		}

		return new Type(
			$rows[0]['code'],
			$rows[0]['name']
		);
	}


	/**
	 * Retourne les types de produits disponibles pour cet utilisateur.
	 *
	 * @param $userId
	 *
	 * @return array
	 */
	public static function FilterByComponent($userId)
	{
		$query = 'EXEC [getTypesByComponent]';
		$query .= '@userId = "' . intval($userId) . '", ';
		$query .= '@languageCode = "' . Language::getCurrent() . '"';

		$rows = Database::Execute($query);

		$types = array();
		foreach ($rows as $row) {
			$types[] = new Type(
				$row['code'],
				$row['name']
			);
		}

		return $types;
	}
}