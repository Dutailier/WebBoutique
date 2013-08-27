(function ($) {
	$(document).ready(function () {
		$('#btnContinue').click(function () {
			closeTransaction(function () {
				window.location = 'productConfigurator.php';
			});
		});

		var count = 10;

		$('#lblRedirect').html(label['CONFIRMATION_REDIRECT'].toString().replace('[time]', count.toString()));

		startCountdown(count, function () {
			closeTransaction(function () {
				logOut();
			});
		});
	});


	/**
	 * Débute le décompte.
	 *
	 * @param count
	 * @param callback
	 */
	function startCountdown(count, callback) {
		var countdown = setInterval(function () {
			$('#lblRedirect').html(label['CONFIRMATION_REDIRECT'].toString().replace('[time]', (--count).toString()));
			if (count == 0) {
				clearInterval(countdown);
				callback();
			}
		}, 1000);
	}
})(jQuery);