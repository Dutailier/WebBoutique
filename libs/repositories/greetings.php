<?php

include_once(ROOT . 'libs/localisation.php');
include_once(ROOT . 'libs/database.php');

include_once(Localisation::getLanguageFile());

/**
 * Class Greetings
 * Gère les différentes méthodes manipulant les salutations.
 */
class Greetings
{
	/**
	 * Retourne toutes les salutions.
	 *
	 * @return array
	 */
	public static function All()
	{
		$query = 'EXEC [getGreetings]';
		$query .= '@languageCode = \'' . Localisation::getCurrentLanguage() . '\'';

		return Database::ODBCExecute($query);
	}
}