<?php

include_once('../config.php');
include_once(DIR . 'libs/security.php');
include_once(DIR . 'libs/localisation.php');
include_once(DIR . 'libs/repositories/models.php');

include_once(Localisation::getLanguageFile());

if (!Security::isAuthenticated()) {
	$data['success'] = false;
	$data['message'] = ERROR_AUTHENTIFICATION_REQUIRED;

} else {
	if (empty($_POST['typeCode'])) {
		$data['success'] = false;
		$data['message'] = ERROR_REQUIRED_TYPE_CODE;
	} else {
		try {
			$finishs = Models::filterByTypeCode($_POST['typeCode']);

			$data['models'] = array();
			foreach ($finishs as $model) {
				$data['models'][] = $model->getInfoArray();
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