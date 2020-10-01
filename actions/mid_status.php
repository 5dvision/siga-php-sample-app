<?php
header('Content-Type: application/json');
        
try {
    echo json_encode($sigaClient->getMobileSigningStatus($_POST['signatureId']));
} catch (Exception $e) {
    http_response_code($e->getCode());
    echo json_encode(['errorMessage' => $e->getMessage()]);
}
