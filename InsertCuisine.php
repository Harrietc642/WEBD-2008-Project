<?php
/*
Name: Harriet Chiu
Date: November 10, 2021
Course: Web Development 2
Topic: Project 
*/
  require_once("config.php");
  session_start();

  if(!isset($_SESSION['current_user_role']) && $_SESSION['current_user_role'] == "admin"){
    header("Location: index.php");
    exit;
  }

     $query = "SELECT * FROM Cuisines";
     $statement_cuisine = $ConnectingDB->prepare($query);
      $statement_cuisine->execute();



if (isset($_POST['cuisinename']))
{
            $cuisinename = filter_input(INPUT_POST, 'cuisinename', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
            $userid = $_SESSION['current_user_id'];

            $query = "INSERT INTO Cuisines (UserID, CuisineName) VALUES (:userid, :cuisinename)";
            $statement_cuisine = $ConnectingDB->prepare($query);

            //  Bind values to the parameters
            $statement_cuisine->bindValue(':cuisinename', $cuisinename);
            $statement_cuisine->bindValue(':userid', $userid);

            if ($statement_cuisine->execute())
            {
                header("Location: Cuisine.php");
                exit;
            }
        
        else
        {
            header("Location: InsertCuisine.php");
            echo "error occurred";
            exit;
        }
}
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

      <form class="" action="InsertCuisine.php" method="post" enctype="multipart/form-data">
        <div class="card bg-secondary text-light mb-3">
          <div class="card-body" style="background: #669fb2;">
            <div class="form-group">
              <label for="title"> <span class="FieldInfo"> Add Cuisine: </span></label>
               <input class="form-control" type="text" name="cuisinename" id="recipename" placeholder="Vietnamese" value="">
            </div>

            <div class="row">
              <div class="col-lg-6 mb-2">
                <a href="Index.php" class="btn btn-block" style="background:#caede3">Cancel</a>
              </div>
              <div class="col-lg-6 mb-2">
                <button type="submit" name="Submit" class="btn btn-block" style="background:#dddb76">Add</button>
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