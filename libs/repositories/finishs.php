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
	 * Retourne tous les finis disponibles pour l'utilisateur et le modèle.
	 *
	 * @param $userId
	 * @param $modelCode
	 *
	 * @return array
	 */
	public static function All($userId, $modelCode)
	{
		$query = 'EXEC [getFinishs]';
		$query .= '@userId = "' . intval($userId) . '", ';
		$query .= '@modelCode = "' . $modelCode . '", ';
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