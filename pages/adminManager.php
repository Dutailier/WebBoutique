<?php
$title = ADMIN_MANAGER_TITLE;
?>

<?php ob_start(); ?>

<!-- Feuilles de style -->
<link type="text/css" rel="stylesheet" href="css/loading.css" />
<link type="text/css" rel="stylesheet" href="css/paging.css" />
<link type="text/css" rel="stylesheet" href="css/manager.css" />
<link type="text/css" rel="stylesheet" href="css/adminManager.css" />

<?php $head = ob_get_contents(); ?>
<?php ob_clean(); ?>

<div class="tabs">
	<ul>
		<li id="btnTabOrdersFeed"><?php echo ADMIN_MANAGER_BTN_TAB_ORDERS_FEED; ?></li>
		<li id="btnTabLogsFeed"><?php echo ADMIN_MANAGER_BTN_TAB_LOGS_FEED; ?></li>
		<li id="btnTabModelsAndTypesList"><?php echo ADMIN_MANAGER_BTN_TAB_MODELS_AND_TYPES_LIST; ?></li>
		<li id="btnTabStoresList"><?php echo ADMIN_MANAGER_BTN_TAB_STORES_LIST; ?></li>

		<?php // WARNING : Devra être ajouté lors d'une publication d'une version B2C. ?>
		<!-- <li id="btnTabCustomersList">--><?php //echo ADMIN_MANAGER_BTN_TAB_CUSTOMERS_LIST; ?><!--</li>-->
	</ul>
</div>

<div id="tabOrdersFeed" class="tab">
</div>

<div id="tabModelsAndTypesList" class="tab">
	<div id="typesFilters" class="filters">
		<div class="keyWordsWrapper">
			<label for="typesKeyWords"><?php echo ADMIN_MANAGER_LBL_SEARCH; ?></label>
			<input id="typesKeyWords" name="typesKeyWords" class="keyWords" type="text" />
		</div>
		<div id="languagesWrapper">
			<label for="languages"><?php echo ADMIN_MANAGER_LBL_LANGUAGE; ?></label>
			<select id="languagesList"></select>
		</div>
	</div>
	<div id="typesList" class="list">
		<div id="typesLoader" class="loader">
			<label><?php echo PLEASE_WAIT; ?></label>
			<img src="img/loader.gif" />
		</div>
		<div id="typesEmpty" class="empty hidden">
			<label><?php echo NO_RESULT; ?></label>
		</div>
	</div>
</div>

<div id="tabLogsFeed" class="tab">
</div>

<div id="tabCustomersList" class="tab">
</div>

<div id="tabStoresList" class="tab">
	<div id="storesFilters" class="filters">
		<div class="keyWordsWrapper">
			<label for="storesKeyWords"><?php echo ADMIN_MANAGER_LBL_SEARCH; ?></label>
			<input id="storesKeyWords" name="storeKeyWords" class="keyWords" type="text" />
		</div>
	</div>
	<div id="storesList" class="list">
		<div id="storesLoader" class="loader">
			<label><?php echo PLEASE_WAIT; ?></label>
			<img src="img/loader.gif" />
		</div>
		<div id="storesEmpty" class="empty hidden">
			<label><?php echo NO_RESULT; ?></label>
		</div>
	</div>
</div>

<!-- Scripts -->
<script src="js/plugins/paging.js"></script>
<script src="js/plugins/filtering.js"></script>
<script src="js/format.js"></script>

<script src="js/manager.js"></script>
<script src="js/adminManager.js"></script>

<?php $content = ob_get_contents(); ?>
<?php ob_end_clean(); ?>

