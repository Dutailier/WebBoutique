<?php

include_once('config.php');
include_once(ROOT . 'libs/security.php');
include_once(ROOT . 'libs/language.php');

include_once(Language::getLanguageFile());

// TODO : Le test d'authentification devra être retiré lors de la publication d'une version B2C.
if (!Security::isAuthenticated()) {
	$page = 'logIn';

} else {
	$page = isSet($_GET['page']) ? $_GET['page'] : 'index';

	switch ($page) {
		case 'home':
		case 'index':
		case 'logIn':
			$page = 'logIn';
			break;
	}
}

$file = ROOT . 'pages/' . $page . '.php';
if (!file_exists($file)) {
	$file = ROOT . 'pages/' . 'error' . '.php';
}

include_once($file);

if (!isSet($title) || !isSet($head) || !isSet($content)) {
	include_once(ROOT . 'pages/' . 'error' . '.php');
}
?>

<html>
<head>
	<title>Web Boutique - <?php echo $title; ?></title>

	<!-- Sélection de la langue -->
	<?php $language = Language::getCurrent(); ?>
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
	<script src="http://ajax.aspnetcdn.com/ajax/jquery.validate/1.11.1/localization/messages_<?php echo $language; ?>.js" charset="utf8"></script>

	<!-- Noty -->
	<script type="text/javascript" src="js/noty/jquery.noty.js"></script>
	<script type="text/javascript" src="js/noty/themes/default.js"></script>
	<script type="text/javascript" src="js/noty/layouts/topRight.js"></script>

	<?php echo $head; ?>

</head>
<body>
<div id="wrapper">
	<div id="header-band">
		<div id="header-wrapper">
			<img id="logo-dutailier" src="img/dutailier.png">
			<ul id="menu">
				<?php if ($language == 'en') { ?>
					<li><a id="btnFrench">Français</a></li>
				<?php } else if ($language == 'fr') { ?>
					<li><a id="btnEnglish">English</a></li>
				<?php } ?>

				<?php if (Security::isAuthenticated()) { ?>
					<li><a id="btnLogOut">Log Out</a></li>
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
	<script src="js/languages/language.<?php echo $language; ?>.js" charset="utf8"></script>

	<script src="js/global/url.js"></script>
	<script src="js/menu.js"></script>
</body>
</html>