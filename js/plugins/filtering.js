(function ($) {
	/**
	 * Filtre les éléments en gardent que ceux dont les "label" ont un texte
	 * correspondant aux mots clés. De plus, cette fonction surligne les textes
	 * correspondant.
	 *
	 * @param keyWords Mots clés.
	 */
	$.fn.filterByKeyWords = function (keyWords) {

		var $elements = $(this);
		var regex = new RegExp(keyWords, 'gi');

		$elements.hide();
		$elements.removeClass('matched');

		$elements.each(function () {
			var $element = $(this);
			var $labels = $element.find('label');

			$labels.each(function () {
				var $label = $(this);

				$label.html($label.text().replace(
					regex,
					function (match) {
						$element.addClass('matched');

						return $('<span></span>')
							.html(match)
							.css({'background-color': 'yellow'});
					}
				));
			});

			return $elements.hasClass('matched');
		});
	}
})(jQuery);
