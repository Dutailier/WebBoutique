(function ($) {
	/**
	 * Filtre les étiquettes en attribuant le style "matched" s'elle correspond
	 * aux mots clés inscrits.
	 * @param $labels           Étiquettes à filtrer.
	 * @param keyWords          Mots clés.
	 * @param highlightClass    Style de surbrillance.
	 */
	function filterByKeyWords($labels, keyWords, highlightClass) {

		$labels.hide();
		$labels.removeClass('matched');

		$labels.each(function (idx, label) {
			var $label = $(label);

			$label.html(
				$label.text().replace(
					new RegExp(keyWords, 'gi'),
					function (match) {
						return $('<span></span>').addClass(highlightClass);
					}
				)
			);
		});
	}
})(jQuery);
