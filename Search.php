<?php
/*
Name: Harriet Chiu
Date: November 10, 2021
Course: Web Development 2
Topic: Project 
*/
  require_once("config.php");
  session_start();

     $query = "SELECT * FROM Recipe";
     $statement = $ConnectingDB->prepare($query);
     $statement->execute(); 

     $query2 = "SELECT * FROM Cuisines";
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
    <!-- HEADER -->
    <div class="container">
      <div class="row mt-4">

        <!-- Main Area Start-->
<section class="container py-2 mb-4">
  <div class="row">
    <div class="offset-lg-1 col-lg-10" style="min-height:400px;">

      <form class="" action="/wd2/Project/Official/searchresult" method="get" enctype="multipart/form-data">

        <div class="card bg-secondary text-light mb-3" style="background: #669fb2;">
            <h3 class="text-center">Find your favourite recipe here</h3>
          <div class="card-body" style="background: #669fb2;">
<!--             <?php if(empty($_POST['recipename'])) : ?>
                <p>you must enter recipe name</p>
              <?php endif ?> -->
            <div class="form-group">
              <label for="title"> <span class="FieldInfo"> Recipe Name: </span></label>
              <input type="hidden" name="keywordrecipe" value="" /><!-- <?=$_GET['id'] ?> -->
               <input class="form-control" type="text" name="keyword" id="keyword" placeholder="Keyword" value="">
            </div>

            <div class="form-group">
              <label for="title"> <span class="FieldInfo"> Cuisine: </span></label>
              <select class="form-control" id="cuisinetype" name="cuisinetype">
                <?php while ($row = $statement_cuisine->fetch()): ?>
                  <div>
                    <!-- <input type="hidden" name="cuisinetype" value="<?=$_GET['cuisinetype'] ?>"> -->
                    <option value="<?= $row['CuisineID'] ?>"><?= $row['CuisineName'] ?></option>
                  </div>        
                <?php endwhile ?>
              </select>
            </div>

            <div class="row">
              <div class="col-lg-6 mb-2">
                <a href="Index.php" class="btn btn-block" style="background:#caede3">Cancel</a>
              </div>
              <div class="col-lg-6 mb-2">
                <button type="submit" name="Submit" class="btn btn-block" style="background:#dddb76">Search</button>
              </div>
            </div>
          </div>
        </div>
      </form>
    </div>
  </div>

</section>
        <!-- Main Area End-->
    </div> 

    </div>

    <!-- HEADER END -->
</body>
</html> 