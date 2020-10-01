<?php

try {
    $sigaClient->endContainerFlow($_SESSION['containerFiles']);
} catch (Exception $e) {
    echo showError($e);
}
deleteUploadedFiles($_SESSION['containerFiles']);
