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
$student = [];
$error_message = "";
$success_message = "";

// Check if NIC is passed via GET
if (isset($_GET['nic'])) {
    $nic = mysqli_real_escape_string($conn, $_GET['nic']);

    // Fetch the student details for display in the form
    $query = "SELECT * FROM singup WHERE nic = '$nic'";
    $result = mysqli_query($conn, $query);

    if ($result && mysqli_num_rows($result) > 0) {
        $student = mysqli_fetch_assoc($result);
    } else {
        $error_message = "No student found with NIC: $nic.";
    }
}

// Handle the form submission for updating or deleting
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['update'])) {
        // If the update button is clicked
        $nic = mysqli_real_escape_string($conn, $_POST['nic']);
        $name = mysqli_real_escape_string($conn, $_POST['name']);
        $address = mysqli_real_escape_string($conn, $_POST['address']);
        $telephone = mysqli_real_escape_string($conn, $_POST['telephone']);
        $course = mysqli_real_escape_string($conn, $_POST['course']);

        $updateQuery = "UPDATE singup SET name='$name', address='$address', telephone='$telephone', course='$course' WHERE nic='$nic'";

        if (mysqli_query($conn, $updateQuery)) {
            $success_message = "Student details updated successfully.";
            // After update, fetch updated details again
            header("Location: student.php");
            $query = "SELECT * FROM singup WHERE nic = '$nic'";
            $result = mysqli_query($conn, $query);
            $student = mysqli_fetch_assoc($result);
        } else {
            $error_message = "Failed to update details: " . mysqli_error($conn);
        }
    }

    if (isset($_POST['delete'])) {
        // If the delete button is clicked
        $nic = mysqli_real_escape_string($conn, $_POST['nic']); 
        $deleteQuery = "DELETE FROM singup WHERE nic='$nic'";

        if (mysqli_query($conn, $deleteQuery)) {
            // Check if rows were affected
            if (mysqli_affected_rows($conn) > 0) {
                $success_message = "Student deleted successfully.";
                header("Location: student.php");  // Redirect back to the student list page
                exit();
            } else {
                $error_message = "No student was deleted. Please check if the NIC is correct.";
            }
        } else {
            $error_message = "Failed to delete student: " . mysqli_error($conn);
        }
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
           
        <li style><a href="home.php" class="login-btn" style="color: black;">Home</a></li>
        <li><a href="student.php" class="login-btn" style="color: black;">Student</a></li>
            
        </ul>
        
    </nav>
</header>

<div class="container">
    <div class="form-box">
        <div class="form-content">
            <h2>Update Student Details</h2>

            <!-- Display error or success message -->
            <?php if ($error_message): ?>
                <p style="color: red;"><?php echo htmlspecialchars($error_message); ?></p>
            <?php elseif ($success_message): ?>
                <p style="color: green;"><?php echo htmlspecialchars($success_message); ?></p>
            <?php endif; ?>

            <!-- Update Form -->
            <form method="POST" action="update.php">
                <div class="input-field">
                    <input type="text" name="nic" value="<?php echo isset($student['nic']) ? htmlspecialchars($student['nic']) : ''; ?>" readonly required>
                    <label>NIC</label>
                </div>
                <div class="input-field">
                    <input type="text" name="name" value="<?php echo isset($student['name']) ? htmlspecialchars($student['name']) : ''; ?>" required>
                    <label>Name</label>
                </div>
                <div class="input-field">
                    <input type="text" name="address" value="<?php echo isset($student['address']) ? htmlspecialchars($student['address']) : ''; ?>" required>
                    <label>Address</label>
                </div>
                <div class="input-field">
                    <input type="text" name="telephone" value="<?php echo isset($student['telephone']) ? htmlspecialchars($student['telephone']) : ''; ?>" required>
                    <label>Telephone No</label>
                </div>
                <div class="input-field">
                    <input type="text" name="course" value="<?php echo isset($student['course']) ? htmlspecialchars($student['course']) : ''; ?>" required>
                    <label>Course</label>
                </div>

                <div class="button-group">
                    <button type="submit" name="update">Update</button>
                    <button type="submit" name="delete" onclick="return confirm('Are you sure you want to delete this student?')"  class="delete-btn">Delete</button>
                    <button type="submit" name="delete" onclick="window.location.href='student.php';" class="delete-btn">Exit</button>
                </div>
            </form>
        </div>
    </div>
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
