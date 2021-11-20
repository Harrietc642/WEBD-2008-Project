<?php
/*
Name: Harriet Chiu
Date: November 10, 2021
Course: Web Development 2
Topic: Project 
*/
  require_once("config.php");
  session_start();

     $query = "SELECT * FROM Recipe";


     $statement = $ConnectingDB->prepare($query);
     $statement->execute(); 

     $query2 = "SELECT * FROM Cuisines";
     $statement_cuisine = $ConnectingDB->prepare($query2);
      $statement_cuisine->execute();


  if (isset($_POST['recipename']) && isset($_POST['cookingtime']) && isset($_POST['preptime']) && isset($_POST['ingredients'])&& isset($_POST['steps']) && (!empty($_POST['recipename'])))
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
            echo "Enter Keyword and try again!";
            header("Location: showSearch.php");

            exit;
          }
  }
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

      <form class="" action="showSearch.php" method="post" enctype="multipart/form-data">

        <div class="card bg-secondary text-light mb-3" style="background: #669fb2;">
            <h3 class="text-center">Find your favourite recipe here</h3>
          <div class="card-body" style="background: #669fb2;">
<!--             <?php if(empty($_POST['recipename'])) : ?>
                <p>you must enter recipe name</p>
              <?php endif ?> -->
            <div class="form-group">
              <label for="title"> <span class="FieldInfo"> Recipe Name: </span></label>
              <input type="hidden" name="keywordrecipe" value="" /><!-- <?=$_GET['id'] ?> -->
               <input class="form-control" type="text" name="keyword" id="keyword" placeholder="Keyword" value="">
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

            <div class="row">
              <div class="col-lg-6 mb-2">
                <a href="Index.php" class="btn btn-block" style="background:#caede3">Cancel</a>
              </div>
              <div class="col-lg-6 mb-2">
                <button type="submit" name="Submit" class="btn btn-block" style="background:#dddb76">Search</button>
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