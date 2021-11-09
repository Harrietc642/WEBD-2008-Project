<?php
require_once("config.php");

 $query = "SELECT * FROM Topics";
 $statement = $ConnectingDB->prepare($query);
 $statement->execute(); 

 $query_top_recipe = "SELECT * FROM Recipe WHERE RecipeID = 1";
 $statement_top_recipe = $ConnectingDB->prepare($query_top_recipe);
 $statement_top_recipe->execute(); 

 $query_top_product = "SELECT * FROM Product WHERE ProductID = 1";
 $statement_top_product = $ConnectingDB->prepare($query_top_product);
 $statement_top_product->execute(); 

 $query_top_rest = "SELECT * FROM Restaurant WHERE RestID = 1";
 $statement_top_rest = $ConnectingDB->prepare($query_top_rest);
 $statement_top_rest->execute(); 

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
          <a href="AdvancedSearch.php" class="nav-link">Advanced Search</a>
        </li>
        <?php if(isset($_SESSION['current_username'])) : ?>
          <li class="nav-item">
            <a href="mypost.php" class="nav-link">My Post</a>
          </li>
      </ul> 
      <form class="form-inline d-none d-sm-block" action="createpost.php">
        <div class="form-group">
          <button  class="btn btn-primary" name="createpost">Create Post</button>
        </div>
      </form>
      <form class="form-inline d-none d-sm-block" action="logout.php">
        <div class="form-group">
          <button  class="btn btn-primary" name="logout">Log out</button>
        </div>
      </form>
              <?php else :?>
                <li class="nav-item">
                  <a href="register.php" class="nav-link">Register</a>
                </li>
                <form class="form-inline d-none d-sm-block" action="Login.php">
                  <div class="form-group">
                    <button  class="btn btn-primary" name="login">Already A Member?</button>
                  </div>
                </form>
            <?php endif ?>            
      </div>
    </div>

    
  </nav>
    <div style="height:10px; background:#27aae1;"></div>
    <!-- NAVBAR END -->
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
        <!-- show top posts of each topic -->
        <div class="col-sm-8 ">
          </br>
          </br>
          <h3>Our Recommended Recipe</h3>
          <?php while ($row = $statement_top_recipe->fetch()): ?>
          <div>
            <h4><?= $row['RecipeName'] ?></h4>
            <p>Authored by: <?= $row['UserID'] ?></p>
            <small>Cooking Time: <?= $row['CookingTime'] ?></small></br>
            <small>Prep Time: <?= $row['PrepTime'] ?></small>
            <p>Ingredients: <?= $row['Ingredients'] ?></p>
            <p>Steps: <?= $row['Steps'] ?></p>
          </div>        
          <?php endwhile ?>

          </br>
          </br>
          <h3>Our Recommended Product</h3>
          <?php while ($row = $statement_top_product->fetch()): ?>
            <div>
              <h4><?= $row['ProductName'] ?></h4>
              <p>Authored by: <?= $row['UserID'] ?></p>
              <p>Used in: <?= $row['RecipeID'] ?></p>
              <p>Origin: <?= $row['Origin'] ?></p>
              <p>Price: $<?= $row['Price'] ?></p>
            </div>        
          <?php endwhile ?>
 


          </br>
          </br>
          <h3>Our Recommended Restaurant</h3>
          <?php while ($row = $statement_top_rest->fetch()): ?>
          <div>
            <h4><?= $row['RestName'] ?></h4>
            <p>Recommended by: <?= $row['UserID'] ?></p>
            <p>Address: <?= $row['Address'] ?></p>
            <p>Rating: <?= $row['Rating'] ?></p>
            <p>Review: <?= $row['Review'] ?></p>
          </div>        
        <?php endwhile ?>
        </div>

        <!-- Main Area End-->

        <!-- Side Area Start -->
        <div class="col-sm-4">
          <div class="card mt-4">
            <div class="card-body">

              <div class="text-center">Welcome to Mary's Food World! That's right! You can share your views on recipes here </div>
            </div>
          </div>
          <br>
          <br>
          <div class="card" >
            <div class="card-header bg-primary text-light" style="background:red">
              <h2 class="lead">Recent Posts on <?php $GET_?></h2>
              </div>
              <div class="card-body">
                  <ul>
                    <?php while ($row = $statement->fetch()): ?>        
                      <a href="<?= $row['Title'] ?>.php"><?= $row['Topic'] ?></a>
                    </br>
                    </br>
                    <?php endwhile ?>
                  </ul>
                
          
            </div>
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