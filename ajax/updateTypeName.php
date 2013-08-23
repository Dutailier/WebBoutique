<?php

include_once('../config.php');
include_once(DIR . 'libs/security.php');
include_once(DIR . 'libs/localisation.php');
include_once(DIR . 'libs/repositories/types.php');

include_once(Localisation::getLanguageFile());

if (!Security::isAuthenticated()) {
	$data['success'] = false;
	$data['message'] = ERROR_AUTHENTIFICATION_REQUIRED;

} else if (Security::getRole() != ROLE_ADMINISTRATOR) {
	$data['success'] = false;
	$data['message'] = ERROR_REQUIRED_ROLE_ADMINISTRATOR;

} else {
	if (empty($_POST['name'])) {
		$data['success'] = false;
		$data['message'] = ERROR_REQUIRED_TYPE_NAME;

	} else if (empty($_POST['typeCode'])) {
		$data['success'] = false;
		$data['message'] = ERROR_REQUIRED_TYPE_CODE;

	} else if (empty($_POST['languageCode'])) {
		$data['success'] = false;
		$data['message'] = ERROR_REQUIRED_LANGUAGE_CODE;

	} else {
		try {
			Types::UpdateName(
				$_POST['name'],
				$_POST['typeCode'],
				$_POST['languageCode']
			);

			$data['success'] = true;

		} catch (Exception $e) {
			$data['success'] = false;
			$data['message'] = $e->getMessage();
		}
	}
}

header('Content-type: application/json');
echo json_encode($data);