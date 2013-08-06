(function ($) {
	/**
	 * Crée une pagination.
	 *
	 * @param $container       Élément dans lequel sera ajouté la pagination.
	 * @param options          Option
	 * @returns {*}            Éléments.
	 */
	$.fn.paginate = function ($container, options) {

		var defaults = {
			numElementsByPage: 10,
			paginationClass  : 'paging'
		};

		options = $.extend({}, defaults, options);

		var $elements = $(this);

		// Si nécessaire, retire une précédente pagination.
		$container.children('ul').filter(function () {
			return $(this).hasClass(options.paginationClass);
		}).remove();

		var numElements = $elements.length;
		var numPages = Math.ceil(numElements / options.numElementsByPage);

		// Si le nombre de page est inférieur ou égale à un,
		// il n'est pas nécessaire de créer une pagination.
		if (numPages > 1) {

			var $paging = $('<ul></ul>').addClass(options.paginationClass);

			var currentPage = 0;
			while (currentPage < numPages) {
				$paging.append($('<li>' + ++currentPage + '</li>'))
			}

			// On ajoute la pagination à l'intérieur de l'élément parent.
			$container.append($paging);

			var $links = $paging.children('li');

			// Sélectionne la première page et cache les éléments des autres pages.
			$links.first().addClass('selected');
			$elements.slice(options.numElementsByPage).hide();

			// Définit le coportement de la pagination créée.
			$links.click(function selectPage() {

				// Retire la sélection courante.
				$links.removeClass('selected');

				// Sélectionne la page cliquée.
				$(this).addClass('selected');

				var currentPage = parseInt($(this).text()) - 1;
				var firstItem = currentPage * options.numElementsByPage;

				// Cache tous les éléments et affiche ceux de la page courante.
				$elements.hide();
				$elements.slice(firstItem, firstItem + options.numElementsByPage).show();
			});
		}

		return $elements;
	}
})(jQuery);