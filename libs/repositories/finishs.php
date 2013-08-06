<?php

include_once(ROOT . 'libs/localisation.php');
include_once(ROOT . 'libs/database.php');
include_once(ROOT . 'libs/entities/finish.php');

include_once(Localisation::getLanguageFile());

/**
 * Class Finishs
 * Gère les différentes méthodes manipulant l'entité Finish.
 */
class Finishs
{
	/**
	 * Retourne le fini.
	 *
	 * @param $code
	 *
	 * @return Finish
	 * @throws Exception
	 */
	public static function Find($code)
	{
		$query = 'EXEC [getFinishByCode]';
		$query .= '@code = "' . intval($code) . '", ';
		$query .= '@languageCode = "' . Localisation::getCurrentLanguage() . '"';

		$rows = Database::ODBCExecute($query);

		if (empty($rows)) {
			throw new Exception(ERROR_FINISH_DOESNT_EXIST);
		}

		return new Finish (
			$rows[0]['code'],
			$rows[0]['name']
		);
	}


	/**
	 * Retourne les finis disponible pour l'utilisateur selon
	 * le type, le modèle, le tissu et le passepoil sélectionné.
	 *
	 * @param $typeCode
	 * @param $modelCode
	 * @param $fabricCode
	 * @param $pipingCode
	 * @param $userId
	 *
	 * @return array
	 */
	public static function FilterByComponent($typeCode, $modelCode, $fabricCode, $pipingCode, $userId)
	{
		$query = 'EXEC [getFinishsByComponent]';
		$query .= '@typeCode = "' . intval($typeCode) . '", ';
		$query .= '@modelCode = "' . intval($modelCode) . '", ';
		$query .= '@fabricCode = "' . intval($fabricCode) . '", ';
		$query .= '@pipingCode = "' . intval($pipingCode) . '", ';
		$query .= '@userId = "' . intval($userId) . '", ';
		$query .= '@LanguageCode = "' . Localisation::getCurrentLanguage() . '"';

		$rows = Database::ODBCExecute($query);

		$finishs = array();
		foreach ($rows as $row) {
			$finishs[] = new Finish (
				$row['code'],
				$row['name']
			);
		}

		return $finishs;
	}
}