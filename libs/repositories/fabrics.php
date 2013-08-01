<?php

include_once(ROOT . 'libs/language.php');
include_once(ROOT . 'libs/database.php');
include_once(ROOT . 'libs/entities/fabric.php');

include_once(Language::getLanguageFile());

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
		$query .= '@code = "' . $code . '", ';
		$query .= '@languageCode = "' . Language::getCurrent() . '"';

		$rows = Database::Execute($query);

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
	 * le type, le modèle, le fini et le passepoil sélectionné.
	 *
	 * @param $typeCode
	 * @param $modelCode
	 * @param $finishCode
	 * @param $pipingCode
	 * @param $userId
	 *
	 * @return array
	 */
	public static function FilterByComponent($typeCode, $modelCode, $finishCode, $pipingCode, $userId)
	{
		$query = 'EXEC [getFabricsByComponent]';
		$query .= '@typeCode = "' . $typeCode . '", ';
		$query .= '@modelCode = "' . $modelCode . '", ';
		$query .= '@finishCode = "' . $finishCode . '", ';
		$query .= '@pipingCode = "' . $pipingCode . '", ';
		$query .= '@userId = "' . $userId . '", ';
		$query .= '@LanguageCode = "' . Language::getCurrent() . '"';

		$rows = Database::Execute($query);

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