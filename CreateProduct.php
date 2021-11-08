

<?php





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
                <li class="nav-item">
          <a href="CreateRecipe.php" class="nav-link">Create Recipe</a>
        </li>
        <li class="nav-item">
          <a href="CreateRestaurant.php" class="nav-link">Create Restos</a>
        </li>
        <li class="nav-item">
          <a href="CreateProduct.php" class="nav-link">Create Product</a>
        </li>
      </ul>

      </div>
    </div>
  </nav>
    <div style="height:10px; background:#27aae1;"></div>
    <!-- NAVBAR END -->
    <!-- HEADER -->
    <div class="container">
      <div class="row mt-4">

        <!-- Main Area Start-->
<section class="container py-2 mb-4">
  <div class="row">
    <div class="offset-lg-1 col-lg-10" style="min-height:400px;">

      <form class="" action="CreateRecipe.php" method="post" enctype="multipart/form-data">
        <div class="card bg-secondary text-light mb-3">
          <div class="card-body bg-dark">
            <div class="form-group">
              <label for="productname"> <span class="FieldInfo"> Product Name: </span></label>
               <input class="form-control" type="text" name="productname" id="productname" placeholder="Enter the product name" value="">
            </div>
 <!--            <div class="form-group">
              <div class="custom-file">
              <input class="custom-file-input" type="File" name="Image" id="imageSelect" value="">
              <label for="imageSelect" class="custom-file-label">Select Image... </label>
              </div>
            </div> -->
            <div class="form-group">
              <label for="origin"> <span class="FieldInfo"> Origin </span></label>
               <input class="form-control" type="text" name="origin" id="origin" placeholder="Canada" value="">
            </div>
            <div class="form-group">
              <label for="price"> <span class="FieldInfo"> Price </span></label>
               <input class="form-control" type="text" name="price" id="price" placeholder="CAD$50/g" value="">
            </div>
            <div class="row">
              <div class="col-lg-6 mb-2">
                <a href="Index.php" class="btn btn-warning btn-block">Cancel</a>
              </div>
              <div class="col-lg-6 mb-2">
                <button type="submit" name="Submit" class="btn btn-success btn-block">Recommend this product</button>
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



  <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.6/umd/popper.min.js" integrity="sha384-wHAiFfRlMFy6i5SRaxvfOCifBUQy1xHdJ/yoi7FRNXMRBu5WHdZYu1hA6ZOblgut" crossorigin="anonymous"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/js/bootstrap.min.js" integrity="sha384-B0UglyR+jN6CkvvICOB2joaf5I4l3gm9GU6Hc1og6Ls7i6U/mkkaduKaBhlAXv9k" crossorigin="anonymous"></script>

</body>
</html>