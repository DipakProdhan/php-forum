<?php

session_start();

echo '<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
  <div class="container-fluid">
    <a class="navbar-brand" href="/NEW/Project - Forum/index.php">AllinOne</a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarSupportedContent">
      <ul class="navbar-nav me-auto">
        <li class="nav-item">
          <a class="nav-link active" aria-current="page" href="/NEW/Project - Forum/index.php">Home</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="about.php">About</a>
        </li>
        <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
            Top Categories
          </a>
          <ul class="dropdown-menu">';

          $sql = "SELECT category_name, category_id FROM categories LIMIT 5";
          $result = mysqli_query($conn, $sql);
          while($row = mysqli_fetch_assoc($result)){
            // echo '<li><a class="dropdown-item" href="threadlist.php?catid='.$row['category_id'].'">'. $row['category_name'].'</a></li>';
            if(isset($_SESSION['loggedin']) && $_SESSION['loggedin']==true){
              echo '<li><a class="dropdown-item" href="threadlist.php?catid=' .$row['category_id']. '">' .$row['category_name']. '</a></li>';
            }
            else{
              
              echo '<li><a class="dropdown-item" href="login.php">' .$row['category_name']. '</a></li>';
            }  
          }
                
    echo '</ul>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="contact.php">Contact</a>
        </li>
      </ul>';

if(isset($_SESSION['loggedin']) && $_SESSION['loggedin']==true){
  echo '<form class="d-flex" role="search" action="search.php" method="get">
      <input class="form-control me-2" type="search" placeholder="Search" name="search_query" aria-label="Search">
      <button class="btn btn-success" type="submit" name="search">Search</button>
      </form>
      <p class="text-light my-1 mx-3">Welcome '. $_SESSION['user_name'].' </p>
      <a href="\NEW\Project - Forum\logout.php" class="btn btn-outline-success ml-2">Logout</a>';
}
else{
  echo '

  <a href="\NEW\Project - Forum\login.php" class="btn btn-outline-success mx-2" tabindex="-1" aria-disabled="true">Login</a>
  <a href="\NEW\Project - Forum\signup.php" class="btn btn-outline-success mx-2" tabindex="-1" aria-disabled="true">Signin</a>';
}
echo '</div>
  </div>
</nav>';




?>
