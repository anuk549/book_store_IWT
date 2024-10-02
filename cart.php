<?php
include 'connect.php';
session_start();
if (isset($_SESSION["email"])) {
    ?>
    <!DOCTYPE html>
    <html lang="en">

    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>My Cart - Beyond Books</title>
        <link rel="stylesheet" href="styles.css">
        <link rel="stylesheet" href="cart.css">
    </head>

    <body>
        <?php include("header.php"); ?>

        <main>
            <h1>My Cart</h1>
            

            <div class="cart-container">
                <table>
                    <thead>
                        <tr>
                            <th>Item</th>
                            <th>Unit Price</th>
                            <th>Qty</th>
                            <th>Total</th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody id="cart-items">
                        <!-- Cart items will be dynamically inserted here -->
                    </tbody>
                </table>
                <div class="cart-summary">
                    <table class="t2">
                        <tr>
                            <th>
                                <p>Sub Total: </p>
                            </th>
                            <th>
                                <p id="sub-total">0.00</p>
                            </th>
                        </tr>
                        <tr>
                            <th>
                                <p>Discount: </p>
                            </th>
                            <th>
                                <p id="discount">0.00</p>
                            </th>
                        </tr>
                        <tr>
                            <th>
                                <p>Total: </p>
                            </th>
                            <th>
                                <p id="total">0.00</p>
                            </th>
                        </tr>
                        <tr>
                            <th>

                            </th>
                            <th>
                                <button id="checkout-btn">Checkout</button>
                            </th>
                        </tr>
                    </table>
                </div>
            </div>
        </main>

        <?php include("footer.php"); ?>

        <script src="cart.js"></script>
    </body>

    </html>
    <?php
} else {
    header("Location: login/index.html");
}

?>