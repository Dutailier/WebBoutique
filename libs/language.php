<?php

/**
 * Class Language
 * Gère les méthodes manipulant les langues.
 */
class Language
{
	/**
	 * Retourne la langue présentement sélectionnée.
	 * @return mixed
	 */
	public static function getCurrent()
	{
		if (isSet($_GET['lang'])) {
			self::setCurrent($_GET['lang']);

			return $_GET['lang'];
		}

		if (session_id() == '') {
			session_start();
		}

		if (isSet($_SESSION['lang'])) {
			return $_SESSION['lang'];
		}

		if (isSet($_COOKIE['lang'])) {
			return $_COOKIE['lang'];
		}

		return 'en';
	}


	/**
	 * Sélectionne la langue.
	 *
	 * @param $lang
	 */
	public static function setCurrent($lang)
	{
		if (session_id() == '') {
			session_start();
		}

		$_SESSION['lang'] = $lang;
		setcookie('lang', $lang, time() + (3600 * 24 * 30));
	}


	/**
	 * Retourne le fichier de la langue présentement sélectionnée.
	 */
	public static function getLanguageFile()
	{
		return ROOT . 'languages/language.' . self::getCurrent() . '.php';
	}
}