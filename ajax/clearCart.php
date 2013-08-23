<?php

include_once('../config.php');
include_once(DIR . 'libs/security.php');
include_once(DIR . 'libs/sessionTransaction.php');

if (!Security::isAuthenticated()) {
	$data['success'] = false;
	$data['message'] = 'You must be authenticated.';
} else {
	try {
		$transaction = new SessionTransaction();
		$transaction->ClearCart();

		$data['success'] = true;

	} catch (Exception $e) {
		$data['success'] = false;
		$data['message'] = $e->getMessage();
	}
}

header('Content-type: application/json');
echo json_encode($data);
