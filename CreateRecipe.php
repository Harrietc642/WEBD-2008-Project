<?php

  require_once("config.php");
  session_start();

  if(!isset($_SESSION['current_user_role']) && $_SESSION['current_user_role'] == "user"){
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




if (isset($_POST['recipename']) && isset($_POST['cookingtime']) && isset($_POST['preptime']) && isset($_POST['ingredients'])&& isset($_POST['steps']))
{
            $recipename = filter_input(INPUT_POST, 'recipename', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
            $cookingtime = filter_input(INPUT_POST, 'cookingtime', FILTER_SANITIZE_FULL_SPECIAL_CHARS);

            $preptime = filter_input(INPUT_POST, 'preptime', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
            $ingredients = filter_input(INPUT_POST, 'ingredients', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
            $steps = filter_input(INPUT_POST, 'steps', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
            $cuisineid = filter_input(INPUT_POST, 'cuisineid', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
            // $restid = 1;
            $userid = $_SESSION['current_user_id'];

            $query = "INSERT INTO Recipe (RecipeName, PrepTime, CookingTime, Ingredients, Steps, UserID, CuisineID) VALUES (:recipename, :cookingtime, :preptime, :ingredients, :steps, :userid, :cuisineid)";
            $statement = $ConnectingDB->prepare($query);

            //  Bind values to the parameters
            $statement->bindValue(':recipename', $recipename);
            $statement->bindValue(':cookingtime', $cookingtime);
            $statement->bindValue(':preptime', $preptime);
            $statement->bindValue(':ingredients', $ingredients);
            $statement->bindValue(':steps', $steps);
            $statement->bindValue(':userid', $userid);
            $statement->bindValue(':cuisineid', $cuisineid);

            if ($statement->execute())
            {
                header("Location: Recipe.php");
                exit;
            }
        
        else
        {
            header("Location: CreateRecipe.php");
            exit;
        }
}
 ?>

<!DOCTYPE html>
<html lang="en">
<head>
  <title>Blog Page</title>
</head>
<body style="background:#ffcc00">
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
                <button type="submit" name="Submit" class="btn btn-block" style="background:#dddb76">Create this recipe</button>
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