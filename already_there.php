<?php
if (isset($_POST['submit'])) {
    $servername = "localhost";
    $username = "root"; // Change this if you have a different MySQL username
    $password = "";     // Change this if you have a different MySQL password
    $dbname = "coursework1";   // Use the name of your database

    // Create a connection
    $conn = new mysqli($servername, $username, $password, $dbname);

    // Check the connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    // Collect user input
    $name = $_POST['name'];
    $email = $_POST['email'];
    $action = $_POST['account-action'];

    // Handle different actions
    if ($action === 'delete') {
        // Delete the user based on provided name and email
        $deleteQuery = "DELETE FROM old_student_databse WHERE name = '$name' AND email = '$email'";
        if ($conn->query($deleteQuery) === TRUE) {
            echo '<script>alert("User deleted successfully.");</script>';
        } else {
            echo "Error deleting user: " . $conn->error;
        }
    } elseif ($action === 'lock' && $action === 'unlock') {
        // Update the status based on provided name and email
        $status = ($action === 'lock') ? 'locked' : 'unlocked';
        $updateQuery = "UPDATE old_student_databse SET status = '$status' WHERE name = '$name' AND email = '$email'";
        if ($conn->query($updateQuery) === TRUE) {
            echo '<script>alert("Status updated successfully.");</script>';
        } else {
            echo "Error updating status: " . $conn->error;
        }
    }

    $conn->close();
}
?>







if (isset($_POST['submit'])) {
    $servername = "localhost";
    $username = "root"; // Change this if you have a different MySQL username
    $password = "";     // Change this if you have a different MySQL password
    $dbname = "coursework1";   // Use the name of your database

    // Create a connection
    $conn = new mysqli($servername, $username, $password, $dbname);

    // Check the connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    // Collect user input
    $name = $_POST['name'];
    $email = $_POST['email'];

    // Check for existing record with the same email or name
    $existingQuery = "SELECT * FROM old_student_databse WHERE name = '$name' OR email = '$email'";
    $existingResult = $conn->query($existingQuery);

    if ($existingResult->num_rows > 0) {
        // Duplicate record found, display error message and exit
        echo '<script>alert("This person is already registered.");</script>';
    } else {
        // Insert data into the table
        $sql = "INSERT INTO old_student_databse (name, email) VALUES ('$name', '$email')";

        if ($conn->query($sql) === TRUE) {
            // Data inserted successfully, redirect to userdashboard.php
            header('Location: userdashboard.php');
            exit; // Make sure to exit after the redirect
        } else {
            echo "Error: " . $sql . "<br>" . $conn->error;
        }
    }

    $conn->close();
}
?>
