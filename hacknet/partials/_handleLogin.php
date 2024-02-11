<?php
$showError = false;
if($_SERVER['REQUEST_METHOD'] == 'POST'){
    include '_dbconnect.php';
    include '_validateUserInput.php';
    $email = validateUserInput($_POST['loginEmail']);
    $password= validateUserInput($_POST['loginPassword']);

    $sql = "SELECT * FROM `users` WHERE `user_email`='$email'";
    $result = mysqli_query($conn, $sql);
    $numRows = mysqli_num_rows($result);
    if($numRows==1){
        $row = mysqli_fetch_assoc($result);
        if(password_verify($password, $row['user_pass'])){
            session_start();
            $_SESSION['loggedin'] = true;
            $_SESSION['useremail'] = $email;
            $_SESSION['userid'] = $row['user_id'];
            header("Location: /hacknet/index.php?loginsuccess=1");
            exit();
        }
    }
    header("Location: /hacknet/index.php?loginsuccess=0");
}
?>