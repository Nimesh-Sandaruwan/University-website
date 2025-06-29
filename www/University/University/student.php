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

// Fetch all student records from the database
$query = "SELECT * FROM singup";
$result = mysqli_query($conn, $query);

if (!$result) {
    die("Query failed: " . mysqli_error($conn));
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
            <li style="margin-right: 10px;"><a href="university.php" class="login-btn" style="color: black ;background-color:#258303">Home</a></li>
            <li style="margin-right: 10px;"><a href="student.php" class="login-btn" style="color: black;background-color:#9B0010">Student</a></li>
            
        </ul>
        
    </nav>
</header>

<div class="container">
    <div class="search-bar">
        <input type="text" id="nic" placeholder="Enter NIC">
        <button onclick="search()">Search</button>
    </div>

    <table>
        <thead>
            <tr>
                <th>NIC</th>
                <th>Name</th>
                <th>Address</th>
                <th>TP</th>
                <th>Course</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            <?php
            if (mysqli_num_rows($result) > 0) {
                // Loop through and display each student record
                while ($row = mysqli_fetch_assoc($result)) {
                    echo "<tr>
                            <td>" . htmlspecialchars($row['nic']) . "</td>
                            <td>" . htmlspecialchars($row['name']) . "</td>
                            <td>" . htmlspecialchars($row['address']) . "</td>
                            <td>" . htmlspecialchars($row['telephone']) . "</td>
                            <td>" . htmlspecialchars($row['course']) . "</td>
                            <td>
                                <button onclick=\"update('" . htmlspecialchars($row['nic']) . "')\">Update</button>
                                <button onclick=\"update('" . htmlspecialchars($row['nic']) . "')\"style=background-color:#9B0010 >Delete</button>
                                                             
                                
                            </td>
                        </tr>";
                }
            } else {
                echo "<tr><td colspan='6'>No students found</td></tr>";
            }
            ?>
        </tbody>
    </table>
</div>
<footer>
        <div class="footer-container">
            <div class="footer-item">
                <h3 style="text-align: left;">Contact Us</h3>
                <ul style="text-align: left;">
                    <li><strong>Email:</strong> CSBT@university.com</li>
                    <li><strong>Telephone:</strong> +123 456 7890</li>
                    <li><strong>WhatsApp:</strong>077-7372145</a></li>
                    <li><strong>Address:</strong> 123 University St, COLOMBO, SRI LANKA</li>
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

<script>
    function search() {
        const nic = document.getElementById("nic").value;
        if (nic) {
            window.location.href = `search.php?nic=${nic}`;
        } else {
            alert("Please enter a NIC to search.");
        }
    }

    function update(nic) {
        // Redirect to update.php with NIC as a parameter
        window.location.href = `update.php?nic=${nic}`;
    }
</script>

</body>
</html>

<?php
// Close the connection
mysqli_close($conn);
?>
