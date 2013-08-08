(function ($) {
	var $modelsSlider;
	var $typesSlider;

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
})(jQuery);