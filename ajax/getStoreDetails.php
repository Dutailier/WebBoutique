<?php

include_once('../config.php');
include_once(DIR . 'libs/security.php');
include_once(DIR . 'libs/localisation.php');
include_once(DIR . 'libs/repositories/stores.php');

include_once(Localisation::getLanguageFile());

if (!Security::isAuthenticated()) {
	$data['success'] = false;
	$data['message'] = 'You must be authenticated.';

} else if (Security::getRole() != ROLE_ADMINISTRATOR) {
	$data['success'] = false;
	$data['message'] = ERROR_REQUIRED_ROLE_ADMINISTRATOR;

} else {

	if (empty($_POST['ref'])) {
		$data['success'] = false;
		$data['message'] = ERROR_REQUIRED_STORE_REF;

	} else {
		try {
			$store   = Stores::Find($_POST['ref']);
			$address = $store->getAddress();

			$data['store']   = $store->getInfoArray();
			$data['address'] = $address->getInfoArray();
			$data['success'] = true;

		} catch (Exception $e) {
			$data['success'] = false;
			$data['message'] = $e->getMessage();
		}
	}
}

header('Content-type: application/json');
echo json_encode($data);