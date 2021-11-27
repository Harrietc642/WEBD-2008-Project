<?php
  require_once("config.php");
  session_start();
  $userid = $_SESSION['current_user_id'];
  $query = "SELECT * FROM Recipe JOIN Users using(UserID) WHERE UserID = $userid";
  
  // $query = "SELECT * FROM Recipe JOIN Users using(UserID) JOIN Cuisines using(CuisineID) WHERE UserID = $userid";
  $statement = $ConnectingDB->prepare($query);
  $statement->execute(); 
  // while ($row = $statement->fetch()): 
  $row = $statement->fetch();
//  $id = $row['RecipeID'];
  $id = filter_input(INPUT_POST, 'id', FILTER_VALIDATE_INT);

  if (isset($_POST['recipename']) && isset($_POST['cookingtime']) && isset($_POST['preptime']) && isset($_POST['ingredients'])&& isset($_POST['steps']) && (!empty($_POST['recipename'])))
  {

            $recipename = filter_input(INPUT_POST, 'recipename', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
            $cookingtime = filter_input(INPUT_POST, 'cookingtime', FILTER_SANITIZE_FULL_SPECIAL_CHARS);

            $preptime = filter_input(INPUT_POST, 'preptime', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
            //$ingredients = filter_input(INPUT_POST, 'ingredients', FILTER_SANITIZE_FULL_SPECIAL_CHARS);\
            $ingredients = $_POST['ingredients'];
            $steps =  $_POST['steps'];
            //$steps = filter_input(INPUT_POST, 'steps', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
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
            $statement->execute();

            header("Location: /wd2/Project/Official/myrecipe");
            exit;
           

  }
      else
    {
      $error_message = "Post Title required. Try again!";
             
              //header("Location: /wd2/Project/Official/addrecipe");
                  

    }
 ?>
 <!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <title></title>
</head>
<body>
     <p><?= "{$error_message}"?></p>
     <a href="CreateRecipe.php">Return</a>
</body>
</html>