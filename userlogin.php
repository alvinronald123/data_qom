<?php
session_start();
include "./connect.php";

if(isset($_POST['submit'])) {
    $username = $_POST['username'];
    $password = $_POST['password'];
    
    $userQuery = "SELECT * FROM staff WHERE username = '$username'";
    $userResult = mysqli_query($conn, $userQuery);

    $staffname = '';
    $staffpassword = '';
    $staffid = '';
    $status = '';

    if ($userResult) {
        $row = mysqli_fetch_assoc($userResult);
        $staffname = $row['username'];
        $staffpassword = $row['password'];
        $staffid = $row['staffID'];
        $status = $row['status'];

        if ($status === 'locked') {
            // Account is locked, redirect to a message page
            header('Location: userlogin.html');
            exit();
        } elseif ($staffname === $username && password_verify($password, $staffpassword)) {
            // Correct username and password, store session and redirect to dashboard
            $_SESSION['staffID'] = $staffid;
            header('Location: userdashboard.php');
            exit();
        } else {
            // Incorrect username or password, redirect to login page
            header('Location: userlogin.html');
            exit();
        }
    } else {
        echo "Error: " . mysqli_error($conn);
    }
}
?>
