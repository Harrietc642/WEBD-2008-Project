<?php
require_once("config.php");

 $query_top_recipe = "SELECT * FROM Recipe WHERE RecipeID = 1";
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
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.6.3/css/all.css" integrity="sha384-UHRtZLI+pbxtHCWp1t77Bi1L4ZtiqrqD80Kn4Z8NTSRyMA2Fd33n5dQ8lWUE00s/" crossorigin="anonymous">
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/css/bootstrap.min.css" integrity="sha384-GJzZqFGwb1QTTN6wy59ffF1BuGJpLSa9DkKMp0DgiMDm4iYMj70gZWKYbI706tWS" crossorigin="anonymous">
  <link rel="stylesheet" href="Css/Styles.css">
  <title>Blog Page</title>
</head>
<body style="background:#ffcc00 ;">
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

          <h3 class="card-header text-light" style="background:#e65c00">Our Recommended Recipe</h3>
         
          <div  class="card-body border border-danger" style="background:#FFF">
            <?php while ($row = $statement_top_recipe->fetch()): ?>
              <h4><?= $row['RecipeName'] ?></h4>
              <p>Authored by: <?= $row['UserID'] ?></p>
              <small>Cooking Time: <?= $row['CookingTime'] ?></small></br>
              <small>Prep Time: <?= $row['PrepTime'] ?></small>
              <p>Ingredients: <?= $row['Ingredients'] ?></p>
              <p>Steps: <?= $row['Steps'] ?></p>
            <?php endwhile ?>
          </div>   
        </div>

        <!-- Main Area End-->

        <!-- Side Area Start -->
        <div class="col-sm-6">
          </br>
          <div class="card mt-2">
            <div class="card-body">
              <div class="text-center">Welcome to Mary's Food World! That's right! You can share your views on recipes here </div>
            </div>
          </div>
        <!-- Side Area End -->

    </div> 

    </div>

    <!-- HEADER END -->
  <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.6/umd/popper.min.js" integrity="sha384-wHAiFfRlMFy6i5SRaxvfOCifBUQy1xHdJ/yoi7FRNXMRBu5WHdZYu1hA6ZOblgut" crossorigin="anonymous"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/js/bootstrap.min.js" integrity="sha384-B0UglyR+jN6CkvvICOB2joaf5I4l3gm9GU6Hc1og6Ls7i6U/mkkaduKaBhlAXv9k" crossorigin="anonymous"></script>

</body>
</html>