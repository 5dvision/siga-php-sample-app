<?php

/**
 * Lets require local devolpment config file if it exists
 */
if (file_exists(__DIR__.'/config-dev.php')) {
    require_once __DIR__.'/config-dev.php';
}

/**
 * Siga endpoint URL
 */
define('SIGA_ENDPOINT', 'https://dsig.eesti.ee');

/**
 * Siga client name
 */
define('SIGA_CLIENT_NAME', '');

/**
 * Siga service name
 */
define('SIGA_SERVICE_NAME', '');

/**
 * Siga ServiceUUID for header(X-Authorization-ServiceUUID)
 */
define('SIGA_UUID', '');

/**
 * Siga signing secret
 */
define('SIGA_SIGN_SECRET', '');

/**
 * Upload directory where the uploaded files are stored
 */
define('UPLOAD_DIR', __DIR__ . DIRECTORY_SEPARATOR . 'uploads');
