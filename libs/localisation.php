<?php

include_once(DIR . 'libs/security.php');
include_once(DIR . 'libs/entities/language.php');

/**
 * Class Localisation
 * Gère les méthodes manipulant les langues.
 */
class Localisation
{
	const LANGUAGE_IDENTITIFER = '__LANGUAGE__';


	/**
	 * Retourne la langue présentement sélectionnée.
	 *
	 * @return mixed
	 */
	public static function getCurrentLanguage()
	{
		if (isSet($_GET['languageCode'])) {
			self::setCurrentLanguage($_GET['languageCode']);

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
	public static function setCurrentLanguage($languageCode)
	{
		if (!self::Exists($languageCode)) {
			return;
		}

		if (session_id() == '') {
			session_start();
		}

		$_SESSION[self::LANGUAGE_IDENTITIFER] = $languageCode;
		setcookie('languageCode', $languageCode, time() + (3600 * 24 * 30));
	}


	/**
	 * Retourne vrai si la langue existe.
	 *
	 * @param $languageCode
	 *
	 * @return bool
	 */
	private static function Exists($languageCode)
	{
		return
			$languageCode == LANGUAGE_ENGLISH ||
			$languageCode == LANGUAGE_FRENCH;
	}


	/**
	 * Retourne le fichier de la langue présentement sélectionnée.
	 */
	public static function getLanguageFile()
	{
		return DIR . 'languages/language.' . strtolower(self::getCurrentLanguage()) . '.php';
	}
}