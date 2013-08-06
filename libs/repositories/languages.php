<?php

include_once(ROOT . 'libs/localisation.php');
include_once(ROOT . 'libs/database.php');
include_once(ROOT . 'libs/entities/language.php');

include_once(Localisation::getLanguageFile());

/**
 * Class Languages
 * Gère les méthodes manipulant l'entité Language.
 */
class Languages
{
	/**
	 * Retourne toutes les langues.
	 *
	 * @return array
	 */
	public static function All()
	{
		$query = 'EXEC [getLanguages]';
		$query .= '@languageCode = "' . Localisation::getCurrentLanguage() . '"';

		$rows = Database::ODBCExecute($query);

		$languages = array();
		foreach ($rows as $row) {
			$languages[] = new Language(
				$row['code'],
				$row['name']
			);
		}

		return $languages;
	}
}