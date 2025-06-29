<?php
// Database connection settings
$host = "localhost";
$user = "root";
$password = "";
$dbname = "universitydb";

// Establish a connection
$conn = mysqli_connect($host, $user, $password, $dbname);

// Check the connection
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

// Start session management
session_start();

// Check if the user is already logged in
if (isset($_SESSION['user'])) {
    // Redirect to the dashboard if already logged in
    header("Location: university.php");
    exit();
}

// Collect user input from the form
$nic = $_POST['nic'];
$name = $_POST['name'];

// Validate user input
if (empty($nic) || empty($name)) {
    echo "Please fill in all fields.";
    exit();
}

// Use prepared statements to prevent SQL injection
$stmt = $conn->prepare("SELECT * FROM singup WHERE nic = ? AND name = ?");
$stmt->bind_param("ss", $nic, $name);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows > 0) {
    // Login successful
    $_SESSION['user'] = $name; // Store user name in session
    header("Location: university.php"); // Redirect to university.php
    exit();
} else {
    // Login failed
    echo "Invalid NIC or Name. Please try again.";
}

// Close the connection
$stmt->close();
$conn->close();
?>
