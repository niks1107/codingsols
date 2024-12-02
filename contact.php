<!doctype html>
<html lang="en">
  <head>
    <?php include 'partials/_dbconnect.php';?>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Contact Us</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-iYQeCzEYFbKjA/T2uDLTpkwGzCiq6soy8tYaI1GyVh/UjpbCx/TYkiZhlZB6+fzT" crossorigin="anonymous">
    <style>
#fass {
  position: fixed;
  left: 0;
  bottom: 0;
  width: 100%;
  background-color: red;
  color: white;
  text-align: center;
}
</style>
  </head>
  <body>
  <?php include 'partials/_header.php';?>
<?php
 $method = $_SERVER['REQUEST_METHOD'];
 if($method == 'POST')
{

  $alert = false;
  $nm = $_POST['name'];
  $email = $_POST['email'];
  $comment = $_POST['comment'];
  $sql = "INSERT INTO `contact` (`name`, `email`, `comments`, `dated`) VALUES ('$nm', '$email', '$comment', current_timestamp()); ";
  $result = mysqli_query($con,$sql);
  $alert = true;
  if($alert)
  
  {
    echo '<div class="alert alert-success alert-dismissible fade show" role="alert">
    <strong>Success!</strong> your response has been submitted successfully
    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>';
  }
}
?>
  <div class="container">

<h1 class="display-4 text-center mb-5 mt-5">Contact To CodingSols</h1>
    <form method="post">
        <div class="mb-3">
            <label for="exampleInputEmail1" class="form-label">Name</label>
            <input type="text" name="name" class="form-control" id="exampleInputEmail1"
                aria-describedby="emailHelp">
        </div>
        <div class="mb-3">
            <label for="exampleInputPassword1" class="form-label">Email Address</label>
            <input type="email" name="email" class="form-control" id="exampleInputPassword1">
        </div>
       
        <div class="">
            <label for="floatingTextarea">Comments</label>
            <textarea class="form-control" placeholder="Leave a comment here" name="desc"
                id="floatingTextarea"></textarea>
        </div>
        <button class="mb-5 mt-4 btn btn-primary">Submit</a>
    </form>

</div>
<?php include 'partials/_footer.php'?>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-u1OknCvxWvY5kfmNBILK2hRnQC3Pr17a+RTT6rIHI7NnikvbZlHgTPOOmMi466C8" crossorigin="anonymous"></script>
  </body>
</html>