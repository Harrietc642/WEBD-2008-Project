<!-----------------
    Name: Group 4
    Date: 2021-09-22
    Course: WEBD-2008 (213758)
    Purpose: Makes sure that the changes/delete request made is valid. 
    A3  
------------------->
<?php
//require_once("config.php");
session_start();





// if(!isset($_SESSION['current_user_role']) && $_SESSION['current_user_role'] == "user"){
//   header("Location: index.php");
//   exit;
// }

if ($_POST) {
    if ($_POST['command'] == 'update') {
        $recipename = filter_input(INPUT_POST, 'recipename', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
        $cookingtime = filter_input(INPUT_POST, 'cookingtime', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
        $preptime = filter_input(INPUT_POST, 'preptime', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
        $ingredients = filter_input(INPUT_POST, 'ingredients', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
        $steps = filter_input(INPUT_POST, 'steps', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
        $cuisineid = filter_input(INPUT_POST, 'cuisineid', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
        require_once("config.php");
         // $statement_update = $ConnectingDB->prepare($query1);

         //$currentRecipeID = $GET['id'];
        $currentRecipeID = $GET['id'];

        $query1 = "UPDATE Recipe SET RecipeName = :recipename, PrepTime = :preptime, CookingTime = :cookingtime, Ingredients = :ingredients, Steps = :steps, CuisineID = :cuisine, WHERE RecipeID = $currentRecipeID";

         $statement_update = $ConnectingDB->prepare($query1);

            $statement_update->bindValue(':recipename', $recipename);
            $statement_update->bindValue(':cookingtime', $cookingtime);
            $statement_update->bindValue(':preptime', $preptime);
            $statement_update->bindValue(':ingredients', $ingredients);
            $statement_update->bindValue(':steps', $steps);
            //$statement_update->bindValue(':userid', $userid);
            $statement_update->bindValue(':cuisineid', $cuisineid);
            //$statement_update->bindValue(':id', $_POST['id']);


            $statement_update->execute();
                            header("Location: MyRecipe.php");
                exit;

    }
}
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
