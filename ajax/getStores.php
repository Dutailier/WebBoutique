<?php

include_once('../config.php');
include_once(DIR . 'libs/security.php');
include_once(DIR . 'libs/localisation.php');
include_once(DIR . 'libs/repositories/stores.php');

include_once(Localisation::getLanguageFile());

if (!Security::isAuthenticated()) {
	$data['success'] = false;
	$data['message'] = ERROR_AUTHENTIFICATION_REQUIRED;

} else if (Security::getRole() != ROLE_ADMINISTRATOR) {
	$data['success'] = false;
	$data['message'] = ERROR_REQUIRED_ROLE_ADMINISTRATOR;

} else {
	try {
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