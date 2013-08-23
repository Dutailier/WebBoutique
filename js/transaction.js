/**
 * Ajoute le produit au panier d'achats.
 *
 * @param productSku
 * @param callback
 */
function addProductToCart(productSku, callback) {
	var parameters = {
		'sku': productSku
	};

	$.post('ajax/addProductToCart.php', parameters)
		.done(function (data) {

			if (data.hasOwnProperty('success') && data['success'] &&
				data.hasOwnProperty('quantity')) {

				callback(data['quantity']);

			} else if (data.hasOwnProperty('message')) {
				noty({
					layout: 'topRight',
					model : 'error',
					text  : data['message']
				});

			} else {
				noty({
					layout: 'topRight',
					model : 'error',
					text  : errors['SERVER_UNREADABLE']
				});
			}
		})
		.fail(function () {
			noty({
				layout: 'topRight',
				model : 'error',
				text  : errors['SERVER_FAILED']
			});
		});
}


/**
 * Retire le produit du panier d'achats.
 *
 * @param productSku
 * @param callback
 */
function removeProductFormCart(productSku, callback) {
	var parameters = {
		'sku': productSku
	};

	$.post('ajax/removeProductFromCart.php', parameters)
		.done(function (data) {

			if (data.hasOwnProperty('success') && data['success'] &&
				data.hasOwnProperty('quantity')) {

				callback(data['quantity']);

			} else if (data.hasOwnProperty('message')) {
				noty({
					layout: 'topRight',
					model : 'error',
					text  : data['message']
				});

			} else {
				noty({
					layout: 'topRight',
					model : 'error',
					text  : errors['SERVER_UNREADABLE']
				});
			}
		})
		.fail(function () {
			noty({
				layout: 'topRight',
				model : 'error',
				text  : errors['SERVER_FAILED']
			});
		});
}

/**
 * Récupère les informations de la transaction.
 */
function getTransactionInfo(callback) {
	$.post('ajax/getTransactionInfo.php')
		.done(function (data) {
			if (data.hasOwnProperty('success') && data['success'] &&
				data.hasOwnProperty('transaction')) {

				var transaction = data['transaction'];

				if (transaction.hasOwnProperty('user') &&
					transaction.hasOwnProperty('address') &&
					transaction.hasOwnProperty('recipientInfo') &&
					transaction.hasOwnProperty('shippingInfo') &&
					transaction.hasOwnProperty('lines') &&
					transaction.hasOwnProperty('summary')) {

					var user = transaction['user'];
					var address = transaction['address'];
					var recipientInfo = transaction['recipientInfo'];
					var shippingInfo = transaction['shippingInfo'];
					var lines = transaction['lines'];
					var summary = transaction['summary'];

					callback(user, address, recipientInfo, shippingInfo, lines, summary);
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
 * Annule la transaction courante.
 *
 * @param callback
 */
function cancelTransaction(callback) {
	$.post('ajax/cancelTransaction.php')
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
