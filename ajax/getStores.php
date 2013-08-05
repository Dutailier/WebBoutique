<?php

include_once('../config.php');
include_once(ROOT . 'libs/security.php');
include_once(ROOT . 'libs/language.php');
include_once(ROOT . 'libs/repositories/stores.php');

include_once(Language::getLanguageFile());

if (!Security::isAuthenticated()) {
	$data['success'] = false;
	$data['message'] = ERROR_AUTHENTIFICATION_REQUIRED;

} else if (Security::getRole() != ROLE_ADMINISTRATOR) {
	$data['success'] = false;
	$data['message'] = ERROR_REQUIRED_ROLE_ADMINISTRATOR;

} else {
	try {
		$user = Security::getUserConnected();

		$stores = Stores::All();

		$data['stores'] = array();
		foreach ($stores as $store) {
			$data['stores'][] = $store->getInfoArray();
		}

		$data['success'] = true;

	} catch (Exception $e) {
		$data['success'] = false;
		$data['message'] = $e->getMessage();
	}
}

header('Content-type: application/json');
echo json_encode($data);