<?php
/*
Name: Harriet Chiu
Date: November 10, 2021
Course: Web Development 2
Topic: Project 
*/
  require_once("config.php");
  session_start();

  // Testing
// echo $_POST['keyword'];
 //echo $_POST['cuisinetype'];

  $keyword = filter_input(INPUT_GET, 'keyword', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
  $page = filter_input(INPUT_GET, 'page', FILTER_VALIDATE_INT);
  $cuisine_type = filter_input(INPUT_GET, 'cuisinetype', FILTER_VALIDATE_INT);
  $query = "SELECT * FROM Recipe JOIN Users using(UserID) JOIN Cuisines using(CuisineID)";
  $statement = $ConnectingDB->prepare($query);
  $statement->execute(); 

  //$row = $statement->fetch();
  if(!$keyword){
    header('location:/wd2/Project/Official/search');
    exit;
  }

  if(!$page)
  {
    $page = 1;
  }
  
  //echo $page;
  //echo $page +1;
  //$cuisine_type = $_GET['cuisinetype'];

  $query_search = "SELECT * FROM Recipe JOIN Cuisines using(CuisineID) WHERE RecipeName LIKE :keyword AND CuisineID = :cuisinetype LIMIT ".(($page -1) *2).",2";
  $statement_search = $ConnectingDB->prepare($query_search);
  $statement_search->bindValue(':keyword', '%'.$keyword.'%');
   $statement_search->bindValue(':cuisinetype', $cuisine_type);
  $statement_search->execute();

  // pagination
    $page_no_count = "SELECT * FROM Recipe JOIN Cuisines using(CuisineID) WHERE RecipeName LIKE :keyword AND CuisineID = :cuisinetype";
    $statement_no_count = $ConnectingDB->prepare($page_no_count);
    $statement_no_count->bindValue(':keyword', '%'.$keyword.'%');
    $statement_no_count->bindValue(':cuisinetype', $cuisine_type);
    $statement_no_count->execute();
    $searchResult_count = $statement_no_count->rowCount();
 ?>

<!DOCTYPE html>
<html lang="en">
<head>
  <title>Blog Page</title>
</head>
<body>
  <?php include('basic.html')?>
    <!-- HEADER -->
    <div class="col-sm-12">
      </br>
      <h4 style="color: #aa574b;">Search Result</h4>

    </div>
        <div class="col-sm-12">
          </br>
          <?php while ($row1 = $statement_search->fetch()): ?>
            <div>

              <h3 class="card-header text-light" style="background:#4d675a"><?= $row1['RecipeName']?></h3>  
              <div  class="card-body border border-danger mb-4" style="background:#f9f7f1">
                <p>
                  <small><?= $row1['CuisineName'] ?></small>
                 
                </p>
                <p>
                  <small>Cooking Time: <?= $row1['CookingTime'] ?></small></br>
                  <small>Prep Time: <?= $row1['PrepTime'] ?></small></br>
                </p>

                <p>
                  <label>Ingredients: </label><br>
                  <?= $row1['Ingredients'] ?></br></br>
                  <label>Steps: </label><br>
                  <?= $row1['Steps'] ?></br>
                </p>

                <p>
                  <img src=" uploads/<?= $row1['img'] ?>" alt=" <?= $row1['img'] ?>">
                </p>
              </div>
            </div>
            <?php endwhile ?>
            <!-- pagination starts  -->
              <ul class="pagination">
                <li class="page-item"><a class="page-link" href="?keyword=<?=$keyword?>&cuisinetype=1&page=1">1</a></li>
                <?php if($searchResult_count > 2) : ?>
                <li class="page-item"><a class="page-link" href="?keyword=<?=$keyword?>&cuisinetype=1&page=2">2</a></li>
                <?php endif ?> 
                <?php if($searchResult_count > 4) : ?>
                <li class="page-item"><a class="page-link" href="?keyword=<?=$keyword?>&cuisinetype=1&page=3">3</a></li>
                <?php endif ?> 
                                <?php if($searchResult_count > 6) : ?>
                <li class="page-item"><a class="page-link" href="?keyword=<?=$keyword?>&cuisinetype=1&page=4">4</a></li>
                <?php endif ?> 
                <?php if($searchResult_count > 8) : ?>
                <li class="page-item"><a class="page-link" href="?keyword=<?=$keyword?>&cuisinetype=1&page=5">5</a></li>
                <?php endif ?> 
                <?php if($searchResult_count > 10) : ?>
                <li class="page-item"><a class="page-link" href="?keyword=<?=$keyword?>&cuisinetype=1&page=6">6</a></li>
                <?php endif ?> 
                 <?php if($searchResult_count > 12) : ?>
                <li class="page-item"><a class="page-link" href="?keyword=<?=$keyword?>&cuisinetype=1&page=7">7</a></li>
                <?php endif ?> 
              </ul>
            <!-- pagination ends --> 
          </div>   
        </div>
    <!-- HEADER END -->
</body>
</html>