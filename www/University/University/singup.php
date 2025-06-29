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

$success_message = "";

// Collect user input
$nic = $_REQUEST['nic'];
$name = $_REQUEST['name'];
$address = $_REQUEST['address'];
$telephone = $_REQUEST['telephone'];
$course = $_REQUEST['course'];

// SQL query
$result = "INSERT INTO singup (nic, name, address, telephone, course) VALUES ('$nic', '$name', '$address', '$telephone', '$course')";

// Execute the query

if (mysqli_query($conn, $result)) {
    
    $success_message = "Now you can Log In the Our Site.";
    
    header("Location: home.php");
    exit(); 

} else {
    echo "Something is Wrong, try again later..";
    echo "Error: " . mysqli_error($conn);
}

// Close the connection
mysqli_close($conn);
?>
