<?php
$title = CART_TITLE;
?>

<?php ob_start(); ?>

	<link type="text/css" rel="stylesheet" href="css/loading.css" />
	<link type="text/css" rel="stylesheet" href="css/paging.css" />
	<link type="text/css" rel="stylesheet" href="css/cart.css" />

<?php $head = ob_get_contents(); ?>
<?php ob_clean(); ?>

	<div class="buttons">
		<input class="btnContinueShopping" type="button" value="<?php echo CART_BTN_CONTINUE_SHOPPING; ?>" />
		<input class="btnProceedOrder" type="button" value="<?php echo CART_BTN_PROCEED_ORDER; ?>" />
		<a class="btnClearCart button"><?php echo CART_BTN_CLEAR_CART; ?></a>
	</div>

	<div id="productsList">
		<div id="productsLoader" class="loader">
			<label><?php echo PLEASE_WAIT; ?></label>
			<img src="img/loader.gif" />
		</div>
		<div id="productsEmpty" class="empty hidden">
			<label><?php echo CART_LBL_NO_PRODUCT; ?></label>
		</div>
	</div>

	<div id="summary">
		<p class="hidden">
			<label id="subTotal"></label>
			<label class="field"><?php echo CART_LBL_SUB_PRICE; ?></label>
		</p>

		<p class="hidden">
			<label id="totalShippingFee"></label>
			<label class="field"><?php echo CART_LBL_TOTAL_SHIPPING_FEE; ?></label>
		</p>

		<p class="hidden">
			<label id="totalPrice"></label>
			<label class="field"><?php echo CART_LBL_TOTAL_PRICE; ?></label>
		</p>

		<p>
			<input class="btnProceedOrder" type="button" value="<?php echo CART_BTN_PROCEED_ORDER; ?>" />
		</p>

		<div id="warnings">
			<label><?php echo LBL_WARNING; ?></label>
		</div>
	</div>

	<script src="js/transaction.js"></script>
	<script src="js/cart.js"></script>

<?php $content = ob_get_contents(); ?>
<?php ob_end_clean(); ?>