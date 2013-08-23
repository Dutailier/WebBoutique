<?php
$title = VALIDATION_TITLE;
?>

<?php ob_start(); ?>

	<link type="text/css" rel="stylesheet" href="css/validation.css" />

<?php $head = ob_get_contents(); ?>
<?php ob_clean(); ?>

	<fieldset id="userInfo">
		<legend><?php echo VALIDATION_LBL_USER_INFO; ?></legend>
		<p>
			<label class="propertie"><?php echo VALIDATION_LBL_USER_NAME; ?></label>
			<label id="lblUserName" class="value"></label>
		</p>

		<p>
			<label class="propertie"><?php echo VALIDATION_LBL_USER_ADDRESS; ?></label>
			<label id="lblUserAddress" class="value"></label>
		</p>

		<p>
			<label class="propertie"><?php echo VALIDATION_LBL_USER_PHONE; ?></label>
			<label id="lblUserPhone" class="value"></label>
		</p>

		<p>
			<label class="propertie"><?php echo VALIDATION_LBL_USER_EMAIL; ?></label>
			<label id="lblUserEmail" class="value"></label>
		</p>
	</fieldset>

	<fieldset id="shipToInfo">
		<legend><?php echo VALIDATION_LBL_SHIP_TO_INFO; ?></legend>
		<p>
			<label class="propertie"><?php echo VALIDATION_LBL_SHIP_TO_NAME; ?></label>
			<label id="lblShipToName" class="value"></label>
		</p>

		<p>
			<label class="propertie"><?php echo VALIDATION_LBL_SHIP_TO_ADDRESS; ?></label>
			<label id="lblShipToAddress" class="value"></label>
		</p>

		<p>
			<label class="propertie"><?php echo VALIDATION_LBL_SHIP_TO_PHONE; ?></label>
			<label id="lblShipToPhone" class="value"></label>
		</p>

		<p>
			<label class="propertie"><?php echo VALIDATION_LBL_SHIP_TO_EMAIL; ?></label>
			<label id="lblShipToEmail" class="value"></label>
		</p>
	</fieldset>

	<hr />

	<div id="linesList">
	</div>

	<div id="summary">
		<p>
			<label id="subTotal"></label>
			<label class="field"><?php echo CART_LBL_SUB_PRICE; ?></label>
		</p>

		<p>
			<label id="totalShippingFee"></label>
			<label class="field"><?php echo CART_LBL_TOTAL_SHIPPING_FEE; ?></label>
		</p>

		<p>
			<label id="totalPrice"></label>
			<label class="field"><?php echo CART_LBL_TOTAL_PRICE; ?></label>
		</p>

		<p>
			<input id="btnConfirm" type="button" value="<?php echo VALIDATION_BTN_CONFIRM; ?>" />
			<a id="btnCancel" class="button"><?php echo VALIDATION_BTN_CANCEL; ?></a>
		</p>

		<div id="warnings">
			<label><?php echo LBL_WARNING; ?></label>
		</div>
	</div>

	<script src="js/transaction.js"></script>
	<script src="js/validation.js"></script>

<?php $content = ob_get_contents(); ?>
<?php ob_end_clean(); ?>