<!DOCTYPE html>
<!-- Coding By CodingNepal - www.codingnepalweb.com -->
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CSBT Campus</title>
    <link rel="icon" type="image/png" href="images/logo4.png">
    <!-- Google Fonts Link For Icons -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Rounded:opsz,wght,FILL,GRAD@48,400,0,0">
    <link rel="stylesheet" href="style.css">
    <script src="script.js" defer></script>
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
                <li style><a href="home.php" class="login-btn" style="color: black;">Home</a></li>
                <li><a href="student.php" class="login-btn" style="color: black;">Student</a></li>
                
            </ul>
            
        </nav>
        <h2 class="h1">WELCOME TO CSBT CAMPUS  <br><br>Start your higher education step</h2>
        
    </header>
    

    

    <div class="blur-bg-overlay"></div>
    <div class="form-popup">
        <span class="close-btn material-symbols-rounded">close</span>
        <div class="form-box login">
            <div class="form-details">
                <h2>Welcome Back</h2><br><br>
                <p>Please log in using your personal information to stay connected with us.</p>
            </div>
            <div class="form-content">
                <h2>LOGIN</h2>
                <form action="login.php" method="POST">
                    <div class="input-field">
                        <input type="text" name="nic" required>
                        <label>NIC</label>
                    </div>
                    <div class="input-field">
                        <input type="text" name="name" required>
                        <label>Name</label>
                    </div>
                    
                    <button type="submit">Log In</button>
                </form>
                <div class="bottom-link">
                    Don't have an account?
                    <a href="singup.php" id="signup-link">Signup</a>
                </div>
            </div>
        </div>
        <div class="form-box signup">
            <div class="form-details">
                <h2>Create Account</h2>
                <p>To become a part of our community, please sign up using your personal information.</p>
            </div>
            <div class="form-content">
                <h2>SIGNUP</h2>
                <form action="singup.php" method="POST">
                    <div class="input-field">
                        <input type="text" name="nic" required>
                        <label>Enter your NIC</label>
                    </div>
                    <div class="input-field">
                        <input type="text" name="name" required>
                        <label>Enter your Name</label>
                    </div>
                    <div class="input-field">
                        <input type="text" name="address" required>
                        <label>Enter your Address</label>
                    </div>
                    <div class="input-field">
                        <input type="text" name="telephone" required>
                        <label>Telephone No</label>
                    </div>
                    <div class="input-field">
                        <input type="text" name="course" required>
                        <label>Enter your Course</label>
                    </div>
                    
                    <button type="submit">Sign Up</button>
                </form>
                <div class="bottom-link">
                    Already have an account? 
                    <a href="#" id="login-link">Login</a>
                </div>
            </div>
        </div>
    </div>
</body>
</html>