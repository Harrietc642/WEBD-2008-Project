<?php
/*
Name: Harriet Chiu
Date: September 28, 2021
Course: Web Development 2
Topic: 
*/
require_once("config.php");
//echo password_hash("123566", PASSWORD_DEFAULT);

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

            $row = $statement->fetch();

            if($password == $confirmpassword && $_POST['username'] !="ADMIN123"){
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
?>


<!DOCTYPE html>
<html lang="en">
<head>
  <title>Login</title>
</head>
<body>
  <?php include('basic.html')?>
    <!-- NAVBAR END -->
    <!-- HEADER -->
    <div class="container">
      <div class="row mt-4">
    <!-- Main Area Start -->
    <section class="container py-2 mb-4">
      <div class="row">
        <div class="offset-sm-3 col-sm-6" style="min-height:500px;">
          <div class="card bg-secondary"  style="color:#8b5939">
            <div class="card-header" style="background: #caede3;">
              <h4>Join Us</h4>
              </div>
              <div class="card-body" style="background:#dadfe1">
              <form class="" action="register.php" method="post">
                <div class="form-group">
                  <label for="username"><span class="FieldInfo" style="color: #8b5939;">Username:</span></label>
                  <div class="input-group mb-3">

                    <input type="text" class="form-control" name="username" id="username" value="">
                  </div>
                </div>
                <div class="form-group">
                  <label for="password"><span class="FieldInfo" style="color: #8b5939;">Password:</span></label>
                  <div class="input-group mb-3">
                    <input type="password" class="form-control" name="password" id="password" value="">
                  </div>
                  <label for="confirmpassword"><span class="FieldInfo" style="color: #8b5939;">Confirm Password:</span></label>
                    <div class="input-group mb-3">

                    <input type="password" class="form-control" name="confirmpassword" id="confirmpassword" value="">
                  </div>
                </div>
                <input type="submit" name="register" class="btn btn-info btn-block" style="background:#caede3; color: #8b5939;"value="Register">
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
