<?php

include_once(ROOT . 'libs/localisation.php');
include_once(ROOT . 'libs/database.php');
include_once(ROOT . 'libs/entities/state.php');

include_once(Localisation::getLanguageFile());

/**
 * Class States
 * Gère les différentes méthodes manipulant l'entité State.
 */
class States
{
	/**
	 * Retourne l'état ou la province.
	 *
	 * @param $code
	 *
	 * @return State
	 * @throws Exception
	 */
	public static function find($code)
	{
		$query = 'EXEC [getStateByCode]';
		$query .= '@code = \'' . $code . '\' ,';
		$query .= '@languageCode = \'' . Localisation::getCurrentLanguage() . '\'';

		$rows = Database::ODBCExecute($query);

		if (empty($rows)) {
			throw new Exception(ERROR_STATE_DOESNT_EXIST);
		}

		return new State(
			$rows[0]['code'],
			$rows[0]['countryCode'],
			$rows[0]['name']
		);
	}


	/**
	 * Retourne les états ou provinces du pays.
	 *
	 * @param $countryCode
	 *
	 * @return array|State
	 */
	public static function filterByCountryCode($countryCode)
	{
		$query = 'EXEC [getStatesByCountryCode]';
		$query .= '@countryCode = \'' . $countryCode . '\' , ';
		$query .= '@languageCode = \'' . Localisation::getCurrentLanguage() . '\'';

		$rows = Database::ODBCExecute($query);

		$states = array();
		foreach ($rows as $row) {
			$states = new State (
				$row['code'],
				$row['countryCode'],
				$row['name']
			);
		}

		return $states;
	}
}