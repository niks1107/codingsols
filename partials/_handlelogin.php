<?php
$showerror = "false";
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    include '_dbconnect.php';
    $email = $_POST['loginemail'];
    $pass = $_POST['loginpass'];
    
    $sql = "SELECT * from users where user_email='$email'";
    $result = mysqli_query($con,$sql);
    $numrows = mysqli_num_rows($result);
    if($numrows == 1)
    {
        $row = mysqli_fetch_assoc($result);
            if (password_verify($pass,$row['user_pass'])) {
                session_start();
                $_SESSION['loggedin'] = true;
                $_SESSION['srno'] = $row['srno'];
                $_SESSION['useremail'] = $email;
                header("Location: /codingsols/index.php");
                echo "logged in".$email;
            }
            
        }
        else{
            header("Location: /codingsols/index.php?login=false");

        }
    }
?>