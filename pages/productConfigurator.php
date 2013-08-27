<?php
$title = CONFIGURATOR_TITLE;
?>

<?php ob_start(); ?>

<link type="text/css" rel="stylesheet" href="css/loading.css" />
<link type="text/css" rel="stylesheet" href="css/productConfigurator.css" />
<link type="text/css" rel="stylesheet" href="js/plugins/bxslider/jquery.bxslider.css" />

<?php $head = ob_get_contents(); ?>
<?php ob_clean(); ?>

<div id="typesDialog">
	<p><?php echo CONFIGURATOR_LBL_TYPES_DIALOG_TEXT; ?></p>

	<div id="typesList">

	</div>
</div>

<div id="slidersWrapper">
	<ul id="typesSlider" class="bxslider">
	</ul>
	<div id="separator"></div>
	<ul id="modelsSlider" class="bxslider">
	</ul>
</div>
<div id="product">
	<div id="left">
		<img id="productImage" />
	</div>
	<div id="right">
		<div id="productInfos">
			<div id="modelDetails">
				<label id="modelName"></label>
				<label id="modelDescription"></label>
			</div>
			<div id="configuration">
				<p>
					<select id="finishsList"></select>
					<label for="finishsList"><?php echo CONFIGURATOR_LBL_FINISH_NAME; ?></label>
				</p>

				<p>
					<select id="fabricsList"></select>
					<label for="fabricsList"><?php echo CONFIGURATOR_LBL_FABRIC_NAME; ?></label>
				</p>

				<p>
					<select id="pipingsList"></select>
					<label for="pipingsList"><?php echo CONFIGURATOR_LBL_PIPING_NAME; ?></label>
				</p>
				<br />

				<p>
					<select id="ottomanIncluded">
						<option value="false"><?php echo CONFIGURATION_LBL_WITHOUT_OTTOMAN; ?></option>
						<option value="true"><?php echo CONFIGURATION_LBL_WITH_OTTOMAN; ?></option>
					</select>
					<label for="ottomanIncluded"><?php echo CONFIGURATOR_LBL_OTTOMAN_INCLUDED; ?></label>
				</p>
			</div>
			<div id="productCosts">
				<p>
					<label id="productPrice"></label>
					<label for="productPrice"><?php echo CONFIGURATOR_LBL_PRODUCT_PRICE; ?></label>
				</p>

				<p>
					<label id="shippingFee"></label>
					<label for="shippingFee"><?php echo CONFIGURATOR_LBL_SHIPPING_FEE; ?></label>
				</p>
			</div>

			<div id="summary">
				<?php if (Security::getRole() == ROLE_STORE) { ?>
					<input id="addToCart" type="button" value="<?php echo CONFIGURATOR_BTN_ADD_TO_CART; ?>" />
				<?php } ?>
			</div>
			<div id="warnings">
				<label><?php echo LBL_WARNING; ?></label>
			</div>
		</div>
	</div>
</div>

<script src="js/plugins/bxslider/jquery.bxslider.min.js"></script>
<script src="js/transaction.js"></script>
<script src="js/productConfigurator.js"></script>

<?php $content = ob_get_contents(); ?>
<?php ob_end_clean(); ?>

