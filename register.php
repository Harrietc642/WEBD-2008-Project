<?php
/*
Name: Harriet Chiu
Date: September 28, 2021
Course: Web Development 2
Topic: 
*/

require_once("config.php");
echo password_hash("123566", PASSWORD_DEFAULT);

$query = "SELECT * FROM Users";
$statement = $ConnectingDB->prepare($query);
$statement->execute(); 

if (isset($_POST['username']) && isset($_POST['password']))
{

        if((strlen($_POST['username'])) >= 1 && (strlen($_POST['password'])) >= 1 && (!ctype_space($_POST['username'])) && (!ctype_space($_POST['password'])))
        {

            $username = filter_input(INPUT_POST, 'username', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
            // $email = filter_input(INPUT_POST, 'email', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
            $password = filter_input(INPUT_POST, 'password', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
            $confirmpassword = filter_input(INPUT_POST, 'confirmpassword', FILTER_SANITIZE_FULL_SPECIAL_CHARS);

            if($password == $confirmpassword){
              $query_insert_user = "INSERT INTO Users (UserName, Password, Role) VALUES (:username, :password, :role)";
              $statement_insert_user = $ConnectingDB->prepare($query_insert_user);

              //  Bind values to the parameters
              $statement_insert_user->bindValue(':username', $username);
              // $statement_insert_user->bindValue(':email', $email);
              $statement_insert_user->bindValue(':password', password_hash($password, PASSWORD_DEFAULT));
              $statement_insert_user->bindValue(':role', "user");

              if ($statement_insert_user->execute())
              {
                  header("Location: index.php");
                  exit;
              }
        }
        else
        {
            header("Location: error.html");
            exit;
        }
            }


}

// $register_username = "";
// $register_email = "";
// $register_password = "";
// $register_confirm_password = "";
// $error = array();

// if (isset($_POST['register'])) {
//   $register_username = $_POST['username'];
//   $register_email = $_POST['email'];
//   $register_password = $_POST['password'];
//   $register_confirm_password = $_POST['confirmPassword'];

//   if (empty( $register_username) || empty( $register_email) || empty( $register_password) || empty( $register_confirm_password) ) {
//     $error = "Required";
//   }
//   elseif ($register_password != $register_confirm_password) {
//     $error = "The passwords do not match";
//   }
// }


//  if(!isset($error)){
// //no error
// $query_username = $row->prepare("SELECT Username FROM Users WHERE Username = :username");
// $query_username->bindParam(':username', $register_username);
// $query_username->execute();

// if($query_username->rowCount() > 0){
//     echo "username already exists! Use another username";
// } else {
//     //Securly insert into database
//     $sql = 'INSERT INTO Users (Username, Email, Password, Role) VALUES (:username,:email,:password, "user")';    
//     $query = $row->prepare($sql);

//     $query->execute(array(

//     ':username' => $register_username,
//     ':email' => $register_email,
//     ':password' => $register_password,
//     //':user' => $Role

//     ));
//     }
// }
// // else{
//     echo "error occured";
//     exit();
// }

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
          <a href="recipe.php" class="nav-link">Recipes</a>
        </li>
        <li class="nav-item">
          <a href="restaurant.php" class="nav-link">Restaurants</a>
        </li>
        <li class="nav-item">
          <a href="product.php" class="nav-link">Products</a>
        </li>
        <li class="nav-item">
          <a href="register.php" class="nav-link">Register</a>
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
              <h4>Join Us</h4>
              </div>
              <div class="card-body bg-dark">
              <form class="" action="register.php" method="post">
                <div class="form-group">
                  <label for="username"><span class="FieldInfo">Username:</span></label>
                  <div class="input-group mb-3">

                    <input type="text" class="form-control" name="username" id="username" value="">
                  </div>
                </div>

<!--                 <div class="form-group">
                  <label for="email"><span class="FieldInfo">Email:</span></label>
                  <div class="input-group mb-3">

                    <input type="text" class="form-control" name="email" id="email" value="">
                  </div>
                </div> -->


                <div class="form-group">
                  <label for="password"><span class="FieldInfo">Password:</span></label>
                  <div class="input-group mb-3">
                    <input type="password" class="form-control" name="password" id="password" value="">
                  </div>
                  <label for="confirmpassword"><span class="FieldInfo">Confirm Password:</span></label>
                    <div class="input-group mb-3">

                    <input type="password" class="form-control" name="confirmpassword" id="confirmpassword" value="">
                  </div>
                </div>
                <input type="submit" name="register" class="btn btn-info btn-block" value="register">
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
