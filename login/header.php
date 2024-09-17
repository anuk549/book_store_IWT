<?php
if (isset($_SESSION['email'])) {
    $email = $_SESSION['email'];
    $query = mysqli_query($conn, "SELECT * FROM users WHERE email='$email'");
    $user = mysqli_fetch_assoc($query);
    echo "<p>Hello " . $user['firstName'] . " " . $user['lastName'] . " :)</p>";
}
?>
<a href="login/logout.php">Logout</a>

