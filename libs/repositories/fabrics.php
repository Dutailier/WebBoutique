<?php

include_once(DIR . 'libs/database.php');
include_once(DIR . 'libs/localisation.php');
include_once(DIR . 'libs/entities/fabric.php');

include_once(Localisation::getLanguageFile());

/**
 * Class Fabrics
 * Gère les différentes méthodes manipulant l'entité Fabric.
 */
class Fabrics
{
	/**
	 * Retourne le tissu.
	 *
	 * @param $code
	 *
	 * @return Fabric
	 * @throws Exception
	 */
	public static function Find($code)
	{
		$query = 'EXEC [getFabricByCode]';
		$query .= '@code = \'' . intval($code) . '\', ';
		$query .= '@languageCode = \'' . Localisation::getCurrentLanguage() . '\'';

		$rows = Database::ODBCExecute($query);

		if (empty($rows)) {
			throw new Exception(ERROR_FABRIC_DOESNT_EXIST);
		}

		return new Fabric (
			$rows[0]['code'],
			$rows[0]['name'],
			$rows[0]['grade']
		);
	}


	/**
	 * Retourne les tissus disponibles pour l'utilisteur selon
	 * le modèle, le fini et le passepoil sélectionné.
	 *
	 * @param $modelCode
	 * @param $finishCode
	 * @param $pipingCode
	 * @param $userId
	 *
	 * @return array
	 */
	public static function FilterByComponent($modelCode, $finishCode, $pipingCode, $userId)
	{
		$query = 'EXEC [getFabricsByComponent]';
		$query .= '@modelCode = \'' . $modelCode . '\', ';

		if (!empty($finishCode)) {
			$query .= '@finishCode = \'' . $finishCode . '\', ';
		}

		if (!empty($pipingCode)) {
			$query .= '@pipingCode = \'' . $pipingCode . '\', ';
		}

		$query .= '@userId = \'' . $userId . '\', ';
		$query .= '@LanguageCode = \'' . Localisation::getCurrentLanguage() . '\'';

		$rows = Database::ODBCExecute($query);

		$fabrics = array();
		foreach ($rows as $row) {
			$fabrics[] = new Fabric (
				$row['code'],
				$row['name'],
				$row['grade']
			);
		}

		return $fabrics;
	}
}