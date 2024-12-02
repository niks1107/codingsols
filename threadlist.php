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
    $id = $_GET['id'];
    include 'partials/_header.php';
    include 'partials/_dbconnect.php';
    $sql = "SELECT * FROM `categories` WHERE `category_id` = $id";
    $result = mysqli_query($con,$sql);
    while($row=mysqli_fetch_assoc($result))
    {
      $catname = $row['category_name'];
      $catdesc = $row['category_description'];
    }
    ?>
    <?php
    $method = $_SERVER['REQUEST_METHOD'];
    if($method == 'POST')
    {
      $showalert = false;
      $th_title = $_POST['title'];
      $th_desc = $_POST['desc'];
      $srno = $_POST['srno'];
      $sql = "INSERT INTO `threads` (`thread_title`, `thread_desc`, `thread_cat_id`, `thread_user_id`, `timestamp`) VALUES ('$th_title','$th_desc','$id','$srno', current_timestamp())";
      $result = mysqli_query($con,$sql);
      $showalert = true;
      if($result)
        {
        echo '<div class="alert alert-success alert-dismissible fade show" role="alert">
        <strong>success!</strong> Your thread has been added wait for community to respond
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
      </div>';
      }
    }

    ?>
    <div class="container my-4">
    <div class="jumbotron">
  <h1 class="display-4">Welcome to <?php echo $catname;?> forum</h1>
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
            </ul>    
          
          </p>
  <a class="btn btn-primary btn-lg" href="#" role="button">Learn more</a>
</div>
    </div>
    <?php
if(isset($_SESSION['loggedin']) && $_SESSION['loggedin']==true){

  echo '
  <div class="container">
  <h1 class="py-2">Start A Discussion</h1>
        <form action="' . $_SERVER["REQUEST_URI"] . '" method="POST">
          <div class="form-group">
            <label for="title">Problem Title</label>
            <input type="text" class="form-control" id="title" name="title" aria-describedby="title">
            <small id="title" class="form-text text-muted">Keep your title short and crisp as possible.</small>
          </div>
          <div class="form-group">
          <label for="desc">Elaborate Your Problem</label>
          <textarea class="form-control" name="desc" id="desc" rows="3"></textarea>
          <input type="hidden" name="srno" value="'.$_SESSION['srno'].'"></div>
          <button type="submit" class="btn btn-success">Submit</button>
          </form>
          </div>
          ';
        }
        else
        {
          echo'
          <div class="container">
          <p class="lead">You are not logged in</p> 
         </div>';
        }
          ?>
    
    
    <div class="container my-4">
        <h1 class="py-2">Browse Questions</h1>
    <?php
    $id = $_GET['id'];
    include 'partials/_dbconnect.php';
    $sql = "SELECT * FROM `threads` WHERE `thread_cat_id` = $id";
    $noresult = true;
    $result = mysqli_query($con,$sql);
    while($row=mysqli_fetch_assoc($result))
    {
      $noresult = false;
      $id = $row['thread_id'];
      $title = $row['thread_title'];
      $desc = $row['thread_desc'];
      $thread_time = $row['timestamp'];
      $thread_user_id = $row['thread_user_id'];
      $sql2 = "SELECT user_email FROM `users` WHERE srno='$thread_user_id'";
      $result2 = mysqli_query($con,$sql2);
      $row2 = mysqli_fetch_assoc($result2);
      $emm = $row2['user_email'];
      $sql3 = "SELECT srno FROM `users` WHERE user_email='$emm'";
      $result3 = mysqli_query($con,$sql3);
      $row3 = mysqli_fetch_assoc($result3);
      $srno = $row3['srno'];
        echo '<div class="d-flex">
        <div class="flex-shrink-0">
        <img src="img/user.png" width="40px">
        </div>
        <div class="flex-grow-1 ms-3">
        <h5 class="mt-0"><a class="text-dark" href="thread.php?threadid='.$id.'&srno='.$srno.'">'.$title.'</a>
        </h5>
        '.$desc.'</div>'.'<p class="font-weight-bold my-0">Asked By: '.$row2['user_email'].' at '.$thread_time.'</p>'.'
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

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-OERcA2EqjJCMA+/3y+gxIOqMEjwtxJY7qPCqsdltbNJuaOe923+mo//f6V8Qbsw3" crossorigin="anonymous"></script>
  </body>
</html>
