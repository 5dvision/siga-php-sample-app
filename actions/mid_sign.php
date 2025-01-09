<?php

/**
 * @var \SigaClient\SigaClient $sigaClient
 */

header('Content-Type: application/json');

try {
    $_arrRequestParams = [
        'personIdentifier' => $_POST['idcode'],
        'phoneNo' => $_POST['phone'],
        'language' => 'EST',
        'messageToDisplay' => "SiGa DEMO app",
    ];

    echo json_encode($sigaClient->prepareMobileSigning($_arrRequestParams));
} catch (Throwable $e) {
    http_response_code($e->getCode());
    echo json_encode(['errorMessage' => $e->getMessage()]);
}
