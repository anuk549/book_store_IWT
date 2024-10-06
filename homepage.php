<?php
session_start();
include("books/fetch_books.php");
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
        <!-- Popup Message Box -->
    <div id="message-box" class="message-box" style="display:none;"></div>
    
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
                        <?php foreach ($books as $book): ?>
                            <div class="product-card">
                                <div class="product-image">
                                    <img src="./img/<?php echo $book["image"] ?>"
                                        alt="<?php echo htmlspecialchars($product['title']); ?>">
                                    <button onclick="addToCart(<?php echo $book['id']?>)" class="cart-btn"><i class="fas fa-shopping-cart"></i></button>
                                </div>
                                <div class="product-info">
                                    <h3><?php echo htmlspecialchars($book['title']); ?></h3>
                                    <p>USD <?php echo number_format($book['price'], 2); ?></p>
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
                        <?php foreach ($books as $book): ?>
                            <div class="product-card">
                                <div class="product-image">
                                    <img src="./img/<?php echo $book["image"]?>"
                                        alt="<?php echo htmlspecialchars($book['title']); ?>">
                                        <button onclick="addToCart(<?php echo $book['id']?>)" class="cart-btn"><i class="fas fa-shopping-cart"></i></button>
                                </div>
                                <div class="product-info">
                                    <h3><?php echo htmlspecialchars($book['title']); ?></h3>
                                    <p>USD <?php echo number_format($book['price'], 2); ?></p>
                                    
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