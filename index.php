<?php
session_start();
include 'includes/db.php';

$remembered_username = $_COOKIE['remembered_username'] ?? '';

if (isset($_POST['login'])) {
    $username = $_POST['username'];
    $password = $_POST['password'];

    // Remember username if checked
    if (isset($_POST['remember'])) {
        setcookie('remembered_username', $username, time() + (86400 * 7), "/"); // 7 days
    } else {
        setcookie('remembered_username', '', time() - 3600, "/"); // clear cookie
    }

    $user = $conn->query("SELECT * FROM users WHERE username='$username'")->fetch_assoc();

    if ($user && password_verify($password, $user['password'])) {
        $_SESSION['user_id'] = $user['id'];
        $_SESSION['username'] = $user['username'];
        $_SESSION['role'] = $user['role'];

        if ($user['role'] === 'admin') {
            header("Location: admin/dashboard.php");
        } elseif ($user['role'] === 'cashier') {
            header("Location: cashier/dashboard.php");
        } else {
            $error = "Unknown role. Contact admin.";
        }
        exit;
    } else {
        $error = "Invalid username or password!";
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Login - Café Ordering System</title>
</head>
<body style="background-image: url('images/dashboard - bg.jpg'); background-repeat: no-repeat; background-attachment: fixed; background-size: cover; padding: 20px; color: #333;">

<div class="main" style="display: flex; justify-content: center; align-items: center; height: 100vh;">
    <div class="container" style="display: flex; flex-direction: column; justify-content: center; align-items: center; padding: 30px; border-radius: 10px; background: rgba(255, 255, 255, 0.1); backdrop-filter: blur(10px); -webkit-backdrop-filter: blur(10px); box-shadow: rgba(0, 0, 0, 0.2) 0px 5px 15px; width: 400px; border: 1px solid rgba(255, 255, 255, 0.3);">
        <h2 style="text-align: center; margin: 10px 0 30px 0; font-size: 25px; font-weight: 800; color: #000;">Login to Café</h2>

        <?php if (isset($error)) echo "<p style='color:red; margin-bottom: 15px;'>$error</p>"; ?>

        <form method="POST" style="display: flex; flex-direction: column; gap: 15px; margin-bottom: 15px;">
            <input type="text" name="username" value="<?= htmlspecialchars($remembered_username) ?>" placeholder="Username" required style="border-radius: 20px; border: 1px solid #c0c0c0; padding: 12px 15px;">

            <input type="password" name="password" id="password" placeholder="Password" required style="border-radius: 20px; border: 1px solid #c0c0c0; padding: 12px 15px;">

            <div style="display: flex; justify-content: space-between; align-items: center; font-size: 14px;">
                <label>
                    <input type="checkbox" onclick="togglePassword()"> Show Password
                </label>
                <label>
                    <input type="checkbox" name="remember" <?= isset($_COOKIE['remembered_username']) ? 'checked' : '' ?>> Remember Me
                </label>
            </div>

            <button type="submit" name="login" style="padding: 10px 15px; border-radius: 20px; border: 0; background: teal; color: white; cursor: pointer;">Login</button>
        </form>

        <a href="register.php" style="margin-bottom: 15px; color: #000; font-size: 14px;">Don’t have an account? Sign up</a>

        <div style="background: rgba(255,255,255,0.85); color: #000; padding: 6px 15px; border-radius: 8px; text-align: left; font-size: 13px; width: 100%;">
            <strong>Login Rules:</strong>
            <ul style="margin-top: 10px; padding-left: 20px;">
                <li><b>Admin:</b> Full access to user and menu management.</li>
                <li><b>Cashier:</b> Can take and manage orders only.</li>
            </ul>
        </div>
    </div>
</div>

<script>
function togglePassword() {
    const pass = document.getElementById("password");
    pass.type = pass.type === "password" ? "text" : "password";
}
</script>

</body>
</html>