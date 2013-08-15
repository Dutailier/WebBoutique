(function ($) {
	$(document).ready(function () {
		updateGreetingsList(function () {});
	});


	/**
	 * Met à jour la liste des salutation.
	 */
	function updateGreetingsList(callback) {
		$.post('ajax/getGreetings.php')
			.done(function (data) {

				if (data.hasOwnProperty('success') && data['success'] &&
					data.hasOwnProperty('greetings')) {

					var greetings = data['greetings'];

					for (var i in greetings) {
						if (greetings.hasOwnProperty(i)) {
							var greeting = greetings[i];

							if (greeting.hasOwnProperty('name')) {
								addGreetingToGreetingsList(greeting);
							}
						}
					}

					callback();


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
			});
	}


	/**
	 * Ajoute une salutation à la liste.
	 *
	 * @param greeting
	 */
	function addGreetingToGreetingsList(greeting) {
		var $greeting = $(
			'<option>' + greeting['name'] + '</option>'
		);

		$greeting.appendTo('#greetingsList');
	}

})(jQuery);