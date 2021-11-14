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
  // $id = $_GET['id'];
  // // echo $id;
  // $query = "SELECT * FROM Recipe JOIN Users using(UserID) WHERE UserID = $userid AND RecipeID = $id";

  // $statement = $ConnectingDB->prepare($query);
  // $statement->execute(); 

  // $query2 = "SELECT * FROM Cuisines";
  // $statement_cuisine = $ConnectingDB->prepare($query2);
  // $statement_cuisine->execute();

  // Delete
  // echo $_POST['command'];



  $userid = $_SESSION['current_user_id'];
  $id = $_GET['id']; // current cuisine

    $query2 = "SELECT * FROM Cuisines WHERE CuisineID = $id AND UserID = $userid";
  $statement_cuisine = $ConnectingDB->prepare($query2);
  $statement_cuisine->execute();

 ?>
<!DOCTYPE html>
<html lang="en">
<head>
  <title>Blog Page</title>
</head>
<body>
  <?php include('basic.html')?>
  <div class="container">
    <div class="row mt-4">
      <section class="container py-2 mb-4">
        <div class="row">
          <div class="offset-lg-1 col-lg-10" style="min-height:400px;">
            <form class="" action="ProcessCuisine.php" method="post" enctype="multipart/form-data">
              <div class="card bg-secondary text-light mb-3">
                <div class="card-body" style="background: #669fb2;">
                  <!-- Content of the form starts -->
                  <?php while ($row = $statement_cuisine->fetch()): ?><!--  everything except cuisine while loop starts-->
                  <!-- Recipe Name Edit starts -->
                    <div class="form-group">
                      <label for="cuisinename1"> <span class="FieldInfo" style="color:#f5aa5f">Cuisine Name:</span></label>
                      <input class="form-control" type="text" name="cuisinename" id="cuisinename" value="<?= $row['CuisineName']?>">
                    </div>
                  <!-- Recipe Name Edit ends -->
                  <?php endwhile ?>  <!-- while loop ends-->

                  <div class="row"><!--  buttons series starts -->
                    <input type="hidden" name="id" value="<?=$_GET['id'] ?>" />
                    <div class="col-lg-4 mb-2">
                      <a href="MyRecipe.php" class="btn btn-block" style="background:#caede3">Cancel</a>
                    </div>
                    <div class="col-lg-4 mb-2">
                      <input type="submit" name="command" value="Delete" class="btn btn-block text-dark" style="background:#aa574b" onclick="return confirm('Are you sure you wish to delete this category? this means you will delete all other user recipes that associated with this category)" />
                    </div>
                    <div class="col-lg-4 mb-2">
                      <input type="submit" name="command" value="Update" class="btn btn-block" style="background:#dddb76" />
                    </div>
                  </div>  <!--  buttons series ends -->
                  <!-- Content of the form ends -->
                </div><!-- <div class="card-body" style="background: #669fb2;"> -->
              </div> <!-- <div class="card bg-secondary text-light mb-3"> -->
            </form> <!-- <form class="" action="ProcessRecipe.php" method="post" enctype="multipart/form-data"> -->
          </div><!--  <div class="offset-lg-1 col-lg-10" style="min-height:400px;"> -->
        </div><!--  <div class="row"> -->
      </section> <!-- <section class="container py-2 mb-4"> -->
    </div> <!-- <div class="row mt-4"> -->
  </div> <!-- <div class="container"> -->
</body>
</html>
