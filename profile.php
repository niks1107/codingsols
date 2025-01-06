<?php
error_reporting(0);
  include 'partials/_header.php';
  $alert = $_GET['alert'];
if($alert == "Data updated successfully")
{
  echo '<div class="alert alert-success alert-dismissible fade show" role="alert">
  <strong>Success!</strong> Your data has been updated successfully.  <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button></div>';
}
  include 'partials/_dbconnect.php';
  $users = $_GET['q'];
  $sql = "SELECT * FROM `users` WHERE user_email= '$users'";
  $result = mysqli_query($con,$sql);
        
  while($row=mysqli_fetch_assoc($result))
      {
          $email = $row['user_email'];
          $name = $row['user_name'];
          $mno = $row['user_mobile'];
          $pwd = $row['user_pass'];
          $time = $row['timestamp'];
      }
if($name == null)
{
  $name = "Update your full name";
}

if($mno == null)
{
  $mno = "Update your mobile number";
}
if($email == null)
{
  $email = "Update your email";
}
if($pwd == null)
{
  $pwd = "Update your password";
}
else{
  $pwd = "********";
}

echo'<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">

  <!-- Bootstrap CSS -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
  ';
    
    echo ' <script>
    // Function to enable text fields when Update button is clicked
    function enableFields() {
      document.getElementById("name").disabled = false;
      document.getElementById("mobile").disabled = false;
      document.getElementById("email").disabled = false;
      document.getElementById("password").disabled = false;
      document.getElementById("updateButton").style.display = "none";
      document.getElementById("saveButton").style.display = "inline-block";
    }
  </script>
</head>
<body>
  <div class="container mt-5">
    <h2 class="mb-4 display-4 text-center">User Profile</h2>
    <form action="handleupdate.php" method="POST">
      <!-- Name Field -->
      <div class="mb-3">
        <label for="name" class="form-label">Full Name</label>
        <input type="text" class="form-control" id="name" value="';
        echo $users. '"disabled>
      </div>
      
      <!-- Mobile Number Field -->
      <div class="mb-3">
        <label for="mobile" class="form-label">Mobile Number</label>
        <input type="text" class="form-control" id="mobile" value="';
        echo $mno . '" disabled>
      </div>

      <!-- Email Field -->
      <div class="mb-3">
        <label for="email" class="form-label">Email address</label>
        <input type="email" class="form-control" id="email" value="';
        echo $email. '" disabled>
      </div>

      <!-- Password Field -->
      <div class="mb-3">
        <label for="password" class="form-label">Password</label>
        <input type="password" class="form-control" id="password" value ="';
        echo $pwd. '" disabled>
      </div>

      <!-- Update and Save Buttons -->
      <button type="button" class="btn btn-secondary" id="updateButton" onclick="enableFields()">Update</button>
      <button type="submit" class="btn btn-primary" id="saveButton" style="display:none;">Save Changes</button>
    </form>
  </div>

  <!-- Bootstrap JS and dependencies -->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
';


?>
 