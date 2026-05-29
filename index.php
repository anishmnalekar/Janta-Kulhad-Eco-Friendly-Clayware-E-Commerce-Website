<?php
session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Janta Kulhad - Home</title>
    <link rel="stylesheet" href="assets/css/style.css">
</head>
<body>
    <!-- Navbar -->
    <?php include('includes/navbar.php'); ?>

    <!-- Landing Section -->
    <header class="landing-header">
        <img src="assets/images/landing_bg.jpg" alt="Janta Kulhad" class="landing-bg">
        <div class="overlay">
            <h1 style="color:#FFFDD0;">Welcome to Janta Kulhad</h1>
            <p>Eco-friendly clayware solutions crafted with love.</p>
        </div>
    </header>

    <!-- Product Information -->
    <section class="products">
        <h2>Our Products</h2>
        <div class="product-container">
            <div class="product-card">
                <img src="assets/images/products/kulhad50.jpeg" alt="50ml Kulhad">
                <h3>50ml Kulhad</h3>
                <p>Best for tea & small servings.</p>
                <p>Price: ₹1.90</p>
            </div>
            <div class="product-card">
                <img src="assets/images/products/kulhad60.jpeg" alt="60ml Kulhad">
                <h3>60ml Kulhad</h3>
                <p>Best for tea & small servings.</p>
                <p>Price: ₹1.90</p>
            </div>
            <div class="product-card">
                <img src="assets/images/products/kulhad70.jpeg" alt="70ml Kulhad">
                <h3>70ml Kulhad</h3>
                <p>Best for tea & small servings.</p>
                <p>Price: ₹1.90</p>
            </div>
            <div class="product-card">
                <img src="assets/images/products/kulhad80.jpeg" alt="80ml Kulhad">
                <h3>80ml Kulhad</h3>
                <p>Perfect for large tea servings.</p>
                <p>Price: ₹2.10</p>
            </div>
            <div class="product-card">
                <img src="assets/images/products/kulhad100.jpeg" alt="100ml Kulhad">
                <h3>100ml Kulhad</h3>
                <p>Perfect for large tea servings.</p>
                <p>Price: ₹2.90</p>
            </div>
            <div class="product-card">
                <img src="assets/images/products/kulhad120.jpeg" alt="120ml Kulhad">
                <h3>120ml Kulhad</h3>
                <p>Perfect for large tea & lassi servings.</p>
                <p>Price: ₹2.90</p>
            </div>
            <div class="product-card">
                <img src="assets/images/products/kulhad200.jpeg" alt="200ml Kulhad">
                <h3>200ml Kulhad</h3>
                <p>Perfect for large tea & lassi servings.</p>
                <p>Price: ₹3.90</p>
            </div>
            <div class="product-card">
                <img src="assets/images/products/handi1.jpeg" alt="Handi">
                <h3>Handis</h3>
                <p>Perfect for large servings.</p>
                <p>Price: ₹2.90</p>
            </div>
            <div class="product-card">
                <img src="assets/images/products/diya1.jpeg" alt="Diya">
                <h3>Diya</h3>
                <p>Decorative Diyas</p>
                <p>Price: ₹2.90</p>
            </div>
            <div class="product-card">
                <img src="assets/images/products/catering1.jpeg" alt="Catering">
                <h3>Catering Plates</h3>
                <p>Perfect small to large servings.</p>
                <p>Price: ₹3.90</p>
            </div>
        </div>
    </section>

    <!-- Gallery -->
    <section class="gallery" align="center">
        <h2>Gallery</h2>
        <div class="carousel">
            <img src="assets/images/gallery1.jpg" alt="Gallery Image 1">
            <img src="assets/images/gallery2.jpg" alt="Gallery Image 2">
            <img src="assets/images/gallery3.jpg" alt="Gallery Image 3">
            <img src="assets/images/gallery4.jpeg" alt="Gallery Image 4">
            <img src="assets/images/gallery5.jpeg" alt="Gallery Image 5">
            <img src="assets/images/gallery6.jpeg" alt="Gallery Image 6">
        </div>
    </section>

    <!-- Footer -->
    <?php include('includes/footer.php'); ?>
</body>
<script src="assets/js/script.js"></script>
</html>
