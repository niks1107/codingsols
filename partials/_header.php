<?php 
include'_dbconnect.php';
error_reporting(0);
if ($_GET['login'] == "false") {
  echo'
  <div class="alert alert-warning alert-dismissible mb-0 fade show" role="alert">
  <strong>warning!</strong>check the credentials
  <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
</div>
  ';
} 
if ($_GET['signupsuccess'] == "false") {
  echo'
  <div class="alert alert-warning alert-dismissible mb-0 fade show" role="alert">
  <strong>warning!</strong> Try again later!!
  <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
</div>
  ';
} 

error_reporting(0);
session_start();
echo '<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
  <div class="container-fluid">
    <a class="navbar-brand" href="index.php">Codingsols</a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarSupportedContent">
      <ul class="navbar-nav me-auto mb-2 mb-lg-0">
        <li class="nav-item">
          <a class="nav-link active" aria-current="page" href="index.php">Home</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="about.php">About</a>
        </li>
        <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
            Top Categories
          </a>
          <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
          ';
          $sql = "SELECT * FROM `categories` WHERE `category_id` BETWEEN 0 AND 5 ";
          $result = mysqli_query($con,$sql);
          while($row = mysqli_fetch_assoc($result))
          {
            echo '<li><a class="dropdown-item" href="threadlist.php?id='.$row['category_id'].'">'.$row['category_name'].'</a></li>';
          }  
          echo'
          </ul>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="contact.php" tabindex="-1" aria-disabled="true">Contact</a>
        </li>
        </ul>
        ';
        if(isset($_SESSION['loggedin']) && $_SESSION['loggedin']==true)
        {
          echo' <form class="d-flex">
         
         <p class="text-light my-0 mx-2"> welcome <a href = profile.php?q='. $_SESSION['useremail'].'>'. $_SESSION['useremail'].'</a></p>
         <a href="partials/_logout.php" role="button" class="btn btn-outline-success mx-2">Logout</a>
         </form>';
          
        }
        else
        {
          echo'
          <button class="btn btn-outline-success mx-2" type="button" data-bs-toggle="modal" data-bs-target="#loginModal">Login</button>
          <button class="btn btn-outline-success" type="button" data-bs-toggle="modal" data-bs-target="#signupModal">Signup</button>
';}
  
        
        echo'</div>
  </div>
</nav>';
include 'partials/_loginmodal.php';
include 'partials/_signupmodal.php';
// include 'partials/_logoutmodal.php';

if (isset($_GET['signupsuccess']) && $_GET['signupsuccess']=="true") {
  echo'
  <div class="alert alert-success alert-dismissible my-0 fade show" role="alert">
  <strong>Success!</strong> You can login now
  <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
</div>
  ';
}

?>