(function ($) {
	/**
	 * Crée une pagination.
	 *
	 * @param numElementsByPage Nombre d'éléments à afficher par page.
	 */
	$.fn.paginate = function (numElementsByPage) {

		var $elements = $(this);
		var $container = $elements.closest('ul.paging');

		// Si nécessaire, retire une précédente pagination.
		$container.find('ul.paging').remove();

		var numItems = $elements.length;
		var numPages = Math.ceil(numItems / numElementsByPage);

		// Si le nombre de page est inférieur ou égale à une,
		// il n'est pas nécessaire de créer une pagination.
		if (numPages <= 1) {
			return;
		}

		var $paging = $('<ul class="paging"></ul>');

		var currentPage = 0;
		while (currentPage < numPages) {
			$paging.append($('<li>' + ++currentPage + '</li>'))
		}

		// On ajoute la pagination à l'intérieur de l'élément parent.
		$container.append($paging);

		var $links = $paging.children('li');

		// Sélectionne la première page et cache tous les éléments des autres pages.
		$links.first().addClass('selected');
		$elements.slice(numElementsByPage).hide();

		// Définit le coportement de la pagination créée.
		$links.click(function () {

			// Retire la sélection courante.
			$links.removeClass('selected');

			// Sélectionne la page cliquée.
			$(this).addClass('selected');

			var currentPage = parseInt($(this).text()) - 1;
			var firstItem = currentPage * numElementsByPage;

			// Cache tous les éléments et affiche ceux de la page courante.
			$elements.hide();
			$elements.slice(firstItem, firstItem + numElementsByPage).show();
		});
	}
})(jQuery);