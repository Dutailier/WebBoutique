<?php

include_once('../config.php');
include_once(ROOT . 'libs/security.php');
include_once(ROOT . 'libs/localisation.php');
include_once(ROOT . 'libs/sessionTransaction.php');

include_once(Localisation::getLanguageFile());

if (!Security::isAuthenticated()) {
	$data['success'] = false;
	$data['message'] = ERROR_AUTHENTIFICATION_REQUIRED;

} else {
	// Nom d'expédition
	if (empty($_POST['greeting'])) {
		$data['success'] = false;
		$data['message'] = ERROR_REQUIRED_GREETING;

	} else if (empty($_POST['firstname'])) {
		$data['success'] = false;
		$data['message'] = ERROR_REQUIRED_FIRSTNAME;

	} else if (empty($_POST['lastname'])) {
		$data['success'] = false;
		$data['message'] = ERROR_REQUIRED_LASTNAME;

		// Adresse d'expédition
	} else if (empty($_POST['street'])) {
		$data['success'] = false;
		$data['message'] = ERROR_REQUIRED_STREET;

	} else if (empty($_POST['zipCode'])) {
		$data['success'] = false;
		$data['message'] = ERROR_REQUIRED_ZIP_CODE;

	} else if (empty($_POST['city'])) {
		$data['success'] = false;
		$data['message'] = ERROR_REQUIRED_CITY;

	} else if (empty($_POST['stateCode'])) {
		$data['success'] = false;
		$data['message'] = ERROR_REQUIRED_STATE_CODE;

		// Autres informations d'expéidition
	} else if (empty($_POST['email'])) {
		$data['success'] = false;
		$data['message'] = ERROR_REQUIRED_EMAIL;

	} else if (empty($_POST['phone'])) {
		$data['success'] = false;
		$data['message'] = ERROR_REQUIRED_PHONE;

	} else {
		try {
			$transaction = new SessionTransaction();

			$transaction->setCustomerInfo(
				Localisation::getCurrentLanguage(),
				$_POST['greeting'],
				$_POST['firstname'],
				$_POST['lastname'],
				$_POST['phone'],
				$_POST['email']
			);

			$transaction->setShippingInfo(
				$_POST['street'],
				$_POST['city'],
				$_POST['zipCode'],
				$_POST['stateCode']
			);

			$transaction->ReadyToPay();

			$data['success'] = true;

		} catch (Exception $e) {
			$data['success'] = false;
			$data['message'] = $e->getMessage();
		}
	}
}

header('Content-type: application/json');
echo json_encode($data);