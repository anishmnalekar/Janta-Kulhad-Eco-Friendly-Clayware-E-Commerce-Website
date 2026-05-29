<?php
session_start();
include('../config/db.php');

// Initialize cart if not set
if (!isset($_SESSION['cart'])) {
    $_SESSION['cart'] = [];
}

// Fetch products from the database
$query = $conn->query("SELECT * FROM products");
$products = [];
while ($row = $query->fetch_assoc()) {
    $products[] = $row;
}

// Get the logged-in username (if available)
$username = isset($_SESSION['username']) ? htmlspecialchars($_SESSION['username']) : "Guest";
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Janta Kulhad - Home</title>
    <link rel="stylesheet" href="../assets/css/style.css">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
</head>
<body>
    <nav class="navbar">
        <img src="../assets/images/logo.png" alt="Janta Kulhad Logo" class="logo">
        <button class="menu-toggle" id="menu-toggle">☰</button>
        <ul class="nav-links">
            <li><a href="index.php">Home</a></li>
            <li><a href="about.php">About Us</a></li>
            <li><a href="gallery.php">Gallery</a></li>
            <li><a href="contact.php">Contact Us</a></li>
            <li><a href="cart.php">Cart (<span id="cart-count"><?php echo count($_SESSION['cart']); ?></span>)</a></li>
            <li><a href="logout.php">Logout</a></li>
        </ul>
    </nav>

    <header class="landing-header">
        <img src="../assets/images/landing_bg.jpg" alt="Landing Background" class="landing-bg">
        <div class="overlay">
            <h1 style="color:#FFFDD0;">Welcome, <?php echo $username; ?>!</h1>
            <p>The art of terracotta redefined.</p>
        </div>
    </header>

    <section class="products">
        <h2>Our Products</h2>
        <div class="product-container">
            <?php foreach ($products as $product) { ?>
                <div class='product-card'>
                    <img src='<?php echo htmlspecialchars($product["image"]); ?>' alt='<?php echo htmlspecialchars($product["product_name"]); ?>'>
                    <h3><?php echo htmlspecialchars($product["product_name"]); ?></h3>
                    <p class="description"><?php echo htmlspecialchars($product["description"]); ?></p>
                    <p class="price">Price: ₹<?php echo number_format($product["price"], 2); ?></p>
                    <button class="add-to-cart" 
                        data-id="<?php echo $product["id"]; ?>" 
                        data-name="<?php echo htmlspecialchars($product["product_name"]); ?>" 
                        data-price="<?php echo $product["price"]; ?>">
                        Add to Cart
                    </button>
                </div>
            <?php } ?>
        </div>
    </section>

    <?php include('../includes/footer.php'); ?>

    <script>
        $(document).ready(function() {
            $(".add-to-cart").click(function() {
                var product_id = $(this).data("id");
                var product_name = $(this).data("name");
                var product_price = $(this).data("price");

                $.ajax({
                    url: "cart_action.php",
                    method: "POST",
                    data: { product_id: product_id, product_name: product_name, product_price: product_price, action: "add" },
                    success: function(response) {
                        $("#cart-count").text(response);
                        alert("Product added to cart!");
                    }
                });
            });
        });
    </script>
</body>
</html>
