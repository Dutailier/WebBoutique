<?php

include_once('config.php');
include_once(ROOT . 'libs/security.php');
include_once(ROOT . 'libs/localisation.php');

include_once(Localisation::getLanguageFile());

// WARNING : Le test d'authentification devra être retiré lors de la publication d'une version B2C.
if (!Security::isAuthenticated()) {
	$page = 'logIn';

} else {
	$page = isSet($_GET['page']) ? $_GET['page'] : 'index';

	switch ($page) {
		case 'home':
		case 'index':
		case 'logIn':
			switch (Security::getRole()) {
				case ROLE_CUSTOMER:
					$page = 'productConfigurator';
					break;
				case ROLE_STORE:
					$page = 'storeManager';
					break;
				case ROLE_ADMINISTRATOR:
					$page = 'adminManager';
					break;
			}
			break;
	}
}

// Inclue la page demandée seulement s'elle existe et est correctement construite.
if (file_exists($file = ROOT . 'pages/' . $page . '.php')) {
	include_once($file);

	if (!isSet($title) || !isSet($head) || !isSet($content)) {
		include_once(ERROR_PAGE);
	}
} else {
	include_once(ERROR_PAGE);
}


?>

<html>
<head>
	<title>Web Boutique - <?php echo $title; ?></title>

	<!-- Sélection de la langue -->
	<?php $languageCode = Localisation::getCurrentLanguage(); ?>

	<!-- Accepte les caractères accentués. -->
	<meta http-equiv="Content-type" content="text/html; charset=utf-8" />

	<link type="text/css" rel="stylesheet" href="css/default.css" />
	<link type="text/css" rel="stylesheet" href="css/master.css" />

	<!-- JQuery -->
	<script src="//ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script>

	<!-- Jquery UI -->
	<script src="http://code.jquery.com/ui/1.10.3/jquery-ui.js"></script>
	<link type="text/css" rel="stylesheet" href="http://code.jquery.com/ui/1.10.3/themes/smoothness/jquery-ui.css" />

	<!-- Jquery Validate plugin -->
	<script src="http://ajax.aspnetcdn.com/ajax/jquery.validate/1.11.1/jquery.validate.js"></script>

	<?php if ($languageCode != LANGUAGE_ENGLISH) { ?>
		<script src="http://ajax.aspnetcdn.com/ajax/jquery.validate/1.11.1/localization/messages_<?php echo strtolower($languageCode); ?>.js" charset="utf8"></script>
	<?php } ?>

	<!-- Noty -->
	<script type="text/javascript" src="js/plugins/noty/jquery.noty.js"></script>
	<script type="text/javascript" src="js/plugins/noty/themes/default.js"></script>
	<script type="text/javascript" src="js/plugins/noty/layouts/topRight.js"></script>

	<!-- Watermark -->
	<script type="text/javascript" src="js/plugins/watermark/jquery.watermark.js"></script>

	<?php echo $head; ?>

</head>
<body>
<div id="wrapper">
	<div id="header-band">
		<div id="header-wrapper">
			<img id="logo-dutailier" src="img/logo-dutailier.png">

			<ul id="menu">
				<?php if (Security::isAuthenticated()) { ?>
					<?php $role = Security::getRole(); ?>
					<?php if ($role == ROLE_ADMINISTRATOR || ROLE_STORE || ROLE_CUSTOMER) { ?>
						<li><a id="btnShoppingCart"><?php echo MENU_LBL_CART; ?></a></li>
					<?php } ?>
					<?php if ($role == ROLE_ADMINISTRATOR) { ?>
						<li><a id="btnAdminManager"><?php echo MENU_LBL_MANAGER; ?></a></li>
					<?php } ?>
				<?php } ?>
				<?php if ($languageCode == LANGUAGE_ENGLISH) { ?>
					<li><a id="btnFrench">Français</a></li>
				<?php } else if ($languageCode == LANGUAGE_FRENCH) { ?>
					<li><a id="btnEnglish">English</a></li>
				<?php } ?>

				<?php if (Security::isAuthenticated()) { ?>
					<li><a id="btnLogOut"><?php echo MENU_LBL_LOGOUT; ?></a></li>
				<?php } ?>
			</ul>
		</div>
	</div>
	<div id="content">
		<?php echo $content; ?>
	</div>
	<div id="footer-band">
		<div id="footer-wrapper">
			<span id="copyright">Dutailier 2013 &copy;</span>
		</div>
	</div>

	<!-- Scripts internes. -->
	<script src="js/languages/language.<?php echo strtolower($languageCode); ?>.js" charset="utf8"></script>
	<script src="js/format.<?php echo strtolower($languageCode); ?>.js"></script>
	<script src="js/global/url.js"></script>
	<script src="js/menu.js"></script>

</body>
</html>