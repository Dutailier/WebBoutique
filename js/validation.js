(function ($) {
	$(document).ready(function () {
		updateTransactionInfo();

		$('#btnCancel').click(function () {
			cancelTransaction(function () {
				window.location = 'cart.php';
			});
		});

		$('#btnConfirm').click(function () {
			confirmTransaction(function () {
				window.location = 'confirmation.php';
			});
		});
	});


	/**
	 * Met à jour les informations de la transaction.
	 */
	function updateTransactionInfo() {
		getTransactionInfo(function (user, address, recipientInfo, shippingInfo, lines, summary) {
			updateUserInfo(user, address);
			updateShipToInfo(recipientInfo, shippingInfo);

			for (var i in lines) {
				if (lines.hasOwnProperty(i)) {
					var line = lines[i];

					addLineToLinesList(line);
				}
			}

			updateSummary(summary);
		});
	}


	/**
	 * Met à jour les informations du demandeur.
	 *
	 * @param user
	 * @param address
	 */
	function updateUserInfo(user, address) {

		// Validation du nom de l'utilisateur.
		if (!user.hasOwnProperty('name') || user['name'] == null) {
			if ((!user.hasOwnProperty('greeting') || user['greeting'] == null) &&
				(!user.hasOwnProperty('firstname') || user['firstname'] == null) &&
				(!user.hasOwnProperty('lastname') || user['lastname'] == null)) {
				return;

			} else {
				$('#lblUserName').html(nameFormat(user['greeting'], user['firstname'], user['lastname']));
			}

		} else {
			$('#lblUserName').html(user['name']);
		}

		// Validation du numéro de téléphone de l'utilisateur.
		if (!user.hasOwnProperty('phone') || user['phone'] == null) {
			return;

		} else {
			$('#lblUserPhone').html(phoneFormat(user['phone']));
		}

		// Validation de l'adresse courriel de l'utilisatuer.
		if (!user.hasOwnProperty('email') || user['email'] == null) {
			return;

		} else {
			$('#lblUserEmail').html(emailFormat(user['email']));
		}

		// Validation de l'adresse de l'utilsiateur.
		if ((!address.hasOwnProperty('street') || address['street'] == null) &&
			(!address.hasOwnProperty('zipcode') || address['zipCode'] == null) &&
			(!address.hasOwnProperty('city') || address['city'] == null) &&
			(!address.hasOwnProperty('stateCode') || address['stateCode'] == null)) {
			return;

		} else {
			$('#lblUserAddress').html(addressFormat(address));
		}
	}


	/**
	 * Met à jour les informations d'expédition.
	 *
	 * @param address
	 */
	function updateShipToInfo(recipientInfo, shippingInfo) {

		// Validation du nom d'expédition.
		if (!recipientInfo.hasOwnProperty('name') || recipientInfo['name'] == null) {
			if ((!recipientInfo.hasOwnProperty('greeting') || recipientInfo['greeting'] == null) &&
				(!recipientInfo.hasOwnProperty('firstname') || recipientInfo['firstname'] == null) &&
				(!recipientInfo.hasOwnProperty('lastname') || recipientInfo['lastname'] == null)) {
				return;

			} else {
				$('#lblShipToName').html(nameFormat(recipientInfo['greeting'], recipientInfo['firstname'], recipientInfo['lastname']));
			}

		} else {
			$('#lblShipToName').html(recipientInfo['name']);
		}

		// Validation du numéro de téléphone d'expédition.
		if (!recipientInfo.hasOwnProperty('phone') || recipientInfo['phone'] == null) {
			return;

		} else {
			$('#lblShipToPhone').html(phoneFormat(recipientInfo['phone']));
		}

		// Validation de l'adresse courriel d'expédition.
		if (!recipientInfo.hasOwnProperty('email') || recipientInfo['email'] == null) {
			return;

		} else {
			$('#lblShipToEmail').html(emailFormat(recipientInfo['email']));
		}

		// Validation de l'adresse d'expédition.
		if ((!shippingInfo.hasOwnProperty('street') || shippingInfo['street'] == null) &&
			(!shippingInfo.hasOwnProperty('zipcode') || shippingInfo['zipCode'] == null) &&
			(!shippingInfo.hasOwnProperty('city') || shippingInfo['city'] == null) &&
			(!shippingInfo.hasOwnProperty('stateCode') || shippingInfo['stateCode'] == null)) {
			return;

		} else {
			$('#lblShipToAddress').html(addressFormat(shippingInfo));
		}
	}


	/**
	 * Ajoute un ligne à la liste de lignes.
	 *
	 * @param line
	 */
	function addLineToLinesList(line) {
		var $line = $(
			'<div class="line" data-id="' + line['id'] + '">' +
			'</div>'
		);

		addInfosToLine(line, $line);
		addDetailsToLine(line, $line);

		$line.appendTo($('#linesList'));
	}


	/**
	 * Ajoute les informations sommaires au ligne.
	 *
	 * @param line
	 * @param $line
	 */
	function addInfosToLine(line, $line) {
		var $infos = $(
			'<div class="infos">' +
			'<label class="modelName">' + line['product']['model']['name'] + '</label>' +
			'<label class="sku">' + skuFormat(line['product']['sku']) + '</label>' +
			'<label class="quantity">' + line['quantity'] + '</label>' +
			'<label class="field">' + label['CART_ITEM_LBL_QUANTITY'] + '</label>' +
			'</div>'
		);

		$infos.appendTo($line);
	}


	/**
	 * Ajoute les informations détaillés au ligne.
	 *
	 * @param line
	 * @param $line
	 */
	function addDetailsToLine(line, $line) {
		var $details = $(
			'<div class="details">' +
			'<div class="imageWrapper">' +
			'<img src="img/products/' + line['product']['imageName'] + '"/>' +
			'</div>' +
			'<div class="detailsWrapper">' + (
				line['product']['modelCode'] != undefined && line['product']['modelCode'] != '' ?
					'<p>' +
					'<label class="field">' + label['CART_ITEM_LBL_MODEL_CODE'] + '</label>' +
					'<label class="modelCode">' + line['product']['modelCode'] + '</label>' +
					'</p>' : ''
				) + (
				line['product']['finishCode'] != undefined && line['product']['finishCode'] != '' ?
					'<p>' +
					'<label class="field">' + label['CART_ITEM_LBL_FINISH_CODE'] + '</label>' +
					'<label class="finishCode">' + line['product']['finishCode'] + '</label>' +
					'</p>' : ''
				) + (
				line['product']['fabricCode'] != undefined && line['product']['fabricCode'] != '' ?
					'<p>' +
					'<label class="field">' + label['CART_ITEM_LBL_FABRIC_CODE'] + '</label>' +
					'<label class="fabricCode">' + line['product']['fabricCode'] + '</label>' +
					'</p>' : ''
				) + (
				line['product']['pipingCode'] != undefined && line['product']['pipingCode'] != '' ?
					'<p>' +
					'<label class="field">' + label['CART_ITEM_LBL_PIPING_CODE'] + '</label>' +
					'<label class="pipingCode">' + line['product']['pipingCode'] + '</label>' +
					'</p>' : ''
				) +
			'</div>' +
			'<div class="totalWrapper">' +
			'<p>' +
			'<label class="price">' + currencyFormat(line['unitPrice']) + '</label>' +
			'<label class="field">' + label['CART_ITEM_LBL_PRICE'] + '</label>' +
			'</p>' +
			'<p>' +
			'<label class="shippingFee">' + currencyFormat(line['unitShippingFee']) + '</label>' +
			'<label class="field">' + label['CART_ITEM_LBL_SHIPPING_FEE'] + '</label>' +
			'</p>' +
			'<p>' +
			'<label class="totalPrice">' + currencyFormat(line['totalPrice']) + '</label>' +
			'<label class="field">' + label['CART_ITEM_LBL_TOTAL_PRICE'] + '</label>' +
			'</p>' +
			'<p>' +
			'<label class="totalShippingFee">' + currencyFormat(line['totalShippingFee']) + '</label>' +
			'<label class="field">' + label['CART_ITEM_LBL_TOTAL_SHIPPING_FEE'] + '</label>' +
			'</p>' +
			'</div>' +
			'</div>'
		);

		$details.appendTo($line);
	}


	function updateSummary(summary) {
		$('#subTotal').text(currencyFormat(summary['subTotal']));
		$('#totalShippingFee').text(currencyFormat(summary['totalShippingFee']));
		$('#totalPrice').text(currencyFormat(summary['subTotal'] + summary['totalShippingFee']));
	}
})
	(jQuery);