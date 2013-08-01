<?php

include_once(ROOT . 'libs/language.php');
include_once(ROOT . 'libs/database.php');
include_once(ROOT . 'libs/entities/piping.php');

include_once(Language::getLanguageFile());

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
		$query .= '@code = "' . $code . '", ';
		$query .= '@languageCode = "' . Language::getCurrent() . '"';

		$rows = Database::Execute($query);

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
		$query = 'EXEC [getPipings]';
		$query .= '@typeCode = "' . $typeCode . '", ';
		$query .= '@modelCode = "' . $modelCode . '", ';
		$query .= '@finishCode = "' . $finishCode . '", ';
		$query .= '@fabricCode = "' . $fabricCode . '", ';
		$query .= '@userId = "' . $userId . '", ';
		$query .= '@LanguageCode = "' . Language::getCurrent() . '"';

		$rows = Database::Execute($query);

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