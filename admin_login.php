<?php
// admin_login.php
session_start();
include("database.php");

$error = '';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $username = $conn->real_escape_string($_POST['username']);
    $password = $_POST['password']; // plain password

    // Check in database
    $sql = "SELECT * FROM admin WHERE username='$username' AND password='$password'";
    $result = $conn->query($sql);

    if ($result->num_rows == 1) {
        // Successful login
        $_SESSION['admin_logged_in'] = true;
        $_SESSION['admin_username'] = $username;

        // Redirect to admin panel
        header("Location: admin_panel.php");
        exit;
    } else {
        $error = "Invalid username or password.";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<title>Admin Login</title>
<style>
    body {
        font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        margin: 0;
        height: 100vh;
        display: flex;
        justify-content: center;
        align-items: center;
        background: linear-gradient(135deg, #f3f3f3, #d9e4f5);
    }

    .login-box {
        background: #ffffff;
        padding: 50px 40px;
        border-radius: 15px;
        box-shadow: 0 15px 35px rgba(0,0,0,0.2);
        width: 380px;
        max-width: 90%;
        text-align: center;
    }

    .login-box h2 {
        margin-bottom: 35px;
        color: #333;
        font-size: 28px;
        letter-spacing: 1px;
    }

    form {
        display: flex;
        flex-direction: column;
        gap: 20px;
    }

    .login-box input[type="text"],
    .login-box input[type="password"] {
        width: 100%;
        padding: 14px 20px;
        border: 1px solid #ccc;
        border-radius: 12px;
        font-size: 16px;
        box-sizing: border-box;
        transition: 0.3s;
    }

    .login-box input[type="text"]:focus,
    .login-box input[type="password"]:focus {
        border-color: #4a90e2;
        box-shadow: 0 0 10px rgba(74,144,226,0.4);
        outline: none;
    }

    .login-box button {
        width: 100%;
        padding: 14px;
        background: #4a90e2;
        color: #fff;
        border: none;
        border-radius: 12px;
        font-size: 16px;
        cursor: pointer;
        transition: 0.3s;
    }

    .login-box button:hover {
        background: #3571c4;
    }

    .error {
        color: red;
        font-weight: 500;
        margin-bottom: 10px;
    }

    .login-box .footer {
        margin-top: 20px;
        font-size: 13px;
        color: #777;
    }
</style>
</head>
<body>
    <div class="login-box">
        <h2>Admin Login</h2>
        <?php if($error != ''){ echo "<div class='error'>$error</div>"; } ?>
        <form method="post">
            <input type="text" name="username" placeholder="Username" required>
            <input type="password" name="password" placeholder="Password" required>
            <button type="submit">Login</button>
        </form>
        <div class="footer">Gym Management System &copy; 2026</div>
    </div>
</body>
</html>