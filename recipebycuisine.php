<?php
  require_once("config.php");
  session_start();
  // $userid = $_SESSION['current_user_id'];

  $query = "SELECT * FROM Recipe JOIN Users using(UserID) JOIN Cuisines using(CuisineID) ORDER BY RecipeName ASC";
  $statement = $ConnectingDB->prepare($query);
  $statement->execute(); 

  $query_cuisine_type = "SELECT * FROM Cuisines ORDER BY CuisineName ASC";
  $statement_cuisine_type = $ConnectingDB->prepare($query_cuisine_type);
  $statement_cuisine_type->execute(); 

 ?>

<!DOCTYPE html>
<html lang="en">
<!-- <script type="text/javascript" async="" src="https://script.4dex.io/localstore.js"></script> -->
<head>
  <title>Blog Page</title>
</head>
<body>
  <?php include('basic.html')?>
    <!-- HEADER -->
    <div class="col-sm-12 text-center">
      </br>
      <h4 class="text-center" style="color: #aa574b;">Cuisines Around The World</h4>
    </div>
     <hr>
    <?php while ($row1 = $statement_cuisine_type->fetch()): ?>
      <a class="card-header text-dark" href="ViewCountry.php?id=<?=($row1['CuisineID'])?>"><?= $row1['CuisineName'] ?></a>
        <!-- <button><a> </a><?= $row1['CuisineName'] ?></button> -->
    <?php endwhile ?>  
     <hr>
<!--     <div id="myDIV">
  This is my DIV element.
</div> -->
<!--     <script type="text/javascript">
      function myFunction() {
        var x = document.getElementsById("myDIV");
        if (x.style.display === "none") {
          x.style.display = "block";
        } else {
        x.style.display = "none";
        }
      }
    </script>

<a class="card-header text-light" href="EditRecipe.php?id=<?=($row['RecipeID'])?>">          edit</a>
 -->




















<!--         <div class="col-sm-12">
          </br>
          <?php while ($row = $statement->fetch()): ?>
            <h3 class="card-header text-light" style="background:#4d675a"><?= $row['RecipeName']?></h3>  
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
            </div>
            <?php endwhile ?>
          </div>   
        </div> -->
    <!-- HEADER END -->
</body>
</html>