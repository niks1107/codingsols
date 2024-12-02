<?php
$showerror = "false";
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    include '_dbconnect.php';
    $user_email = $_POST['signupEmail1'];
    $password = $_POST['signuppassword'];
    $cpassword = $_POST['signupcpassword'];
    
    $existsql = "select * from users where user_email = '.$user_email.'";
    $result = mysqli_query($con,$existsql);
    $numrows = mysqli_num_rows($result);
    if ($numrows>0) {
        $showerror = "Email already in use";
    }
    else
    {
        
        if($password == $cpassword)
        {
            $hash = password_hash($password,PASSWORD_DEFAULT);
            $sql = "INSERT INTO `users` (`user_email`,`user_pass`,`timestamp`) VALUES ('$user_email','$hash',current_timestamp())";
            $result = mysqli_query($con,$sql);
            if ($result) {
                $showAlert = true;
                header("location: /codingsols/index.php?signupsuccess=true");
                exit();
                        }
        }
        else
        {
            $showerror = "passwords do not match";
            
        }
        
    }
    header("location: /codingsols/index.php?signupsuccess=false&error=$showerror");
}
?>