<?php
$showError = "false";
if($_SERVER['REQUEST_METHOD'] == 'POST'){
    include '_dbconnect.php';
    include '_validateUserInput.php';
    $user_email = validateUserInput($_POST['signupEmail']);
    $password = validateUserInput($_POST['signupPassword']);
    $cpassword = validateUserInput($_POST['signupCpassword']);

    // Check whether this email exists
    $existSql = "SELECT * FROM `users` WHERE `user_email`= '$user_email'";
    $result = mysqli_query($conn, $existSql);
    $numRows = mysqli_num_rows($result);
    if($numRows>0){
        $showError = "Username already in use";
    }
    else{
        if(($password == $cpassword) && $password!=NULL && $password!=""){
            $hash = password_hash($password, PASSWORD_DEFAULT);
            $sql = "INSERT INTO `users` (`user_id`, `user_email`, `user_pass`, `timestamp`) VALUES (NULL, '$user_email', '$hash', current_timestamp())";
            $result = mysqli_query($conn, $sql);
            echo mysqli_error($conn);
            if($result){
                $showAlert = true;
                header("Location: /hacknet/index.php?signupsuccess=1");
                exit();
            }
        }
        else{
            $showError = "Passwords do not match";
        }
    }
    header("Location: /hacknet/index.php?signupsuccess=0&error=$showError");
}
?>