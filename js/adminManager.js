(function ($) {
// Évènements définis une fois le document HTML complètement généré.

	$(document).ready(function () {

		$('#btnTabOrdersFeed').click(function () {
			selectTabOrdersFeed();
		});

		$('#btnTabProductsList').click(function () {
			selectTabProductsList();
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

		$('#storeKeyWords').keyup(function () {
			filterStoresByKeyWords();
		})

		//noinspection FallthroughInSwitchStatementJS
		switch ($.URL.getParam('tab')) {
			case 'productsList':
				selectTabProductsList();
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

	$(document).on('click', 'div.store', function () {
		firstClickInStore($(this));
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
	 * Affiche le contenu de l'onglet de la liste de produits.
	 */
	function selectTabProductsList() {
		$('div.tabs').find('li').removeClass('selected');
		$('div.tab').hide();

		$('#btnTabProductsList').addClass('selected');
		$('#tabProductsList').show();
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

		updateStoresList();
	}


	/**
	 * Met à jour la liste de commerçants.
	 */
	function updateStoresList() {

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
			})
	}


	/**
	 * Gère le premier click sur un commerçant.
	 *
	 * @param $store
	 */
	function firstClickInStore($store) {
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
			.always(function () {
				$infos.animate({'opacity': 1});
				$infos.click(function () {
					$store.children('div.details').stop().slideToggle();
				})
			})
	}


	/**
	 * Filtre les commerçants par mot clés et crée une pagination.
	 */
	function filterStoresByKeyWords() {

		var keyWords = $('#storeKeyWords').val();
		var $stores = $('#storesList').children('div.store');

		$stores
			.filterByKeyWords(keyWords, {})
			.paginate({});
	}


	/**
	 * Ajoute un commerçant à la liste des commerçants.
	 *
	 * @param store
	 */
	function addStoreToStoresList(store) {
		var $store = $('<div class="store" data-ref="' + store['ref'] + '"></div>');

		addInfosToStore(store, $store);

		$store.appendTo('#storesList');
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
				'<label class="values">' + store['email'] + '</label>' +
				'</p>' +
				'<p>' +
				'<label class="properties">' + label['STORE_CONTACT_INFOS_EMAIL_REP'] + '</label>' +
				'<label class="values">' + store['emailRep'] + '</label>' +
				'</p>' +
				'<p>' +
				'<label class="properties">' + label['STORE_CONTACT_INFOS_EMAIL_AGENT'] + '</label>' +
				'<label class="values">' + store['emailAgent'] + '</label>' +
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