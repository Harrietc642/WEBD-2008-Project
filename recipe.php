

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
      </ul>
      <ul class="navbar-nav ml-auto">
        <form class="form-inline d-none d-sm-block" action="Login.php">
          <div class="form-group">
          <button  class="btn btn-primary" name="login">Already A Member?</button>
          </div>
        </form>
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


        <?php while ($row = $statement->fetch()): ?>
        <div>
            <h4><?= $row['RecipeName'] ?></h4>
            <p>Authored by: <?= $row['UserID'] ?></p>
            <small>Cooking Time: <?= $row['CookingTime'] ?></small></br>
            <small>Prep Time: <?= $row['PrepTime'] ?></small>
            <p>Ingredients: <?= $row['Ingredients'] ?></p>
            <p>Steps: <?= $row['Steps'] ?></p>
        </div>        

        <?php endwhile ?>
        <!-- Main Area End-->



    </div> 

    </div>

    <!-- HEADER END -->



  <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.6/umd/popper.min.js" integrity="sha384-wHAiFfRlMFy6i5SRaxvfOCifBUQy1xHdJ/yoi7FRNXMRBu5WHdZYu1hA6ZOblgut" crossorigin="anonymous"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/js/bootstrap.min.js" integrity="sha384-B0UglyR+jN6CkvvICOB2joaf5I4l3gm9GU6Hc1og6Ls7i6U/mkkaduKaBhlAXv9k" crossorigin="anonymous"></script>

</body>
</html>