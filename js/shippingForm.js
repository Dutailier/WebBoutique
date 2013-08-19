(function ($) {
	$(document).ready(function () {

		$.validator.addMethod('phone', function (value) {
			return /^[1]?[-. ]?\(?([0-9]{3})\)?[-. ]?([0-9]{3})[-. ]?([0-9]{4})$/g.test(value)
		}, label['VALIDATION_PHONE_MUST_BE_STANDARD']);

		$.validator.addMethod('zipCode', function (value) {
			var countryCode = $('#countriesList').val();

			switch (countryCode) {
				case 'CA':
					return /^[1]?[-. ]?\(?([0-9]{3})\)?[-. ]?([0-9]{3})[-. ]?([0-9]{4})$/g.test(value);
					break;
				case 'US' :
					return /^[0-9]{5}$/g.test(value);
					break;
				default:
					return false;
			}
		}, label['VALIDATION_ZIP_CODE_MUST_BE_STANDARD']);


		$('#billingForm').validate({
			rules: {
				// Nom de facturation
				greetingsList  : { required: true },
				txtFirstName   : { required: true },
				txtLastName    : { required: true },

				// Adresse de facturation
				txtStreet      : { required: true },
				txtZipCode     : { required: true, zipCode: true },
				txtCity        : { required: true },

				// Autres informations
				txtEmail       : { required: true, email: true },
				txtConfirmation: { required: true, email: true, equalTo: '#txtEmail' },
				txtPhone       : { required: true, phone: true }
			},

			messages: {
				txtFirstName   : { required: messages['REQUIRED_FIRST_NAME'] },
				txtLastName    : { required: messages['REQUIRED_LAST_NAME'] },
				txtStreet      : { required: messages['REQUIRED_STREET'] },
				txtZipCode     : { required: messages['REQUIRED_ZIP_CODE'] },
				txtCity        : { required: messages['REQUIRED_CITY'] },
				txtPhone       : { required: messages['REQUIRED_PHONE'] },
				txtEmail       : {
					required: messages['REQUIRED_EMAIL'],
					email   : messages['EMAIL_INVALID']
				},
				txtConfirmation: {
					required: messages['REQUIRED_EMAIL'],
					email   : messages['EMAIL_INVALID'],
					equalTo : messages['EMAIL_DIFFERENT']
				}
			},

			wrapper: 'li',

			errorPlacement: function (error) {
				$('#summary').append(error);
			},

			submitHandler: function () {
				submitBillingInfos(function () {});
			}
		});

		$('#countriesList').change(function () {
			updateStatesList($('#countriesList').val(), function () {});
			updateWatermark();
		});

		$('#btnClear').click(function () {
			clearFields();
		});

		$('#btnCancel').click(function () {
			cancelTransaction();
		});

		// Initialisation de la page

		updateGreetingsList(function () {});

		updateCountriesList(function () {
			updateStatesList($('#countriesList').val(), function () {});

			updateWatermark();
		});
	});


	/**
	 * Met à jour les indices dans les champs.
	 */
	function updateWatermark() {
		var countryCode = $('#countriesList').val();

		$('#txtFirstName').watermark(label['BILLING_FORM_WATERMARK_FIRST_NAME']);
		$('#txtLastName').watermark(label['BILLING_FORM_WATERMARK_LAST_NAME']);
		$('#txtEmail, #txtConfirmation').watermark(label['BILLING_FORM_WATERMARK_EMAIL']);
		$('#txtPhone').watermark(label['BILLING_FORM_WATERMARK_PHONE']);

		switch (countryCode) {
			case 'CA':
				$('#txtZipCode').watermark(label['BILLING_FORM_WATERMARK_ZIP_CODE_CA']);
				break;
			case 'US' :
				$('#txtZipCode').watermark(label['BILLING_FORM_WATERMARK_ZIP_CODE_US']);
				break;
		}
	}

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
	 * Met à jour la liste de pays.
	 *
	 * @param callback
	 */
	function updateCountriesList(callback) {
		$.post('ajax/getCountries.php')
			.done(function (data) {

				if (data.hasOwnProperty('success') && data['success'] &&
					data.hasOwnProperty('countries')) {

					var countries = data['countries'];

					for (var i in countries) {
						if (countries.hasOwnProperty(i)) {
							var country = countries[i];

							if (country.hasOwnProperty('code') &&
								country.hasOwnProperty('name')) {
								addCountryToCountriesList(country);
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
	 * Met à jour la liste des états ou provinces.
	 *
	 * @param countryCode
	 * @param callback
	 */
	function updateStatesList(countryCode, callback) {

		$('#statesList').find('option').remove();

		var parameters = {
			'countryCode': countryCode
		};

		$.post('ajax/getStatesByCountryCode.php', parameters)
			.done(function (data) {

				if (data.hasOwnProperty('success') && data['success'] &&
					data.hasOwnProperty('states')) {

					var states = data['states'];

					for (var i in states) {
						if (states.hasOwnProperty(i)) {
							var state = states[i];

							if (state.hasOwnProperty('code') &&
								state.hasOwnProperty('name')) {
								addStateToStatesList(state);
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
	 * Envoie les informations de facturation.
	 *
	 * @param callback
	 */
	function submitBillingInfos(callback) {
		var informations = {
			// Nom de facturation
			'greeting'   : $('#greetingsList').text(),
			'firstname'  : $('#txtFirstName').val(),
			'lastname'   : $('#txtLastName').val(),

			// Adresse de facturation
			'street'     : $('#txtStreet').val(),
			'zipCode'    : $('#txtZipCode').val(),
			'city'       : $('#txtCity').val(),
			'stateCode'  : $('#statesList').val(),
			'countryCode': $('#countriesList').val(),

			// Autres informations
			'email'      : $('#txtEmail').val(),
			'phone'      : $('#txtPhone').val()
		};

		$.post('ajax/submitBillingInfos.php', informations)
			.done(function (data) {

				if (data.hasOwnProperty('success') && data['success']) {

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
	 * Efface les champs du formulaire.
	 */
	function clearFields() {
		window.location.reload();
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


	/**
	 * Ajoute un pays à la liste.
	 *
	 * @param country
	 */
	function addCountryToCountriesList(country) {
		var $country = $(
			'<option value="' + country['code'] + '">' + country['name'] + '</option>'
		);

		$country.appendTo('#countriesList');
	}


	/**
	 * Ajoute l'état ou la province à la liste.
	 *
	 * @param state
	 */
	function addStateToStatesList(state) {
		var $state = $(
			'<option value="' + state['code'] + '">' + state['name'] + '</option>'
		);

		$state.appendTo('#statesList');
	}

})(jQuery);