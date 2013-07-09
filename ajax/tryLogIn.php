<?php

include_once('../defines.php');
include_once(ROOT . 'libs/security.php');
include_once(ROOT . 'libs/language.php');

include_once(Language::getLanguageFile());

if (empty($_POST['username']) || empty($_POST['password'])) {
	$data['success'] = false;
	$data['message'] = ERROR_CREDENTIELS_REQUIRED;

} else {
	try {
		$data['valid'] = Security::TryLogin(
			$_POST['username'],
			$_POST['password']);

		$data['success'] = true;

	} catch (Exception $e) {
		$data['success'] = false;
		$data['message'] = $e->getMessage();
	}
}

header('Content-type: application/json');
echo json_encode($data);