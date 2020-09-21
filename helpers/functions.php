<?php

/**
 * Generates bootrapt html error
 *
 * @param $e The Exception that the error is based on.
 *
 * @return string Html error message
 */
function showError($e)
{
    $code = $e->getCode();
    $message = ($code ? $code . ': ' : '') . $e->getMessage();
    
    return '<p class="alert alert-danger">' . $message . '</p>';
}

/**
 * Upload files to server
 *
 * @return array Uploaded files array
 */
function uploadFile()
{
    $input_field_name = 'datafile';

    //Check for upload errors
    if (($_FILES[$input_field_name]['error'] > 0)) {
        throw getUploadErrorException($_FILES[$input_field_name]['error']);
    }

    //Upload file
    $filename = $_FILES[$input_field_name]['name'];
    $ext = pathinfo($filename, PATHINFO_EXTENSION);
    $uFilename = uniqid('SiGa', true).'.'.$ext;
    $destination = UPLOAD_DIR .'/'. $uFilename;

    if (!move_uploaded_file($_FILES[$input_field_name]['tmp_name'], $destination)) {
        throw new Exception('There was a problem saving the uploaded file to disk.');
    }

    $files[] = [
        'name' => $_FILES[$input_field_name]['name'],
        'path' => $destination,
        'data' => file_get_contents($destination),
        'mime' => $_FILES[$input_field_name]['type'],
        'size' => $_FILES[$input_field_name]['size'],
    ];

    return $files;
}

/**
 * Get upload error exception
 *
 * @param $code Upload error code.
 *
 * @return Exception Corresponding exception.
 */
function getUploadErrorException($code)
{
    switch ($code) {
        case UPLOAD_ERR_INI_SIZE:
            $message = 'The uploaded file exceeds the upload_max_filesize directive in php.ini';
            break;
        case UPLOAD_ERR_FORM_SIZE:
            $message = 'The uploaded file exceeds the MAX_FILE_SIZE directive that was specified in the HTML form';
            break;
        case UPLOAD_ERR_PARTIAL:
            $message = 'The uploaded file was only partially uploaded';
            break;
        case UPLOAD_ERR_NO_FILE:
            $message = 'No file was uploaded';
            break;
        case UPLOAD_ERR_NO_TMP_DIR:
            $message = 'Missing a temporary folder';
            break;
        case UPLOAD_ERR_CANT_WRITE:
            $message = 'Failed to write file to disk';
            break;
        case UPLOAD_ERR_EXTENSION:
            $message = 'File upload stopped by extension';
            break;

        default:
            $message = 'Unknown upload error';
            break;
    }

    return new Exception($message, $code);
}

/**
 * FileSize human readable format
 *
 * @param int $bytes Bytes
 * @param integer $decimals Decimal places
 *
 * @return string Human readable file size
 */
function human_filesize($bytes, $decimals = 2)
{
    $sz = 'BKMGTP';
    $factor = floor((strlen($bytes) - 1) / 3);
    return sprintf("%.{$decimals}f", $bytes / pow(1024, $factor)) . @$sz[$factor];
}

/**
 * Dump ouput
 *
 * @param mixed $input Input to print out
 *
 * @return void
 */
function dump($input)
{
    echo "<pre class='bg-light border p-3'>";
    print_r($input);
    echo "</pre>";
}

/**
 * Dump and die
 *
 * @param mixed $input Input
 *
 * @return void
 */
function dd($input)
{
    dump($input);
    exit();
}
