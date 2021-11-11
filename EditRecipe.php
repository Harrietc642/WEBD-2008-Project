

<?php
// global $ConnectingDB;
// $sql = "SELECT * FROM Topics ORDER BY TopicID desc";
// $stmt = $ConnectingDB->query($sql);
// while ($DataRows = $stmt->fetch()) {
//   $TopicId = $DataRows["TopicID"];
//   $TopicName=$DataRows["Topic"];
// }
require_once("config.php");
session_start();
    // require('connect.php');
    $userid = $_SESSION['current_user_id'];
    $id = $_GET['id'];
     // SQL is written as a String.
     $query = "SELECT * FROM Recipe JOIN Users using(UserID) WHERE UserID = $userid AND RecipeID = $id";

     // A PDO::Statement is prepared from the query.
     $statement = $ConnectingDB->prepare($query);

     // Execution on the DB server is delayed until we execute().
     $statement->execute(); 


     $query2 = "SELECT * FROM Cuisines";
     $statement_cuisine = $ConnectingDB->prepare($query2);
      $statement_cuisine->execute();

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
  <?php include('basic.html')?>
    <!-- HEADER -->
    <div class="container">
      <div class="row mt-4">

        <!-- Main Area Start-->
<section class="container py-2 mb-4">
  <div class="row">
    <div class="offset-lg-1 col-lg-10" style="min-height:400px;">
      <form class="" action="ProcessRecipe.php" method="post" enctype="multipart/form-data">
        <div class="card bg-secondary text-light mb-3">
          <div class="card-body bg-dark">
            
            
            <?php while ($row = $statement->fetch()): ?>
              <!-- Recipe Name Edit Starts -->
              <div class="form-group">
                <label for="recipename1"> <span class="FieldInfo">Recipe Name:</span></label>
                <input class="form-control" type="text" name="recipename" id="recipename" value="<?= $row['RecipeName']?>">
              </div>
            <!-- Recipe Name Edit Ends -->

            <!-- Cooking Time Edit Starts -->
              <div class="form-group">
                <label for="cookingtime1"> <span class="FieldInfo">Cooking Time:</span></label>
                <input class="form-control" type="text" name="cookingtime" id="cookingtime" value="<?= $row['CookingTime']?>">
              </div>
            <!-- Cooking Time Edit Ends -->

            <!-- Prep Time Edit Starts -->
              <div class="form-group">
                <label for="preptime1"> <span class="FieldInfo">Prep Time:</span></label>
                <input class="form-control" type="text" name="preptime" id="preptime" value="<?= $row['PrepTime']?>">
              </div>
            <!-- Prep Time Edit Ends -->

            <!-- Ingredients Edit Starts -->
              <div class="form-group">
                <label for="ingredients1"> <span class="FieldInfo">Ingredients:</span></label>
                <textarea class="form-control" id="ingredients" name="ingredients"  rows="8" cols="80"><?= $row['Ingredients']?></textarea>
              </div>
            <!-- Ingredients Time Edit Ends -->

            <!-- Ingredients Edit Starts -->
              <div class="form-group">
                <label for="steps1"> <span class="FieldInfo">Steps:</span></label>
                <textarea class="form-control" id="steps" name="steps"  rows="8" cols="80"><?= $row['Steps']?></textarea>
              </div>
            <!-- Ingredients Time Edit Ends -->
            <?php endwhile ?>

            <!-- Cuisine Type Edit Starts -->
              <div class="form-group">
                <label for="title"> <span class="FieldInfo"> Cuisine: </span></label>
                
                <select class="form-control" id="cuisineid" name="cuisineid" value="<?= $row2['CuisineID']?>">
                  <?php while ($row2 = $statement_cuisine->fetch()): ?>
                    <div>
                      <option value="<?= $row2['CuisineID'] ?>"><?= $row2['CuisineName'] ?></option>
                    </div> 
                  <?php endwhile ?>
                </select>
              </div>
            <!-- Cuisine Type Edit Ends -->
            <!-- Recipe Name Edit Starts -->
            <?php while ($row3 = $statement->fetch()): ?>
              <div class="form-group">
                <label for="cookingtime1"> <span class="FieldInfo">Cooking Time:</span></label>
                <input class="form-control" type="text" name="cookingtime" id="cookingtime" value="<?= $row3['CookingTime']?>">
              </div>
            <?php endwhile ?>
            <!-- Recipe Name Edit Ends -->
            <div class="row">
                <div class="col-lg-4 mb-2">
                  <a href="MyPost.php" class="btn btn-warning btn-block">Cancel</a>
                </div>
                            <div class="col-lg-4 mb-2">
                 <input type="submit" name="command" value="delete" class="btn btn-danger btn-block" onclick="return confirm('Are you sure you wish to delete this post?')" />
            </div>
                <div class="col-lg-4 mb-2">
              <input type="submit" name="command" value="update" class="btn btn-success btn-block" />
            </div>

          
            </div>








<!-- 

            <div class="row">
              <div class="col-lg-4 mb-2">
                <a href="MyPost.php" class="btn btn-warning btn-block">Cancel</a>
              </div>
              <div class="col-lg-4 mb-2">
                <a href="ProcessRecipe.php" class="btn btn-danger btn-block">Delete</a>
              </div>
              <div class="col-lg-4 mb-2">
                <a type="" name="command" href="ProcessRecipe.php" class="btn btn-success btn-block">Update this Recipe</a>
              </div>
            </div> -->
          </div>
        </div>
      </form>
     </div>
  </div>
</section> 
</div>
</div>
</body>
        <!-- Main Area End-->



    </div> 

    </div>

    <!-- HEADER END -->



  <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.6/umd/popper.min.js" integrity="sha384-wHAiFfRlMFy6i5SRaxvfOCifBUQy1xHdJ/yoi7FRNXMRBu5WHdZYu1hA6ZOblgut" crossorigin="anonymous"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/js/bootstrap.min.js" integrity="sha384-B0UglyR+jN6CkvvICOB2joaf5I4l3gm9GU6Hc1og6Ls7i6U/mkkaduKaBhlAXv9k" crossorigin="anonymous"></script>

</body>
</html>