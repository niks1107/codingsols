<?php
$showerror = "false";
include 'partials/_dbconnect.php';
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = $_POST['updatename'];
    $mno = $_POST['updatemobile'];
    $email = $_POST['updateemail'];
    $pass = $_POST['updatepass'];

    $query = "UPDATE `users` SET `user_email` = 'nevil@gmail.com', `user_mobile` = 99788, `user_pass` = 9999 WHERE `users`.`user_name` = 'nevil amraniya'";
    $result = mysqli_query($con,$query);
    
    if($result)
    {
        $alert =  "Data updated successfully";
    }
    else
    {
        $alert = "Data not updated";
    }
}
header("location: /codingsols/profile.php?alert=$alert");
?>