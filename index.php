<?php

require __DIR__.'/vendor/autoload.php';
require __DIR__.'/helpers/functions.php';
require __DIR__.'/config.php';

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

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if ($_POST['act'] === 'create_new_doc') {
        loadActionTemplate($_POST['act']);
    }
} else {
    loadActionTemplate('default');
}
