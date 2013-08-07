<?php

include_once('../config.php');
include_once(ROOT . 'libs/security.php');
include_once(ROOT . 'libs/localisation.php');
include_once(ROOT . 'libs/repositories/models.php');

include_once(Localisation::getLanguageFile());

if (!Security::isAuthenticated()) {
	$data['success'] = false;
	$data['message'] = ERROR_AUTHENTIFICATION_REQUIRED;

} else if (Security::getRole() != ROLE_ADMINISTRATOR) {
	$data['success'] = false;
	$data['message'] = ERROR_REQUIRED_ROLE_ADMINISTRATOR;

} else {
	if (empty($_POST['description'])) {
		$data['success'] = false;
		$data['message'] = ERROR_REQUIRED_MODEL_DESCRIPTION;

	} else if (empty($_POST['modelCode'])) {
		$data['success'] = false;
		$data['message'] = ERROR_REQUIRED_MODEL_CODE;

	} else if (empty($_POST['languageCode'])) {
		$data['success'] = false;
		$data['message'] = ERROR_REQUIRED_LANGUAGE_CODE;

	} else {
		try {
			Models::UpdateDescription(
				$_POST['description'],
				$_POST['modelCode'],
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