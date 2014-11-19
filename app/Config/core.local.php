<?php

/**
 * DEV Environment specific config settings
 */
Configure::write('debug', 1);

// Global constants
define('G_APP_ENV', 'dev');
define('G_DB_CONFIG', 'default');

// Error handling
Configure::write('App.error.layout', 'error');

Configure::write('Error', array(
	'handler' => 'ErrorHandler::handleError',
	'level' => E_ALL & ~E_DEPRECATED,
	'trace' => true
));
