(function ($) {
	$(document).ready(function () {
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


	/**
	 * Déconnecte l'utilisateur.
	 */
	function logOut() {
		$.post('ajax/logOut.php')
			.done(function (data) {

				if (data.hasOwnProperty('success') && data['success']) {

					// En redirigeant l'utiisateur vers "index.php",
					// il sera automatique pris en charge.
					window.location = 'index.php';

				} else if (data.hasOwnProperty('message')) {
					noty({
						layout: 'topRight',
						type  : 'error',
						text  : data['message']
					});

				} else {
					noty({
						layout: 'topRight',
						type  : 'error',
						text  : errors['SERVER_UNREADABLE']
					});
				}
			})
			.fail(function () {
				noty({
					layout: 'topRight',
					type  : 'error',
					text  : errors['SERVER_FAILED']
				});
			})
	}
})(jQuery);