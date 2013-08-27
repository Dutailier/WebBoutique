<?php
$title = CONFIRMATION_TITLE;
?>

<?php ob_start(); ?>

<?php $head = ob_get_contents(); ?>
<?php ob_clean(); ?>

<h1><?php echo CONFIRMATION_TEXT; ?></h1>
<p>
	<label id="lblRedirect" />
</p>

<input id="btnContinue" type="button" value="<?php echo CART_BTN_CONTINUE_SHOPPING; ?>" />

<script src="js/transaction.js"></script>
<script src="js/confirmation.js"></script>

<?php $content = ob_get_contents(); ?>
<?php ob_end_clean(); ?>

