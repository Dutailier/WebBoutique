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
		// TODO : Implémenter à procédure stockée.
		$query = 'EXEC [getPipingByCode]';
		$query .= '@code = "' . $code . '", ';
		$query .= '@languageCode = "' . Language::getCurrent() . '"';

		$rows = Database::Execute($query);

		if (empty($rows)) {
			// TODO : Implémenter l'erreur.
			throw new Exception(ERROR_PIPING_DOESNT_EXIST);
		}

		return new Piping (
			$rows[0]['code'],
			$rows[0]['name']
		);
	}



	/**
	 * Retourne tous les passepoils.
	 *
	 * @return array
	 */
	public static function All()
	{
		// TODO : Implémenter la procédure stockée.
		$query = 'EXEC [getPipings]';
		$query .= '@LanguageCode = "' . Language::getCurrent() . '"';

		$rows = Database::Execute($query);

		$pipings = array();
		foreach ($rows as $row) {
			$pipings[] = new Piping (
				$row['code'],
				$row['name']
			);
		}

		return $pipings;
	}
}