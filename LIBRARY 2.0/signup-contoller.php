<?php
session_start();
include 'db.php';

// Function to sanitize input data
function sanitizeInput($data) {
    global $conn;
    return htmlspecialchars(mysqli_real_escape_string($conn, trim($data)));
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $firstname = sanitizeInput($_POST['firstname']);
    $lastname = sanitizeInput($_POST['lastname']);
    $username = sanitizeInput($_POST['username']);
    $email = sanitizeInput($_POST['email']);
    $tel = sanitizeInput($_POST['tel']);
    $address = sanitizeInput($_POST['address']);
    $password = sanitizeInput($_POST['password']);
    $c_password = sanitizeInput($_POST['c-password']);
    $gender = sanitizeInput($_POST['gender']);
    $_SESSION['username'] = $username;
    // Validate passwords
    if ($password !== $c_password) {
        header("Location: SIGNUP.php?notification=pwd_error");
        exit();
    }

    // Check if username or email already exists
    $check_user_sql = "SELECT * FROM users WHERE username='$username' OR email='$email'";
    $result = $conn->query($check_user_sql);

    if ($result->num_rows > 0) {
        header("Location: SIGNUP.php?notification=user_error");
        exit();
    }

    // Insert user data into the database
    $insert_sql = "INSERT INTO users (firstname, lastname, username, email, phone, address, password, gender) 
                VALUES ('$firstname', '$lastname', '$username', '$email', '$tel', '$address', '$password', '$gender')";

    if ($conn->query($insert_sql) === TRUE) {
        $reg = "Registration successful! login now";
        // Redirect to login page or dashboard
        header("Location: login.php?sucess=". $Reg ."&login=".$_SESSION['username']);
        exit();

    } else {

        header("Location: SIGNUP.php?notification=db_failed");
        exit();
    }

    $conn->close();
}
?>
