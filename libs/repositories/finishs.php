<?php

include_once(ROOT . 'libs/language.php');
include_once(ROOT . 'libs/database.php');
include_once(ROOT . 'libs/entities/finish.php');

include_once(Language::getLanguageFile());

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
		$query .= '@code = "' . $code . '", ';
		$query .= '@languageCode = "' . Language::getCurrent() . '"';

		$rows = Database::Execute($query);

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
	public static function All($typeCode, $modelCode, $fabricCode, $pipingCode, $userId)
	{
		$query = 'EXEC [getFinishs]';
		$query .= '@typeCode = "' . $typeCode . '", ';
		$query .= '@modelCode = "' . $modelCode . '", ';
		$query .= '@fabricCode = "' . $fabricCode . '", ';
		$query .= '@pipingCode = "' . $pipingCode . '", ';
		$query .= '@userId = "' . $userId . '", ';
		$query .= '@LanguageCode = "' . Language::getCurrent() . '"';

		$rows = Database::Execute($query);

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