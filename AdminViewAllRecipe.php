<?php
/*
Name: Harriet Chiu
Date: November 10, 2021
Course: Web Development 2
Topic: Project 
*/
  require_once("config.php");
  session_start();

  $userid = $_SESSION['current_user_id'];
  $query = "SELECT * FROM Recipe JOIN Users using(UserID)";
  
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
              <!-- <a class="card-header text-light" href="AdminDeleteRecipe.php?id=<?=($row['RecipeID'])?>">          Delete</a> -->
            </h3>
            <form class="" action="AdminDeleteRecipe.php" method="post" enctype="multipart/form-data">
              <div class="card-header text-light"style="background:#4d675a">
                <input type="hidden" name="id" value="<?=$row['RecipeID'] ?>" />
                <input type="submit" name="command" value="Delete" class="btn btn-block text-dark text-center col-sm-2" style="background:#847b45 " onclick="return confirm('Are you sure you wish to delete this post?')" />
              </div>     
            </form>

            <div  class="card-body border border-danger mb-4" style="background:#f9f7f1 ">
              <p>
              <small>Username: <?= $row['Username'] ?></small></br>
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
