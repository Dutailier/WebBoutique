(function ($) {
	var $modelsSlider;
	var $typesSlider;

	var _modelCode;
	var _product;
	var _ottoman;

	// Évènements définis une fois le document HTML complètement généré.
	$(document).ready(function () {
		updateTypesToTypesList(function () {
			$('#typesDialog').dialog({
				title    : label['CONFIGURATOR_LBL_TYPES_DIALOG_TITLE'],
				width    : 600,
				height   : 300,
				modal    : true,
				resizable: false,
				draggable: false
			});
		});

		updateTypesInSlider(function () {
			$typesSlider = $('#typesSlider').bxSlider({
				minSlides          : 1,
				maxSlides          : 1,
				slideWidth         : 210,
				slideMargin        : 0,
				fadeOutControlOnEnd: true,
				infiniteLoop       : false,
				easing             : 'ease-in-out',
				onSliderLoad       : function () {
					var $type = $('div.type')
						.eq($typesSlider.getCurrentSlide());

					updateModelsByTypeCode($type.data('code'), function () {
						$modelsSlider = $('#modelsSlider').bxSlider({
							controls           : false,
							maxSlides          : 4,
							slideWidth         : 170,
							slideMargin        : 0,
							fadeOutControlOnEnd: true,
							infiniteLoop       : false,
							easing             : 'ease-in-out'
						});

						updateModel($('div.model').first().data('code'));
					})
				},
				onSlideBefore      : function () {
					var $type = $('div.type')
						.eq($typesSlider.getCurrentSlide());

					updateModelsByTypeCode($type.data('code'), function () {
						$modelsSlider.reloadSlider();
						updateModel($('div.model').first().data('code'));
					});
				}
			});
		});
	});

	// Gère les évènements des éléments générés dynamiquement.

	$(document).on('click', '#typesList > div.type', function () {
		var $type = $(this);

		$('#typesDialog').dialog('close');

		var slideIndex = $('#typesList').children().index($type);
		$typesSlider.goToSlide(slideIndex, null);
	});

	$(document).on('click', 'div.model', function () {
		updateModel($(this).data('code'));
	});

	$(document).on('change', '#ottomanIncluded', function () {
		updateOttoman(function () {
			updateSummary();
		});
	});

	$(document).on('change', '#finishsList', function () {
		var finishCode = $('#finishsList').val();
		var fabricCode = $('#fabricsList').val();
		var pipingCode = $('#pipingsList').val();

		updateFabricsListComponent(_modelCode, finishCode, pipingCode, function () {
			var $fabricsList = $('#fabricsList');

			if ($fabricsList.children().length) {
				$fabricsList.parent('p').fadeIn(1000);
			} else {
				$fabricsList.parent('p').hide();
			}

			$fabricsList.val(fabricCode);

			updatePipingsListComponent(_modelCode, finishCode, fabricCode, function () {
				var $pipingsList = $('#pipingsList');

				if ($pipingsList.children().length) {
					$pipingsList.parent('p').fadeIn(1000);
				} else {
					$pipingsList.parent('p').hide();
				}

				$pipingsList.val(pipingCode);

				getProductInfo(_modelCode, finishCode, fabricCode, pipingCode, function (product) {
					_product = product;
					updateProductInfo(product);
				});
			});
		});
	});


	$(document).on('change', '#fabricsList', function () {
		var finishCode = $('#finishsList').val();
		var fabricCode = $('#fabricsList').val();
		var pipingCode = $('#pipingsList').val();

		updateFinishsListComponent(_modelCode, fabricCode, pipingCode, function () {
			var $finishsList = $('#finishsList');

			if ($finishsList.children().length) {
				$finishsList.parent('p').fadeIn(1000);
			} else {
				$finishsList.parent('p').hide();
			}

			$finishsList.val(finishCode);

			updatePipingsListComponent(_modelCode, finishCode, fabricCode, function () {
				var $pipingsList = $('#pipingsList');

				if ($pipingsList.children().length) {
					$pipingsList.parent('p').fadeIn(1000);
				} else {
					$pipingsList.parent('p').hide();
				}

				$pipingsList.val(pipingCode);

				getProductInfo(_modelCode, finishCode, fabricCode, pipingCode, function (product) {
					_product = product;
					updateProductInfo(product);
				});
			});
		});
	});


	$(document).on('change', '#pipingsList', function () {
		var finishCode = $('#finishsList').val();
		var fabricCode = $('#fabricsList').val();
		var pipingCode = $('#pipingsList').val();

		updateFabricsListComponent(_modelCode, finishCode, pipingCode, function () {
			var $fabricsList = $('#fabricsList');

			if ($fabricsList.children().length) {
				$fabricsList.parent('p').fadeIn(1000);
			} else {
				$fabricsList.parent('p').hide();
			}

			$fabricsList.val(fabricCode);

			updateFinishsListComponent(_modelCode, fabricCode, pipingCode, function () {
				var $finishsList = $('#finishsList');

				if ($finishsList.children().length) {
					$finishsList.parent('p').fadeIn(1000);
				} else {
					$finishsList.parent('p').hide();
				}

				$finishsList.val(finishCode);

				getProductInfo(_modelCode, finishCode, fabricCode, pipingCode, function (product) {
					_product = product;
					updateProductInfo(product);
				});
			});
		});
	});


	$(document).on('click', '#addToCart', function () {
		addProductToCart(_product['sku'], function () {

			// Ajout du tabouret rembourré si inclu.
			if (_ottoman != undefined) {
				addProductToCart(_ottoman['sku'], function () {
					showContinueDialog();
				});
			}
			else {
				showContinueDialog();
			}
		});
	});


	/**
	 * Met à jours la liste des types disponibles.
	 *
	 * @param callback
	 */
	function updateTypesInSlider(callback) {
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
	 * Met à jours la liste des types disponibles.
	 *
	 * @param callback
	 */
	function updateTypesToTypesList(callback) {
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
								addTypeToTypesList(type);
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
	function updateModel(modelCode) {
		getModelByCode(modelCode, function (model) {
			updateModelInfo(model);
		});

		updateConfiguration(modelCode, function (modelCode, finishCode, fabricCode, pipingCode) {
			getProductInfo(modelCode, finishCode, fabricCode, pipingCode, function (product) {
				_product = product;
				updateProductInfo(product);
			});
		});
	}


	/**
	 * Met à jour les informations du produit configuré.
	 *
	 * @param product
	 */
	function updateProductInfo(product) {
		$('#productImage').attr('src', 'img/products/' + product['imageName']);

		if (product.hasOwnProperty('modelCodeMatchingOttoman')) {
			$('#ottomanIncluded').parent('p').fadeIn(1000);

		} else {
			$('#ottomanIncluded').parent('p').hide();
		}

		updateOttoman(function () {
			updateSummary();
		});
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
	function getProductInfo(modelCode, finishCode, fabricCode, pipingCode, callback) {

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
	function updateModelInfo(model) {
		var $modelName = $('#modelName');
		var $modelDescription = $('#modelDescription');

		_modelCode = model['code'];
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
				$finishsList.parent('p').fadeIn(1000);
			} else {
				$finishsList.parent('p').hide();
			}

			var finishCode = $finishsList.find('option:selected').val();

			updateFabricsListComponent(modelCode, finishCode, null, function () {
				var $fabricsList = $('#fabricsList');

				if ($fabricsList.children().length) {
					$fabricsList.parent('p').fadeIn(1000);
				} else {
					$fabricsList.parent('p').hide();
				}

				var fabricCode = $fabricsList.find('option:selected').val();

				updatePipingsListComponent(modelCode, finishCode, fabricCode, function () {
					var $pipingsList = $('#pipingsList');

					if ($pipingsList.children().length) {
						$pipingsList.parent('P').fadeIn(1000);
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
	 * Affiche la fenêtre demandant à l'utilisateur s'il veut poursuivre ses achats.
	 */
	function showContinueDialog() {
		$(
			'<div>' +
			'<p>' + label['CART_DIALOG_LBL_ADD_SUCCESFULLY'] + '</p>' +
			'<p>' + label['CART_DIALOG_LBL_WANT_CONTINUE_SHOPPING'] + '</p>' +
			'</div>'
		).dialog({
				title    : label['CONFIGURATOR_DIALOG_CONTINUE_SHOPPING_TITLE'],
				width    : 450,
				height   : 265,
				modal    : true,
				resizable: false,
				draggable: false,
				buttons  : [
					{
						'id' : 'dialogYes',
						text : label['CART_DIALOG_BTN_YES'],
						click: function () {
							$(this).dialog('close');
						}},
					{
						'id' : 'dialogNo',
						text : label['CART_DIALOG_BTN_NO'],
						click: function () {
							$('#dialogYes, #dialogNo').button('disable');
							window.location = 'cart.php';
						}
					}
				]
			});
	}


	/**
	 * Met à jour le tabouret correspondant à la chaise.
	 */
	function updateOttoman(callback) {
		if ($('#ottomanIncluded').val() == 'true') {
			getProductInfo(
				_product['modelCodeMatchingOttoman'],
				_product['finishCode'],
				_product['fabricCode'],
				_product['pipingCode'],
				function (ottoman) {
					_ottoman = ottoman;
					callback();
				});
		} else {
			_ottoman = undefined;
			callback();
		}
	}


	/**
	 * Met à jour le sommaire du produit.
	 */
	function updateSummary() {
		var price = parseFloat(_product['price']);
		var shippingFee = parseFloat(_product['shippingFee']);

		if (_ottoman != undefined) {
			price += parseFloat(_ottoman['price']);
			shippingFee += parseFloat(_ottoman['shippingFee']);
		}

		$('#productPrice').text(currencyFormat(price));
		$('#shippingFee').text(currencyFormat(shippingFee));
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
	 * Ajoute un type à la liste de types de produit.
	 *
	 * @param type
	 */
	function addTypeToTypesList(type) {
		var $type = $(
			'<div class="type" data-code="' + type['code'] + '">' +
			'<img src="img/types/' + type['code'] + '.png" />' +
			'<label class="name">' + type['name'] + '</label>' +
			'</div>'
		);
		$type.appendTo('#typesList');
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