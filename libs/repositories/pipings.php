<?php

include_once(DIR . 'libs/database.php');
include_once(DIR . 'libs/localisation.php');
include_once(DIR . 'libs/entities/piping.php');

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
	 * le modèle, le fini et le tissu sélectionné.
	 *
	 * @param $modelCode
	 * @param $finishCode
	 * @param $fabricCode
	 * @param $userId
	 *
	 * @return mixed
	 */
	public static function FilterByComponent($modelCode, $finishCode, $fabricCode, $userId)
	{
		$query = 'EXEC [getPipingsByComponent]';
		$query .= '@modelCode = \'' . $modelCode . '\', ';

		if (!empty($finishCode)) {
			$query .= '@finishCode = \'' . $finishCode . '\', ';
		}

		if (!empty($fabricCode)) {
			$query .= '@fabricCode = \'' . $fabricCode . '\', ';
		}

		$query .= '@userId = \'' . $userId . '\', ';
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