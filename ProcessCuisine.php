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
  // // All associated recipes
  // $query = "SELECT * FROM Recipe WHERE CuisineID = $currentCuisineid";
  // // $query = "SELECT * FROM Recipe JOIN Users using(UserID) WHERE UserID = $userid";
  // $statement_associated_recipes = $ConnectingDB->prepare($query);
  // $statement_associated_recipes->execute(); 
  // $row_associated_recipes = $statement_associated_recipes->fetch();
  // $cuisine_wish_to_delete = $row_associated_recipes['RecipeID'];
  
    $query = "SELECT * FROM Cuisines JOIN Users using(UserID) WHERE UserID = $userid";
  
  // $query = "SELECT * FROM Recipe JOIN Users using(UserID) JOIN Cuisines using(CuisineID) WHERE UserID = $userid";
  $statement = $ConnectingDB->prepare($query);
  $statement->execute(); 
  // while ($row = $statement->fetch()): 
  $row = $statement->fetch();
  //$id = $row['CuisineID'];
//$id = $_GET['id'];

  if ($_POST['command'] == 'Delete') {
       // $id =$row['CuisineID'];
        // $id = $_GET['id'];
        $query_delete_asso_recipe = "DELETE FROM Cuisines WHERE CuisineID = $id";
        $statement_delete = $ConnectingDB->prepare($query_delete_asso_recipe);
        $statement_delete->execute();
  }
  
  if ($_POST['command'] == 'Update') {
        // $id =$row['CuisineID'];
    //$id = $_GET['id'];
        $cuisinename = filter_input(INPUT_POST, 'cuisinename', FILTER_SANITIZE_FULL_SPECIAL_CHARS);

        // $query_update_recipe = "DELETE FROM Recipe WHERE RecipeID = $id";
        $query_update_cuisine = "UPDATE Cuisines SET CuisineName = :cuisinename WHERE CuisineID = $id";

//          $statement_update = $ConnectingDB->prepare($query1);
        $statement_update = $ConnectingDB->prepare($query_update_cuisine);

            $statement_update->bindValue(':cuisinename', $cuisinename);
        $statement_update->execute();
  }

  header("Location: Cuisine.php");
  exit;


  // endwhile ;


    // require_once("config.php");
    // require_once("MyRecipe.php");
    // //session_start();
    // $id = $_GET['id'];
    // echo $id;
    // $id = filter_input(INPUT_POST, 'id', FILTER_SANITIZE_NUMBER_INT);
    // $query = "DELETE FROM quotes WHERE id = :id";
    // $statement = $ConnectingDB->prepare($query);
    // $statement->bindValue(':id', $id, PDO::PARAM_INT);
    // $statement->execute();

    // if ($_POST['command'] == 'delete') {
    //     $id = $_GET['id'];
    //     $query = "DELETE FROM Recipe WHERE RecipeID = $id";
    //     // -- $query = "SELECT * FROM Recipe JOIN Users using(UserID) WHERE UserID = $userid AND RecipeID = $id";
    //     $statement = $ConnectingDB->prepare($query);
    //     $statement->execute();
    //     header("Location: MyRecipe.php");
    // }
?>


<?php
// if(!isset($_SESSION['current_user_role']) && $_SESSION['current_user_role'] == "user"){
//   header("Location: index.php");
//   exit;
// }

// if ($_POST) {
//     if ($_POST['command'] == 'update') {
//         $recipename = filter_input(INPUT_POST, 'recipename', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
//         $cookingtime = filter_input(INPUT_POST, 'cookingtime', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
//         $preptime = filter_input(INPUT_POST, 'preptime', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
//         $ingredients = filter_input(INPUT_POST, 'ingredients', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
//         $steps = filter_input(INPUT_POST, 'steps', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
//         $cuisineid = filter_input(INPUT_POST, 'cuisineid', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
//         require_once("config.php");
//          // $statement_update = $ConnectingDB->prepare($query1);

//          //$currentRecipeID = $GET['id'];
//         $currentRecipeID = $GET['id'];

//         $query1 = "UPDATE Recipe SET RecipeName = :recipename, PrepTime = :preptime, CookingTime = :cookingtime, Ingredients = :ingredients, Steps = :steps, CuisineID = :cuisine, WHERE RecipeID = $currentRecipeID";

//          $statement_update = $ConnectingDB->prepare($query1);

//             $statement_update->bindValue(':recipename', $recipename);
//             $statement_update->bindValue(':cookingtime', $cookingtime);
//             $statement_update->bindValue(':preptime', $preptime);
//             $statement_update->bindValue(':ingredients', $ingredients);
//             $statement_update->bindValue(':steps', $steps);
//             //$statement_update->bindValue(':userid', $userid);
//             $statement_update->bindValue(':cuisineid', $cuisineid);
//             //$statement_update->bindValue(':id', $_POST['id']);


//             $statement_update->execute();
//                             header("Location: MyRecipe.php");
//                 exit;

//     }
// }
// if (filter_input(INPUT_POST, 'id', FILTER_VALIDATE_INT) != NULL || filter_input(INPUT_POST, 'id', FILTER_VALIDATE_INT) != false)
// {
//     $userid = $_SESSION['current_user_id'];
//     $id = $_POST['id'];
//     $currentRecipeID = $GET['id'];

//     if ($_POST['command'] == 'delete')
//     {
//         // $query = "SELECT * FROM Recipe JOIN Users using(UserID) WHERE UserID = $userid AND RecipeID = $id";


//         $query = "DELETE FROM Recipe JOIN Users using(UserID) WHERE UserID = $userid AND RecipeID = $currentRecipeID";

//         $statement = $ConnectingDB->prepare($query);
//         $statement->execute();
//         header("Location: MyRecipe.php");
//     }
//     else if($_POST['command'] == 'update'){
//         $recipename = filter_input(INPUT_POST, 'recipename', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
//         $cookingtime = filter_input(INPUT_POST, 'cookingtime', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
//         $preptime = filter_input(INPUT_POST, 'preptime', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
//         $ingredients = filter_input(INPUT_POST, 'ingredients', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
//         $steps = filter_input(INPUT_POST, 'steps', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
//         $cuisineid = filter_input(INPUT_POST, 'cuisineid', FILTER_SANITIZE_FULL_SPECIAL_CHARS);

//         $query1 = "UPDATE Recipe SET RecipeName = :recipename, PrepTime = :preptime, CookingTime = :cookingtime, Ingredients = :ingredients, Steps = :steps, CuisineID = :cuisine, UserID = :userid, WHERE UserID = $userid AND RecipeID = $currentRecipeID";


//         // "SELECT * FROM Recipe WHERE RecipeID=$id";
//         $statement_update = $ConnectingDB->prepare($query1);
// // RecipeName, PrepTime, CookingTime, Ingredients, Steps, UserID, CuisineID
//             $statement_update->bindValue(':recipename', $recipename);
//             $statement_update->bindValue(':cookingtime', $cookingtime);
//             $statement_update->bindValue(':preptime', $preptime);
//             $statement_update->bindValue(':ingredients', $ingredients);
//             $statement_update->bindValue(':steps', $steps);
//             $statement_update->bindValue(':userid', $userid);
//             $statement_update->bindValue(':cuisineid', $cuisineid);

//             $statement_update->execute();
//                             header("Location: MyRecipe.php");
//                 exit;
//     }
// }


// else
// {
//     header("Location: index.php");
//     exit;
// }

?>
