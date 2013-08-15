<?php
$title = BILLING_FORM_TITLE;
?>

<?php ob_start(); ?>

<link type="text/css" rel="stylesheet" href="css/billingForm.css" />

<?php $head = ob_get_contents(); ?>
<?php ob_clean(); ?>

<h1><?php echo BILLING_FORM_TITLE; ?></h1>

<fieldset id="billingName">
	<legend><?php echo BILLING_FORM_LBL_BILLING_NAME; ?></legend>
	<p>
		<select id="greetingsList"></select>
		<input id="txtFirstName" watermark="<?php echo BILLING_FORM_LBL_FIRST_NAME; ?>" />
		<input id="txtLastName" watermark="<?php echo BILLING_FORM_LBL_LAST_NAME; ?>" />
	</p>
</fieldset>

<fieldset>
	<legend><?php echo BILLING_FORM_LBL_BILLING_ADDRESS; ?></legend>

	<div class="left">
		<p>
			<label for="txtStreet"><?php echo BILLING_FORM_LBL_STREET; ?></label>
			<textarea id="txtStreet"></textarea>
		</p>

		<p>
			<label for="txtZipCode"><?php echo BILLING_FORM_LBL_ZIP_CODE; ?></label>
			<input id="txtZipCode" />
		</p>
	</div>
	<div class="right">
		<p>
			<label for="txtCity"><?php echo BILLING_FORM_LBL_CITY; ?></label>
			<input id="txtCity" />
		</p>

		<p>
			<label for="statesList"><?php echo BILLING_FORM_LBL_STATE; ?></label>
			<select id="statesList"></select>
		</p>

		<p>
			<label for="countriesList"><?php echo BILLING_FORM_LBL_COUNTRY; ?></label>
			<select id="countriesList"></select>
		</p>
	</div>
</fieldset>

<fieldset>
	<legend><?php echo BILLING_FORM_LBL_CONTACT_INFORMATION; ?></legend>

	<div class="left">
		<p>
			<label for="txtEmail"><?php echo BILLING_FORM_LBL_EMAIL; ?></label>
			<input id="txtEmail" />
		</p>

		<p>
			<label for="txtPhone"><?php echo BILLING_FORM_LBL_PHONE; ?></label>
			<input id="txtPhone" />
		</p>
	</div>
	<div class="right">
		<p>
			<label for="txtConfirmation"><?php echo BILLING_FORM_LBL_CONFIRMATION; ?></label>
			<input id="txtConfirmation" />
		</p>
	</div>
</fieldset>

<script src="js/billingForm.js"></script>

<?php $content = ob_get_contents(); ?>
<?php ob_end_clean(); ?>

