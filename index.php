<?php

require __DIR__.'/vendor/autoload.php';
require __DIR__.'/helpers/functions.php';
require __DIR__.'/config.php';

session_start();

$sigaClient = SigaClient\SigaClient::create([
    'url' => SIGA_ENDPOINT,
    'name' => SIGA_CLIENT_NAME,
    'service' => SIGA_SERVICE_NAME,
    'uuid' => SIGA_UUID,
    'secret' => SIGA_SIGN_SECRET,
]);

if ($_SESSION['containerId']) {
    $sigaClient->setContainerId($_SESSION['containerId']);
}

/**
 * Load action template
 *
 * @param string $action Action name
 * @param array $params Parameters passed to template
 *
 * @return void
 */
function loadActionTemplate(string $action, array $params = [])
{
    loadHeader();
    loadContentTemplate($action, $params);
    loadFooter();
}

function loadHeader()
{
    require(__DIR__.'/templates/header.php');
}

function loadContentTemplate(string $action, array $params = [])
{
    extract($params);

    $allowedActions = ['default','create_new_doc', 'show_doc_info'];

    if (in_array($action, $allowedActions)) {
        include(__DIR__.'/templates/'.strtolower($action).'.php');
    }
}

function loadFooter()
{
    require(__DIR__.'/templates/footer.php');
}


/* Parse acts */
if ($_GET['action'] == 'download_container') {
    try {
        $pathToFile = getUploadDirectory(). DIRECTORY_SEPARATOR . $_SESSION['containerId'].'.asice';

        if (!file_exists($pathToFile)) {
            throw new Exception("Signed file not found!");
        }

        $containerName = getContainerName($_SESSION['containerId'], $_SESSION['containerFiles']);

        header("Content-Disposition: attachment; filename=\"" . $containerName . "\"");
        header("Content-Transfer-Encoding: Binary");
        header('Content-Type: application/force-download');
        header('Content-Length: ' . filesize($pathToFile));
        header('Connection: close');
        readfile($pathToFile);
        die();
    } catch (Exception $e) {
        loadHeader();
        echo showError($e);
        loadFooter();
        exit;
    }
}
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $action = $_POST['action'];

    if ($action === 'create_new_doc') {
        loadHeader();
        try {
            $files = uploadFile();

            loadContentTemplate($action, ['files'=> $files]);

            $_SESSION['containerId'] = $sigaClient->createContainer($_POST['containerType'], $files);
            $_SESSION['containerFiles'] = array_column($files, 'path', 'name');
        } catch (Throwable $e) {
            echo showError($e);
        }
        loadFooter();
    } elseif ($action === 'prepare_signing') {
        try {
            header('Content-Type: application/json');
            echo json_encode($sigaClient->prepareSigning($_POST['certificateHex']));
        } catch (Throwable $e) {
            deleteUploadedFiles($_SESSION['containerFiles']);
            echo showError($e);
        }
    } elseif ($action === 'finalize_signing') {
        try {
            $sigaClient->finalizeSigning($_POST['signatureId'], $_POST['signatureHex']);
        } catch (Throwable $e) {
            echo showError($e);
        }
        deleteUploadedFiles($_SESSION['containerFiles']);
    } elseif ($action === 'mid_sign') {
        require_once('actions/mid_sign.php');
    } elseif ($action === 'mid_status') {
        require_once('actions/mid_status.php');
    } elseif ($action === 'mid_finalize_sign') {
        require_once('actions/mid_finalize_sign.php');
    }
} else {
    unset($_SESSION);
    loadActionTemplate('default');
}
