<?php
/*
Name: Harriet Chiu
Date: November 10, 2021
Course: Web Development 2
Topic: Project 
*/
  require_once("config.php");
  session_start();

  $id = filter_input(INPUT_GET, "id", FILTER_VALIDATE_INT);
  if(!$id)
  {
    header('location:/wd2/Project/Official/allrecipes');
    exit;
  }
  $query = "SELECT * FROM Recipe JOIN Users using(UserID) JOIN Cuisines using(CuisineID) WHERE RecipeID = $id";
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
    <div class="col-sm-12">
      </br>
      <h4 style="color: #aa574b;">These recipes are ordered alphabetically</h4>

    </div>
        <div class="col-sm-12">
          </br>
          <?php while ($row = $statement->fetch()): ?>
            <a class="card-header text-light" style="background:#4d675a" href="/wd2/Project/Official/singlerecipe/<?= $row['RecipeID']?> "><?= $row['RecipeName']?></a>  
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
    <!--           <img src="uploads/<?= $row['img'] ?>"> -->
              <?php if(!empty($row['img'])) : ?>
<!--               <p>
               <!--  <img src=" uploads/<?= $row['img'] ?>" alt=" <?= $row['img'] ?>"> -->
              </p> 
              <?php endif ?>
            </div>
            <?php endwhile ?>
          </div>   
        </div>
    <!-- HEADER END -->
</body>
</html>