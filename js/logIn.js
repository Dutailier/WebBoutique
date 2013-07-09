$(document).ready(function () {

	$('#frmLogIn').validate({

		rules: {
			username: { required: true },
			password: { required: true }
		},

		submitHandler: function () {

			var credentials = {
				"username": $('#username').val(),
				"password": $('#password').val()
			};

			$.post('ajax/tryLogIn.php', credentials)
				.done(function (data) {

					if (data.hasOwnProperty('success') &&
						data['success'] &&
						data.hasOwnProperty('valid') &&
						data['valid']) {

						window.location = 'index.php';

					} else if (data.hasOwnProperty('message')) {
						noty({layout: 'topRight', type: 'error', text: data['message']});

					} else {
						noty({layout: 'topRight', type: 'error', text: 'The result of the server is unreadable.'});
					}
				})
				.fail(function () {
					noty({layout: 'topRight', type: 'error', text: 'Communication with the server failed.'});
				})
		}
	});
});