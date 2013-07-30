<?php

include_once(ROOT . 'libs/language.php');
include_once(ROOT . 'libs/database.php');
include_once(ROOT . 'libs/entities/model.php');

include_once(Language::getLanguageFile());

/**
 * Class Models
 * Gère les différentes méthodes manipulant l'entité Model.
 */
class Models
{
	/**
	 * Retourne le modèle.
	 *
	 * @param $code
	 *
	 * @return Model
	 * @throws Exception
	 */
	public static function Find($code)
	{
		// TODO : Implémenter à procédure stockée.
		$query = 'EXEC [getModelByCode]';
		$query .= '@code = "' . $code . '", ';
		$query .= '@languageCode = "' . Language::getCurrent() . '"';

		$rows = Database::Execute($query);

		if (empty($rows)) {
			// TODO : Implémenter l'erreur.
			throw new Exception(ERROR_MODEL_DOESNT_EXIST);
		}

		return new Model (
			$rows[0]['code'],
			$rows[0]['name']
		);
	}


	/**
	 * Retourne tous les modèles.
	 *
	 * @return array
	 */
	public static function All()
	{
		// TODO : Implémenter la procédure stockée.
		$query = 'EXEC [getModels]';
		$query .= '@LanguageCode = "' . Language::getCurrent() . '"';

		$rows = Database::Execute($query);

		$models = array();
		foreach ($rows as $row) {
			$models[] = new Model (
				$row['code'],
				$row['name']
			);
		}

		return $models;
	}
}