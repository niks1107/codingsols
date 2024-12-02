<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title></title>
    <style>
        
    </style>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-Zenh87qX5JnK2Jl0vWa8Ck2rdkQ2Bzep5IDxbcnCeuOxjzrPF/et3URy9Bv1WTRi" crossorigin="anonymous">
  </head>
  <body>
    <?php
    $id = $_GET['threadid'];
    $nm = $_GET['srno'];
    include 'partials/_header.php';
    include 'partials/_dbconnect.php';
    $sql = "SELECT * FROM `threads` WHERE `thread_id` = $id";
    $result = mysqli_query($con,$sql);
    while($row=mysqli_fetch_assoc($result))
    { 
      $catname = $row['thread_title'];
      $catdesc = $row['thread_desc'];
    }
    ?>

<?php
    $method = $_SERVER['REQUEST_METHOD'];
    if($method == 'POST')
    {
      $showalert = false;
      $comment = $_POST['comment'];
      $srno = $_POST['srno'];
      $sql = "INSERT INTO `comments` (`comment_content`, `thread_id`, `comment_by`, `comment_time`) VALUES ('$comment', '$id', '$srno', current_timestamp());";
      $result = mysqli_query($con,$sql);
      $showalert = true;
      if($showalert)
        {
        echo '<div class="alert alert-success alert-dismissible fade show" role="alert">
        <strong>Success!</strong> Your comment has been added
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
      </div>';
      }
    }

    ?>
<?php
 $sql2 = "SELECT user_email FROM `users` WHERE srno='$nm'";
 $result2 = mysqli_query($con,$sql2);
 $row2 = mysqli_fetch_assoc($result2);
 $posted = $row2['user_email'];
?>
    <div class="container my-4">
    <div class="jumbotron">
  <h1 class="display-4"><?php echo $catname;?></h1>
  <p class="lead mt-4"><?php echo $catdesc;?></p>
  <hr class="my-4">
  <p>
    
     <h4>Forum rules</h4>
                <li>No Spam / Advertising / Self-promote in the forums.</li>
                <li>Do not post copyright-infringing material.</li>
                <li>Do not post “offensive” posts, links or images. ...
                    Do not cross post questions.</li>
                <li>Do not cross post questions.</li>
                <li>Do not PM users asking for help.</li>
                <li>Remain respectful of other members at all times.</li>
            </ul></p>
        <p><b>Posted by: <?php echo $posted; ?></b></p>
</div>
    </div>
    <?php
if(isset($_SESSION['loggedin']) && $_SESSION['loggedin']==true)
{
  
  echo'
  <div class="container">
  <h1 class="py-2">Post a Comment</h1>
  <form action="'. $_SERVER['REQUEST_URI'] . '" method="POST">
  <div class="form-group">
  <label for="desc">Type your comment</label>
  <textarea class="form-control" name="comment" id="comment" rows="3"></textarea>
  <input type="hidden" name="srno" value="'.$_SESSION['srno'].'">
  </div>
  <button type="submit" class="btn btn-success mt-3">Post Comment</button>
  </form>
  </div>
  ';
}
else
{
  echo'
  <div class="container">
     <p class="lead">You are not logged in</p> 
    </div>
';}
  ?>
    <div class="container" id="ques">
      <h1 class="py-2">Discussion</h1>
      <?php
    $id = $_GET['threadid'];
    include 'partials/_dbconnect.php';
    $sql = "SELECT * FROM `comments` WHERE `thread_id` = $id";
    $noresult = true;
    $result = mysqli_query($con,$sql);
    while($row=mysqli_fetch_assoc($result))
    {
      $noresult = false;
      $id = $row['comment_id'];
      $content = $row['comment_content'];
      $comment_time = $row['comment_time'];
      $comment_by = $row['comment_by'];
      $sql2 = "SELECT user_email FROM `users` WHERE srno='$comment_by'";
      $result2 = mysqli_query($con,$sql2);
      $row2 = mysqli_fetch_assoc($result2);
      
      
      echo '<div class="d-flex">
      <div class="flex-shrink-0">
      <img src="img/user.png" width="40px">
      </div>
      <div class="flex-grow-1 ms-3">
      <p class="font-weight-bold my-0">'.$row2['user_email'].' at '.$comment_time.'</p>
      '.$content.'
      </div>
      </div>';
    }
    if ($noresult) {
      echo'<div class="jumbotron jumbotron-fluid">
      <div class="container">
      <h1 class="display-4">No Threads Found</h1>
      <p class="lead">Be the first person to ask the question</p>
      </div>
      </div>';
    }
    ?>
</div>


<?php include 'partials/_ footer.php';?>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-OERcA2EqjJCMA+/3y+gxIOqMEjwtxJY7qPCqsdltbNJuaOe923+mo//f6V8Qbsw3" crossorigin="anonymous"></script>
  </body>
</html>