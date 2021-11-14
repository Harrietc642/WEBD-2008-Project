<?php
    /*
    Name: Harriet Chiu
    Date: September 30, 2021
    Course: Web Development 2
    Topic: Challenge 7 - File Upload
    */

   use \Gumlet\ImageResize; // open source library
   require 'lib\ImageResize.php';
   require 'lib\ImageResizeException.php';
   require_once("config.php");



  // echo strval($_FILES['image']['type']);
    // file_upload_path() - Safely build a path String that uses slashes appropriate for our OS.
    // Default upload path is an 'uploads' sub-folder in the current folder.
    function file_upload_path($original_filename, $upload_subfolder_name = 'uploads') {
       $current_folder = dirname(__FILE__);
       
       // Build an array of paths segment names to be joins using OS specific slashes.
          //  $current_folder = dirname(__FILE__) : where our upload_and_filter php file is 
          // $upload_subfolder_name = 'uploads'
          // basename($_FILES['uploaded_file']['name']) --> this returns the name of the file (e.g. cat.jpg)
       $path_segments = [$current_folder, $upload_subfolder_name, basename($original_filename)];
       
       // The DIRECTORY_SEPARATOR constant is OS specific.
       // this join function joins all the segments in the array of $path_segments, while using the DIRECTORY_SEPARATOR to separate each segment
       return join(DIRECTORY_SEPARATOR, $path_segments);
    }

    // file_is_an_image() - Checks the mime-type & extension of the uploaded file for "image-ness".
    function file_is_an_image_or_a_pdf($temporary_path, $new_path) {

        // $allowed_mime_types :  what are the actually file types we want 
        $allowed_mime_types      = ['image/gif', 'image/jpeg', 'image/png', 'application/pdf'];

        // what extensions we allow
        $allowed_file_extensions = ['gif', 'jpg', 'jpeg', 'png', 'pdf'];
        
        // pathinfo($new_path, PATHINFO_EXTENSION) : returns a hash with the information about the path
           // PATHINFO_EXTENSION : this pulls out just the extension name itself
        $actual_file_extension   = pathinfo($new_path, PATHINFO_EXTENSION);

        // getimagesize() funciton can return different information of the image 
          // in this case, ['mime'] returns the mime type

        $actual_mime_type = '';

        if(getimagesize($temporary_path)){
            $actual_mime_type        = getimagesize($temporary_path)['mime'];
        }
        elseif(strval($_FILES['image']['type']) == 'application/pdf'){
            $pdf_filename        = $_FILES['image']['name']; // this includes the file name with the extension
       
            $temporary_pdf_path  = $_FILES['image']['tmp_name'];
            $new_pdf_path        = file_upload_path($pdf_filename);

            move_uploaded_file($temporary_pdf_path, $new_pdf_path);
        }

        
        // if(strval($_FILES['image']['type']) == 'application/pdf'){
        //     move_uploaded_file($temporary_image_path, $new_image_path);
        // }
        
        // this is a boolean variable to check whether the actual file extension that we drew out, is it contained in our allowable extension array 
        $file_extension_is_valid = in_array($actual_file_extension, $allowed_file_extensions);

        // this is a boolean variable to check whether the actual file mime type that we drew out, is it contained in our allowable mime array 
        $mime_type_is_valid      = in_array($actual_mime_type, $allowed_mime_types);
        
        return $file_extension_is_valid && $mime_type_is_valid; // this returns both verification that the extension type and the mime type are allowed by us 
    }
    

    // main line of code starts here

    // image_upload_detected : this is a boolean to check: 
       // isset($_FILES['image'])  : did it get uploaded
       // $_FILES['image']['error'] === 0 : was there no errors
    $image_upload_detected = isset($_FILES['image']) && ($_FILES['image']['error'] === 0);

    // $upload_error_detected  : if there is any error, it got handles right down to line 66 in the HTML block elseif ($image_upload_detected)
    $upload_error_detected = isset($_FILES['image']) && ($_FILES['image']['error'] > 0);


    // if the error value is 0, that means if there is no error at all
    if ($image_upload_detected) { 

        // 1. Grab the file name and Store it into the variable 
        $image_filename        = $_FILES['image']['name']; // this includes the file name with the extension

        // 2. Grab the file path and Store it into the variable 
        $temporary_image_path  = $_FILES['image']['tmp_name'];

        // 3. Call a function named file_upload_path that passed in the $image_filename
        $new_image_path        = file_upload_path($image_filename);

        $ToString_Original_Name =  strval($_FILES['image']['name']);



        // file_is_an_image($temporary_image_path, $new_image_path) is the function we created to check if the uploaded file is actually an image 
           // two parameters
           // $temporary_image_path 
           // $new_image_path : where we want to store it to
        if (file_is_an_image_or_a_pdf($temporary_image_path, $new_image_path)) {

        // move_uploaded_file($temporary_image_path, $new_image_path) --> this is the function where we check if there is any error when uploading, error is displayed in line 35 $error in p tag
                // this function takes a few parameters: 
                // $temporary_image_path : what file you want to move
                // $new_image_path : where do you want it to move to
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

            // Resize to Max Width 50px
            $imageMax50 = new ImageResize($new_image_path);
            $imageMax50->resizeToWidth(50);
           
            $ToString_Orginal_Ext = strval($_FILES['image']['type']);
            
            $new_max50_fileName = $ToString_Original_Name . '_thumbnail.' . $actual_file_extension;
            $imageMax50->save($new_max50_fileName);

 
        }
    }
    // main line of code ends
?>
 <!DOCTYPE html>
 <html>
     <head><title>File Upload Form</title></head>
 <body>
     <form method='post' enctype='multipart/form-data'>
         <label for='image'>Image Filename:</label>
         <input type='file' name='image' id='image'>
         <input type='submit' name='submit' value='Upload Image'>
     </form>
     
    <?php if ($upload_error_detected): ?>

        <p>Error Number: <?= $_FILES['image']['error'] ?></p>

    <?php elseif ($image_upload_detected): ?>

        <p>Client-Side Filename: <?= $_FILES['image']['name'] ?></p>
        <p>Apparent Mime Type:   <?= $_FILES['image']['type'] ?></p>
        <p>Size in Bytes:        <?= $_FILES['image']['size'] ?></p>
        <p>Temporary Path:       <?= $_FILES['image']['tmp_name'] ?></p>

    <?php endif ?>
 </body>
 </html>