<?php

include_once(DIR . 'libs/database.php');
include_once(DIR . 'libs/localisation.php');

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