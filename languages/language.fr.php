<?php

// Menu principal
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

// Page du gestionnaire pour commerçant
define('STORE_MANAGER_TITLE', 'Gestionnaire pour commerçant.');

// Page du gestionnaire pour administrateur
define('ADMIN_MANAGER_TITLE', 'Gestionnaire pour adiministrateur.');
define('ADMIN_MANAGER_BTN_TAB_ORDERS_FEED', 'Commandes');
define('ADMIN_MANAGER_BTN_TAB_MODELS_LIST', 'Modèles');
define('ADMIN_MANAGER_BTN_TAB_LOGS_FEED', 'Évènements');
define('ADMIN_MANAGER_BTN_TAB_CUSTOMERS_LIST', 'Consommateurs');
define('ADMIN_MANAGER_BTN_TAB_STORES_LIST', 'Commerçants');
define('ADMIN_MANAGER_LBL_SEARCH', 'Recherche : ');
define('ADMIN_MANAGER_BTN_ADD_STORE', 'Ajouter un commerçant');
define('ADMIN_MANAGER_LBL_LANGUAGE', 'Langue : ');

// Autres
define('PLEASE_WAIT', 'Veuillez patienter...');
define('NO_RESULT', 'Aucun résult trouvé.');

// Erreurs du panier d'achats
define('ERROR_ITEM_DOESNT_EXIST', 'L\'item n\'est pas contenu dans le panier d\'achats.');
define('ERROR_POSITIVE_QUANTITY_REQUIRED', 'Une quantité positive est requise.');

// Erreurs de sécurité
define('ERROR_ALREADY_LOGIN', 'Vous êtes déjà connecté.');
define('ERROR_CREDENTIELS_REQUIRED', 'Le nom d\'utilisateur et le mot de passe sont obligatoire.');
define('ERROR_CREDENTIELS_INCORRECT', 'Le nom d\'utilisateur ou le mot de passe est incorrect.');
define('ERROR_AUTHENTIFICATION_REQUIRED', 'Vous devez être authentifié.');
define('ERROR_REQUIRED_ROLE_ADMINISTRATOR', 'Vous devez être authentifié en tant qu\'administrateur.');

// Erreurs AJAX
define('ERROR_REQUIRED_LANGUAGE_CODE', 'Le code de la langue des requis.');
define('ERROR_REQUIRED_STORE_REF', 'La référence du commerçant est requise.');

// Erreurs de transaction
define('ERROR_TRANSACTION_ALREADY_CHECKOUT', 'Vous avez déjà finalisé vos achats.');
define('ERROR_TRANSACTION_ALREADY_COMPLETE', 'Les informations d\'expédition ont déjà été inscrites.');
define('ERROR_TRANSACTION_STATUS_INVALID', 'Le statut n\'est pas valide.');
define('ERROR_TRANSACTION_ALREADY_OPEN', 'La transaction a déjà débuté.');

// Erreurs d'entités
define('ERROR_USER_DOESNT_EXIST', 'L\'utilisteur n\'existe pas.');
define('ERROR_USER_WASNT_ADDED', 'L\'utilisateur n\'a pas correctement été ajouté.');
define('ERROR_TYPE_DOESNT_EXIST', 'Le type n\'existe pas.');
define('ERROR_ADDRESS_WASNT_ADDED', 'Le type n\'a pas correctement été ajouté.');
define('ERROR_ADDRESS_DOESNT_EXIST', 'L\'adresse n\'existe pas.');
define('ERROR_ADDRESS_ZIP_CODE_CA_INVALID', 'Le code postal doit être standard. (ex : H0H 0H0)');
define('ERROR_ADDRESS_ZIP_CODE_US_INVALID', 'Le code postal doit être standard. (ex : 12345)');
define('ERROR_COMMENT_WASNT_ADDED', 'Le commentaire n\'a pas correctement été ajouté.');
define('ERROR_COMMENT_DOESNT_EXIST', 'Le commentaire n\'existe pas.');
define('ERROR_COUNTRY_DOESNT_EXIST', 'Le pays n\'existe pas.');
define('ERROR_CUSTOMER_WASNT_ADDED', 'Le consommateur n\'existe pas.');
define('ERROR_CUSTOMER_PHONE_INVALID', 'Le numéro de téléphone du client doit être standard. (ex : 1-234-567-9012)');
define('ERROR_CUSTOMER_EMAIL_INVALID', 'L\'adresse courriel du client doit être standard. (ex : info@dutailier.com)');
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
define('ERROR_STORE_PHONE_INVALID', 'Le numéro de téléphone du commerçant doit être standard. (ex : 1-234-567-9012)');
define('ERROR_STORE_EMAIL_INVALID', 'L\'adresse courriel du commerçant doit être standard. (ex : info@dutailier.com)');
define('ERROR_STORE_EMAIL_REP_INVALID', 'L\'adresse courriel du représentant doit être standard. (ex : info@dutailier.com)');
define('ERROR_STORE_EMAIL_AGENT_INVALID', 'L\'adresse courriel de l\'agent doit être standard. (ex : info@dutailier.com)');
define('ERROR_ROLE_INVALID', 'Le rôle n\'est pas valide.');
define('ERROR_LINE_WASNT_ADDED', 'La ligne n\'a pas correctement été ajouté.');
define('ERROR_LINE_DOESNT_EXIST', 'La ligne n\'existe pas.');

// Erreurs de base de donnéées
define('ERROR_DB_EXECUTION_FAILED', 'L\'exécution de la requête à échouée.');
define('ERROR_DB_CONNECTION_FAILED', 'La connexion à la base de données a échouée.');
