<?php
/*
Name: Harriet Chiu
Date: November 10, 2021
Course: Web Development 2
Topic: Project 
*/
  require_once("config.php");
  session_start();

  $userid = $_SESSION['current_user_id'];
     $id = filter_input(INPUT_GET, 'id', FILTER_VALIDATE_INT);
  //$id = $_GET['id'];
  // echo $id;
  $query = "SELECT * FROM Recipe JOIN Users using(UserID) WHERE UserID = $userid AND RecipeID = $id";

  $statement = $ConnectingDB->prepare($query);
  $statement->execute(); 

  $query2 = "SELECT * FROM Cuisines";
  $statement_cuisine = $ConnectingDB->prepare($query2);
  $statement_cuisine->execute();

  // Delete
  // echo $_POST['command'];

    //   if ($_POST['command'] == 'Delete') {
    //     $id = $_GET['id'];
    //     $query_delete_recipe = "DELETE FROM Recipe WHERE RecipeID = $id";
    //     $statement_delete = $ConnectingDB->prepare($query_delete_recipe);
    //     $statement_delete->execute();
    //     header("Location: MyRecipe.php");
    // }
 ?>

<!DOCTYPE html>
<html lang="en">
<head>
  <title>Blog Page</title>
    <script type="text/javascript" src="tinymce/tinymce.min.js"></script>
  <script>
    tinymce.init({
      selector:'#ingredients'
    });
    tinymce.init({
      selector:'#steps'
    });
  </script>
</head>
<body>
  <?php include('basic.html')?>
  <div class="container">
    <div class="row mt-4">
      <section class="container py-2 mb-4">
        <div class="row">
          <div class="offset-lg-1 col-lg-10" style="min-height:400px;">
            <form class="" action="ProcessRecipe.php" method="post" enctype="multipart/form-data">
              <div class="card bg-secondary text-light mb-3">
                <div class="card-body" style="background: #669fb2;">
                  <!-- Content of the form starts -->
                  <?php while ($row = $statement->fetch()): ?><!--  everything except cuisine while loop starts-->
                  <!-- Recipe Name Edit starts -->
                  <div class="form-group">
                    <label for="recipename1"> <span class="FieldInfo" style="color:#f5aa5f">Recipe Name:</span></label>
                    <input class="form-control" type="text" name="recipename" id="recipename" value="<?= $row['RecipeName']?>">
                  </div>
                  <!-- Recipe Name Edit ends -->

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

                  <!-- Steps Edit Starts -->
                  <div class="form-group">
                    <label for="steps1"> <span class="FieldInfo">Steps:</span></label>
                    <textarea class="form-control" id="steps" name="steps"  rows="8" cols="80"><?= $row['Steps']?></textarea>
                  </div>
                  <!-- Steps Time Edit Ends -->

                                    <!-- Photo Edit Starts -->
                  <div class="form-group">
                    <p>  Current Image:    
                    <?php if(!empty($row['img'])) : ?>      
                      <img src=" uploads/<?= $row['img'] ?>" alt=" <?= $row['img'] ?>">
                      <?php else :?>
                        None
                       <?php endif ?>
                    </p>
                    
                  </div>
                  <!-- Photo Edit Ends -->
                  <?php endwhile ?>  <!--  everything except cuisine while loop ends-->

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



                  <div class="row"><!--  buttons series starts -->
                   <input type="hidden" name="id" value="<?=$_GET['id'] ?>" />
                    <div class="col-lg-4 mb-2">
                      <a href="MyRecipe.php" class="btn btn-block" style="background:#caede3">Cancel</a>
                    </div>
                    <div class="col-lg-4 mb-2">
                      <input type="submit" name="command" value="Delete" class="btn btn-block text-dark" style="background:#aa574b" onclick="return confirm('Are you sure you wish to delete this post?')" />
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