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
    $dob = $_POST['dob'];
    $age = $_POST['age'];
    $year_from = $_POST['year_from'];
    $year_to = $_POST['year_to'];
    $occupation = $_POST['occupation'];
    $address = $_POST['address'];
    $phone_number = $_POST['phone_number'];
    $university = $_POST['university'];
    $email = $_POST['email'];
    $course = $_POST['course'];
    $gender = $_POST['gender'];

    // Check for existing record with the same name or email
    $existingQuery = "SELECT * FROM old_student_databse WHERE name = '$name' OR email = '$email'";
    $existingResult = $conn->query($existingQuery);

    if ($existingResult->num_rows > 0) {
        // Duplicate record found, display alert message
        echo '<script>alert("This person is already registered."); window.location.href = "userdashboard.php";</script>';
    } else {
        // Insert data into the table
        $sql = "INSERT INTO old_student_databse (name, dob, age, year_from, year_to, occupation, address, phone_number, university, email, course, gender)
                VALUES ('$name', '$dob', '$age', '$year_from', '$year_to', '$occupation', '$address', '$phone_number', '$university', '$email', '$course', '$gender')";

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
