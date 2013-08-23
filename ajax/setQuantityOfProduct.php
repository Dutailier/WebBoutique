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
	if (empty($_POST['sku'])) {
		$data['success'] = false;
		$data['message'] = ERROR_REQUIRED_PRODUCT_SKU;

	} else if (!isSet($_POST['quantity'])) {
		$data['success'] = false;
		$data['message'] = ERROR_REQUIRED_QUANTITY;

	} else {
		try {
			$transaction = new SessionTransaction();

			$product = $transaction->setQuantityOfProduct(
				$_POST['sku'],
				$_POST['quantity']
			);

			$data['product'] = $product->getInfoArray();
			$data['success'] = true;

		} catch (Exception $e) {
			$data['success'] = false;
			$data['message'] = $e->getMessage();
		}
	}
}

header('Content-type: application/json');
echo json_encode($data);