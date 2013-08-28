<?php

// Menu principal
define('MENU_LBL_PRODUCTS', 'Products');
define('MENU_LBL_CART', 'Shopping Cart');
define('MENU_LBL_MANAGER', 'Manager');
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

// Page du configurateur de produit
define('CONFIGURATOR_TITLE', 'Product configurator');
define('CONFIGURATOR_LBL_FINISH_NAME', 'Finish :');
define('CONFIGURATOR_LBL_FABRIC_NAME', 'Fabric :');
define('CONFIGURATOR_LBL_PIPING_NAME', 'Piping :');
define('CONFIGURATOR_LBL_PRODUCT_PRICE', 'Price :');
define('CONFIGURATOR_LBL_SHIPPING_FEE', 'Shipping Fee :');
define('CONFIGURATOR_BTN_ADD_TO_CART', 'Add to Cart');
define('CONFIGURATOR_LBL_TYPES_DIALOG_TEXT', 'Click on the kind of product you are looking for.');
define('CONFIGURATOR_LBL_OTTOMAN_INCLUDED', 'Upholstered Ottoman :');
define('CONFIGURATION_LBL_WITH_OTTOMAN', 'Included');
define('CONFIGURATION_LBL_WITHOUT_OTTOMAN', 'Not Included');
define('CONFIGURATOR_LBL_PILOW_MATCHED', 'Lombar Pillow :');

// Page du panier d'achats
define('CART_TITLE', 'Shopping Cart');
define('CART_LBL_TOTAL_PRICE', 'Total Price :');
define('CART_LBL_TOTAL_SHIPPING_FEE', 'Total Shipping Fee :');
define('CART_LBL_SUB_PRICE', 'Subtotal :');
define('CART_BTN_CONTINUE_SHOPPING', 'Continue shopping');
define('CART_BTN_PROCEED_ORDER', 'Proceed');
define('CART_BTN_CLEAR_CART', 'Clear');
define('CART_LBL_NO_PRODUCT', 'No product ordered.');

// Page d'informations d'expédition
define('SHIPPING_FORM_TITLE', 'Shipping Information');
define('SHIPPING_FORM_LBL_SHIPPING_NAME', 'Name');
define('SHIPPING_FORM_LBL_SHIPPING_ADDRESS', 'Address');
define('SHIPPING_FORM_LBL_STREET', 'Address');
define('SHIPPING_FORM_LBL_CITY', 'City');
define('SHIPPING_FORM_LBL_ZIP_CODE', 'Zip Code');
define('SHIPPING_FORM_LBL_STATE', 'State or province');
define('SHIPPING_FORM_LBL_COUNTRY', 'Country');
define('SHIPPING_FORM_LBL_EMAIL', 'Email');
define('SHIPPING_FORM_LBL_PHONE', 'Phone');
define('SHIPPING_FORM_LBL_CONFIRMATION', 'Email Confirmation');
define('SHIPPING_FORM_LBL_CONTACT_INFORMATION', 'Contact');
define('SHIPPING_FORM_BTN_CANCEL', 'Cancel');
define('SHIPPING_FORM_BTN_SUBMIT', 'Next');
define('SHIPPING_FORM_BTN_CLEAR', 'Clear');
define('SHIPPING_FORM_LBL_FIRST_NAME', 'Firstname');
define('SHIPPING_FORM_LBL_LAST_NAME', 'Lastname');

// Page de validation
define('VALIDATION_TITLE', 'Validation');
define('VALIDATION_LBL_USER_INFO', 'User Information');
define('VALIDATION_LBL_USER_NAME', 'Name :');
define('VALIDATION_LBL_USER_ADDRESS', 'Address :');
define('VALIDATION_LBL_USER_PHONE', 'Phone :');
define('VALIDATION_LBL_USER_EMAIL', 'Email :');
define('VALIDATION_LBL_USER_EMAIL_REP', 'Representant\'s email :');
define('VALIDATION_LBL_USER_EMAIL_AGENT', 'Agent\'s email :');
define('VALIDATION_LBL_SHIP_TO_INFO', 'Shipping Information');
define('VALIDATION_LBL_SHIP_TO_NAME', 'Name :');
define('VALIDATION_LBL_SHIP_TO_ADDRESS', 'Address :');
define('VALIDATION_LBL_SHIP_TO_PHONE', 'Phone :');
define('VALIDATION_LBL_SHIP_TO_EMAIL', 'Email :');
define('VALIDATION_BTN_CANCEL', 'Cancel');
define('VALIDATION_BTN_CONFIRM', 'Confirm');

// Page de confirmation
define('CONFIRMATION_TITLE', 'Confirmation');
define('CONFIRMATION_TEXT', 'Your order been processed. You will receive a confirmation email shortly.');

// Page du gestionnaire pour commerçant
define('STORE_MANAGER_TITLE', 'Store Manager');

// Page du gestionnaire pour administrateur
define('ADMIN_MANAGER_TITLE', 'Administrator Manager');
define('ADMIN_MANAGER_BTN_TAB_ORDERS_FEED', 'Orders Feed');
define('ADMIN_MANAGER_BTN_TAB_MODELS_AND_TYPES_LIST', 'Models & Types List');
define('ADMIN_MANAGER_BTN_TAB_LOGS_FEED', 'Logs Feed');
define('ADMIN_MANAGER_BTN_TAB_CUSTOMERS_LIST', 'Customers List');
define('ADMIN_MANAGER_BTN_TAB_STORES_LIST', 'Stores List');
define('ADMIN_MANAGER_LBL_SEARCH', 'Search : ');
define('ADMIN_MANAGER_LBL_LANGUAGE', 'Language : ');

// Autres
define('PLEASE_WAIT', 'Please wait...');
define('NO_RESULT', 'No result was found.');
define('LBL_WARNING', '* Sales taxes not included in the price.');

// Erreurs du panier d'achats
define('ERROR_ITEM_DOESNT_EXIST', 'The item isn\'t inside the cart.');
define('ERROR_POSITIVE_QUANTITY_REQUIRED', 'A positive quantity is required.');

// Erreurs AJAX
define('ERROR_REQUIRED_LANGUAGE_CODE', 'The language code is required.');
define('ERROR_REQUIRED_TYPE_NAME', 'The type name is required.');
define('ERROR_REQUIRED_TYPE_CODE', 'The type code is required.');
define('ERROR_REQUIRED_MODEL_NAME', 'The model name is required.');
define('ERROR_REQUIRED_MODEL_DESCRIPTION', 'The model description is required.');
define('ERROR_REQUIRED_MODEL_CODE', 'The model code is required.');
define('ERROR_REQUIRED_STORE_REF', 'The store ref is required.');
define('ERROR_REQUIRED_PRODUCT_SKU', 'The product sku is required.');
define('ERROR_REQUIRED_GREETING', 'The greeting is required.');
define('ERROR_REQUIRED_FIRSTNAME', 'The firstname is required.');
define('ERROR_REQUIRED_LASTNAME', 'The lastname is required.');
define('ERROR_REQUIRED_STREET', 'The street is required.');
define('ERROR_REQUIRED_CITY', 'The city is required.');
define('ERROR_REQUIRED_ZIP_CODE', 'The zip code is required.');
define('ERROR_REQUIRED_STATE_CODE', 'The state code is required.');
define('ERROR_REQUIRED_COUNTRY_CODE', 'The country code is required.');
define('ERROR_REQUIRED_EMAIL', 'The email is required.');
define('ERROR_REQUIRED_PHONE', 'The phone number is required.');
define('ERROR_REQUIRED_QUANTITY', 'A quantity is required.');

// Erreurs de sécurité
define('ERROR_ALREADY_LOGIN', 'You\'re already log In.');
define('ERROR_CREDENTIELS_REQUIRED', 'Username and password are required.');
define('ERROR_CREDENTIELS_INCORRECT', 'Username or password incorrect.');
define('ERROR_AUTHENTIFICATION_REQUIRED', 'Your authentification is required.');
define('ERROR_REQUIRED_ROLE_ADMINISTRATOR', 'You must be authenficated as administrator.');
define('ERROR_REQUIRED_ROLE_STORE', 'You must be authenficated as store.');


// Erreurs de transaction
define('ERROR_TRANSACTION_REQUIRED_STATUS_OPEN', 'The transaction must be previously initiated.');
define('ERROR_TRANSACITON_NO_PRODUCT', 'The transaction must be at least one product.');
define('ERROR_TRANSACTION_TOTAL_PRICE_MAX', 'The transaction does not exceed the maximum allowed.');
define('ERROR_TRANSACTION_REQUIRED_STATUS_CHECKOUT', 'You must first complete your purchases.');
define('ERROR_TRANSACTION_REQUIRED_RECIPIENT_INFO', 'The shipping information must be completed.');
define('ERROR_TRANSACTION_REQUIRED_SHIPPING_INFO', 'The shipping information must be completed.');
define('ERROR_TRANSACTION_REQUIRED_STATUS_FINALIZED', 'The shipping information must be confirmed.');
define('ERROR_TRANSACTION_STATUS_INVALID', 'The status is invalid.');
define('ERROR_TRANSACTION_FILE_CANNOT_OPEN', 'The file cannot be open.');

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
define('ERROR_RECIPIENT_PHONE_INVALID', 'The phone number must be stardard. (i.e. 1-234-567-9012)');
define('ERROR_RECIPIENT_EMAIL_INVALID', 'The email must be valid. (i.e. info@dutalier.com)');

// Erreurs de base de donnéées
define('ERROR_DB_EXECUTION_FAILED', 'The execution of the query failed.');
define('ERROR_DB_CONNECTION_FAILED', 'The database connection failed.');
