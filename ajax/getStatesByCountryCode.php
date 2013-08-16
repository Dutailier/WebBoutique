<?php

include_once('../config.php');
include_once(ROOT . 'libs/security.php');
include_once(ROOT . 'libs/localisation.php');
include_once(ROOT . 'libs/repositories/states.php');

include_once(Localisation::getLanguageFile());

if (!Security::isAuthenticated()) {
	$data['success'] = false;
	$data['message'] = ERROR_AUTHENTIFICATION_REQUIRED;

} else {
	if (empty($_POST['countryCode'])) {
		$data['success'] = false;
		$data['message'] = ERROR_REQUIRED_COUNTRY_CODE;

	} else {
		try {
			$states = States::filterByCountryCode($_POST['countryCode']);

			$data['states'] = array();
			foreach ($states as $state) {
				$data['states'][] = $state->getInfoArray();
			}

			$data['success'] = true;

		} catch (Exception $e) {
			$data['success'] = false;
			$data['message'] = $e->getMessage();
		}
	}
}

header('Content-type: application/json');
echo json_encode($data);