<?php

include_once('../config.php');
include_once(ROOT . 'libs/security.php');
include_once(ROOT . 'libs/localisation.php');
include_once(ROOT . 'libs/repositories/fabrics.php');

include_once(Localisation::getLanguageFile());

if (!Security::isAuthenticated()) {
	$data['success'] = false;
	$data['message'] = ERROR_AUTHENTIFICATION_REQUIRED;

} else {
	if (empty($_POST['modelCode'])) {
		$data['success'] = false;
		$data['message'] = ERROR_REQUIRED_MODEL_CODE;

	} else {
		try {

			$user = Security::getUserConnected();

			$pipings = Fabrics::FilterByComponent(
				$_POST['modelCode'],
				isSet($_POST['finishCode']) ? $_POST['finishCode'] : null,
				isSet($_POST['pipingCode']) ? $_POST['pipingCode'] : null,
				$user->getId()
			);

			$data['fabrics'] = array();
			foreach ($pipings as $fabric) {
				$data['fabrics'][] = $fabric->getInfoArray();
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