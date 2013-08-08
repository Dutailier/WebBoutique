<?php
$title = CONFIGURATOR_TITLE;
?>

<?php ob_start(); ?>

<link type="text/css" rel="stylesheet" href="css/loading.css" />
<link type="text/css" rel="stylesheet" href="css/productConfigurator.css" />
<link type="text/css" rel="stylesheet" href="js/bxslider/jquery.bxslider.css" />

<?php $head = ob_get_contents(); ?>
<?php ob_clean(); ?>

<div id="slidersWrapper">
	<ul id="typesSlider" class="bxslider">
	</ul>
	<div id="separator"></div>
	<ul id="modelsSlider" class="bxslider">
	</ul>
</div>

<script src="js/bxslider/jquery.bxslider.min.js"></script>
<script src="js/productConfigurator.js"></script>

<?php $content = ob_get_contents(); ?>
<?php ob_end_clean(); ?>

