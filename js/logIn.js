(function ($) {
	$(document).ready(function () {

		$('#frmLogIn').validate({

			rules: {
				txtUsername: { required: true },
				txtPassword: { required: true }
			},

			submitHandler: function () {
				var $txtUsername = $('#txtUsername');
				var $txtPassword = $('#txtPassword');
				var $btnLogIn = $('#btnLogIn');

				// Désactive temporairement les champs et le bouton.
				$txtUsername.attr('disabled', true);
				$txtPassword.attr('disabled', true);
				$btnLogIn.attr('disabled', true);

				var credentials = {
					'username': $txtUsername.val(),
					'password': $txtPassword.val()
				};

				$.post('ajax/tryLogIn.php', credentials)
					.done(function (data) {

						if (data.hasOwnProperty('success') && data['success'] &&
							data.hasOwnProperty('valid') && data['valid']) {

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
					.always(function () {
						// Active les champs et les boutons.
						$txtUsername.removeAttr('disabled');
						$txtPassword.removeAttr('disabled');
						$btnLogIn.removeAttr('disabled');
					})
			}
		});
	});
})(jQuery);