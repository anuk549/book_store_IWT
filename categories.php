<?php
include("category-proccess/fetch-categories2.php");
?>

<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Categories | Beyond Books</title>
    <link rel="stylesheet" href="styles.css">
    <link rel="stylesheet" href="categories.css">
</head>

<body>
    <?php include 'header.php'; ?>

    <main class="categories-section">
        <div class="categories-header">
            <h1>All Categories</h1>
            <p>Browse All Categories For Books, Stationery and More</p>
        </div>

        <div class="categories-grid">
            <?php
            foreach ($categories as $categorie) {
                ?>
                <div class="category-card">
                    <div class="category-icon">
                        <img src="<?php echo substr($categorie['category_img'], 1); ?>" alt="Children's Books">
                    </div>
                    <div class="category-name"><?php echo $categorie['category_name'] ?></div>
                </div>
                <?php
            }
            ?>

        </div>


    </main>

    <?php include 'footer.php'; ?>

    <script>
        // Add hover effects and click handling for category cards
        document.querySelectorAll('.category-card').forEach(card => {
            card.addEventListener('click', () => {
                // Navigate to category page
                console.log(`Navigating to ${card.querySelector('.category-name').textContent} category`);
            });
        });

        // Show more button functionality
        document.querySelector('.show-more-btn').addEventListener('click', () => {
            console.log('Loading more categories...');
            // Implement show more functionality here
        });
    </script>
</body>

</html>