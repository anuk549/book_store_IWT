<?php
session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST['username'];
    $password = $_POST['password'];

    // In a real application, you would validate against a database
    // This is just a simple example
    if ($username === 'admin' && $password === '123') {
        $_SESSION['user'] = $username;
        $_SESSION['is_admin'] = true;

        // Create a cookie that expires in 30 days
        $cookie_name = "admin_logged_in";
        $cookie_value = base64_encode($username); // Simple encoding, not for sensitive data
        $cookie_expiry = time() + (86400 * 30); // 86400 = 1 day
        setcookie($cookie_name, $cookie_value, $cookie_expiry, "/", "", true, true);

        // Redirect to dashboard
        header("Location: dashboard.php");
        exit();
    } else {
        $error = "Invalid username or password";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sign-in Result</title>
    <link rel="stylesheet" href="signin-styles.css">
</head>
<body>
    <div class="signin-container">
        <?php
        if (isset($error)) {
            echo "<p class='error-message'>$error</p>";
            echo "<p><a href='signin.html'>Try again</a></p>";
        }
        ?>
    </div>
</body>
</html>