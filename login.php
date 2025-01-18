<?php
// Database connection
$servername = "localhost";
$username = "username";
$password = " ";
$dbname = "DATA";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Login logic
if (isset($_POST['login'])) {
    $username = $_POST['username'];
    $password = $_POST['password'];
    $role = $_POST['role'];

    if ($role == 'user') {
        $sql = "SELECT * FROM user_table WHERE username='$username' AND password='$password'";
    } else {
        $sql = "SELECT * FROM club_associate_table WHERE username='$username' AND password='$password'";
    }

    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        // Login successful
        session_start();
        $_SESSION['username'] = $username;
        $_SESSION['role'] = $role;
        header("Location: dashboard.php");
    } else {
        // Login failed
        echo "Invalid username or password";
    }
}

$conn->close();
?>
