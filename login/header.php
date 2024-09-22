<div class="header-content">
    <?php
    if (isset($_SESSION['email'])) {
        $email = $_SESSION['email'];
        $query = mysqli_query($conn, "SELECT * FROM users WHERE email='$email'");
        $user = mysqli_fetch_assoc($query);
        echo "<p class='greeting'>Hello " . htmlspecialchars($user['firstName']) . " " . htmlspecialchars($user['lastName']) . " :)</p>";
    }
    ?>
    <a href="login/logout.php" class="logout-button">Logout</a>
</div>
