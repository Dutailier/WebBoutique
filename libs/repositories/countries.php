<?php

include_once(DIR . 'libs/database.php');
include_once(DIR . 'libs/localisation.php');
include_once(DIR . 'libs/entities/country.php');

include_once(Localisation::getLanguageFile());

/**
 * Class Countries
 * Gère les différentes méthodes manipulant l'entité Country.
 */
class Countries
{
	/**
	 * Retourne le pays.
	 *
	 * @param $code
	 *
	 * @return Country
	 * @throws Exception
	 */
	public static function Find($code)
	{
		$query = 'EXEC [getCountryByCode]';
		$query .= '@code = \'' . $code . '\', ';
		$query .= '@languageCode = \'' . Localisation::getCurrentLanguage() . '\'';

		$rows = Database::ODBCExecute($query);

		if (empty($rows)) {
			throw new Exception(ERROR_COUNTRY_DOESNT_EXIST);
		}

		return new Country(
			$rows[0]['code'],
			$rows[0]['name']
		);
	}


	/**
	 * Retourne tous les pays.
	 *
	 * @return array
	 */
	public static function All()
	{
		$query = 'EXEC [getCountries]';
		$query .= '@languageCode = \'' . Localisation::getCurrentLanguage() . '\'';

		$rows = Database::ODBCExecute($query);

		$countries = array();
		foreach ($rows as $row) {
			$countries[] = new Country(
				$row['code'],
				$row['name']
			);
		}

		return $countries;
	}
}