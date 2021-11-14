<?php
/*
Name: Harriet Chiu
Date: November 10, 2021
Course: Web Development 2
Topic: Project 
*/
  require_once("config.php");
  session_start();
  // $userid = $_SESSION['current_user_id'];

  $query = "SELECT * FROM Cuisines ORDER BY CuisineName ASC";
  $statement = $ConnectingDB->prepare($query);
  $statement->execute(); 

if(!isset($_SESSION['current_user_role']) && $_SESSION['current_user_role'] != "admin"){
  header("Location: index.php");
  exit;
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
    <div class="col-sm-12">
      </br>
      <h4 style="color: #aa574b;" class="text-center"> Cuisine Manager</h4>

    </div>
        <div class="col-sm-10">
          </br>
          <a class="card-header text-dark" href="InsertCuisine.php">Add New Cuisine Here</a><hr><hr><br>
           <h6 style="color: #aa574b;">Create, Update or Delete the Cuisine Categories (A-Z)</h6></br>
          <?php while ($row = $statement->fetch()): ?>

            <a class="card-header text-dark text-center"  href="EditCuisine.php?id=<?=($row['CuisineID'])?>"><?= $row['CuisineName'] ?></a>
            <!-- <hr class=" col-sm-2"> -->
<!--             <h3 class="card-header text-light" style="background:#4d675a"><?= $row['RecipeName']?></h3>  
            <div  class="card-body border border-danger mb-4" style="background:#f9f7f1">
              <p>
                <small><?= $row['CuisineName'] ?></small>
                <small>-  Authored by: <?= $row['Username'] ?></small>
              </p>
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
            </div> -->
            <?php endwhile ?>
          </div>   
        </div>
    <!-- HEADER END -->
</body>
</html>