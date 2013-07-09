(function ($) {
	/**
	 * URL class
	 * Gère différentes méthodes manipulant l'URL.
	 */
	$.URL = new function () {

		this.url = window.location;


		/**
		 * Retourne les paramètres URL.
		 * @returns {{}}
		 */
		this.getParams = function () {
			var keyValues = this.url.search.substr(1).split('&');

			var params = {};
			for (var i = 0; i < keyValues.length; i++) {
				var keyValue = keyValues[i].split('=');

				if (keyValue.length == 2) {
					params[keyValue[0]] = decodeURIComponent(keyValue[1]);
				}
			}

			return params;
		};


		/**
		 * Définit un paramètre URL. (Recharge de la page)
		 * @param key
		 * @param value
		 */
		this.setParam = function (key, value) {
			var i = 0;
			var keyValues = this.url.search.substr(1).split('&');

			while (i < keyValues.length) {
				var keyValue = keyValues[i].split('=');

				if (keyValue[0] == key) {
					break;
				}

				i++;
			}
			keyValues[i] = [key, encodeURIComponent(value)].join('=');

			this.url.search = keyValues.join('&');
		};
	}
})(jQuery);