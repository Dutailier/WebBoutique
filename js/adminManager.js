(function ($) {
// Évènements définis une fois le document HTML complètement généré.

	$(document).ready(function () {

		$('#btnTabOrdersFeed').click(function () {
			selectTabOrdersFeed();
		});

		$('#btnTabModelsAndTypesList').click(function () {
			selectTabModelsAndTypesList();
		});

		$('#btnTabLogsFeed').click(function () {
			selectTabLogsFeed();
		});

		$('#btnTabCustomersList').click(function () {
			selectTabCustomersList();
		});

		$('#btnTabStoresList').click(function () {
			selectTabStoresList();
		});

		$('#languagesList').change(function () {
			updateTypesList();
		});

		$('#storeKeyWords').keyup(function () {
			filterStoresByKeyWords();
		});

		//noinspection FallthroughInSwitchStatementJS
		switch ($.URL.getParam('tab')) {
			case 'modelsAndTypesList':
				selectTabModelsAndTypesList();
				break;

			case 'logsFeed':
				selectTabLogsFeed();
				break;

			case 'customersList':
				selectTabCustomersList();
				break;

			case 'storesList':
				selectTabStoresList();
				break;

			case 'ordersFeed':
			default:
				selectTabOrdersFeed();
				break;
		}
	});

	// Gère les évènements liés aux éléments générés dynamiquement.

	$(document).on('click', 'div.store > div.infos', function () {
		firstClickOnStore($(this).closest('div.store'));
	});

	$(document).on('click', 'div.type > div.infos', function () {
		firstClickOnType($(this).closest('div.type'));
	});

	$(document).on('click', 'input.btnEdit', function (e) {
		e.stopPropagation();

		var $btnEdit = $(this);
		var $lblEdit = $btnEdit.prev();
		var $txtEdit = $('<input class="txtEdit" type="text" />');

		$txtEdit.val($lblEdit.text());
		$txtEdit.width($lblEdit.width() + 15);
		$txtEdit.insertBefore($btnEdit);
		$lblEdit.hide();
		$btnEdit.hide();
	});

	$(document).on('click', 'input.txtEdit', function (e) {
		e.stopPropagation();
	});

	$(document).on('keyup', 'input.txtEdit', function (e) {
		// Seulement si la touche entrée est "ENTER".
		if (e.keyCode == 13) {
			var $txtEdit = $(this);
			var $lblEdit = $txtEdit.prev();
			var $btnEdit = $txtEdit.siblings('input.btnEdit');
			var $element = $txtEdit.closest('div.type, div.model');

			if ($element.is('div.type')) {
				updateTypeName($txtEdit.val(), $element, function () {
					$lblEdit.text($txtEdit.val());
					$lblEdit.show();
					$btnEdit.show();
					$txtEdit.remove();
				});
			}
		}
	});


	/**
	 * Affiche le contenu de l'onglet du flux de commandes.
	 */
	function selectTabOrdersFeed() {
		$('div.tabs').find('li').removeClass('selected');
		$('div.tab').hide();

		$('#btnTabOrdersFeed').addClass('selected');
		$('#tabOrdersFeed').show();
	}


	/**
	 * Affiche le contenu de l'onglet de la liste de modèles.
	 */
	function selectTabModelsAndTypesList() {
		$('div.tabs').find('li').removeClass('selected');
		$('div.tab').hide();

		$('#btnTabModelsAndTypesList').addClass('selected');
		$('#tabModelsAndTypesList').show();

		if ($('div.type').length == 0 &&
			$('#typesLoader').is(':hidden')) {
			updateLanguagesList();
		}
	}


	/**
	 * Affiche le contenu de l'onglet du flux d'évènements.
	 */
	function selectTabLogsFeed() {
		$('div.tabs').find('li').removeClass('selected');
		$('div.tab').hide();

		$('#btnTabLogsFeed').addClass('selected');
		$('#tabLogsFeed').show();
	}


	/**
	 * Affiche le contenu de l'onglet de la liste de consommateurs.
	 */
	function selectTabCustomersList() {
		$('div.tabs').find('li').removeClass('selected');
		$('div.tab').hide();

		$('#btnTabCustomersList').addClass('selected');
		$('#tabCustomersList').show();
	}


	/**
	 * Affiche le contenu de l'onglet de la liste de commerçants.
	 */
	function selectTabStoresList() {
		$('div.tabs').find('li').removeClass('selected');
		$('div.tab').hide();

		$('#btnTabStoresList').addClass('selected');
		$('#tabStoresList').show();

		if ($('div.store').length == 0 &&
			$('#storesLoader').is(':hidden')) {
			updateStoresList();
		}
	}


	/**
	 * Met à jour la liste des langues.
	 */
	function updateLanguagesList() {

		$('#typesLoader').show();
		$('#modelsFilters').find('input, select').attr('disabled', true);

		$.post('ajax/getLanguages.php')
			.done(function (data) {

				if (data.hasOwnProperty('success') && data['success'] &&
					data.hasOwnProperty('languages')) {

					var languages = data['languages'];
					var $languages = $('#languagesList');

					$languages.find('option').remove();

					for (var i in languages) {
						if (languages.hasOwnProperty(i)) {
							var language = languages[i];

							if (language.hasOwnProperty('code') &&
								language.hasOwnProperty('name')) {
								addLanguageToLanguagesList(language);
							}
						}
					}

					// Déclanche le changement de langue.
					$languages.trigger('change');

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
				$('div.store').show();
			})
			.always(function () {
			})
	}


	/**
	 * Met à jour la liste des types.
	 */
	function updateTypesList() {

		var parameters = {
			'languageCode': $('#languagesList').val()
		};

		$.post('ajax/getTypesByLanguageCode.php', parameters)
			.done(function (data) {

				if (data.hasOwnProperty('success') && data['success'] &&
					data.hasOwnProperty('types')) {

					var types = data['types'];
					var $types = $('#typesList').children('div.type');

					$types.remove();

					for (var i in types) {
						if (types.hasOwnProperty(i)) {
							var type = types[i];

							if (type.hasOwnProperty('code') &&
								type.hasOwnProperty('name')) {
								addTypeToTypesList(type);
							}
						}
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
				$('div.store').show();
			})
			.always(function () {
				$('#typesLoader').hide();
				$('#modelsFilters').find('input, select').attr('disabled', false);
			})
	}


	/**
	 * Met à jour le nom d'un type.
	 *
	 * @param name
	 * @param $type
	 */
	function updateTypeName(name, $type, callback) {

		var parameters = {
			'name'        : name,
			'typeCode'    : $type.data('code'),
			'languageCode': $('#languagesList').val()
		};

		$.post('ajax/updateTypeName.php', parameters)
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
				$('div.store').show();
			})
			.always(function () {
			})
	}

	/**
	 * Met à jour la liste de commerçants.
	 */
	function updateStoresList() {

		$('#storesFilters').find('input, select').attr('disabled', true);

		$('div.store').hide();
		$('#storeEmpty').hide();
		$('#storesLoader').show();

		$.post('ajax/getStores.php')
			.done(function (data) {

				if (data.hasOwnProperty('success') && data['success'] &&
					data.hasOwnProperty('stores')) {

					$('#storesList').children('div.store').remove();

					var stores = data['stores'];

					for (var i in stores) {
						if (stores.hasOwnProperty(i)) {
							var store = stores[i];

							if (store.hasOwnProperty('ref') &&
								store.hasOwnProperty('name')) {
								addStoreToStoresList(store);
							}
						}
					}

					filterStoresByKeyWords();

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
				$('div.store').show();
			})
			.always(function () {
				$('#storesLoader').hide();
				$('#storesFilters').find('input, select').attr('disabled', false);
			})
	}


	/**
	 * Gère le premier click sur un type de produit.
	 *
	 * @param $type
	 */
	function firstClickOnType($type) {
		var $infos = $type.children('div.infos');

		var parameters = {
			'typeCode'    : $type.data('code'),
			'languageCode': $('#languagesList').val()
		};

		$infos.click(false);
		$infos.animate({'opacity': 0.5});

		$.post('ajax/getModelsByTypeCodeAndLanguageCode.php', parameters)
			.done(function (data) {

				if (data.hasOwnProperty('success') && data['success'] &&
					data.hasOwnProperty('models')) {

					var models = data['models'];

					addTypeDetailsToType(models, $type);

					$infos.animate({'opacity': 1});
					$infos.click(function () {
						$type.children('div.details').stop().slideToggle();
					});

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
	 * Gère le premier click sur un commerçant.
	 *
	 * @param $store
	 */
	function firstClickOnStore($store) {
		var $infos = $store.children('div.infos');

		var parameters = {
			'ref': $store.data('ref')
		};

		$infos.click(false);
		$infos.animate({'opacity': 0.5});

		$.post('ajax/getStoreDetails.php', parameters)
			.done(function (data) {

				if (data.hasOwnProperty('success') && data['success'] &&
					data.hasOwnProperty('store') &&
					data.hasOwnProperty('address')) {

					var store = data['store'];
					var address = data['address'];

					if (store.hasOwnProperty('username') &&
						store.hasOwnProperty('phone') &&
						store.hasOwnProperty('email') &&
						store.hasOwnProperty('emailRep') &&
						store.hasOwnProperty('emailAgent') &&
						address.hasOwnProperty('street') &&
						address.hasOwnProperty('city') &&
						address.hasOwnProperty('zipCode') &&
						address.hasOwnProperty('stateCode')) {
						addStoreDetailsToStore(store, address, $store);

						$infos.animate({'opacity': 1});
						$infos.click(function () {
							$store.children('div.details').stop().slideToggle();
						})
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
			})
	}


	/**
	 * Filtre les commerçants par mot clés et crée une pagination.
	 */
	function filterStoresByKeyWords() {

		var keyWords = $('#storeKeyWords').val();
		var $storesList = $('#storesList');

		var $filtered = $storesList.children('div.store')
			.filterByKeyWords(keyWords, {})
			.paginate($storesList, {});

		if ($filtered.length > 0) {
			$('#storesEmpty').hide();
		} else {
			$('#storesEmpty').show();
		}
	}


	/**
	 * Ajoute une language a la liste de langues.
	 *
	 * @param language
	 */
	function addLanguageToLanguagesList(language) {
		var $language = $(
			'<option value="' + language['code'] + '">' +
				language['name'] +
				'</option>'
		);

		$language.appendTo('#languagesList');
	}


	/**
	 * Ajoute un type de produit à la liste des types de produits.
	 *
	 * @param type
	 */
	function addTypeToTypesList(type) {
		var $type = $(
			'<div class="type" data-code="' + type['code'] + '">' +
				'</div>'
		);

		addInfosToType(type, $type);

		$type.appendTo('#typesList');
	}

	/**
	 * Ajoute un commerçant à la liste des commerçants.
	 *
	 * @param store
	 */
	function addStoreToStoresList(store) {
		var $store = $(
			'<div class="store" data-ref="' + store['ref'] + '">' +
				'</div>'
		);

		addInfosToStore(store, $store);

		$store.appendTo('#storesList');
	}


	/**
	 * Ajoute les informations sommaires au type de produit.
	 *
	 * @param type
	 * @param $type
	 */
	function addInfosToType(type, $type) {
		var $infos = $(
			'<div class="infos">' +
				'<label class="code search">' + type['code'] + '</label>' +
				'<label class="name search">' + type['name'] + '</label>' +
				'<input class="btnEdit" type="button" />' +
				'</div>'
		);

		$infos.appendTo($type);
	}


	/**
	 * Ajoute les informations sommaires au commerçant.
	 *
	 * @param store
	 * @param $store
	 */
	function addInfosToStore(store, $store) {
		var $infos = $(
			'<div class="infos">' +
				'<label class="ref search">' + store['ref'] + '</label>' +
				'<label class="name search">' + store['name'] + '</label>' +
				'</div>'
		);

		$infos.appendTo($store);
	}


	/**
	 * Ajoute les informations détaillées du type de produit.
	 *
	 * @param models
	 * @param $type
	 */
	function addTypeDetailsToType(models, $type) {
		var $details = $('<div class="details"></div>');

		addModelsListToTypeDetails(models, $details);

		$details.hide().appendTo($type).slideDown();
	}


	/**
	 * Génère la liste de modèles du type de produit.
	 *
	 * @param models
	 * @param $details
	 */
	function addModelsListToTypeDetails(models, $details) {
		var $modelsList = $('<div class="modelsList"></div>');

		for (var i in models) {
			var model = models[i];

			if (model.hasOwnProperty('code') &&
				model.hasOwnProperty('name') &&
				model.hasOwnProperty('description')) {

				model['description'] = model['description'] == null ?
					label['TYPE_MODEL_EMPTY_DESCRIPTION'] :
					model['description'];

				var $model = $(
					'<div class="model" data-code="' + model['code'] + '">' +
						'<div class="infos">' +
						'<label class="code search">' + model['code'] + '</label>' +
						'<label class="name search">' + model['name'] + '</label>' +
						'<input class="btnEdit" type="button" />' +
						'</div>' +
						'<div class="details">' +
						'<label class="description">' + model['description'] + '</label>' +
						'<input class="btnEdit" type="button" />' +
						'</div>' +
						'</div>'
				);
				$model.appendTo($modelsList);
			}
		}
		$modelsList.appendTo($details);
	}


	/**
	 * Ajoute les informations détaillées au commerçant.
	 *
	 * @param store
	 * @param $store
	 */
	function addStoreDetailsToStore(store, address, $store) {
		var $details = $('<div class="details"></div>');

		$details.append(
			'<fieldset class="contactInfos">' +
				'<legend>' + label['STORE_CONTACT_INFOS_LEGEND'] + '</legend>' +
				'<p>' +
				'<label class="properties">' + label['STORE_CONTACT_INFOS_PHONE'] + '</label>' +
				'<label class="values">' + phoneFormat(store['phone']) + '</label>' +
				'</p>' +
				'<p>' +
				'<label class="properties">' + label['STORE_CONTACT_INFOS_EMAIL'] + '</label>' +
				'<label class="values">' + emailFormat(store['email']) + '</label>' +
				'</p>' +
				'<p>' +
				'<label class="properties">' + label['STORE_CONTACT_INFOS_EMAIL_REP'] + '</label>' +
				'<label class="values">' + emailFormat(store['emailRep']) + '</label>' +
				'</p>' +
				'<p>' +
				'<label class="properties">' + label['STORE_CONTACT_INFOS_EMAIL_AGENT'] + '</label>' +
				'<label class="values">' + emailFormat(store['emailAgent']) + '</label>' +
				'</p>' +
				'<p>' +
				'<label class="properties">' + label['STORE_CONTACT_INFOS_ADDRESS'] + '</label>' +
				'<label class="values">' + addressFormat(address) + '</label>' +
				'</p>' +
				'</fieldset>'
		);

		$details.hide().appendTo($store).slideDown();
	}
})(jQuery);