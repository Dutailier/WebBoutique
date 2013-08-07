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
	 * Modifie le modèle du produit.
	 *
	 * @param Model $model
	 * @param       $languageCode
	 */
	public static function Update(Model $model, $languageCode)
	{
		$query = 'EXEC [updateModel]';
		$query .= '@name = "' . $model->getName() . '", ';
		$query .= '@code = "' . $model->getCode() . '", ';
		$query .= '@languageCode = "' . $languageCode . '"';

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
		$query .= '@code = "' . intval($code) . '", ';
		$query .= '@languageCode = "' . Localisation::getCurrentLanguage() . '"';

		$rows = Database::ODBCExecute($query);

		if (empty($rows)) {
			throw new Exception(ERROR_MODEL_DOESNT_EXIST);
		}

		return new Model (
			$rows[0]['code'],
			$rows[0]['typeCode'],
			$rows[0]['name'],
			$rows[0]['description']
		);
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
		$query .= '@typeCode = "' . intval($typeCode) . '", ';
		$query .= '@userId = "' . intval($userId) . '", ';
		$query .= '@LanguageCode = "' . Localisation::getCurrentLanguage() . '"';

		$rows = Database::ODBCExecute($query);

		$models = array();
		foreach ($rows as $row) {
			$models[] = new Model (
				$row['code'],
				$row['typeCode'],
				$row['name'],
				$row['description']
			);
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
	public static function filterByModelCodeAndLanguageCode($typeCode, $languageCode)
	{
		$query = 'EXEC [getModelsByTypeCode]';
		$query .= '@typeCode = "' . $typeCode . '", ';
		$query .= '@languageCode = "' . $languageCode . '"';

		$rows = Database::ODBCExecute($query);

		$models = array();
		foreach ($rows as $row) {
			$models[] = new Model(
				$row['code'],
				$row['typeCode'],
				$row['name'],
				$row['description']
			);
		}

		return $models;
	}
}