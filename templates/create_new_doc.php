<?php

try {
    $input_field_name = 'datafile';

    //Check for upload errors
    if (($_FILES[$input_field_name]['error'] > 0)) {
        throw getUploadErrorException($_FILES[$input_field_name]['error']);
    }
    
    //Upload file
    $filename = $_FILES[$input_field_name]['name'];
    $destination = UPLOAD_DIR .'/'. $filename;
    
    dd($filename);
    dump($destination);

    if (!move_uploaded_file($_FILES[$file_input_name]['tmp_name'], $destination)) {
        throw new Exception('There was a problem saving the uploaded file to disk.');
    }


    require('show_doc_info.php');
} catch (Exception $e) {
    echo showError($e);
}
