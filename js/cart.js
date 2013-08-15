(function ($) {
	var _products = [];

	$(document).ready(function () {

		updateProductsList();

		$('input.btnContinueShopping').click(function () {
			window.location = 'productConfigurator.php';
		});

		$('a.btnClearCart').click(function () {
			clearCart(function () {
				_products = [];
				$('#productsList').find('div.product').remove();
				updateSummaryInfos();
			});
		});
	});

	$(document).on('change', 'input.quantity', function () {
		var quantity = $(this).val() || 0;
		var $product = $(this).closest('div.product');

		setQuantityOfProduct($product, quantity, function (product) {

			_products[product['sku']] = product;

			if (quantity == 0) {
				$product.slideUp(function () {
					$(this).remove();

					updateSummaryInfos();
				});
			} else {
				$product.find('label.price').text(currencyFormat(product['price']));
				$product.find('label.shippingFee').text(currencyFormat(product['shippingFee']));
				$product.find('label.totalPrice').text(currencyFormat(product['totalPrice']));
				$product.find('label.totalShippingFee').text(currencyFormat(product['totalShippingFee']));

				updateSummaryInfos();
			}
		});
	});


	/**
	 * Met à jour la liste de produits.
	 */
	function updateProductsList() {

		$('#productsLoader').show();

		$.post('ajax/getProductsFromCart.php')
			.done(function (data) {

				if (data.hasOwnProperty('success') && data['success'] &&
					data.hasOwnProperty('products')) {

					var products = data['products'];

					for (var i in products) {
						if (products.hasOwnProperty(i)) {
							var product = products[i];

							if (product.hasOwnProperty('sku') &&
								product.hasOwnProperty('typeCode') &&
								product.hasOwnProperty('price') &&
								product.hasOwnProperty('shippingFee') &&
								product.hasOwnProperty('totalPrice') &&
								product.hasOwnProperty('totalShippingFee') &&
								product.hasOwnProperty('model')) {

								var model = product['model'];

								if (model.hasOwnProperty('name')) {

									// Ajoute le produit au tableau local afin de
									// pouvoir calculer les totaux côté client.
									_products[product['sku']] = product;

									addProductToProductsList(product);
								}
							}
						}
					}
					updateSummaryInfos();

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
			.always(function () {
				$('#productsLoader').hide();
			})
	}


	/**
	 * Définit la quantité du produit.
	 *
	 * @param $product
	 * @param quantity
	 * @param callback
	 */
	function setQuantityOfProduct($product, quantity, callback) {

		var parameters = {
			'sku'     : $product.data('sku'),
			'quantity': quantity
		};

		$.post('ajax/setQuantityOfProduct.php', parameters)
			.done(function (data) {

				if (data.hasOwnProperty('success') && data['success'] &&
					data.hasOwnProperty('product')) {

					callback(data['product']);

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
	 * Vide le panier d'achats.
	 *
	 * @param callback
	 */
	function clearCart(callback) {

		$('div.product').hide();
		$('#productsLoader').show();

		$.post('ajax/clearCart.php')
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
			}).
			always(function () {
				$('div.product').show();
				$('#productsLoader').hide();
			});
	}


	/**
	 * Ajoute un produit à la liste de produits.
	 *
	 * @param product
	 */
	function addProductToProductsList(product) {
		var $product = $(
			'<div class="product" data-sku="' + product['sku'] + '">' +
			'</div>'
		);

		addInfosToProduct(product, $product);
		addDetailsToProduct(product, $product);

		$product.appendTo($('#productsList'));
	}


	/**
	 * Ajoute les informations sommaires au produit.
	 *
	 * @param product
	 * @param $product
	 */
	function addInfosToProduct(product, $product) {
		var $infos = $(
			'<div class="infos">' +
			'<label class="modelName">' + product['model']['name'] + '</label>' +
			'<label class="sku">' + skuFormat(product['sku']) + '</label>' +
			'<input type="number" min="0" max="10" class="quantity"  value="' + product['quantity'] + '" />' +
			'<label class="field">' + label['CART_ITEM_LBL_QUANTITY'] + '</label>' +
			'</div>'
		);

		$infos.appendTo($product);
	}


	/**
	 * Ajoute les informations détaillés au produit.
	 *
	 * @param product
	 * @param $product
	 */
	function addDetailsToProduct(product, $product) {
		var $details = $(
			'<div class="details">' +
			'<div class="imageWrapper">' +
			'<img src="img/products/' + product['imageName'] + '"/>' +
			'</div>' +
			'<div class="detailsWrapper">' + (
				product['modelCode'] != undefined && product['modelCode'] != '' ?
					'<p>' +
					'<label class="field">' + label['CART_ITEM_LBL_MODEL_CODE'] + '</label>' +
					'<label class="modelCode">' + product['modelCode'] + '</label>' +
					'</p>' : ''
				) + (
				product['finishCode'] != undefined && product['finishCode'] != '' ?
					'<p>' +
					'<label class="field">' + label['CART_ITEM_LBL_FINISH_CODE'] + '</label>' +
					'<label class="finishCode">' + product['finishCode'] + '</label>' +
					'</p>' : ''
				) + (
				product['fabricCode'] != undefined && product['fabricCode'] != '' ?
					'<p>' +
					'<label class="field">' + label['CART_ITEM_LBL_FABRIC_CODE'] + '</label>' +
					'<label class="fabricCode">' + product['fabricCode'] + '</label>' +
					'</p>' : ''
				) + (
				product['pipingCode'] != undefined && product['pipingCode'] != '' ?
					'<p>' +
					'<label class="field">' + label['CART_ITEM_LBL_PIPING_CODE'] + '</label>' +
					'<label class="pipingCode">' + product['pipingCode'] + '</label>' +
					'</p>' : ''
				) +
			'</div>' +
			'<div class="totalWrapper">' +
			'<p>' +
			'<label class="price">' + currencyFormat(product['price']) + '</label>' +
			'<label class="field">' + label['CART_ITEM_LBL_PRICE'] + '</label>' +
			'</p>' +
			'<p>' +
			'<label class="shippingFee">' + currencyFormat(product['shippingFee']) + '</label>' +
			'<label class="field">' + label['CART_ITEM_LBL_SHIPPING_FEE'] + '</label>' +
			'</p>' +
			'<p>' +
			'<label class="totalPrice">' + currencyFormat(product['totalPrice']) + '</label>' +
			'<label class="field">' + label['CART_ITEM_LBL_TOTAL_PRICE'] + '</label>' +
			'</p>' +
			'<p>' +
			'<label class="totalShippingFee">' + currencyFormat(product['totalShippingFee']) + '</label>' +
			'<label class="field">' + label['CART_ITEM_LBL_TOTAL_SHIPPING_FEE'] + '</label>' +
			'</p>' +
			'</div>' +
			'</div>'
		);

		$details.appendTo($product);
	}


	/**
	 * Met à jour les totaux.
	 */
	function updateSummaryInfos() {
		var subTotal = 0;
		var totalShippingFee = 0;
		var totalPrice = 0;

		for (var i in _products) {
			var product = _products[i];

			if (product.hasOwnProperty('totalPrice') &&
				product.hasOwnProperty('totalShippingFee')) {
				subTotal += product['totalPrice'];
				totalShippingFee += product['totalShippingFee'];
				totalPrice += (subTotal + totalShippingFee);
			}
		}

		totalPrice = subTotal + totalShippingFee;

		var $subTotal = $('#subTotal');
		var $totalShippingFee = $('#totalShippingFee');
		var $totalPrice = $('#totalPrice');

		$subTotal.text(currencyFormat(subTotal));
		$totalShippingFee.text(currencyFormat(totalShippingFee));
		$totalPrice.text(currencyFormat(totalPrice));

		$subTotal.parent().toggle(subTotal > 0);
		$totalShippingFee.parent().toggle(totalShippingFee > 0);
		$totalPrice.parent().toggle(totalPrice > 0);

		$('#productsEmpty').toggle(totalPrice <= 0);
		$('input.btnProceedOrder').prop('disabled', totalPrice <= 0);
		$('#summary').toggle(totalPrice > 0);
	}
})(jQuery);
