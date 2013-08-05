<?php

include_once(ROOT . 'libs/security.php');

define('LANGUAGE_FRENCH', 'FR');
define('LANGUAGE_ENGLISH', 'EN');

/**
 * Class Language
 * Gère les méthodes manipulant les langues.
 */
class Language
{
	const LANGUAGE_IDENTITIFER = '__LANGUAGE__';


	/**
	 * Retourne la langue présentement sélectionnée.
	 *
	 * @return mixed
	 */
	public static function getCurrent()
	{
		if (isSet($_GET['languageCode'])) {
			self::setCurrent($_GET['languageCode']);

			return $_GET['languageCode'];
		}

		if (session_id() == '') {
			session_start();
		}

		if (isSet($_SESSION[self::LANGUAGE_IDENTITIFER])) {
			return strtoupper($_SESSION[self::LANGUAGE_IDENTITIFER]);
		}

		if (isSet($_COOKIE['languageCode'])) {
			return $_COOKIE['languageCode'];
		}

		return LANGUAGE_ENGLISH;
	}


	/**
	 * Sélectionne la langue.
	 *
	 * @param $languageCode
	 */
	public static function setCurrent($languageCode)
	{
		if (session_id() == '') {
			session_start();
		}

		$_SESSION[self::LANGUAGE_IDENTITIFER] = $languageCode;
		setcookie('languageCode', $languageCode, time() + (3600 * 24 * 30));
	}


	/**
	 * Retourne le fichier de la langue présentement sélectionnée.
	 */
	public static function getLanguageFile()
	{
		return ROOT . 'languages/language.' . strtolower(Language::getCurrent()) . '.php';
	}
}