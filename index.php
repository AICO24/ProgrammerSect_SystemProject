<?php
// index.php
session_start();
if (isset($_SESSION["username"])) {
    header("Location: dashboard.php");
    exit();
}

$prefilledUsername = isset($_GET['signup_username']) ? htmlspecialchars($_GET['signup_username']) : '';
$showSignUp = isset($_GET['show_signup']) ? true : false;
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
    <title>Jail Management System</title>
    <link rel="stylesheet" href="style.css"/>
    <link rel="stylesheet" href="https://fonts.googleapis.com"/>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;700&display=swap" rel="stylesheet"/>
    <link href="https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css"/>
</head>
<body>
    <div class="container">
        <div class="form-container active" id="loginForm">
            <h1>LOGIN</h1>
            <p class="welcome-text">Welcome to Jail Management System</p>

            <form action="login.php" method="POST" autocomplete="off">
                <label>USERNAME</label>
                <div class="input-box">
                    <i class='bx bx-user'></i>
                    <input type="text" name="username" id="loginUsername" placeholder="Enter Username" required>
                </div>

                <label>PASSWORD</label>
                <div class="input-box">
                    <i class='bx bx-lock-alt'></i>
                    <input type="password" name="password" id="loginPassword" placeholder="Enter Password" required>
                    <i class="fa-regular fa-eye toggle-password" onclick="togglePassword('loginPassword', this)"></i>
                </div>

                <div class="forgot-password">
                    <a href="forgot_password.php">Forgot Password?</a>
                </div>

                <button type="submit" class="login-btn" id="loginBtn">LOGIN</button>
            </form>

            <div class="signup">
                Don't have an account? <a href="#" id="showSignup">Sign Up</a>
            </div>
        </div>

        <div class="form-container" id="signup-form">
            <h2>SIGNUP</h2>
            <p class="welcome-text">Welcome to Jail Management System</p>

            <form action="signup.php" method="POST" autocomplete="off">
                <label>Enter Your Lastname</label>
                <div class="input-box">
                    <i class='bx bx-user'></i>
                    <input type="text" name="lastname" placeholder="Enter Lastname" required>
                </div>

                <label>Enter Your Firstname</label>
                <div class="input-box">
                    <i class='bx bx-user'></i>
                    <input type="text" name="firstname" placeholder="Enter Firstname" required>
                </div>

                <label>Enter Your Username</label>
                <div class="input-box">
                    <i class='bx bx-user'></i>
                    <input type="text" name="username" id="signupUsername" placeholder="Enter Username" value="<?php echo $prefilledUsername; ?>" required>
                </div>

                <label>Enter Your Email</label>
                <div class="input-box">
                    <i class="bx bx-envelope"></i>
                    <input type="email" name="email" placeholder="Enter Email" required>
                </div>

                <label>Enter Your Password</label>
                <div class="input-box">
                    <i class='bx bx-lock-alt'></i>
                    <input type="password" name="password" id="signupPassword1" placeholder="Enter Password" required>
                    <i class="fa-regular fa-eye toggle-password" onclick="togglePassword('signupPassword1', this)"></i>
                </div>

                <label>Re-Enter Your Password</label>
                <div class="input-box">
                    <i class='bx bx-lock-alt'></i>
                    <input type="password" name="password2" id="signupPassword2" placeholder="Re-enter Password" required>
                    <i class="fa-regular fa-eye toggle-password" onclick="togglePassword('signupPassword2', this)"></i>
                </div>

                <button type="submit" class="login-btn">SIGNUP</button>
            </form>

            <div class="signup">
                Already have an account? <a href="#" id="showLogin">Login</a>
            </div>
        </div>
    </div>

    <script>
        const loginForm = document.getElementById("loginForm");
        const signupForm = document.getElementById("signup-form");
        const showSignupLink = document.getElementById("showSignup");
        const showLoginLink = document.getElementById("showLogin");

        showSignupLink.addEventListener("click", function(e) {
            e.preventDefault();
            loginForm.classList.remove("active");
            signupForm.classList.add("active");
        });

        showLoginLink.addEventListener("click", function(e) {
            e.preventDefault();
            signupForm.classList.remove("active");
            loginForm.classList.add("active");
        });
        function togglePassword(inputId, icon) {
            const input = document.getElementById(inputId);
            if (input.type === "password") {
                input.type = "text";
                icon.classList.remove("fa-eye");
                icon.classList.add("fa-eye-slash");
            } else {
                input.type = "password";
                icon.classList.remove("fa-eye-slash");
                icon.classList.add("fa-eye");
            }
        }

        <?php if ($showSignUp): ?>
            loginForm.classList.remove("active");
            signupForm.classList.add("active");
        <?php endif; ?>
    </script>
</body>
</html>
