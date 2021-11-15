<?php
/*
Name: Harriet Chiu
Date: November 10, 2021
Course: Web Development 2
Topic: Project 
*/
  require_once("config.php");
  session_start();
  require_once("imageprocess.php");

 





    // function file_upload_path($original_filename, $upload_subfolder_name = 'uploads') {
    //    $current_folder = dirname(__FILE__);

    //    $path_segments = [$current_folder, $upload_subfolder_name, basename($original_filename)];

    //    return join(DIRECTORY_SEPARATOR, $path_segments);
    // }


    // function file_is_an_image($temporary_path, $new_path) {
    //     $allowed_mime_types      = ['image/gif', 'image/jpeg', 'image/png'];
    //     $allowed_file_extensions = ['gif', 'jpg', 'jpeg', 'png'];
        
    //     $actual_file_extension   = pathinfo($new_path, PATHINFO_EXTENSION);
    //     $actual_mime_type = getimagesize($temporary_path)['mime'];
    //     $mime_type_is_valid      = in_array($actual_mime_type, $allowed_mime_types);
    //     $file_extension_is_valid = in_array($actual_file_extension, $allowed_file_extensions);

        
    //     return $file_extension_is_valid && $mime_type_is_valid;
    // }

    // $image_upload_detected = isset($_FILES['image']) && ($_FILES['image']['error'] === 0);
    // $upload_error_detected = isset($_FILES['image']) && ($_FILES['image']['error'] > 0);



    // if ($image_upload_detected) { 
    //     $image_filename        = $_FILES['image']['name']; 
    //     $temporary_image_path  = $_FILES['image']['tmp_name'];
    //     $new_image_path        = file_upload_path($image_filename);
    //     $ToString_Original_Name =  strval($_FILES['image']['name']);

    //     if (file_is_an_image($temporary_image_path, $new_image_path)) {

    //         if(move_uploaded_file($temporary_image_path, $new_image_path)){
    //           $image = new ImageResize($_FILES['image']['name']);
    //           $image->resize(350,350);
    //           $resized_new_image = pathinfo($_FILES['image']['name'], PATHINFO_FILENAME).'_medium'.pathinfo(($_FILES['image']['name']), PATHINFO_EXTENSION);
    //           $image->save('uploads/'. $resized_new_image);
            
    //         }

    //         // $actual_file_extension   = pathinfo($new_image_path, PATHINFO_EXTENSION);


    //         // $ToString_Original_Name =  strval($_FILES['image']['name']);
    //         // $ToString_Original_Name = substr($ToString_Original_Name, 0, strrpos($ToString_Original_Name, '.'));
    //         // $ToString_Original_Name = 'uploads/' . $ToString_Original_Name;
    //         // $imageMax400 = new ImageResize($new_image_path);
    //         // $imageMax400->resizeToWidth(400);
            
    //         // $ToString_Orginal_Ext = strval($_FILES['image']['type']);
    //         // $new_max400_fileName = $ToString_Original_Name. '_medium.'. $actual_file_extension;
    //         // $imageMax400->save($new_max400_fileName);

    //     //    $resized_new_image = pathinfo($_FILES['image']['name'], PATHINFO_FILENAME).'_medium'.pathinfo($_FILES['image']['name']), PATHINFO_EXTENSION);
            

    //         // Resize to Max Width 50px
    //         // $imageMax50 = new ImageResize($new_image_path);
    //         // $imageMax50->resizeToWidth(50);
           
    //         // $ToString_Orginal_Ext = strval($_FILES['image']['type']);
            
    //         // $new_max50_fileName = $ToString_Original_Name . '_thumbnail.' . $actual_file_extension;
    //         // $imageMax50->save($new_max50_fileName);



        // }s
    // }
    // Image Processing ends



// && $_SESSION['current_user_role'] == "user"
  if(!isset($_SESSION['current_user_role'])){
    header("Location: index.php");
    exit;
  }


     $query = "SELECT * FROM Recipe";


     $statement = $ConnectingDB->prepare($query);
     $statement->execute(); 
     $current_user_id = $_SESSION['current_user_id'];

     $query1 = "SELECT * FROM Restaurant WHERE UserID = :userid";
     

     $statement_inspire_rest = $ConnectingDB->prepare($query1);
     $statement_inspire_rest->bindValue(':userid', $_SESSION['current_user_id']);
     $statement_inspire_rest->execute(); 



     $query2 = "SELECT * FROM Cuisines";
     $statement_cuisine = $ConnectingDB->prepare($query2);
      $statement_cuisine->execute();


// isset($_POST['recipename']) && isset($_POST['cookingtime']) && isset($_POST['preptime']) && isset($_POST['ingredients'])&& isset($_POST['steps'])

  if (isset($_POST['recipename']) && isset($_POST['cookingtime']) && isset($_POST['preptime']) && isset($_POST['ingredients'])&& isset($_POST['steps']) && (!empty($_POST['recipename'])))
  {
  // if ((strlen($_POST['recipename'])) >= 1 && (strlen($_POST['preptime'])) >= 1 && (strlen($_POST['ingredients'])) >= 1 && (strlen($_POST['steps'])) >= 1 && (strlen($_POST['cookingtime'])) >= 1 && (!ctype_space($_POST['recipename'])) && (!ctype_space($_POST['cookingtime'])) && (!ctype_space($_POST['preptime'])) && (!ctype_space($_POST['ingredients'])) && (!ctype_space($_POST['steps'])))
  // {

            $recipename = filter_input(INPUT_POST, 'recipename', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
            $cookingtime = filter_input(INPUT_POST, 'cookingtime', FILTER_SANITIZE_FULL_SPECIAL_CHARS);

            $preptime = filter_input(INPUT_POST, 'preptime', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
            $ingredients = filter_input(INPUT_POST, 'ingredients', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
            $steps = filter_input(INPUT_POST, 'steps', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
            $cuisineid = filter_input(INPUT_POST, 'cuisineid', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
            // $restid = 1;
            $userid = $_SESSION['current_user_id'];
           // $img = $$new_max400_fileName;

            $query = "INSERT INTO Recipe (RecipeName, PrepTime, CookingTime, Ingredients, Steps, UserID, CuisineID, img) VALUES (:recipename, :cookingtime, :preptime, :ingredients, :steps, :userid, :cuisineid, :img)";
            $statement = $ConnectingDB->prepare($query);

            //  Bind values to the parameters
            $statement->bindValue(':recipename', $recipename);
            $statement->bindValue(':cookingtime', $cookingtime);
            $statement->bindValue(':preptime', $preptime);
            $statement->bindValue(':ingredients', $ingredients);
            $statement->bindValue(':steps', $steps);
            $statement->bindValue(':userid', $userid);
            $statement->bindValue(':cuisineid', $cuisineid);
            $new_max400_fileName_project = strstr("$new_max400_fileName","/"); 
            $statement->bindValue(':img', $new_max400_fileName_project);
  
              if ($statement->execute())
            {
                header("Location: Recipe.php");
                exit;
            }
        
          else
          {
            echo "All fields required. Try again!";
            header("Location: CreateRecipe.php");
                
            exit;
          }
  }
  // else
  // {
  //   echo "error - upload";
  // }
 ?>

<!DOCTYPE html>
<html lang="en">
<head>
  <title>Blog Page</title>
</head>
<body>
<?php include('basic.html')?>
    <!-- HEADER -->
    <div class="container">
      <div class="row mt-4">

        <!-- Main Area Start-->
<section class="container py-2 mb-4">
  <div class="row">
    <div class="offset-lg-1 col-lg-10" style="min-height:400px;">

      <form class="" action="CreateRecipe.php" method="post" enctype="multipart/form-data">
        <div class="card bg-secondary text-light mb-3">
          <div class="card-body" style="background: #669fb2;">
<!--             <?php if(empty($_POST['recipename'])) : ?>
                <p>you must enter recipe name</p>
              <?php endif ?> -->
              <!-- <p><?= "{$error}"?></p> -->
            <div class="form-group">
              <label for="title"> <span class="FieldInfo"> Post Title: </span></label>
               <input class="form-control" type="text" name="recipename" id="recipename" placeholder="My New Recipe" value="">
            </div>

            <div class="form-group">
              <label for="title"> <span class="FieldInfo"> Cuisine: </span></label>
              <select class="form-control" id="cuisineid" name="cuisineid">
                <?php while ($row = $statement_cuisine->fetch()): ?>
                  <div>
                    <option value="<?= $row['CuisineID'] ?>"><?= $row['CuisineName'] ?></option>
                  </div>        
                <?php endwhile ?>
              </select>
            </div>
            <div class="form-group">
              <div class="custom-file">
         <label for='image'>Image Filename:</label>
         <input type='file' name='image' id='image'>
         <!-- <input type='submit' name='submit' value='Upload Image'> -->
              </div>
            </div>
            <div class="form-group">
              <label for="cookingtime"> <span class="FieldInfo"> Cooking Time </span></label>
               <input class="form-control" type="text" name="cookingtime" id="cookingtime" placeholder="--- 20 minutes ---" value="">
            </div>
            <div class="form-group">
              <label for="preptime"> <span class="FieldInfo"> Prep Time </span></label>
               <input class="form-control" type="text" name="preptime" id="preptime" placeholder="--- 2 hours ---" value="">
            </div>
            <div class="form-group">
              <label for="Post"> <span class="FieldInfo"> Ingredients </span></label>
              <textarea class="form-control" id="ingredients" name="ingredients" rows="8" cols="80"></textarea>
            </div>
            <div class="form-group">
              <label for="Post"> <span class="FieldInfo"> Steps </span></label>
              <textarea class="form-control" id="steps" name="steps" rows="8" cols="80"></textarea>
            </div>
            <div class="row">
              <div class="col-lg-6 mb-2">
                <a href="Index.php" class="btn btn-block" style="background:#caede3">Cancel</a>
              </div>
              <div class="col-lg-6 mb-2">
                <button type="submit" name="Submit" class="btn btn-block" style="background:#dddb76" value="Upload Image">Create this recipe</button>
              </div>
            </div>
          </div>
        </div>
      </form>
    </div>
  </div>

</section>
        <!-- Main Area End-->
    </div> 

    </div>

    <!-- HEADER END -->
</body>
</html>