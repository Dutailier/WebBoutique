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
		})
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
		})
}
