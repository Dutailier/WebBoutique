(function ($) {
	/**
	 * location class
	 * Gère différentes méthodes manipulant l'location.
	 */
	$.URL = new function () {

		this.location = window.location;
		this.keyValues = this.location.search.substr(1).split('&');

		/**
		 * Retourne les paramètres location.
		 * @returns {{}}	Paramètres URL
		 */
		this.getParams = function () {

			var params = {};
			for (var i = 0; i < this.keyValues.length; i++) {
				var keyValue = this.keyValues[i].split('=');

				if (keyValue.length == 2) {
					params[keyValue[0]] = decodeURIComponent(keyValue[1]);
				}
			}

			return params;
		};


		/**
		 * Définit un paramètre location. (Recharge de la page)
		 * @param key		Clé.
		 * @param value		Valeur.
		 */
		this.setParam = function (key, value) {

			var i = 0;
			while (i < this.keyValues.length) {
				var keyValue = this.keyValues[i].split('=');

				if (keyValue[0] == key) {
					break;
				}

				i++;
			}
			this.keyValues[i] = [key, encodeURIComponent(value)].join('=');

			this.location.search = this.keyValues.join('&');
		};
	}
})(jQuery);