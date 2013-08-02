(function ($) {
	/**
	 * location class
	 * Gère différentes méthodes manipulant la location.
	 */
	$.URL = new function () {

		this.location = window.location;
		this.keyValues = this.location.search.substr(1).split('&');

		/**
		 * Retourne la valeur du paramètre.
		 *
		 * @param key           Clé.
		 *
		 * @returns {string}    Valeur.
		 */
		this.getParam = function (key) {

			var i = 0;
			while (i < this.keyValues.length) {
				var keyValue = this.keyValues[i].split('=');

				if (keyValue.length == 2 && keyValue[0] == key) {
					return decodeURIComponent(keyValue[1]);
				}
				i++;
			}

			return null;
		};


		/**
		 * Définit un paramètre. (Recharge de la page)
		 *
		 * @param key        Clé.
		 * @param value      Valeur.
		 */
		this.setParam = function (key, value) {

			var i = 0;
			while (i < this.keyValues.length) {
				var keyValue = this.keyValues[i].split('=');

				if (keyValue.length == 2 && keyValue[0] == key) {
					break;
				}
				i++;
			}

			// Si le paramètre n'existe pas, il sera ajouté.
			this.keyValues[i] = [key, encodeURIComponent(value)].join('=');

			this.location.search = this.keyValues.join('&');
		};
	}
})(jQuery);