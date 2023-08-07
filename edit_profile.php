<?php
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

if (isset($_GET['id'])) {
    $user_id = $_GET['id'];

    // Retrieve user details from the database based on user_id
    $sql = "SELECT * FROM old_student_databse WHERE ID = $user_id";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
    } else {
        echo "User not found.";
        exit;
    }
}

if (isset($_POST['update'])) {
    // Collect updated user input
    $updated_name = $_POST['name'];
    $updated_dob = $_POST['dob'];
    $updated_age = $_POST['age'];
    $updated_year_from = $_POST['year_from'];
    $updated_year_to = $_POST['year_to'];
    $updated_occupation = $_POST['occupation'];
    $updated_address = $_POST['address'];
    $updated_phone_number = $_POST['phone_number'];
    $updated_university = $_POST['university'];
    $updated_email = $_POST['email'];
    $updated_course = $_POST['course'];
    $updated_gender = $_POST['gender'];

    // Update data in the database
    $update_sql = "UPDATE old_student_databse 
                   SET name = '$updated_name', dob = '$updated_dob', age = '$updated_age',
                   year_from = '$updated_year_from', year_to = '$updated_year_to',
                   occupation = '$updated_occupation', address = '$updated_address',
                   phone_number = '$updated_phone_number', university = '$updated_university',
                   email = '$updated_email', course = '$updated_course', gender = '$updated_gender'
                   WHERE ID = $user_id";

    if ($conn->query($update_sql) === TRUE) {
        header('Location: userdashboard.php');
        exit;
    } else {
        echo "Error updating record: " . $conn->error;
    }
}

$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Profile</title>
</head>
<body>
    <h1>Edit Profile</h1>
    <form action="" method="post">
        <input type="text" name="name" value="<?php echo $row['name']; ?>" placeholder="Name"><br>
        <input type="date" name="dob" value="<?php echo $row['dob']; ?>"><br>
        <input type="text" name="age" value="<?php echo $row['age']; ?>" placeholder="Age"><br>
        <input type="text" name="year_from" value="<?php echo $row['year_from']; ?>" placeholder="Year From"><br>
        <input type="text" name="year_to" value="<?php echo $row['year_to']; ?>" placeholder="Year To"><br>
        <input type="text" name="occupation" value="<?php echo $row['occupation']; ?>" placeholder="Occupation"><br>
        <input type="text" name="address" value="<?php echo $row['address']; ?>" placeholder="Address"><br>
        <input type="text" name="phone_number" value="<?php echo $row['phone_number']; ?>" placeholder="Phone Number"><br>
        <input type="text" name="university" value="<?php echo $row['university']; ?>" placeholder="University"><br>
        <input type="email" name="email" value="<?php echo $row['email']; ?>" placeholder="Email"><br>
        <input type="text" name="course" value="<?php echo $row['course']; ?>" placeholder="Course"><br>
        <input type="text" name="gender" value="<?php echo $row['gender']; ?>" placeholder="Gender"><br>
        <input type="submit" name="update" value="Update">
    </form>
</body>
</html>
