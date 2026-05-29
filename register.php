<?php
include 'includes/db.php';

$success = "";
$error = "";

if (isset($_POST['register'])) {
    $username = trim($_POST['username']);
    $password = $_POST['password'];
    $confirm = $_POST['confirm'];

    if ($password !== $confirm) {
        $error = "Passwords do not match!";
    } else {
        $check = $conn->query("SELECT id FROM users WHERE username='$username'");
        if ($check->num_rows > 0) {
            $error = "Username already taken!";
        } else {
            $hashed = password_hash($password, PASSWORD_DEFAULT);
            $conn->query("INSERT INTO users (username, password, role) VALUES ('$username', '$hashed', 'admin')");
            $success = "Account created successfully! You can now login.";
        }
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Signup - Café Ordering System</title>
</head>
<body style="background-image: url('images/dashboard - bg.jpg'); background-repeat: no-repeat; background-attachment: fixed; background-size: cover; padding: 20px; color: #333;">

<div class="main" style="display: flex; justify-content: center; align-items: center; height: 100vh;">
    <div class="container" style="display: flex; flex-direction: column; justify-content: center; align-items: center; padding: 30px; border-radius: 10px; background: rgba(255, 255, 255, 0.1); backdrop-filter: blur(10px); -webkit-backdrop-filter: blur(10px); box-shadow: rgba(0, 0, 0, 0.2) 0px 5px 15px; width: 400px; border: 1px solid rgba(255, 255, 255, 0.3);">
        <h2 style="text-align: center; margin: 10px 0 30px 0; font-size: 25px; font-weight: 800; color: #000;">Create an Account</h2>

        <?php if ($error) echo "<p style='color:red;'>$error</p>"; ?>
        <?php if ($success) echo "<p style='color:green;'>$success</p>"; ?>

        <form method="POST" style="display: flex; flex-direction: column; gap: 15px; margin-bottom: 15px;">
            <input type="text" name="username" placeholder="Username" required style="border-radius: 20px; border: 1px solid #ccc; padding: 12px 15px;">
            <input type="password" name="password" placeholder="Password" required style="border-radius: 20px; border: 1px solid #ccc; padding: 12px 15px;">
            <input type="password" name="confirm" placeholder="Confirm Password" required style="border-radius: 20px; border: 1px solid #ccc; padding: 12px 15px;">
            <button type="submit" name="register" style="padding: 10px 15px; border-radius: 20px; border: 0; background: teal; color: white; cursor: pointer;">Sign Up</button>
        </form>

        <a href="index.php" style="color: #000; font-size: 14px;">← Back to Login</a>
    </div>
</div>

</body>
</html>

<?php
include 'includes/db.php';

$success = "";
$error = "";

if (isset($_POST['register'])) {
    $username = trim($_POST['username']);
    $password = $_POST['password'];
    $confirm = $_POST['confirm'];

    if ($password !== $confirm) {
        $error = "Passwords do not match!";
    } else {
        $check = $conn->query("SELECT id FROM users WHERE username='$username'");
        if ($check->num_rows > 0) {
            $error = "Username already taken!";
        } else {
            $hashed = password_hash($password, PASSWORD_DEFAULT);
            $conn->query("INSERT INTO users (username, password, role) VALUES ('$username', '$hashed', 'admin')");
            $success = "Account created successfully! You can now login.";
        }
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Signup - Café Ordering System</title>
</head>
<body style="background-image: url('images/dashboard - bg.jpg'); background-repeat: no-repeat; background-attachment: fixed; background-size: cover; padding: 20px; color: #333;">

<div class="main" style="display: flex; justify-content: center; align-items: center; height: 100vh;">
    <div class="container" style="display: flex; flex-direction: column; justify-content: center; align-items: center; padding: 30px; border-radius: 10px; background: rgba(255, 255, 255, 0.1); backdrop-filter: blur(10px); -webkit-backdrop-filter: blur(10px); box-shadow: rgba(0, 0, 0, 0.2) 0px 5px 15px; width: 400px; border: 1px solid rgba(255, 255, 255, 0.3);">
        <h2 style="text-align: center; margin: 10px 0 30px 0; font-size: 25px; font-weight: 800; color: #000;">Create an Account</h2>

        <?php if ($error) echo "<p style='color:red;'>$error</p>"; ?>
        <?php if ($success) echo "<p style='color:green;'>$success</p>"; ?>

        <form method="POST" style="display: flex; flex-direction: column; gap: 15px; margin-bottom: 15px;">
            <input type="text" name="username" placeholder="Username" required style="border-radius: 20px; border: 1px solid #ccc; padding: 12px 15px;">
            <input type="password" name="password" placeholder="Password" required style="border-radius: 20px; border: 1px solid #ccc; padding: 12px 15px;">
            <input type="password" name="confirm" placeholder="Confirm Password" required style="border-radius: 20px; border: 1px solid #ccc; padding: 12px 15px;">
            <button type="submit" name="register" style="padding: 10px 15px; border-radius: 20px; border: 0; background: teal; color: white; cursor: pointer;">Sign Up</button>
        </form>

        <a href="index.php" style="color: #000; font-size: 14px;">← Back to Login</a>
    </div>
</div>

</body>
</html>