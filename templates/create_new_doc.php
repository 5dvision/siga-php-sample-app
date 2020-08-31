<?php

try {
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
        'name'=>$_FILES[$input_field_name]['name'],
        'mime'=>$_FILES[$input_field_name]['type'],
        'size' => human_filesize($_FILES[$input_field_name]['size']),
    ];

    require('show_doc_info.php');
} catch (Exception $e) {
    echo showError($e);
}
