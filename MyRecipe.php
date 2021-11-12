<?php
  require_once("config.php");
  session_start();

  $userid = $_SESSION['current_user_id'];
  $query = "SELECT * FROM Recipe JOIN Users using(UserID) WHERE UserID = $userid";
  
  // $query = "SELECT * FROM Recipe JOIN Users using(UserID) JOIN Cuisines using(CuisineID) WHERE UserID = $userid";
  $statement = $ConnectingDB->prepare($query);
  $statement->execute(); 
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
        <div class="col-sm-12">
          </br>
          <?php while ($row = $statement->fetch()): ?>
            <h3 class="card-header text-light" style="background:#4d675a">
              <?= $row['RecipeName']?>
              <a class="card-header text-light" href="EditRecipe.php?id=<?=($row['RecipeID'])?>">          edit</a>

            </h3>
            <div  class="card-body border border-danger mb-4" style="background:#f9f7f1 ">
              <p>
              <small>Cooking Time: <?= $row['CookingTime'] ?></small></br>
              <small>Prep Time: <?= $row['PrepTime'] ?></small></br>
              </p>

              <p>
                <label>Ingredients: </label><br>
                <?= $row['Ingredients'] ?></br></br>
                <label>Steps: </label><br>
                <?= $row['Steps'] ?></br>
              </p>
            </div>
            <?php endwhile ?>    
          </div>   
        </div>
    </div> 
    </div>
    <!-- HEADER END -->
</body>
</html>