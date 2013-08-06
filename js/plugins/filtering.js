(function ($) {
	/**
	 * Filtre les éléments en gardant ceux qui ont des éléments de la classe 'search'
	 * et qui correspondent aux mots clés.
	 *
	 * @param keyWords Mot clés
	 * @param options  Options
	 * @returns {*}    Éléments filtrés
	 */
	$.fn.filterByKeyWords = function (keyWords, options) {

		var defaults = {
			minLength     : 1,
			matchedClass  : 'matched',
			highlightClass: 'highlight'
		};

		options = $.extend({}, defaults, options);

		var $elements = $(this);
		var regex = new RegExp(keyWords, 'gi');

		$elements.hide();
		$elements.removeClass(options.matchedClass);

		$elements.each(function () {
			var $element = $(this);
			var $labels = $element.find('.search');

			$labels.each(function () {
				var $label = $(this);

				$label.html(
					$label.text().replace(
						regex,
						function (match) {
							$element.addClass(options.matchedClass);

							// Si aucun mots clés n'est rechercé, on retourne chaque caractère.
							if (keyWords.length < options.minLength) {
								return match;
							}

							// On crée un span qui surlignera les mots clés.
							var $span = $('<span></span>')
								.addClass(options.highlightClass)
								.text(match);

							// On retourne l'élément HTML ainsi créé.
							return  $span.get(0).outerHTML;
						}
					)
				);
			});
		});

		return  $elements.filter(function () {
			return $(this).hasClass(options.matchedClass);
		}).show();
	}
})(jQuery);
