<?php

include_once(ROOT . 'libs/localisation.php');
include_once(ROOT . 'libs/database.php');
include_once(ROOT . 'libs/entities/model.php');

include_once(Localisation::getLanguageFile());

/**
 * Class Models
 * Gère les différentes méthodes manipulant l'entité Model.
 */
class Models
{
	/**
	 * Modifie le nom du modèle.
	 *
	 * @param $name
	 * @param $code
	 * @param $languageCode
	 */
	public static function UpdateName($name, $code, $languageCode)
	{
		$query = 'EXEC [updateModelName]';
		$query .= '@name = \'' . $name . '\', ';
		$query .= '@code = \'' . $code . '\', ';
		$query .= '@languageCode = \'' . $languageCode . '\'';

		Database::ODBCExecute($query);
	}


	/**
	 * Modifie la description du modèle.
	 *
	 * @param $description
	 * @param $code
	 * @param $languageCode
	 */
	public static function UpdateDescription($description, $code, $languageCode)
	{
		$query = 'EXEC [updateModelDescription]';
		$query .= '@description = \'' . htmlentities($description, ENT_QUOTES ) . '\', ';
		$query .= '@code = \'' . $code . '\', ';
		$query .= '@languageCode = \'' . $languageCode . '\'';

		Database::ODBCExecute($query);
	}


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
		$query = 'EXEC [getModelByCode]';
		$query .= '@code = \'' . intval($code) . '\', ';
		$query .= '@languageCode = \'' . Localisation::getCurrentLanguage() . '\'';

		$rows = Database::ODBCExecute($query);

		if (empty($rows)) {
			throw new Exception(ERROR_MODEL_DOESNT_EXIST);
		}

		$model = new Model (
			$rows[0]['code'],
			$rows[0]['name'],
			$rows[0]['description']
		);
		$model->setTypeCode($rows[0]['typeCode']);

		return $model;
	}


	/**
	 * Retourne tous les modèles disponible pour l'utilisateur selon
	 * le type sélectionné.
	 *
	 * @param $typeCode
	 * @param $userId
	 *
	 * @return array
	 */
	public static function FilterByComponent($typeCode, $userId)
	{
		$query = 'EXEC [getModelsByComponent]';
		$query .= '@typeCode = \'' . intval($typeCode) . '\', ';
		$query .= '@userId = \'' . intval($userId) . '\', ';
		$query .= '@LanguageCode = \'' . Localisation::getCurrentLanguage() . '\'';

		$rows = Database::ODBCExecute($query);

		$models = array();
		foreach ($rows as $row) {
			$model = $models[] = new Model (
				$row['code'],
				$row['name'],
				$row['description']
			);
			$model->setTypeCode($row['typeCode']);
		}

		return $models;
	}


	/**
	 * Retourne tous les modèles de produits dans la langue et pour le type de produit sélectionnés.
	 *
	 * @param $typeCode
	 * @param $languageCode
	 *
	 * @return array
	 */
	public static function filterByTypeCodeAndLanguageCode($typeCode, $languageCode)
	{
		$query = 'EXEC [getModelsByTypeCode]';
		$query .= '@typeCode = \'' . $typeCode . '\', ';
		$query .= '@languageCode = \'' . $languageCode . '\'';

		$rows = Database::ODBCExecute($query);

		$models = array();
		foreach ($rows as $row) {
			$model = $models[] = new Model (
				$row['code'],
				$row['name'],
				$row['description']
			);
			$model->setTypeCode($row['typeCode']);
		}

		return $models;
	}
}