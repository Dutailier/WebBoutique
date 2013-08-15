(function ($) {
	var $modelsSlider;
	var $typesSlider;
	var modelCode;
	var productSku;

	// Évènements définis une fois le document HTML complètement généré.
	$(document).ready(function () {
		updateTypes(function () {
			$typesSlider = $('#typesSlider').bxSlider({
				minSlides       : 1,
				maxSlides       : 1,
				slideWidth      : 210,
				slideMargin     : 0,
				hideControlOnEnd: true,
				infiniteLoop    : false,
				easing          : 'ease-in-out',
				onSliderLoad    : function () {
					var $type = $('div.type')
						.eq($typesSlider.getCurrentSlide());

					updateModelsByTypeCode($type.data('code'), function () {
						$modelsSlider = $('#modelsSlider').bxSlider({
							controls        : false,
							maxSlides       : 4,
							slideWidth      : 170,
							slideMargin     : 0,
							hideControlOnEnd: true,
							infiniteLoop    : false,
							easing          : 'ease-in-out'
						});

						updateProduct($('div.model').first().data('code'));
					})
				},
				onSlideBefore   : function () {
					var $type = $('div.type')
						.eq($typesSlider.getCurrentSlide());

					updateModelsByTypeCode($type.data('code'), function () {
						$modelsSlider.reloadSlider();
					});
				}
			});
		});
	});

	// Gère les évènements des éléments générés dynamiquement.

	$(document).on('click', 'div.model', function () {
		updateProduct($(this).data('code'));
	});

	$(document).on('change', '#finishsList', function () {
		var finishCode = $('#finishsList').val();
		var fabricCode = $('#fabricsList').val();
		var pipingCode = $('#pipingsList').val();

		updateFabricsListComponent(modelCode, finishCode, pipingCode, function () {
			var $fabricsList = $('#fabricsList');

			if ($fabricsList.children().length) {
				$fabricsList.parent('p').show();
			} else {
				$fabricsList.parent('p').hide();
			}

			$fabricsList.val(fabricCode);

			updatePipingsListComponent(modelCode, finishCode, fabricCode, function () {
				var $pipingsList = $('#pipingsList');

				if ($pipingsList.children().length) {
					$pipingsList.parent('p').show();
				} else {
					$pipingsList.parent('p').hide();
				}

				$pipingsList.val(pipingCode);

				getProductInfos(modelCode, finishCode, fabricCode, pipingCode, function (product) {
					updateProductInfos(product);
				});
			});
		});
	});


	$(document).on('change', '#fabricsList', function () {
		var finishCode = $('#finishsList').val();
		var fabricCode = $('#fabricsList').val();
		var pipingCode = $('#pipingsList').val();

		updateFinishsListComponent(modelCode, fabricCode, pipingCode, function () {
			var $finishsList = $('#finishsList');

			if ($finishsList.children().length) {
				$finishsList.parent('p').show();
			} else {
				$finishsList.parent('p').hide();
			}

			$finishsList.val(finishCode);

			updatePipingsListComponent(modelCode, finishCode, fabricCode, function () {
				var $pipingsList = $('#pipingsList');

				if ($pipingsList.children().length) {
					$pipingsList.parent('p').show();
				} else {
					$pipingsList.parent('p').hide();
				}

				$pipingsList.val(pipingCode);

				getProductInfos(modelCode, finishCode, fabricCode, pipingCode, function (product) {
					updateProductInfos(product);
				});
			});
		});
	});


	$(document).on('change', '#pipingsList', function () {
		var finishCode = $('#finishsList').val();
		var fabricCode = $('#fabricsList').val();
		var pipingCode = $('#pipingsList').val();

		updateFabricsListComponent(modelCode, finishCode, pipingCode, function () {
			var $fabricsList = $('#fabricsList');

			if ($fabricsList.children().length) {
				$fabricsList.parent('p').show();
			} else {
				$fabricsList.parent('p').hide();
			}

			$fabricsList.val(fabricCode);

			updateFinishsListComponent(modelCode, fabricCode, pipingCode, function () {
				var $finishsList = $('#finishsList');

				if ($finishsList.children().length) {
					$finishsList.parent('p').show();
				} else {
					$finishsList.parent('p').hide();
				}

				$finishsList.val(finishCode);

				getProductInfos(modelCode, finishCode, fabricCode, pipingCode, function (product) {
					updateProductInfos(product);
				});
			});
		});
	});


	$(document).on('click', '#addToCart', function () {
		addProductToCart(productSku);
	});


	/**
	 * Met à jours la liste des types disponibles.
	 *
	 * @param callback
	 */
	function updateTypes(callback) {
		$.post('ajax/getTypes.php')
			.done(function (data) {

				if (data.hasOwnProperty('success') && data['success'] &&
					data.hasOwnProperty('types')) {

					var types = data['types'];

					for (var i in types) {
						if (types.hasOwnProperty(i)) {
							var type = types[i];

							if (type.hasOwnProperty('code') &&
								type.hasOwnProperty('name')) {
								addTypeToTypesSlider(type);
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
			})
	}

	/**
	 * Met à jour la liste de modèles disponibles pour ce type de produit.
	 *
	 * @param typeCode
	 * @param callback
	 */
	function updateModelsByTypeCode(typeCode, callback) {
		var parameters = {
			'typeCode': typeCode
		};

		$.post('ajax/getModelsByTypeCode.php', parameters)
			.done(function (data) {

				if (data.hasOwnProperty('success') && data['success'] &&
					data.hasOwnProperty('models')) {

					var $models = $('div.model');
					var models = data['models'];

					$models.remove();

					for (var i in models) {
						if (models.hasOwnProperty(i)) {
							var model = models[i];

							if (model.hasOwnProperty('code') &&
								model.hasOwnProperty('name')) {
								addModelToModelsSlider(model);
							}
						}
					}

					callback();

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
	 * Met à jour les informations sur le produit.
	 *
	 * @param modelCode
	 */
	function updateProduct(modelCode) {
		getModelByCode(modelCode, function (model) {
			updateModelDetails(model);
		});

		updateConfiguration(modelCode, function (modelCode, finishCode, fabricCode, pipingCode) {
			getProductInfos(modelCode, finishCode, fabricCode, pipingCode, function (product) {
				updateProductInfos(product);
			});
		});
	}


	/**
	 * Met à jour les informations du produit configuré.
	 *
	 * @param product
	 */
	function updateProductInfos(product) {
		productSku = product['sku'];

		$('#productImage').attr('src', 'img/products/' + product['imageName']);
		$('#productPrice').text(currencyFormat(product['price']));
		$('#shippingFee').text(currencyFormat(product['shippingFee']));
	}


	/**
	 * Met à jour la liste de finis disponibles.
	 *
	 * @param modelCode
	 * @param fabricCode
	 * @param pipingCode
	 * @param callback
	 */
	function updateFinishsListComponent(modelCode, fabricCode, pipingCode, callback) {

		var parameters = {
			'modelCode' : modelCode,
			'fabricCode': fabricCode,
			'pipingCode': pipingCode
		};

		$.post('ajax/getFinishsByComponent.php', parameters)
			.done(function (data) {

				if (data.hasOwnProperty('success') && data['success'] &&
					data.hasOwnProperty('finishs')) {

					var $finishs = $('#finishsList').children();
					var finishs = data['finishs'];

					$finishs.remove();

					for (var i in finishs) {
						if (finishs.hasOwnProperty(i)) {
							var finish = finishs[i];

							if (finish.hasOwnProperty('code') &&
								finish.hasOwnProperty('name')) {
								addFinishInfosToFinishsList(finish);
							}
						}
					}

					callback();

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
	 * Met à jour la liste de tissus disponibles.
	 *
	 * @param modelCode
	 * @param finishCode
	 * @param pipingCode
	 * @param callback
	 */
	function updateFabricsListComponent(modelCode, finishCode, pipingCode, callback) {

		var parameters = {
			'modelCode' : modelCode,
			'finishCode': finishCode,
			'pipingCode': pipingCode
		};

		$.post('ajax/getFabricsByComponent.php', parameters)
			.done(function (data) {

				if (data.hasOwnProperty('success') && data['success'] &&
					data.hasOwnProperty('fabrics')) {

					var $fabrics = $('#fabricsList').children();
					var fabrics = data['fabrics'];

					$fabrics.remove();

					for (var i in fabrics) {
						if (fabrics.hasOwnProperty(i)) {
							var fabric = fabrics[i];

							if (fabric.hasOwnProperty('code') &&
								fabric.hasOwnProperty('name')) {
								addFabricInfosToFabricsList(fabric);
							}
						}
					}

					callback();

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
	 * Met à jour la liste de passepoils disponibles.
	 *
	 * @param modelCode
	 * @param finishCode
	 * @param fabricCode
	 * @param callback
	 */
	function updatePipingsListComponent(modelCode, finishCode, fabricCode, callback) {

		var parameters = {
			'modelCode' : modelCode,
			'finishCode': finishCode,
			'fabricCode': fabricCode
		};

		$.post('ajax/getPipingsByComponent.php', parameters)
			.done(function (data) {

				if (data.hasOwnProperty('success') && data['success'] &&
					data.hasOwnProperty('pipings')) {

					var $pipings = $('#pipingsList').children();
					var pipings = data['pipings'];

					$pipings.remove();

					for (var i in pipings) {
						if (pipings.hasOwnProperty(i)) {
							var piping = pipings[i];

							if (piping.hasOwnProperty('code') &&
								piping.hasOwnProperty('name')) {
								addPipingInfosToPipingsList(piping);
							}
						}
					}

					callback();

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
	 * Récupère les informations détaillées sur le modèle sélectionné.
	 *
	 * @param modelCode
	 * @param callback
	 */
	function getModelByCode(modelCode, callback) {
		var parameters = {
			'modelCode': modelCode
		};

		$.post('ajax/getModelByCode.php', parameters)
			.done(function (data) {

				if (data.hasOwnProperty('success') && data['success'] &&
					data.hasOwnProperty('model')) {

					var model = data['model'];

					if (model.hasOwnProperty('code') &&
						model.hasOwnProperty('name') &&
						model.hasOwnProperty('description')) {
						callback(model);
					}

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
	 * Récupère les informations du produit configuré.
	 *
	 * @param modelCode
	 * @param finishCode
	 * @param fabricCode
	 * @param pipingCode
	 * @param callback
	 */
	function getProductInfos(modelCode, finishCode, fabricCode, pipingCode, callback) {
		var parameters = {
			'modelCode' : modelCode,
			'finishCode': finishCode,
			'fabricCode': fabricCode,
			'pipingCode': pipingCode
		};

		$.post('ajax/getProductByComponent.php', parameters)
			.done(function (data) {

				if (data.hasOwnProperty('success') && data['success'] &&
					data.hasOwnProperty('product')) {

					var product = data['product'];

					if (product.hasOwnProperty('sku') &&
						product.hasOwnProperty('imageName')) {
						callback(product);
					}

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
	 * Met à jour les informations détaillées du modèle sélectionné.
	 *
	 * @param model
	 */
	function updateModelDetails(model) {
		var $modelName = $('#modelName');
		var $modelDescription = $('#modelDescription');

		modelCode = model['code'];
		$modelName.html(model['name']);
		$modelDescription.html(model['description']);
	}


	/**
	 * Met à jour les différents options disponibles pour ce modèle.
	 *
	 * @param modelCode
	 * @param callback
	 */
	function updateConfiguration(modelCode, callback) {
		updateFinishsListComponent(modelCode, null, null, function () {
			var $finishsList = $('#finishsList');

			if ($finishsList.children().length) {
				$finishsList.parent('p').show();
			} else {
				$finishsList.parent('p').hide();
			}

			var finishCode = $finishsList.find('option:selected').val();

			updateFabricsListComponent(modelCode, finishCode, null, function () {
				var $fabricsList = $('#fabricsList');

				if ($fabricsList.children().length) {
					$fabricsList.parent('p').show();
				} else {
					$fabricsList.parent('p').hide();
				}

				var fabricCode = $fabricsList.find('option:selected').val();

				updatePipingsListComponent(modelCode, finishCode, fabricCode, function () {
					var $pipingsList = $('#pipingsList');

					if ($pipingsList.children().length) {
						$pipingsList.parent('P').show();
					} else {
						$pipingsList.parent('p').hide();
					}

					var pipingCode = $pipingsList.find('option:selected').val();

					callback(modelCode, finishCode, fabricCode, pipingCode);
				});
			});
		});
	}


	/**
	 * Ajoute un type à la liste de types de produit.
	 *
	 * @param type
	 */
	function addTypeToTypesSlider(type) {
		var $type = $(
			'<li>' +
			'<div class="type" data-code="' + type['code'] + '">' +
			'<img src="img/types/' + type['code'] + '.png" />' +
			'<label class="name">' + type['name'] + '</label>' +
			'</div>' +
			'</li>'
		);
		$type.appendTo('#typesSlider');
	}


	/**
	 * Ajoute un modèle à la liste de modèles.
	 *
	 * @param model
	 */
	function addModelToModelsSlider(model) {
		var $model = $(
			'<li>' +
			'<div class="model" data-code="' + model['code'] + '">' +
			'<img src="img/models/' + model['code'] + '.png" />' +
			'<label class="name">' + model['name'] + '</label>' +
			'</div>' +
			'</li>'
		);
		$model.appendTo('#modelsSlider');
	}


	/**
	 * Ajoute un fini à la liste de finis.
	 *
	 * @param finish
	 */
	function addFinishInfosToFinishsList(finish) {
		$('#finishsList').append(
			$('<option class="finish"></option>')
				.val(finish['code'])
				.text(finish['name'])
		);
	}


	/**
	 * Ajoute un tissu à la liste de tissus.
	 *
	 * @param fabric
	 */
	function addFabricInfosToFabricsList(fabric) {
		$('#fabricsList').append(
			$('<option class="fabric"></option>')
				.val(fabric['code'])
				.text(fabric['name'])
		);
	}


	/**
	 * Ajoute un passepoil à la liste de passepoils.
	 *
	 * @param piping
	 */
	function addPipingInfosToPipingsList(piping) {
		$('#pipingsList').append(
			$('<option class="piping"></option>')
				.val(piping['code'])
				.text(piping['name'])
		);
	}
})(jQuery);