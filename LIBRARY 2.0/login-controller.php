<?php
session_start();
include 'db.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $user = $_POST['username'];
    $pass = $_POST['password'];

    $sql = "SELECT staff_id, username FROM staff WHERE username='$user' AND password='$pass'";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $_SESSION['loggedin'] = true;
        $_SESSION['userid'] = $row['staff_id'];
        $_SESSION['username'] = $row['first_name'] . ' ' . $row['last_name'];
        header("Location: dashboard.php");
    } else {
        header("Location: login.php?notificatoin=false");
    }
}
?>
