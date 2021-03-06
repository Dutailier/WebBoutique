<?php

include_once('../config.php');
include_once(DIR . 'libs/security.php');
include_once(DIR . 'libs/localisation.php');
include_once(DIR . 'libs/sessionTransaction.php');

include_once(Localisation::getLanguageFile());

if (!Security::isAuthenticated()) {
	$data['success'] = false;
	$data['message'] = ERROR_AUTHENTIFICATION_REQUIRED;

} else {
	try {
		$transaction = new SessionTransaction();

		$recipientInfo = $transaction->getRecipientInfo();
		$shippingInfo  = $transaction->getShippingInfo();

		$data['recipientInfo'] = $recipientInfo->getInfoArray();
		$data['shippingInfo']  = $shippingInfo->getInfoArray();
		$data['success']       = true;

	} catch (Exception $e) {
		$data['success'] = false;
		$data['message'] = $e->getMessage();
	}
}

header('Content-type: application/json');
echo json_encode($data);