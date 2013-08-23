(function ($) {
	$(document).ready(function () {
		updateTransactionInfo();
	});


	/**
	 * Met à jour les informations de la transaction.
	 */
	function updateTransactionInfo() {
		getUserInfo(function (user, address) {
			updateUserInfo(user, address);
		});

		getShipToInfo(function (recipientInfo, shippingInfo) {
			updateShipToInfo(recipientInfo, shippingInfo);
		});
	}


	/**
	 * Récupère les informations du demandeur.
	 */
	function getUserInfo(callback) {
		$.post('ajax/getUserConnected.php')
			.done(function (data) {
				if (data.hasOwnProperty('success') && data['success'] &&
					data.hasOwnProperty('user') &&
					data.hasOwnProperty('address')) {

					var user = data['user'];
					var address = data['address'];

					if ((user.hasOwnProperty('name') ||
						 (user.hasOwnProperty('greeting') &&
						  user.hasOwnProperty('firstname') &&
						  user.hasOwnProperty('lastname'))) &&
						user.hasOwnProperty('phone') &&
						user.hasOwnProperty('email') &&
						address.hasOwnProperty('street') &&
						address.hasOwnProperty('city') &&
						address.hasOwnProperty('zipCode') &&
						address.hasOwnProperty('stateCode')) {
						callback(user, address);
					}

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
	 * Récupère les informations d'expédition.
	 */
	function getShipToInfo(callback) {

	}


	/**
	 * Met à jour les informations du demandeur.
	 *
	 * @param user
	 * @param address
	 */
	function updateUserInfo(user, address) {
		var name = !user.hasOwnProperty('name') ?
			nameFormat(user['greeting'], user['firstname'], user['lastname']) :
			user['name'];

		$('#lblUserName').html(name);
		$('#lblUserAddress').html(addressFormat(address));
		$('#lblUserPhone').html(phoneFormat(user['phone']));
		$('#lblUserEmail').html(emailFormat(user['email']));
	}


	/**
	 * Met à jour les informations d'expédition.
	 *
	 * @param address
	 */
	function updateShipToInfo(recipientInfo, shippingInfo) {
		$('#lblShipToName').html(recipientInfo['name']);
		$('#lblShipToAddress').html(addressFormat(shippingInfo));
		$('#lblShipToPhone').html(phoneFormat(recipientInfo['phone']));
		$('#lblShipToEmail').html(emailFormat(recipientInfo['email']));
	}
})(jQuery);