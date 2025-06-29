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

// Initialize variables
$nic = "";
$results = [];

// Get the NIC from the query parameter
if (isset($_GET['nic']) && !empty($_GET['nic'])) {
    $nic = mysqli_real_escape_string($conn, $_GET['nic']);

    // Query to search for the student by NIC
    $query = "SELECT * FROM singup WHERE nic LIKE '%$nic%' OR name LIKE '%$nic%'";
    $result = mysqli_query($conn, $query);

    // Fetch matching records
    if ($result && mysqli_num_rows($result) > 0) {
        while ($row = mysqli_fetch_assoc($result)) {
            $results[] = $row;
        }
    } else {
        $error_message = "No students found with NIC or Name matching '$nic'.";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CSBT Campus</title>
    <link rel="icon" type="image/png" href="images/logo4.png">
    <link rel="stylesheet" href="style.css">
</head>
<body>

<header>
    <nav class="navbar">
        <span class="hamburger-btn material-symbols-rounded">menu</span>
        <a href="#" class="logo">
            <img src="images/logo4.png" alt="logo">
        </a>
        <ul class="links">
            <span class="close-btn material-symbols-rounded">close</span>
            <li style><a href="university.php" class="login-btn" style="color: black;">Home</a></li>
            <li><a href="student.php" class="login-btn" style="color: black;">Student</a></li>
           
        </ul>
        
    </nav>
</header>

<div class="container">

    <h1>Search Results</h1>  
    

    <table>
   
        <thead>
            <tr>
                <th>NIC</th>
                <th>Name</th>
                <th>Address</th>
                <th>TP</th>
                <th>Course</th>

            </tr>
        </thead>
        <tbody>
            <?php if (!empty($results)): ?>
                <?php foreach ($results as $row): ?>
                    <tr>
                        <td><?php echo htmlspecialchars($row['nic']); ?></td>
                        <td><?php echo htmlspecialchars($row['name']); ?></td>
                        <td><?php echo htmlspecialchars($row['address']); ?></td>
                        <td><?php echo htmlspecialchars($row['telephone']); ?></td>
                        <td><?php echo htmlspecialchars($row['course']); ?></td>
                        <td>
                            
                        </td>
                    </tr>
                <?php endforeach; ?>
            <?php else: ?>
                <tr>
                    <td colspan="6">
                        <?php echo isset($error_message) ? htmlspecialchars($error_message) : "No students found."; ?>
                    </td>
                </tr>
            <?php endif; ?>
        </tbody>
    </table>

    <button style="background-color: red; float: right; border: none; padding: 10px 20px; color: white;" onclick="window.location.href='student.php';">Exit</button>



</div>
<footer>
        <div class="footer-container">
            <div class="footer-item">
                <h3 style="text-align: left;">Contact Us</h3>
                <ul style="text-align: left;">
                    <li><strong>Email:</strong> info@university.com</li>
                    <li><strong>Telephone:</strong> +123 456 7890</li>
                    <li><strong>WhatsApp:</strong>077-7372145</a></li>
                    <li><strong>Address:</strong> 123 University St, City, Country</li>
                </ul>
            </div>
            <div class="footer-item">
                <h3 style="text-align: right;">Follow Us</h3>
                <ul class="social-links">
                
                <li><a href="https://www.facebook.com/youruniversity" target="_blank">
                    <img src="images/fb.jpg" alt="Facebook" width="40" height="40">
                </a></li>
                <li><a href="https://twitter.com/youruniversity" target="_blank">
                    <img src="images/tw.png" alt="Twitter" width="40" height="40">
                </a></li>
                <li><a href="https://www.instagram.com/youruniversity" target="_blank">
                    <img src="images/insta.jpg" alt="Instagram" width="40" height="40">
                </a></li>
                <li><a href="https://www.linkedin.com/youruniversity" target="_blank">
                    <img src="images/lin.png" alt="LinkedIn" width="40" height="40">
                </a></li>
            </ul>
                
            </div>
        </div>
        <div class="footer-bottom">
            <img src="images/logo4.png" alt="University Logo" width="150" height="150"> 
            <p>&copy; 2024 CSBT Campus. All rights reserved.</p>

        </div>
    </footer>


</body>
</html>

<?php
// Close the database connection
mysqli_close($conn);
?>
