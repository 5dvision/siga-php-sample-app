<?php

/**
 * @var \SigaClient\SigaClient $sigaClient
 */

try {
    $sigaClient->endContainerFlow($_SESSION['containerFiles']);
} catch (Throwable $e) {
    echo showError($e);
}
deleteUploadedFiles($_SESSION['containerFiles']);
