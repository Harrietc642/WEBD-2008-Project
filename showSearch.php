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
  $keyword = $_POST['keyword'];

  $query = "SELECT * FROM Recipe JOIN Users using(UserID) JOIN Cuisines using(CuisineID)";
  $statement = $ConnectingDB->prepare($query);
  $statement->execute(); 

  $row = $statement->fetch();
  $string_keyword = strpos($row['RecipeName'], $keyword);

  $query_search = "SELECT * FROM Recipe JOIN Cuisines using(CuisineID) WHERE RecipeName = $string_keyword";
  $statement_search = $ConnectingDB->prepare($query_search);
  $statement_search->execute(); 
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
      <h4 style="color: #aa574b;">These recipes are ordered alphabetically</h4>

    </div>
        <div class="col-sm-12">
          </br>
          <?php while ($row1 = $statement_search->fetch()): ?>
            <h3 class="card-header text-light" style="background:#4d675a"><?= $row1['RecipeName']?></h3>  
            <div  class="card-body border border-danger mb-4" style="background:#f9f7f1">
              <p>
                <small><?= $row1['CuisineName'] ?></small>
                <small>-  Authored by: <?= $row1['Username'] ?></small>
              </p>
              <p>
              <small>Cooking Time: <?= $row1['CookingTime'] ?></small></br>
              <small>Prep Time: <?= $row1['PrepTime'] ?></small></br>
              </p>

              <p>
                <label>Ingredients: </label><br>
                <?= $row1['Ingredients'] ?></br></br>
                <label>Steps: </label><br>
                <?= $row1['Steps'] ?></br>
              </p>

              <p>
                <img src=" uploads/<?= $row1['img'] ?>" alt=" <?= $row1['img'] ?>">
              </p>
            </div>
            <?php endwhile ?>
          </div>   
        </div>
    <!-- HEADER END -->
</body>
</html>