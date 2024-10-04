<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Sign-in</title>
    <link rel="stylesheet" href="admin-login-styles.css">
</head>
<body>
    <div class="signin-container">
        <h2>Admin Sign-in</h2>
        <form id="signinForm" action="admin-login-proccess.php" method="post">
            <div class="form-group">
                <label for="username">Username:</label>
                <input type="text" id="username" name="username" required>
            </div>
            <div class="form-group">
                <label for="password">Password:</label>
                <input type="password" id="password" name="password" required>
            </div>
            <button type="submit">Sign In</button>
        </form>
        <p id="errorMessage" class="error-message"></p>
    </div>
    <script src="admin-signin.js"></script>
</body>
</html>