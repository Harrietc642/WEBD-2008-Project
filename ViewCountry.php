<?php 
/*
Name: Harriet Chiu
Date: November 10, 2021
Course: Web Development 2
Topic: Project 
*/
require_once("config.php");
session_start();
$id = $_GET['id'];

  $query_cuisine_type = "SELECT * FROM Cuisines JOIN Recipe using(CuisineID) WHERE CuisineID = $id ORDER BY CuisineName ASC";
  $statement_cuisine_type = $ConnectingDB->prepare($query_cuisine_type);
  $statement_cuisine_type->execute(); 

    $query_nav = "SELECT * FROM Cuisines ORDER BY CuisineName ASC";
  $statement_nav = $ConnectingDB->prepare($query_nav);
  $statement_nav->execute(); 
 ?>

 <!DOCTYPE html>
 <html>
 <head>
 	<meta charset="utf-8">
 	<title></title>
 </head>
 <body>
 <?php include('basic.html')?>
    <div class="col-sm-12">
      </br>
      <h4 class="text-center" style="color: #aa574b;">Cuisines Around The World</h4>
    </div>
 <hr>
 <div class="col-sm-11">
 	    <?php while ($row1 = $statement_nav->fetch()): ?>
      <a class="card-header text-dark" href="ViewCountry.php?id=<?=($row1['CuisineID'])?>"><?= $row1['CuisineName'] ?></a>

    <?php endwhile ?>  
    <hr>


   <?php while ($row = $statement_cuisine_type->fetch()): ?>
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

 </body>
 </html>