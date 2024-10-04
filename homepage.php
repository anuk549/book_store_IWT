<?php
session_start();
include("books/fetch_books.php");

$featured_products = [
    ['id' => 1, 'title' => 'MedialDownes', 'price' => 69.00],
    ['id' => 2, 'title' => 'MedialDownes', 'price' => 69.00],
    ['id' => 3, 'title' => 'MedialDownes', 'price' => 69.00],
    ['id' => 4, 'title' => 'MedialDownes', 'price' => 69.00],
    ['id' => 5, 'title' => 'MedialDownes', 'price' => 69.00],
    ['id' => 6, 'title' => 'MedialDownes', 'price' => 69.00],
    ['id' => 7, 'title' => 'MedialDownes', 'price' => 69.00]
];

$new_arrivals = $featured_products; // Using same data for demo
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Beyond Books</title>
    <link rel="stylesheet" href="styles.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
</head>

<body>
    <?php include 'header.php'; ?>

    <main>
        <!-- Hero Section -->
        <section class="hero">
            <div class="container">
                <div class="hero-content">
                    <span class="subtitle">Beyond Books</span>
                    <h1>Discover a World Beyond Books</h1>
                    <p>Dive into our curated collection of timeless literature and the latest bestsellers. Whether
                        you're looking for a classic read or something new, Beyond Books offers an endless selection to
                        feed your mind and soul.</p>
                    <div class="hero-buttons">
                        <button class="btn primary">Read More</button>
                    </div>
                </div>
                <div class="hero-image">
                    <img src="img/hero.png" alt="Hero Image">
                </div>
            </div>
        </section>

        <!-- Featured Products Section -->
        <section class="products featured">
            <div class="container">
                <h2>Featured</h2>
                <div class="product-slider">
                    <button class="slider-arrow prev"><i class="fas fa-chevron-left"></i></button>
                    <div class="product-container">
                        <?php foreach ($featured_products as $product): ?>
                            <div class="product-card">
                                <div class="product-image">
                                    <img src="/api/placeholder/200/300"
                                        alt="<?php echo htmlspecialchars($product['title']); ?>">
                                </div>
                                <div class="product-info">
                                    <h3><?php echo htmlspecialchars($product['title']); ?></h3>
                                    <p>USD <?php echo number_format($product['price'], 2); ?></p>
                                    <button class="cart-btn"><i class="fas fa-shopping-cart"></i></button>
                                </div>
                            </div>
                        <?php endforeach; ?>
                    </div>
                    <button class="slider-arrow next"><i class="fas fa-chevron-right"></i></button>
                </div>
            </div>
        </section>

        <!-- New Arrivals Section -->
        <section class="products new-arrivals">
            <div class="container">
                <h2>New Arrival</h2>
                <div class="product-slider">
                    <button class="slider-arrow prev"><i class="fas fa-chevron-left"></i></button>
                    <div class="product-container">
                        <?php foreach ($new_arrivals as $product): ?>
                            <div class="product-card">
                                <div class="product-image">
                                    <img src="/api/placeholder/200/300"
                                        alt="<?php echo htmlspecialchars($product['title']); ?>">
                                </div>
                                <div class="product-info">
                                    <h3><?php echo htmlspecialchars($product['title']); ?></h3>
                                    <p>USD <?php echo number_format($product['price'], 2); ?></p>
                                    <button class="cart-btn"><i class="fas fa-shopping-cart"></i></button>
                                </div>
                            </div>
                        <?php endforeach; ?>
                    </div>
                    <button class="slider-arrow next"><i class="fas fa-chevron-right"></i></button>
                </div>
            </div>
        </section>
    </main>

    <?php include 'footer.php'; ?>
    <script src="script.js"></script>
</body>

</html>