<?php

require __DIR__.'/vendor/autoload.php';
require __DIR__.'/helpers/functions.php';
require __DIR__.'/config.php';

session_start();

$sigaClient = SigaClient\Client::Instance([
    'url' => SIGA_ENDPOINT,
    'client' => SIGA_CLIENT_NAME,
    'service' => SIGA_SERVICE_NAME,
    'uuid' => SIGA_UUID,
    'secret' => SIGA_SIGN_SECRET,
]);

/**
 * Load action template
 *
 * @param string $action Action name
 *
 * @return void
 */
function loadActionTemplate($action)
{
    $_arrAllowedActions = ['default','create_new_doc'];

    require(__DIR__.'/templates/header.php');
    
    if (in_array($action, $_arrAllowedActions)) {
        include(__DIR__.'/templates/'.strtolower($action).'.php');
    }
    
    require(__DIR__.'/templates/footer.php');
}



/* Parse acts */

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if ($_POST['act'] === 'prepare_remote_signing') {
        dump('siin');
        dump($_POST);
    } elseif ($_POST['action'] === 'create_new_doc') {
        loadActionTemplate($_POST['action']);
        
        if ($_POST['conversionType'] === 'ASIC') {
            $sigaClient->createAsicContainer();
        } elseif ($_POST['conversionType'] === 'HASHCODE') {
            $sigaClient->createHashcodeContainer();
        }
    }
} else {
    loadActionTemplate('default');
}
