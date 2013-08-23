<?php

include_once('../config.php');
include_once(DIR . 'libs/security.php');
include_once(DIR . 'libs/localisation.php');
include_once(DIR . 'libs/repositories/stores.php');

include_once(Localisation::getLanguageFile());

if (!Security::isAuthenticated()) {
	$data['success'] = false;
	$data['message'] = 'You must be authenticated.';

} else {
	try {
		$user    = Security::getUserConnected();
		$address = $user->getAddress();

		$data['user']    = $user->getInfoArray();
		$data['address'] = $address->getInfoArray();
		$data['success'] = true;

	} catch (Exception $e) {
		$data['success'] = false;
		$data['message'] = $e->getMessage();
	}
}

header('Content-type: application/json');
echo json_encode($data);