<?php

include_once('../config.php');
include_once(ROOT . 'libs/security.php');
include_once(ROOT . 'libs/localisation.php');
include_once(ROOT . 'libs/repositories/finishs.php');

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

			$finishs = Finishs::FilterByComponent(
				$_POST['modelCode'],
				isSet($_POST['fabricCode']) ? $_POST['fabricCode'] : null,
				isSet($_POST['pipingCode']) ? $_POST['pipingCode'] : null,
				$user->getId()
			);

			$data['finishs'] = array();
			foreach ($finishs as $finish) {
				$data['finishs'][] = $finish->getInfoArray();
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