<?php

include_once(DIR . 'libs/database.php');
include_once(DIR . 'libs/localisation.php');
include_once(DIR . 'libs/entities/type.php');

include_once(Localisation::getLanguageFile());

/**
 * Class Types
 * Gère les différentes méthodes manipulant l'entité Type.
 */
class Types
{
	/**
	 * Modifie le nom du type de produit.
	 *
	 * @param $name
	 * @param $code
	 * @param $languageCode
	 */
	public static function UpdateName($name, $code, $languageCode)
	{
		$query = 'EXEC [updateTypeName]';
		$query .= '@name = \'' . $name . '\', ';
		$query .= '@code = \'' . $code . '\', ';
		$query .= '@languageCode = \'' . $languageCode . '\'';

		Database::ODBCExecute($query);
	}


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
		$query .= '@code = \'' . intval($code) . '\', ';
		$query .= '@languageCode = \'' . Localisation::getCurrentLanguage() . '\'';

		$rows = Database::ODBCExecute($query);

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
		$query .= '@userId = \'' . intval($userId) . '\', ';
		$query .= '@languageCode = \'' . Localisation::getCurrentLanguage() . '\'';

		$rows = Database::ODBCExecute($query);

		$types = array();
		foreach ($rows as $row) {
			$types[] = new Type(
				$row['code'],
				$row['name']
			);
		}

		return $types;
	}


	/**
	 * Retourne tous les types de produits dans la langue sélectionnée.
	 *
	 * @param $languageCode
	 *
	 * @return array
	 */
	public static function filterByLanguageCode($languageCode)
	{
		$query = 'EXEC [getTypes]';
		$query .= '@languageCode = \'' . $languageCode . '\'';

		$rows = Database::ODBCExecute($query);

		$types = array();
		foreach ($rows as $row) {
			$types[] = new Type(
				$row['code'],
				$row['name']
			);
		}

		return $types;
	}


	/**
	 * Retourne tous les types.
	 *
	 * @return array
	 */
	public static function All()
	{
		return self::filterByLanguageCode(Localisation::getCurrentLanguage());
	}
}