<?php
session_start();
// include("connect.php");

// Function to check if the user is logged in
function is_logged_in()
{
    if (isset($_SESSION['user']) && $_SESSION['is_admin'] === true) {
        return true;
    }

    // Check for cookie if session is not set
    if (isset($_COOKIE['admin_logged_in'])) {
        $username = base64_decode($_COOKIE['admin_logged_in']);
        if ($username === 'admin') { // In a real app, validate against database
            $_SESSION['user'] = $username;
            $_SESSION['is_admin'] = true;
            return true;
        }
    }

    return false;
}

// Check if user is logged in
if (!is_logged_in()) {
    header("Location: admin-login.php");
    exit();
}

// Function to load tab content
function loadTabContent($tab)
{
    if ($tab === 'categories') {
        $file = 'tabs/categories.php';  // Adjusted path to match file location
    } else if ($tab === 'books') {
        $file = 'tabs/books.php';  // Adjusted path to match file location
    }

    if (file_exists($file)) {
        define('ADMIN_DASHBOARD', true); // Prevent direct access
        include $file;
    } else {
        echo "<p>Tab content not found.</p>";
    }
}

// Determine which tab to load
$currentTab = isset($_GET['tab']) ? $_GET['tab'] : 'categories';
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard</title>
    <link rel="stylesheet" href="dashboard.css">
</head>

<body>
<div class="container">
    <aside>
        <div class="logo-div"><a href="../homepage.php"><img src="../img/logo.png" alt="logo" class="logo"></a></div>
        <hr>
        <nav>
            <ul>
                <li><a href="?tab=categories" class="<?php echo $currentTab == 'categories' ? 'active' : ''; ?>">Categories</a></li>
                <li><a href="?tab=books" class="<?php echo $currentTab == 'books' ? 'active' : ''; ?>">Books</a></li>
            </ul>
        </nav>
    </aside>
    <main>
        <header>
            <span>Welcome <?php echo htmlspecialchars($_SESSION['user']); ?>,</span>
            <a href="./admin-logout-proccess.php">Logout</a>
        </header>
        <div id="content">
            <?php loadTabContent($currentTab); ?>
        </div>
    </main>
</div>
    <script src="dashboard.js"></script>
</body>

</html>