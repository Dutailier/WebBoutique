<?php

include_once('../config.php');
include_once(ROOT . 'libs/security.php');
include_once(ROOT . 'libs/localisation.php');

include_once(Localisation::getLanguageFile());

if (empty($_POST['username']) || empty($_POST['password'])) {
	$data['success'] = false;
	$data['message'] = ERROR_CREDENTIELS_REQUIRED;

} else {
	try {
		if ($data['valid'] = Security::TryLogin($_POST['username'], $_POST['password'])) {
			Localisation::setCurrentLanguage(Security::getUserConnected()->getLanguageCode());
		}

		$data['success'] = true;

	} catch (Exception $e) {
		$data['success'] = false;
		$data['message'] = $e->getMessage();
	}
}

header('Content-type: application/json');
echo json_encode($data);