<?php
/*
Name: Harriet Chiu
Date: September 28, 2021
Course: Web Development 2
Topic: 
*/

require_once("config.php");
    // require('connect.php');

     // SQL is written as a String.
if (isset($_POST['username'])) {
          if  (isset($_POST['username']) && isset($_POST['password'])) {
          // $username = $row['username'];
          // $password = $row['password'];
          $username = $_POST['username'];
          $password = $_POST['password'];

          $query = "SELECT * FROM Users WHERE Username = '$username'";

          $statement = $ConnectingDB->prepare($query);
          $statement->execute(); 

            $row = $statement->fetch();
            if ($row == true) {
              $uname = $row['Username'];
              $pw = $row['Password'];
              $userid = $row['UserID'];     
              $user_role =  $row['Role'];

              if ($username == $uname && password_verify($password, $pw)) {
                session_start();    
                $_SESSION['current_username'] = $username;
                $_SESSION['current_user_id'] = $userid;
                $_SESSION['current_user_role'] = $user_role;

                header("Location: index.php");
                exit;
              }       
            }
            else
            {
              echo "Error Occurred" .$uname. $pw. $username. $password;
              exit;
            }
      }
}




?>


<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.6.3/css/all.css" integrity="sha384-UHRtZLI+pbxtHCWp1t77Bi1L4ZtiqrqD80Kn4Z8NTSRyMA2Fd33n5dQ8lWUE00s/" crossorigin="anonymous">
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/css/bootstrap.min.css" integrity="sha384-GJzZqFGwb1QTTN6wy59ffF1BuGJpLSa9DkKMp0DgiMDm4iYMj70gZWKYbI706tWS" crossorigin="anonymous">
  <!-- <link rel="stylesheet" href="Css/Styles.css"> -->
  <title>Login</title>
</head>
<body>
 <!-- NAVBAR -->
  <div style="height:10px; background:#27aae1;"></div>
  <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
    <div class="container">
      <a href="#" class="navbar-brand"> Mary's Food World</a>
      <button class="navbar-toggler" data-toggle="collapse" data-target="#navbarcollapseCMS">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="navbarcollapseCMS">
      <ul class="navbar-nav mr-auto">
        <li class="nav-item">
          <a href="Index.php" class="nav-link">Home</a>
        </li>
        <li class="nav-item">
          <a href="#" class="nav-link">Recipes</a>
        </li>
        <li class="nav-item">
          <a href="Blog.php?page=1" class="nav-link">Restaurants</a>
        </li>
        <li class="nav-item">
          <a href="#" class="nav-link">Products</a>
        </li>
        <li class="nav-item">
          <a href="#" class="nav-link">Register</a>
        </li>
      </ul>
      <ul class="navbar-nav ml-auto">
        <form class="form-inline d-none d-sm-block" action="Login.php">
          <div class="form-group">
          <button  class="btn btn-primary" name="login">Already A Member?</button>
          </div>
        </form>
      </ul>
      </div>
    </div>
  </nav>
    <div style="height:10px; background:#27aae1;"></div>
    <!-- NAVBAR END -->
    <!-- HEADER -->
    <div class="container">
      <div class="row mt-4">

    <!-- Main Area Start -->
    <section class="container py-2 mb-4">
      <div class="row">
        <div class="offset-sm-3 col-sm-6" style="min-height:500px;">


          <div class="card bg-secondary text-light">
            <div class="card-header">
              <h4>Wellcome Back !</h4>
              </div>
              <div class="card-body bg-dark">
              <form class="" action="" method="post">


                  <!-- <p>Incorrect Username or Password, try again!</p> -->


                <div class="form-group">
                  <label for="username"><span class="FieldInfo">Username:</span></label>
                  <div class="input-group mb-3">
                    <div class="input-group-prepend">
                      <span class="input-group-text text-white bg-info"> <i class="fas fa-user"></i> </span>
                    </div>
                    <input type="text" class="form-control" name="username" id="username" value="">
            
                  </div>
                </div>
                <div class="form-group">
                  <label for="password"><span class="FieldInfo">Password:</span></label>
                  <div class="input-group mb-3">
                    <div class="input-group-prepend">
                      <span class="input-group-text text-white bg-info"> <i class="fas fa-lock"></i> </span>
                    </div>
                    <input type="password" class="form-control" name="password" id="password" value="">
                  </div>
                </div>
                <input type="submit" name="submit" class="btn btn-info btn-block" value="Login">

              </form>

            </div>




          </div>


        </div>

      </div>

    </section>
    <!-- Main Area End -->


  <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.6/umd/popper.min.js" integrity="sha384-wHAiFfRlMFy6i5SRaxvfOCifBUQy1xHdJ/yoi7FRNXMRBu5WHdZYu1hA6ZOblgut" crossorigin="anonymous"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/js/bootstrap.min.js" integrity="sha384-B0UglyR+jN6CkvvICOB2joaf5I4l3gm9GU6Hc1og6Ls7i6U/mkkaduKaBhlAXv9k" crossorigin="anonymous"></script>

</body>
</html>