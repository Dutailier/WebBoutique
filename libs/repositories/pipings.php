<?php

include_once(ROOT . 'libs/localisation.php');
include_once(ROOT . 'libs/database.php');
include_once(ROOT . 'libs/entities/piping.php');

include_once(Localisation::getLanguageFile());

/**
 * Class Pipings
 * Gère les différentes méthodes manipulant l'entité Piping.
 */
class Pipings
{
	/**
	 * Retourne le passepoil.
	 *
	 * @param $code
	 *
	 * @return Piping
	 * @throws Exception
	 */
	public static function Find($code)
	{
		$query = 'EXEC [getPipingByCode]';
		$query .= '@code = \'' . intval($code) . '\', ';
		$query .= '@languageCode = \'' . Localisation::getCurrentLanguage() . '\'';

		$rows = Database::ODBCExecute($query);

		if (empty($rows)) {
			throw new Exception(ERROR_PIPING_DOESNT_EXIST);
		}

		return new Piping (
			$rows[0]['code'],
			$rows[0]['name']
		);
	}


	/**
	 * Retourne les passepoils disponibles pour l'utilisateur selon
	 * le type, le modèle, le fini et le tissu sélectionné.
	 *
	 * @param $typeCode
	 * @param $modelCode
	 * @param $finishCode
	 * @param $fabricCode
	 * @param $userId
	 *
	 * @return mixed
	 */
	public static function FilterByComponent($typeCode, $modelCode, $finishCode, $fabricCode, $userId)
	{
		$query = 'EXEC [getPipingsByComponent]';
		$query .= '@typeCode = \'' . intval($typeCode) . '\', ';
		$query .= '@modelCode = \'' . intval($modelCode) . '\', ';
		$query .= '@finishCode = \'' . intval($finishCode) . '\', ';
		$query .= '@fabricCode = \'' . intval($fabricCode) . '\', ';
		$query .= '@userId = \'' . intval($userId) . '\', ';
		$query .= '@LanguageCode = \'' . Localisation::getCurrentLanguage() . '\'';

		$rows = Database::ODBCExecute($query);

		$fabrics = array();
		foreach ($rows as $row) {
			$fabrics[] = new Piping (
				$row['code'],
				$row['name']
			);
		}

		return $fabrics;
	}
}