<?php
/*
Name: Harriet Chiu
Date: November 10, 2021
Course: Web Development 2
Topic: Project 
*/
  require_once("config.php");
  session_start();
  require_once("imageprocess.php");
  $userid = $_SESSION['current_user_id'];
  $query = "SELECT * FROM Recipe JOIN Users using(UserID) WHERE UserID = $userid";
  
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
             <?php if(!empty($row['img'])) : ?>
            <div class="card-body border border-danger mb-4" style="background:#f9f7f1 ">
              <a class="card-header text-dark col-sm-10 mb-4" style="background:#f9f7f1 " href="EditPhoto.php?id=<?=($row['RecipeID'])?>">Delete</a>
              <br>
              
               <p>
                <img src=" uploads/<?= $row['img'] ?>" alt=" <?= $row['img'] ?>">
                 
              </p>
            </div>
            <?php endif ?>
            <?php endwhile ?>    
          </div>   
        </div>
    </div> 
    </div>
    <!-- HEADER END -->
</body>
</html>