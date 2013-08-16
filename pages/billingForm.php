<?php
$title = BILLING_FORM_TITLE;
?>

<?php ob_start(); ?>

<link type="text/css" rel="stylesheet" href="css/billingForm.css" />

<?php $head = ob_get_contents(); ?>
<?php ob_clean(); ?>

<h1><?php echo BILLING_FORM_TITLE; ?></h1>

<form id="billingForm">
	<ul id="summary"></ul>
	<fieldset id="billingName">
		<legend><?php echo BILLING_FORM_LBL_BILLING_NAME; ?></legend>
		<p>
			<select id="greetingsList" name="greetingsList"></select>
			<input id="txtFirstName" name="txtFirstName" watermark="<?php echo BILLING_FORM_LBL_FIRST_NAME; ?>" />
			<input id="txtLastName" name="txtLastName" watermark="<?php echo BILLING_FORM_LBL_LAST_NAME; ?>" />
		</p>
	</fieldset>

	<fieldset>
		<legend><?php echo BILLING_FORM_LBL_BILLING_ADDRESS; ?></legend>

		<div class="left">
			<p>
				<label for="txtStreet"><?php echo BILLING_FORM_LBL_STREET; ?></label>
				<textarea id="txtStreet" name="txtStreet"></textarea>
			</p>

			<p>
				<label for="txtZipCode"><?php echo BILLING_FORM_LBL_ZIP_CODE; ?></label>
				<input id="txtZipCode" name="txtZipCode" />
			</p>
		</div>
		<div class="right">
			<p>
				<label for="txtCity"><?php echo BILLING_FORM_LBL_CITY; ?></label>
				<input id="txtCity" name="txtCity" />
			</p>

			<p>
				<label for="statesList"><?php echo BILLING_FORM_LBL_STATE; ?></label>
				<select id="statesList" name="statesList"></select>
			</p>

			<p>
				<label for="countriesList"><?php echo BILLING_FORM_LBL_COUNTRY; ?></label>
				<select id="countriesList" name="countriesList"></select>
			</p>
		</div>
	</fieldset>

	<fieldset>
		<legend><?php echo BILLING_FORM_LBL_CONTACT_INFORMATION; ?></legend>

		<div class="left">
			<p>
				<label for="txtEmail"><?php echo BILLING_FORM_LBL_EMAIL; ?></label>
				<input id="txtEmail" name="txtEmail" />
			</p>

			<p>
				<label for="txtConfirmation"><?php echo BILLING_FORM_LBL_CONFIRMATION; ?></label>
				<input id="txtConfirmation" name="txtConfirmation" />
			</p>
		</div>
		<div class="right">
			<p>
				<label for="txtPhone"><?php echo BILLING_FORM_LBL_PHONE; ?></label>
				<input id="txtPhone" name="txtPhone" />
			</p>
		</div>
	</fieldset>
	<div id="buttons">
		<input id="btnCancel" type="button" value="<?php echo BILLING_FORM_BTN_CANCEL; ?>" />
		<input id="btnSubmit" type="submit" value="<?php echo BILLING_FORM_BTN_SUBMIT; ?>" />
		<a id="btnClear" class="button"><?php echo BILLING_FORM_BTN_CLEAR; ?></a>
	</div>
</form>

<script src="js/transaction.js"></script>
<script src="js/billingForm.js"></script>

<?php $content = ob_get_contents(); ?>
<?php ob_end_clean(); ?>

