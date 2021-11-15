<?php
 use \Gumlet\ImageResize; // open source library
  require 'lib\ImageResize.php';
  require 'lib\ImageResizeException.php';

    function file_upload_path($original_filename, $upload_subfolder_name = 'uploads') {
       $current_folder = dirname(__FILE__);

       $path_segments = [$current_folder, $upload_subfolder_name, basename($original_filename)];

       return join(DIRECTORY_SEPARATOR, $path_segments);
    }

    function file_is_an_image_or_a_pdf($temporary_path, $new_path) {
        $allowed_mime_types      = ['image/gif', 'image/jpeg', 'image/png'];
        $allowed_file_extensions = ['gif', 'jpg', 'jpeg', 'png'];
        $actual_file_extension   = pathinfo($new_path, PATHINFO_EXTENSION);
        $actual_mime_type = getimagesize($temporary_path)['mime'];
        
        $file_extension_is_valid = in_array($actual_file_extension, $allowed_file_extensions);
        $mime_type_is_valid      = in_array($actual_mime_type, $allowed_mime_types);
        return $file_extension_is_valid && $mime_type_is_valid; // this returns both verification that the extension type and the mime type are allowed by us 
    }
    
    $image_upload_detected = isset($_FILES['image']) && ($_FILES['image']['error'] === 0);
    $upload_error_detected = isset($_FILES['image']) && ($_FILES['image']['error'] > 0);
    if ($image_upload_detected) { 
        $image_filename        = $_FILES['image']['name']; 
        $temporary_image_path  = $_FILES['image']['tmp_name'];
        $new_image_path        = file_upload_path($image_filename);
        $ToString_Original_Name =  strval($_FILES['image']['name']);

        if (file_is_an_image_or_a_pdf($temporary_image_path, $new_image_path)) {
            move_uploaded_file($temporary_image_path, $new_image_path);
            $actual_file_extension   = pathinfo($new_image_path, PATHINFO_EXTENSION);


        // Grab the orginal image and resize them to two new versions : Resized Max Width 400px: original_filename_medium.ext AND Resized Max Width 50px: original_filename_thumbnail.ext 
        // Resize to Max Width 400px
            $ToString_Original_Name =  strval($_FILES['image']['name']);
            $ToString_Original_Name = substr($ToString_Original_Name, 0, strrpos($ToString_Original_Name, '.'));

            $ToString_Original_Name = 'uploads/' . $ToString_Original_Name;
            $imageMax400 = new ImageResize($new_image_path);
            $imageMax400->resizeToWidth(400);      
            $ToString_Orginal_Ext = strval($_FILES['image']['type']);
            $new_max400_fileName = $ToString_Original_Name. '_medium.'. $actual_file_extension;
            $imageMax400->save($new_max400_fileName);

            // if (condition) {
            //   // try here tomorrow
            // }
 
        }
        // if (file_is_an_image_or_a_pdf($temporary_image_path, $new_image_path) == false) {
        //   // code...
        //   echo "upload fail, try again!";
        // }
        // {
        //   echo "upload fail, try again!";

        // }
    }

?>