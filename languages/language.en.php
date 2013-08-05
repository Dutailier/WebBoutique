<?php

// Menu principal
define('MENU_LBL_LOGOUT', 'Log Out');

// Page d'acceuil
define('HOME_TITLE', 'Home');

// Page de connexion
define('LOGIN_TITLE', 'Log In');
define('LOGIN_BTN_LOGIN', 'Log In');
define('LOGIN_LBL_USERNAME', 'Username');
define('LOGIN_LBL_PASSWORD', 'Password');

// Page d'erreur
define('ERROR_TITLE', 'Error');
define('ERROR_404', '404 - Page not found.');

// Page du gestionnaire pour commerçant
define('STORE_MANAGER_TITLE', 'Gestionnaire pour commerçant.');

// Page du gestionnaire pour administrateur
define('ADMIN_MANAGER_TITLE', 'Gestionnaire pour adiministrateur.');
define('ADMIN_MANAGER_BTN_TAB_ORDERS_FEED', 'Orders Feed');
define('ADMIN_MANAGER_BTN_TAB_PRODUCTS_LIST', 'Products List');
define('ADMIN_MANAGER_BTN_TAB_LOGS_FEED', 'Logs Feed');
define('ADMIN_MANAGER_BTN_TAB_CUSTOMERS_LIST', 'Customers List');
define('ADMIN_MANAGER_BTN_TAB_STORES_LIST', 'Stores List');
define('ADMIN_MANAGER_LBL_SEARCH', 'Search : ');
define('ADMIN_MANAGER_BTN_ADD_STORE', 'Add Store');

// Autres
define('PLEASE_WAIT', 'Please wait...');
define('NO_RESULT', 'No result was found.');

// Erreurs du panier d'achats
define('ERROR_ITEM_DOESNT_EXIST', 'The item isn\'t inside the cart.');
define('ERROR_POSITIVE_QUANTITY_REQUIRED', 'A positive quantity is required.');

// Erreurs de sécurité
define('ERROR_ALREADY_LOGIN', 'You\'re already log In.');
define('ERROR_CREDENTIELS_REQUIRED', 'Username and password are required.');
define('ERROR_CREDENTIELS_INCORRECT', 'Username or password incorrect.');
define('ERROR_AUTHENTIFICATION_REQUIRED', 'Your authentification is required.');
define('ERROR_REQUIRED_ROLE_ADMINISTRATOR', 'You must be authenficated as administrator.');

// Erreurs de transaction
define('ERROR_TRANSACTION_ALREADY_CHECKOUT', 'You have already checkout.');
define('ERROR_TRANSACTION_ALREADY_COMPLETE', 'You have already complete the recipient and shipping information.');
define('ERROR_TRANSACTION_STATUS_INVALID', 'The status is invalid.');
define('ERROR_TRANSACTION_ALREADY_OPEN', 'The transaction is already open.');

// Erreurs d'entités
define('ERROR_USER_DOESNT_EXIST', 'The user doesn\'t exist.');
define('ERROR_USER_WASNT_ADDED', 'The user wasn\'t added.');
define('ERROR_TYPE_DOESNT_EXIST', 'The type doesn\'t exist.');
define('ERROR_ADDRESS_WASNT_ADDED', 'The address wasn\'t added.');
define('ERROR_ADDRESS_DOESNT_EXIST', 'The address doesn\'t exist.');
define('ERROR_ADDRESS_ZIP_CODE_CA_INVALID', 'The zip code must standard. (i.e. H0H 0H0)');
define('ERROR_ADDRESS_ZIP_CODE_US_INVALID', 'The zip code must standard. (i.e. 12345)');
define('ERROR_COMMENT_WASNT_ADDED', 'The comment wasn\'t added.');
define('ERROR_COMMENT_DOESNT_EXIST', 'The comment doesn\'t exist.');
define('ERROR_COUNTRY_DOESNT_EXIST', 'The country doesn\'t exist.');
define('ERROR_CUSTOMER_WASNT_ADDED', 'The customer doesn\'t exist.');
define('ERROR_CUSTOMER_PHONE_INVALID', 'The phone\'s customer must be stardard. (i.e. 1-234-567-9012)');
define('ERROR_CUSTOMER_EMAIL_INVALID', 'The email\'s customer must be standard. (i.e. info@dutailier.com)');
define('ERROR_FABRIC_DOESNT_EXIST', 'The fabric doesn\'t exist.');
define('ERROR_FINISH_DOESNT_EXIST', 'The finish doesn\'t exist.');
define('ERROR_LOG_DOESNT_EXIST', 'The log doesn\'t exist.');
define('ERROR_MODEL_DOESNT_EXIST', 'The model doesn\'t exist.');
define('ERROR_ORDER_WASNT_ADDED', 'The order wasn\'t added.');
define('ERROR_ORDER_DOESNT_EXIST', 'The order doesn\'t exist.');
define('ERROR_PIPING_DOESNT_EXIST', 'The piping doesn\'t exist.');
define('ERROR_PRODUCT_DOESNT_EXIST', 'The product doesn\'t exist.');
define('ERROR_TYPE_INVALID', 'The type isn\'t valid.');
define('ERROR_RECIPIENT_WASNT_ADDED', 'The recipient wasn\'t added.');
define('ERROR_RECIPIENT_DOESNT_EXIST', 'The recipient doesn\'t exist.');
define('ERROR_SHIPPING_INFO_WASNT_ADDED', 'The shipping infos wasn\'t added.');
define('ERROR_SHIPPING_INFO_DOESNT_EXIST', 'The shipping infos doesn\'t exist.');
define('ERROR_STATE_DOESNT_EXIST', 'The state doesn\'t exist.');
define('ERROR_STORE_DOESNT_EXIST', 'The store doesn\'t exist.');
define('ERROR_STORE_PHONE_INVALID', 'The phone\'s store must be stardard. (i.e. 1-234-567-9012)');
define('ERROR_STORE_EMAIL_INVALID', 'The email\'s store must be standard. (i.e. info@dutailier.com)');
define('ERROR_STORE_EMAIL_REP_INVALID', 'The email\'s representant must be standard. (i.e. info@dutailier.com)');
define('ERROR_STORE_EMAIL_AGENT_INVALID', 'The email\'s agent must be standard. (i.e. info@dutailier.com)');
define('ERROR_ROLE_INVALID', 'The role isn\'t valid.');
define('ERROR_LINE_WASNT_ADDED', 'The line wasn\'t added.');
define('ERROR_LINE_DOESNT_EXIST', 'The line doesn\'t exist.');

// Erreurs de base de donnéées
define('ERROR_DB_EXECUTION_FAILED', 'The execution of the query failed.');
define('ERROR_DB_CONNECTION_FAILED', 'The database connection failed.');
