/**
 * Concatonne les détails de l'adresse en une seule chaîne de caractères.
 * @param address
 * @returns {string}
 */
function addressFormat(address) {
	return address['street'] + ', ' +
		   address['city'] + ', ' +
		   (address['zipCode'].length == 6 ?
			   address['zipCode'].substring(0, 3) + ' ' + address['zipCode'].substring(3) :
			   address['zipCode']) + ', ' +
		   address['stateCode'];
}


/**
 * Transforme 12345678901 pour 1-234-567-8910.
 * @param phone
 * @returns {string}
 */
function phoneFormat(phone) {
	return phone.substring(0, 1) + '-' +
		   phone.substring(1, 4) + '-' +
		   phone.substring(4, 7) + '-' +
		   phone.substring(7);
}


/**
 * Transforme 2013-06-07 10:24:15.227 pour 2013-06-07 10:24.
 * @param date
 * @returns {string}
 */
function dateFormat(date) {
	return date.substring(0, 16);
}


/**
 * Retourne un lien hypertexte de l'adresse courriel.
 * @param email
 * @returns {string}
 */
function emailFormat(email) {
	return '<a href="mailto:' + email + '">' + email + '</a>';
}


/**
 * Transforme le prix selon la langue.
 *
 * @param price
 */
function currencyFormat(price) {
	var dollarsCents = price.toString().split('.');
	var dollars = dollarsCents[0];
	var cents = (dollarsCents[1] || '');

	var left = dollars.substring(0, 1);
	var right = (cents + '00').substring(0, 2);

	for (var i = 1; i < dollars.length; i++) {
		left += (i % 3 == 0 ? ',' : '') + dollars.substring(i, i + 1);
	}

	return '$ ' + left + '.' + right;
}