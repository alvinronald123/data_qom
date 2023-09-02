<?php
include './connect.php';

if(isset($_POST['submit'])) {
    // Get the selected account action and status
    $accountAction = $_POST['account-action'];
    
    // Get other form inputs if needed
    $staffname = $_POST['user-name'];
    $staffemail = $_POST['user-email'];
    
    // Use prepared statement to insert data securely
    $password = '0000'; // Placeholder value, you should change this
    $encPassword = password_hash($password, PASSWORD_BCRYPT);
    
    // Check if the user exists in the database
    $checkQuery = "SELECT * FROM staff WHERE username = '$staffname' AND email = '$staffemail'";
    $checkResult = $conn->query($checkQuery);

    if ($checkResult->num_rows > 0) {
        // User exists, handle the selected action
        if ($accountAction === 'lock') {
            // Update the status to 'locked'
            mysqli_query($conn, "UPDATE staff SET status = 'locked' WHERE username = '$staffname' AND email = '$staffemail'");
        } elseif ($accountAction === 'unlock') {
            // Update the status to 'unlocked'
            mysqli_query($conn, "UPDATE staff SET status = 'unlocked' WHERE username = '$staffname' AND email = '$staffemail'");
        } elseif ($accountAction === 'delete') {
            // Delete the user from the database
            mysqli_query($conn, "DELETE FROM staff WHERE username = '$staffname' AND email = '$staffemail'");
        }
    } else {
        // User does not exist, so add them
        mysqli_query($conn,"INSERT INTO staff(username,email,password,status) VALUES('$staffname', '$staffemail','$encPassword', 'account-action')");
    }

    // Close the database connection
    $conn->close();

    // Redirect back to the page where the form is located
    header("Location: admindashboard.php");
    exit();
}
?>





//
include './connect.php';

if (isset($_POST['submit'])) {
    // Get the selected account action
    $accountAction = $_POST['account-action'];

    // Get other form inputs if needed
    $staffname = $_POST['user-name'];
    $staffemail = $_POST['user-email'];
    
    if ($accountAction === 'adduser') {
        // User selected "Add User" action, so add the user to the database
        $password = '0000';
        $enc = password_hash($password, PASSWORD_BCRYPT);
        mysqli_query($conn, "INSERT INTO staff(username, email, password, status) VALUES ('$staffname', '$staffemail', '$enc', 'account-action')");
    } else {
        // Check if the user exists in the database
        $checkQuery = "SELECT * FROM staff WHERE username = '$staffname' AND email = '$staffemail'";
        $checkResult = $conn->query($checkQuery);

        if ($checkResult->num_rows > 0) {
            // User exists, update or delete based on the selected action
            if ($accountAction === 'lock') {
                // Update the status to 'account locked'
                mysqli_query($conn, "UPDATE staff SET status = 'account locked' WHERE username = '$staffname' AND email = '$staffemail'");
            } elseif ($accountAction === 'unlock') {
                // Update the status to 'account unlocked'
                mysqli_query($conn, "UPDATE staff SET status = 'account unlocked' WHERE username = '$staffname' AND email = '$staffemail'");
            } elseif ($accountAction === 'delete') {
                // Delete the user from the database
                mysqli_query($conn, "DELETE FROM staff WHERE username = '$staffname' AND email = '$staffemail'");
            }
        } else {
            // User does not exist
            echo "User does not exist.";
        }
    }
    
    // Close the database connection
    $conn->close();
    
    // Redirect back to the page where the form is located
    header("Location: admindashboard.php");
    exit();
}
?>








////

include './connect.php';

if(isset($_POST['submit'])) {
    // Get the selected account action and status
    $accountAction = $_POST['account-action'];
    $accountStatus = $_POST['account-status']; // This holds the value of lock, unlock, or delete
    
    // Get other form inputs if needed
    $staffname = $_POST['user-name'];
    $staffemail = $_POST['user-email'];
    $password = '0000';
    $enc = password_hash($password, PASSWORD_BCRYPT);

    $checkQuery = "SELECT * FROM staff WHERE user-name = '$staffname' AND user-email = '$staffemail'";
    $checkResult = $conn->query($checkQuery);

    if ($checkResult->num_rows > 0) {
        // User exists, update the status column only if different
        $row = $checkResult->fetch_assoc();
        $currentStatus = $row['status'];
        
        if ($currentStatus !== $accountStatus) {
            $updateQuery = "UPDATE staff SET status = '$accountStatus' WHERE user-name = '$staffname' AND user-email = '$staffemail'";
            $updateResult = $conn->query($updateQuery);
            
            if ($updateResult) {
                // Status updated successfully
                echo "Status updated successfully.";
            } else {
                // Update failed
                echo "Status update failed.";
            }
        } else {
            // Status is already the same, no need to update
            echo "Status is already the same.";
        }
    } else {
        // User does not exist
        echo "User does not exist.";
    }
    
    // Close the database connection
    if ($staffname && $staffemail === 0){

        $accountAction = $_POST['account-action'];
        $accountStatus = $_POST['account-status']; // This holds the value of lock, unlock, or delete
        
        // Get other form inputs if needed
        $staffname = $_POST['user-name'];
        $staffemail = $_POST['user-email'];
        $password = '0000';
        $enc = password_hash($password, PASSWORD_BCRYPT);
       
    mysqli_query($conn,"insert into staff(username,email,password,status) values('$staffname', '$staffemail','$enc', 'account-action')");
    
    }

    
  
    // Close the database connection
    $conn->close();
    
    // Redirect back to the page where the form is located
    header("Location: admindashboard.php");
    exit();
}
?>






/*
include './connect.php';

if(isset($_POST['submit'])){
    // Get the account action and account identifier
    $accountAction = $_POST['account-action'];
    $accountId = $_POST['account-id'];

    $staffname = $_POST['user-name'];
    $staffemail = $_POST['user-email'];
    $password = '0000';
    $enc = password_hash($password, PASSWORD_BCRYPT);

    mysqli_query($conn,"insert into staff(username,email,password) values('$staffname', '$staffemail','$enc')");
    
   
    // Close the database connection
    $conn->close();
    
    // Redirect back to the page where the form is located
    header("Location: admindashboard.php");
    exit();
}
?>

