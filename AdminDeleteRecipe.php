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

  $id = $_POST['id'];
  
  if ($_POST['command'] == 'Delete') {
        // $id =$row['RecipeID'];
        // $id = $_GET['id'];
        $query_delete_recipe = "DELETE FROM Recipe WHERE RecipeID = $id";
        $statement_delete = $ConnectingDB->prepare($query_delete_recipe);
        $statement_delete->execute();
  }
  header("Location: AdminViewAllRecipe.php");
  exit;
?>