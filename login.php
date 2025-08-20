<?php
session_start();
include "db.php";

$usernameError = "";
$passwordError = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = trim($_POST['username']);
    $password = trim($_POST['password']);

    if (!empty($username) && !empty($password)) {

        $stmt = $conn->prepare("SELECT password FROM users WHERE username = ?");
        $stmt->bind_param("s", $username);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows === 1) {
            $row = $result->fetch_assoc();
            if (password_verify($password, $row['password'])) {
                $_SESSION['username'] = $username;
                header("Location: dashboard.php");
                exit();
            } else {
                $passwordError = "Invalid password";
            }
        } else {
            $usernameError = "Invalid username";
        }

        $stmt->close();
    } else {
        $usernameError = "Please fill in all fields";
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">
    <style>
        <?php include 'style.css'; ?>
        .error {
            color: #ff4d4d;
            background-color: #ffe6e6;
            padding: 8px;
            border-radius: 10px;
            font-size: 14px;
            margin-top: 5px;
            margin-bottom: 10px;
            box-shadow: inset 2px 2px 4px #d1d1d1, inset -2px -2px 4px #ffffff;
            text-align: center;
        }
    </style>
</head>
<body>
    <div class="container">
        <h2>Login</h2>
        <form method="POST">

            <label>USERNAME</label>
            <div class="input-box">
                <span class="icon">👤</span>
                <input type="text" name="username" id="loginUsername" placeholder="Enter Username" required>
            </div>

            <?php if ($usernameError): ?>
                <div class="error"><?php echo $usernameError; ?></div>
            <?php endif; ?>

           <label>PASSWORD</label>
                <div class="input-box">
                    <span class="icon">🔒</span>
                    <input type="password" name="password" id="loginPassword" placeholder="Enter Password" required>
                    <i class="fa-regular fa-eye toggle-password" onclick="togglePassword('loginPassword', this)"></i>
                </div>
                
            <?php if ($passwordError): ?>
                <div class="error"><?php echo $passwordError; ?></div>
            <?php endif; ?>

            <div class="forgot-password">
                <a href="forgot_password.php">Forgot Password?</a>
            </div>

            <button type="submit" class="login-btn" id="loginBtn">LOGIN</button>
            <div class="signup">
                Don’t have an account? 
                <a href="signup.php<?php echo isset($username) ? '?username=' . urlencode($username) : ''; ?>">Sign Up</a>
            </div>
        </form>
    </div>
</body>
</html>
