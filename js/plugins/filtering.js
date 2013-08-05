(function ($) {
	/**
	 * Filtre les éléments en gardent que ceux dont la classe est "search" et qu'ils
	 * ont un texte correspondant aux mots clés. De plus, cette fonction surligne les
	 * mots clés recherchés.
	 *
	 * @param keyWords Mots clés.
	 */
	$.fn.filterByKeyWords = function (keyWords, options) {

		var defaults = {
			minLength: 1
		};

		var options = $.extend({}, defaults, options);

		var $elements = $(this);
		var regex = new RegExp(keyWords, 'gi');

		$elements.hide();
		$elements.removeClass('matched');

		$elements.each(function () {
			var $element = $(this);
			var $labels = $element.find('.search');

			$labels.each(function () {
				var $label = $(this);

				$label.html(
					$label.text().replace(
						regex,
						function (match) {
							$element.addClass('matched');

							// Si aucun mots clés n'a été inscrit, on réinitialise la valeur du label.
							// Autrement, on surligne les mot clés.
							return keyWords.length < options.minLength ? match :
								'<span class="highlight">' + match + '</span>';
						}
					)
				);
			});
		});

		return  $elements.filter('.matched').show();
	}
})(jQuery);
