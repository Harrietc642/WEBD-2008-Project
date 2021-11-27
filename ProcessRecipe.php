<!-----------------
/*
Name: Harriet Chiu
Date: November 10, 2021
Course: Web Development 2
Topic: Project 
*/
------------------->
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
  //$id = $_POST['id'];
  



      if(isset($_POST['recipename']) && isset($_POST['cookingtime']) && isset($_POST['preptime']) && isset($_POST['ingredients'])&& isset($_POST['steps']) && (!empty($_POST['recipename'])))
    {
        if ($_POST['command'] == 'Delete') {
        // $id =$row['RecipeID'];
        // $id = $_GET['id'];
        $query_delete_recipe = "DELETE FROM Recipe WHERE RecipeID = $id";
        $statement_delete = $ConnectingDB->prepare($query_delete_recipe);
        $statement_delete->execute();
  }
  
  if ($_POST['command'] == 'Update') {
        // $id =$row['RecipeID'];
        $recipename = filter_input(INPUT_POST, 'recipename', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
        $cookingtime = filter_input(INPUT_POST, 'cookingtime', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
        $preptime = filter_input(INPUT_POST, 'preptime', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
        //$ingredients = filter_input(INPUT_POST, 'ingredients', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
        //$steps = filter_input(INPUT_POST, 'steps', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
        $ingredients = $_POST['ingredients'];
        $steps =  $_POST['steps'];
        $cuisineid = filter_input(INPUT_POST, 'cuisineid', FILTER_SANITIZE_NUMBER_INT);

        // $query_update_recipe = "DELETE FROM Recipe WHERE RecipeID = $id";
        $query_update_recipe = "UPDATE Recipe SET RecipeName = :recipename, PrepTime = :preptime, CookingTime = :cookingtime, Ingredients = :ingredients, Steps = :steps, CuisineID = :cuisineid WHERE RecipeID = $id";

//          $statement_update = $ConnectingDB->prepare($query1);
        $statement_update = $ConnectingDB->prepare($query_update_recipe);

            $statement_update->bindValue(':recipename', $recipename);
            $statement_update->bindValue(':cookingtime', $cookingtime);
            $statement_update->bindValue(':preptime', $preptime);
            $statement_update->bindValue(':ingredients', $ingredients);
            $statement_update->bindValue(':steps', $steps);
            //$statement_update->bindValue(':userid', $userid);
            $statement_update->bindValue(':cuisineid', $cuisineid);
        $statement_update->execute();
  }
             
      header("Location: MyRecipe.php");
      exit;
                  

    }
    else
    {
      $error_message = "Post title required. Try again!";
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
     <a href="MyRecipe.php">Return</a>
</body>
</html>