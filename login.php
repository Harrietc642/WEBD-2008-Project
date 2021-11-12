<?php
/*
Name: Harriet Chiu
Date: September 28, 2021
Course: Web Development 2
Topic: 
*/

require_once("config.php");

if (isset($_POST['username'])) {
          if  (isset($_POST['username']) && isset($_POST['password'])) {
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
              else{
                echo "Incorrect Username or password, try again";
              }     
            }
            else
            {
              echo "Error Occurred";
              // .$uname. $pw. $username. $password
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
    <!-- HEADER -->
  <div class="container">
    <div class="row mt-4">
    <!-- Main Area Start -->
      <section class="container py-2 mb-4">
        <div class="row">
          <div class="offset-sm-3 col-sm-6" style="min-height:500px;">
          <div class="card bg-secondary" style="color:#8b5939">
            <div class="card-header" style="background: #caede3;">
              <h4>Welcome Back !</h4>
              </div>
              <div class="card-body" style="background:#dadfe1">
              <form class="" action="" method="post">
                <!-- add error login here -->
                <div class="form-group">
                  <label for="username" ><span class="FieldInfo" style="color: #8b5939;">Username:</span></label>
                  <div class="input-group mb-3">
                    <div class="input-group-prepend">
                      <span class="input-group-text text-white" style="background:#caede3"> <i class="fas fa-user"></i> </span>
                    </div>
                    <input type="text" class="form-control" name="username" id="username" value="">
                  </div>
                </div>
                <div class="form-group">
                  <label for="password"><span class="FieldInfo" style="color: #8b5939;">Password:</span></label>
                  <div class="input-group mb-3">
                    <div class="input-group-prepend" >
                      <span class="input-group-text text-white" style="background:#caede3"> <i class="fas fa-lock" ></i> </span>
                    </div>
                    <input type="password" class="form-control" name="password" id="password" value="">
                  </div>
                </div>
                <input type="submit" name="submit" class="btn btn-info btn-block" style="background:#caede3; color: #8b5939;" value="Login">
              </form>
            </div>
          </div>
        </div>
      </div>
    </section>
    <!-- Main Area End -->
</body>
</html>