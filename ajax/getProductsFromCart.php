<?php

include_once('../config.php');
include_once(DIR . 'libs/security.php');
include_once(DIR . 'libs/localisation.php');
include_once(DIR . 'libs/sessionTransaction.php');

include_once(Localisation::getLanguageFile());

if (!Security::isAuthenticated()) {
	$data['success'] = false;
	$data['message'] = ERROR_AUTHENTIFICATION_REQUIRED;

} else if (Security::getRole() != ROLE_STORE) {
	$data['success'] = false;
	$data['message'] = ERROR_REQUIRED_ROLE_STORE;

} else {
	try {
		$transaction = new SessionTransaction();

		$products = $transaction->getItems();

		$data['products'] = array();
		foreach ($products as $product) {
			$data['products'][] = $product->getInfoArray();
		}

		$data['success'] = true;

	} catch (Exception $e) {
		$data['success'] = false;
		$data['message'] = $e->getMessage();
	}
}

header('Content-type: application/json');
echo json_encode($data);