

<?php
// global $ConnectingDB;
// $sql = "SELECT * FROM Topics ORDER BY TopicID desc";
// $stmt = $ConnectingDB->query($sql);
// while ($DataRows = $stmt->fetch()) {
//   $TopicId = $DataRows["TopicID"];
//   $TopicName=$DataRows["Topic"];
// }
require_once("config.php");
    // require('connect.php');
    
     // SQL is written as a String.
     $query = "SELECT * FROM Recipe";

     // A PDO::Statement is prepared from the query.
     $statement = $ConnectingDB->prepare($query);

     // Execution on the DB server is delayed until we execute().
     $statement->execute(); 

if (isset($_POST['recipename']) && isset($_POST['cookingtime']) && isset($_POST['preptime']) && isset($_POST['ingredients'])&& isset($_POST['steps']))
{



            $recipename = filter_input(INPUT_POST, 'recipename', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
            $cookingtime = filter_input(INPUT_POST, 'cookingtime', FILTER_SANITIZE_FULL_SPECIAL_CHARS);

            $preptime = filter_input(INPUT_POST, 'preptime', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
            $ingredients = filter_input(INPUT_POST, 'ingredients', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
            $steps = filter_input(INPUT_POST, 'steps', FILTER_SANITIZE_FULL_SPECIAL_CHARS);



            $query = "INSERT INTO Recipe (RecipeName, PrepTime, CookingTime, Ingredients, Steps) VALUES (:recipename, :cookingtime, :preptime, :ingredients, :steps)";
            $statement = $ConnectingDB->prepare($query);

            //  Bind values to the parameters
            $statement->bindValue(':recipename', $recipename);
            $statement->bindValue(':cookingtime', $cookingtime);
            $statement->bindValue(':preptime', $preptime);
            $statement->bindValue(':ingredients', $ingredients);

            $statement->bindValue(':steps', $steps);

            if ($statement->execute())
            {
                header("Location: index.php");
                exit;
            }
        
        else
        {
            header("Location: CreateRecipe.html");
            exit;
        }
}
















 ?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.6.3/css/all.css" integrity="sha384-UHRtZLI+pbxtHCWp1t77Bi1L4ZtiqrqD80Kn4Z8NTSRyMA2Fd33n5dQ8lWUE00s/" crossorigin="anonymous">
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/css/bootstrap.min.css" integrity="sha384-GJzZqFGwb1QTTN6wy59ffF1BuGJpLSa9DkKMp0DgiMDm4iYMj70gZWKYbI706tWS" crossorigin="anonymous">
  <link rel="stylesheet" href="Css/Styles.css">
  <title>Blog Page</title>
</head>
<body>
  <!-- NAVBAR -->
  <div style="height:10px; background:#27aae1;"></div>
  <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
    <div class="container">
      <a href="#" class="navbar-brand"> Mary's Food World</a>
      <button class="navbar-toggler" data-toggle="collapse" data-target="#navbarcollapseCMS">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="navbarcollapseCMS">
      <ul class="navbar-nav mr-auto">
        <li class="nav-item">
          <a href="Index.php" class="nav-link">Home</a>
        </li>
        <li class="nav-item">
          <a href="recipe.php" class="nav-link">Recipes</a>
        </li>
        <li class="nav-item">
          <a href="restaurant.php" class="nav-link">Restaurants</a>
        </li>
        <li class="nav-item">
          <a href="product.php" class="nav-link">Products</a>
        </li>
        <li class="nav-item">
          <a href="register.php" class="nav-link">Register</a>
        </li>
                <li class="nav-item">
          <a href="CreateRecipe.php" class="nav-link">Create Recipe</a>
        </li>
        <li class="nav-item">
          <a href="CreateRestaurant.php" class="nav-link">Create Restos</a>
        </li>
        <li class="nav-item">
          <a href="CreateProduct.php" class="nav-link">Create Product</a>
        </li>
      </ul>

      </div>
    </div>
  </nav>
    <div style="height:10px; background:#27aae1;"></div>
    <!-- NAVBAR END -->
    <!-- HEADER -->
    <div class="container">
      <div class="row mt-4">

        <!-- Main Area Start-->
<section class="container py-2 mb-4">
  <div class="row">
    <div class="offset-lg-1 col-lg-10" style="min-height:400px;">

      <form class="" action="CreateRecipe.php" method="post" enctype="multipart/form-data">
        <div class="card bg-secondary text-light mb-3">
          <div class="card-body bg-dark">
            <div class="form-group">
              <label for="title"> <span class="FieldInfo"> Post Title: </span></label>
               <input class="form-control" type="text" name="recipename" id="recipename" placeholder="My New Recipe" value="">
            </div>
 <!--            <div class="form-group">
              <div class="custom-file">
              <input class="custom-file-input" type="File" name="Image" id="imageSelect" value="">
              <label for="imageSelect" class="custom-file-label">Select Image... </label>
              </div>
            </div> -->
            <div class="form-group">
              <label for="cookingtime"> <span class="FieldInfo"> Cooking Time </span></label>
               <input class="form-control" type="text" name="cookingtime" id="cookingtime" placeholder="00:30" value="">
            </div>
            <div class="form-group">
              <label for="preptime"> <span class="FieldInfo"> Prep Time </span></label>
               <input class="form-control" type="text" name="preptime" id="preptime" placeholder="00:30" value="">
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
                <a href="Index.php" class="btn btn-warning btn-block">Cancel</a>
              </div>
              <div class="col-lg-6 mb-2">
                <button type="submit" name="Submit" class="btn btn-success btn-block">Create this recipe</button>
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



  <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.6/umd/popper.min.js" integrity="sha384-wHAiFfRlMFy6i5SRaxvfOCifBUQy1xHdJ/yoi7FRNXMRBu5WHdZYu1hA6ZOblgut" crossorigin="anonymous"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/js/bootstrap.min.js" integrity="sha384-B0UglyR+jN6CkvvICOB2joaf5I4l3gm9GU6Hc1og6Ls7i6U/mkkaduKaBhlAXv9k" crossorigin="anonymous"></script>

</body>
</html>