(function ($) {
	$(document).ready(function () {
		$('#btnShoppingCart').click(function () {
			window.location = 'cart.php';
		});

		$('#btnAdminManager').click(function () {
			window.location = 'adminManager.php';
		});

		$('#btnFrench').click(function () {
			$.URL.setParam('languageCode', 'FR');
		});

		$('#btnEnglish').click(function () {
			$.URL.setParam('languageCode', 'EN');
		});

		$('#btnLogOut').click(function () {
			logOut();
		});
	});
})(jQuery);