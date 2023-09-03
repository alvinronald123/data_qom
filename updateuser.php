<?php
session_start();
// $staff = $_SESSION['staffID'];
include './connect.php';
/* if(isset($_POST['submit'])){ */
    // if($_FILES['upload']['name']){
    //     $file_tmp = $_FILES['upload']['tmp_name'];
    //     $target_dir = "upload/$staff";
    //     move_uploaded_file($file_tmp, $target_dir);
    
    // }
    
if(isset($_POST['submit'])){   
    $uname = $_POST['staffname'];
    $pass = $_POST['staffpass'];
    $enc = password_hash($pass, PASSWORD_BCRYPT);
    $gender = $_POST['staffgender'];
    $dob = $_POST['staffdob'];
    $email = $_POST['staffemail'];
    $uId =$_POST['userId'];

    print_r($_FILES);
    if($_FILES['upload']){
        $file=$_FILES['upload'];
        $file_tmp=$file['tmp_name'];
        $file_name = $file['name'];
        $oldImg=$_SESSION['userImg'];
        $_SESSION['userImg'] = $file_name;

        move_uploaded_file($file_tmp, "./upload/$file_name");
        unlink("./upload/$oldImg");
        $upimg="UPDATE staff set userImg='$file_name' WHERE staffID = '$uId'";
        print_r($upimg);
        $query=mysqli_query($conn,$upimg) or die($conn->error);
        
        
       
    }
    $sql = "update staff set password = '$enc',username = '$uname', gender = '$gender', email = '$email', dob = '$dob'   where staffID = '$uId'";
    mysqli_query($conn, $sql);



    header('Location: userdashboard.php'); 

}