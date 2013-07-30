<?php

include_once(ROOT . 'libs/language.php');
include_once(ROOT . 'libs/database.php');
include_once(ROOT . 'libs/entities/state.php');

include_once(Language::getLanguageFile());

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
		$query = 'EXEC [getStateById]';
		$query .= '@id = "' . intval($code) . '" ,';
		$query .= '@languageCode = "' . Language::getCurrent() . '"';

		$rows = Database::Execute($query);

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
		$query = 'EXEC [getStatesByCountryId]';
		$query .= '@countryId = "' . intval($countryCode) . '" , ';
		$query .= '@languageCode = "' . Language::getCurrent() . '"';

		$rows = Database::Execute($query);

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