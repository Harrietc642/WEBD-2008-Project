<?php
/*
Name: Harriet Chiu
Date: November 10, 2021
Course: Web Development 2
Topic: Project 
*/
require_once("config.php");

 $query_top_recipe = "SELECT * FROM Recipe JOIN Users using(UserID) WHERE RecipeID = 11";
 $statement_top_recipe = $ConnectingDB->prepare($query_top_recipe);
 $statement_top_recipe->execute(); 

 $query = "SELECT * FROM Cuisines";
 $statement = $ConnectingDB->prepare($query);
 $statement->execute(); 

 session_start();
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
        <div class="col-sm-8 ">
          <h1>Your Favourite Foodie Blog</h1>
          <h1 class="lead">Harriet's WEBD-2008 Project - RRC</h1>  
          <?php if(isset($_SESSION['current_username'])) : ?>              
            <div>
               <a href="index.php"><?= 'Welcome Back! '. $_SESSION['current_username']. $_SESSION['current_user_id']?>    </a> 
            </div>
          <?php endif ?>  
        </div>

        <div class="col-sm-6 ">
          </br>
          <h3 class="card-header text-light" style="background:#d3b94f">Our Recommended Recipe</h3>  
          <div  class="card-body border border-danger" style="background:#FFF">
            <?php while ($row = $statement_top_recipe->fetch()): ?>
              <h4><?= $row['RecipeName'] ?></h4>
              <p>Authored by: <?= $row['Username'] ?></p>
              <p>
                <small>Cooking Time: <?= $row['CookingTime'] ?></small></br>
                <small>Prep Time: <?= $row['PrepTime'] ?></small>
              </p>
              
                <p>Ingredients: </p>
                <p><?= $row['Ingredients'] ?></p>
                <p>Steps: </p>
                <p><?= $row['Steps'] ?></p>
            <?php endwhile ?>
          </div>   
        </div>
        <!-- Main Area End-->

        <!-- Side Area Start -->
        <div class="col-sm-6">
          </br>
          <div class="card mt-2" style="background:#caede3">
            <div class="card-body">
              <div class="text-center">Welcome to Mary's Food World! That's right! You can share your views on recipes here </div>
            </div>
          </div>
        <!-- Side Area End -->
        </div> 
    </div>
    <!-- HEADER END -->
</body>
</html>