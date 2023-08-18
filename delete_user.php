<?php
include './connect.php';

if (isset($_POST['submit'])) {
    // Get the selected account action and status
    $accountAction = $_POST['account-action'];

    // Get other form inputs if needed
    $staffname = $_POST['user-name'];
    $staffemail = $_POST['user-email'];

    // Check if user exists in the database
    $userQuery = "SELECT * FROM staff WHERE username = '$staffname' AND email = '$staffemail'";
    $userResult = $conn->query($userQuery);

    if ($userResult->num_rows > 0) {
        $userData = $userResult->fetch_assoc();
        $currentStatus = $userData['status'];

        // Perform the desired action based on account action
        if ($accountAction === 'lock') {
            // Update the status to 'locked' in the database
            $newStatus = 'locked';
            if ($currentStatus !== $newStatus) {
                $updateQuery = "UPDATE staff SET status = '$newStatus' WHERE username = '$staffname' AND email = '$staffemail'";
                $updateResult = $conn->query($updateQuery);
            }
        } elseif ($accountAction === 'unlock') {
            // Update the status to 'not-locked' in the database
            $newStatus = 'not-locked';
            if ($currentStatus !== $newStatus) {
                $updateQuery = "UPDATE staff SET status = '$newStatus' WHERE username = '$staffname' AND email = '$staffemail'";
                $updateResult = $conn->query($updateQuery);
            }
        } elseif ($accountAction === 'delete') {
            // Delete the account from the database
            $deleteQuery = "DELETE FROM staff WHERE username = '$staffname' AND email = '$staffemail'";
            $deleteResult = $conn->query($deleteQuery);
        }
    } else {
        // User not found in the database
        echo "User not found.";
    }

    // Close the database connection
    $conn->close();

    // Redirect back to the page where the form is located
    header("Location: admindashboard.php");
    exit();
}
?>






session_start();
include "./connect.php";

if(isset($_POST['submit'])) {
    $accountAction = $_POST['account-action'];
    $username = $_POST['user-name'];
    $email = $_POST['user-email'];

    if ($accountAction === 'delete') {
        // Check if the username and email exist in the database
        $checkQuery = "SELECT * FROM staff WHERE username = '$username' AND email = '$email'";
        $checkResult = $conn->query($checkQuery);

        if ($checkResult->num_rows > 0) {
            // Delete the account from the database
            $deleteQuery = "DELETE FROM staff WHERE username = '$username' AND email = '$email'";
            $deleteResult = $conn->query($deleteQuery);

            if ($deleteResult) {
                $_SESSION['message'] = "Account deleted successfully.";
            } else {
                $_SESSION['message'] = "Account deletion failed.";
            }
        } else {
            $_SESSION['message'] = "Account not found.";
        }
    } else {
        // Update status for lock/unlock actions
        $status = ($accountAction === 'lock') ? 'locked' : 'not-locked';

        $updateQuery = "UPDATE staff SET status = '$status' WHERE username = '$username' AND email = '$email'";
        $updateResult = $conn->query($updateQuery);

        if ($updateResult) {
            $_SESSION['message'] = "Account status updated successfully.";
        } else {
            $_SESSION['message'] = "Account status update failed.";
        }
    }

    header('Location: admindashboard.php');
    exit();
}
?>







//
session_start();
include "./connect.php";

if(isset($_POST['submit'])) {
    $accountAction = $_POST['account-action'];
    $username = $_POST['username'];
    $email = $_POST['email'];

     // Perform the desired action based on account action
     if ($accountAction === 'lock') {
        // Update the status to 'locked' in the database
        $sql = "UPDATE staff SET status = 'locked' WHERE username = '$staffname' OR email = '$staffemail'";
        $result = $conn->query($sql);
    } elseif ($accountAction === 'unlock') {
        // Update the status to 'unlocked' in the database
        $sql = "UPDATE staff SET status = 'unlocked' WHERE username = '$staffname' OR email = '$staffemail'";
        $result = $conn->query($sql);
    } elseif ($accountAction === 'delete') {
        // Delete the account from the database
        $sql = "DELETE FROM staff WHERE username = '$staffname' OR email = '$staffemail'";
        $result = $conn->query($sql);
    }
    

    header('Location: admindashboard.php');
    exit();
}
?>

