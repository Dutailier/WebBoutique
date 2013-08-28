<?php

// Menu principal
define('MENU_LBL_PRODUCTS', 'Produits');
define('MENU_LBL_CART', 'Panier d\'achats');
define('MENU_LBL_MANAGER', 'Gestionnaire');
define('MENU_LBL_LOGOUT', 'Se déconnecter');

// Page d'acceuil
define('HOME_TITLE', 'Home');

// Page de connexion
define('LOGIN_TITLE', 'Connexion');
define('LOGIN_BTN_LOGIN', 'Se connecter');
define('LOGIN_LBL_USERNAME', 'Nom d\'utilisateur');
define('LOGIN_LBL_PASSWORD', 'Mot de passe');

// Page d'erreur
define('ERROR_TITLE', 'Erreur');
define('ERROR_404', '404 - La page demandée n\'existe pas.');

// Page du configurateur de produit
define('CONFIGURATOR_TITLE', 'Configurateur de produit');
define('CONFIGURATOR_LBL_FINISH_NAME', 'Fini :');
define('CONFIGURATOR_LBL_FABRIC_NAME', 'Tissu :');
define('CONFIGURATOR_LBL_PIPING_NAME', 'Passepoil :');
define('CONFIGURATOR_LBL_PRODUCT_PRICE', 'Prix :');
define('CONFIGURATOR_LBL_SHIPPING_FEE', 'Frais de livraison :');
define('CONFIGURATOR_BTN_ADD_TO_CART', 'Ajouter au panier');
define('CONFIGURATOR_LBL_TYPES_DIALOG_TEXT', 'Cliquez sur le type de produit que vous cherchez.');
define('CONFIGURATOR_LBL_OTTOMAN_INCLUDED', 'Tabouret rembourré :');
define('CONFIGURATION_LBL_WITH_OTTOMAN', 'Inclu');
define('CONFIGURATION_LBL_WITHOUT_OTTOMAN', 'Non inclu');
define('CONFIGURATOR_LBL_PILOW_MATCHED', 'Coussin lombaire :');

// Page du panier d'achats
define('CART_TITLE', 'Panier d\'achats');
define('CART_LBL_TOTAL_PRICE', 'Prix total :');
define('CART_LBL_TOTAL_SHIPPING_FEE', 'Frais d\'expédition total :');
define('CART_LBL_SUB_PRICE', 'Sous total :');
define('CART_BTN_CONTINUE_SHOPPING', 'Continuer vos achats');
define('CART_BTN_PROCEED_ORDER', 'Finaliser');
define('CART_BTN_CLEAR_CART', 'Vider');
define('CART_LBL_NO_PRODUCT', 'Aucun produits.');

// Page d'informations d'expédition
define('SHIPPING_FORM_TITLE', 'Informations d\'expédition');
define('SHIPPING_FORM_LBL_SHIPPING_NAME', 'Nom');
define('SHIPPING_FORM_LBL_SHIPPING_ADDRESS', 'Adresse');
define('SHIPPING_FORM_LBL_STREET', 'Adresse');
define('SHIPPING_FORM_LBL_CITY', 'Ville');
define('SHIPPING_FORM_LBL_ZIP_CODE', 'Code postal');
define('SHIPPING_FORM_LBL_STATE', 'État ou province');
define('SHIPPING_FORM_LBL_COUNTRY', 'Pays');
define('SHIPPING_FORM_LBL_EMAIL', 'Courriel');
define('SHIPPING_FORM_LBL_PHONE', 'Téléphone');
define('SHIPPING_FORM_LBL_CONFIRMATION', 'Confirmation');
define('SHIPPING_FORM_LBL_CONTACT_INFORMATION', 'Contact');
define('SHIPPING_FORM_BTN_CANCEL', 'Annuler');
define('SHIPPING_FORM_BTN_SUBMIT', 'Continuer');
define('SHIPPING_FORM_BTN_CLEAR', 'Vider');
define('SHIPPING_FORM_LBL_FIRST_NAME', 'Prénom');
define('SHIPPING_FORM_LBL_LAST_NAME', 'Nom');

// Page de validation
define('VALIDATION_TITLE', 'Validation');
define('VALIDATION_LBL_USER_INFO', 'Informations du demandeur');
define('VALIDATION_LBL_USER_NAME', 'Nom :');
define('VALIDATION_LBL_USER_ADDRESS', 'Addresse :');
define('VALIDATION_LBL_USER_PHONE', 'Téléphone :');
define('VALIDATION_LBL_USER_EMAIL', 'Courriel :');
define('VALIDATION_LBL_USER_EMAIL_REP', 'Courriel (rep) :');
define('VALIDATION_LBL_USER_EMAIL_AGENT', 'Courriel (agent) :');
define('VALIDATION_LBL_SHIP_TO_INFO', 'Informations d\'expédition');
define('VALIDATION_LBL_SHIP_TO_NAME', 'Nom :');
define('VALIDATION_LBL_SHIP_TO_ADDRESS', 'Addresse :');
define('VALIDATION_LBL_SHIP_TO_PHONE', 'Téléphone :');
define('VALIDATION_LBL_SHIP_TO_EMAIL', 'Courriel :');
define('VALIDATION_BTN_CANCEL', 'Annuler');
define('VALIDATION_BTN_CONFIRM', 'Confirmer');

// Page de confirmation
define('CONFIRMATION_TITLE', 'Confirmation');
define('CONFIRMATION_TEXT', 'Votre commande a bien été traité. Vous recevrez un courriel de confirmation sous peu.');

// Page du gestionnaire pour commerçant
define('STORE_MANAGER_TITLE', 'Gestionnaire pour commerçant.');

// Page du gestionnaire pour administrateur
define('ADMIN_MANAGER_TITLE', 'Gestionnaire pour adiministrateur.');
define('ADMIN_MANAGER_BTN_TAB_ORDERS_FEED', 'Commandes');
define('ADMIN_MANAGER_BTN_TAB_MODELS_AND_TYPES_LIST', 'Modèles & Types');
define('ADMIN_MANAGER_BTN_TAB_LOGS_FEED', 'Évènements');
define('ADMIN_MANAGER_BTN_TAB_CUSTOMERS_LIST', 'Consommateurs');
define('ADMIN_MANAGER_BTN_TAB_STORES_LIST', 'Commerçants');
define('ADMIN_MANAGER_LBL_SEARCH', 'Recherche : ');
define('ADMIN_MANAGER_LBL_LANGUAGE', 'Langue : ');

// Autres
define('PLEASE_WAIT', 'Veuillez patienter...');
define('NO_RESULT', 'Aucun résult trouvé.');
define('LBL_WARNING', '* Taxes de ventes non incluses dans le prix.');

// Erreurs du panier d'achats
define('ERROR_ITEM_DOESNT_EXIST', 'L\'item n\'est pas contenu dans le panier d\'achats.');
define('ERROR_POSITIVE_QUANTITY_REQUIRED', 'Une quantité positive est requise.');

// Erreurs de sécurité
define('ERROR_ALREADY_LOGIN', 'Vous êtes déjà connecté.');
define('ERROR_CREDENTIELS_REQUIRED', 'Le nom d\'utilisateur et le mot de passe sont obligatoire.');
define('ERROR_CREDENTIELS_INCORRECT', 'Le nom d\'utilisateur ou le mot de passe est incorrect.');
define('ERROR_AUTHENTIFICATION_REQUIRED', 'Vous devez être authentifié.');
define('ERROR_REQUIRED_ROLE_ADMINISTRATOR', 'Vous devez être authentifié en tant qu\'administrateur.');
define('ERROR_REQUIRED_ROLE_STORE', 'Vous devez être authentifié en tant que commerçant.');

// Erreurs de transaction
define('ERROR_TRANSACTION_REQUIRED_STATUS_OPEN', 'La transaction doit être préalablement initiée.');
define('ERROR_TRANSACITON_NO_PRODUCT', 'La transaction doit avoir au minimum un produit.');
define('ERROR_TRANSACTION_TOTAL_PRICE_MAX', 'La transaction ne doit pas dépassé le maximum alloué.');
define('ERROR_TRANSACTION_REQUIRED_STATUS_CHECKOUT', 'Vous devez au préalable finaliser vos achats.');
define('ERROR_TRANSACTION_REQUIRED_RECIPIENT_INFO', 'Les informations d\'expédition doivent être complétées.');
define('ERROR_TRANSACTION_REQUIRED_SHIPPING_INFO', 'Les informations d\'expédition doivent être complétées.');
define('ERROR_TRANSACTION_REQUIRED_STATUS_FINALIZED', 'Les informations d\'expédition doivent être confirmées.');
define('ERROR_TRANSACTION_STATUS_INVALID', 'Le statut inscrit est invalide.');
define('ERROR_TRANSACTION_FILE_CANNOT_OPEN', 'Le fichier ne peut pas être ouvert.');

// Erreurs AJAX
define('ERROR_REQUIRED_LANGUAGE_CODE', 'Le code de la langue est requis.');
define('ERROR_REQUIRED_TYPE_NAME', 'Le nom du type de produit est requis.');
define('ERROR_REQUIRED_TYPE_CODE', 'Le code du type de produit est requis.');
define('ERROR_REQUIRED_MODEL_NAME', 'Le nom du modèle est requis.');
define('ERROR_REQUIRED_MODEL_DESCRIPTION', 'La description du modèle est requises.');
define('ERROR_REQUIRED_MODEL_CODE', 'Le code du modèle est requis.');
define('ERROR_REQUIRED_STORE_REF', 'La référence du commerçant est requise.');
define('ERROR_REQUIRED_PRODUCT_SKU', 'La sku du produit est requis.');
define('ERROR_REQUIRED_GREETING', 'La salutation est requis.');
define('ERROR_REQUIRED_FIRSTNAME', 'Le prénom est requis.');
define('ERROR_REQUIRED_LASTNAME', 'Le nom est requis.');
define('ERROR_REQUIRED_STREET', 'L\'adresse est requis.');
define('ERROR_REQUIRED_CITY', 'La ville est requis.');
define('ERROR_REQUIRED_ZIP_CODE', 'Le code postal est requis.');
define('ERROR_REQUIRED_STATE_CODE', 'L\'état est requis.');
define('ERROR_REQUIRED_COUNTRY_CODE', 'Le pays est requis.');
define('ERROR_REQUIRED_EMAIL', 'Le courriel est requis.');
define('ERROR_REQUIRED_PHONE', 'Le numéro de téléphone est requis.');
define('ERROR_REQUIRED_QUANTITY', 'Une quantité est requise.');

// Erreurs d'entités
define('ERROR_USER_DOESNT_EXIST', 'L\'utilisteur n\'existe pas.');
define('ERROR_USER_WASNT_ADDED', 'L\'utilisateur n\'a pas correctement été ajouté.');
define('ERROR_TYPE_DOESNT_EXIST', 'Le type n\'existe pas.');
define('ERROR_ADDRESS_WASNT_ADDED', 'Le type n\'a pas correctement été ajouté.');
define('ERROR_ADDRESS_DOESNT_EXIST', 'L\'adresse n\'existe pas.');
define('ERROR_ADDRESS_ZIP_CODE_CA_INVALID', 'Le code postal doit être standard. <br /> (ex : H0H 0H0)');
define('ERROR_ADDRESS_ZIP_CODE_US_INVALID', 'Le code postal doit être standard. <br /> (ex : 12345)');
define('ERROR_COMMENT_WASNT_ADDED', 'Le commentaire n\'a pas correctement été ajouté.');
define('ERROR_COMMENT_DOESNT_EXIST', 'Le commentaire n\'existe pas.');
define('ERROR_COUNTRY_DOESNT_EXIST', 'Le pays n\'existe pas.');
define('ERROR_CUSTOMER_WASNT_ADDED', 'Le consommateur n\'existe pas.');
define('ERROR_CUSTOMER_PHONE_INVALID', 'Le numéro de téléphone du client doit être standard. <br /> (ex : 1-450-772-2304)');
define('ERROR_CUSTOMER_EMAIL_INVALID', 'L\'adresse courriel du client doit être standard. <br /> (ex : info@dutailier.com)');
define('ERROR_FABRIC_DOESNT_EXIST', 'Le tissu n\'existe pas.');
define('ERROR_FINISH_DOESNT_EXIST', 'Le fini n\'existe pas.');
define('ERROR_LOG_DOESNT_EXIST', 'L\'entrée du journal d\'évènements n\'existe pas.');
define('ERROR_MODEL_DOESNT_EXIST', 'Le modèle n\'existe pas.');
define('ERROR_ORDER_WASNT_ADDED', 'La commande n\'a pas correctement été ajoutée.');
define('ERROR_ORDER_DOESNT_EXIST', 'Le commande n\'existe pas.');
define('ERROR_PIPING_DOESNT_EXIST', 'Le passepoil n\'existe pas.');
define('ERROR_PRODUCT_DOESNT_EXIST', 'Le produit n\'existe pas.');
define('ERROR_TYPE_INVALID', 'Le type n\'est pas valide.');
define('ERROR_RECIPIENT_WASNT_ADDED', 'Le destinateur n\'a pas correctement été ajouté.');
define('ERROR_RECIPIENT_DOESNT_EXIST', 'Le destinateur n\'existe pas.');
define('ERROR_SHIPPING_INFO_WASNT_ADDED', 'Les informations d\'expéditions n\'ont pas correctement été ajoutées.');
define('ERROR_SHIPPING_INFO_DOESNT_EXIST', 'Les informations d\'expéditions n\'existent pas.');
define('ERROR_STATE_DOESNT_EXIST', 'L\'état ou la province n\'existe pas.');
define('ERROR_STORE_DOESNT_EXIST', 'Le commerçant n\'existe pas.');
define('ERROR_STORE_PHONE_INVALID', 'Le numéro de téléphone du commerçant doit être standard. <br /> (ex : 1-450-772-2304)');
define('ERROR_STORE_EMAIL_INVALID', 'L\'adresse courriel du commerçant doit être standard. <br /> (ex : info@dutailier.com)');
define('ERROR_STORE_EMAIL_REP_INVALID', 'L\'adresse courriel du représentant doit être standard. <br /> (ex : info@dutailier.com)');
define('ERROR_STORE_EMAIL_AGENT_INVALID', 'L\'adresse courriel de l\'agent doit être standard. <br /> (ex : info@dutailier.com)');
define('ERROR_ROLE_INVALID', 'Le rôle n\'est pas valide.');
define('ERROR_LINE_WASNT_ADDED', 'La ligne n\'a pas correctement été ajouté.');
define('ERROR_LINE_DOESNT_EXIST', 'La ligne n\'existe pas.');
define('ERROR_RECIPIENT_PHONE_INVALID', 'Le numéro de téléphone doit être valide. <br /> (ex: 1-450-772-2304)');
define('ERROR_RECIPIENT_EMAIL_INVALID', 'L\'adresse courriel doit être valide. <br /> (ex: info@dutalier.com)');

// Erreurs de base de donnéées
define('ERROR_DB_EXECUTION_FAILED', 'L\'exécution de la requête à échouée.');
define('ERROR_DB_CONNECTION_FAILED', 'La connexion à la base de données a échouée.');
