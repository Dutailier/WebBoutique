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
<div id="product">
	<div id="productInfos">
		<div id="modelDetails">
			<label id="modelName"></label>
			<label id="modelDescription"></label>
		</div>
		<div id="configuration">
			<p>
				<label id="finishName" for="finishsList"><?php echo CONFIGURATOR_LBL_FINISH_NAME; ?></label>
				<select id="finishsList"></select>
			</p>

			<p>
				<label id="fabricName" for="fabricsList"><?php echo CONFIGURATOR_LBL_FABRIC_NAME; ?></label>
				<select id="fabricsList"></select>
			</p>

			<p>
				<label id="pipingName" for="pipingsList"><?php echo CONFIGURATOR_LBL_PIPING_NAME; ?></label>
				<select id="pipingsList"></select>
			</p>
		</div>
	</div>
	<img id="productImage" />
</div>

<script src="js/bxslider/jquery.bxslider.min.js"></script>
<script src="js/productConfigurator.js"></script>

<?php $content = ob_get_contents(); ?>
<?php ob_end_clean(); ?>

