<?php
session_start();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gallery - Janta Kulhad</title>
    <link rel="stylesheet" href="assets/css/style.css">
</head>
<body>
    <nav class="navbar">
        <img src="assets/images/logo.png" alt="Janta Kulhad Logo" class="logo">
        <ul class="nav-links">
            <li><a href="index.php">Home</a></li>
            <li><a href="about.php">About Us</a></li>
            <li><a href="gallery.php">Gallery</a></li>
            <li><a href="contact.php">Contact Us</a></li>
        </ul>
    </nav>

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

    <?php include('includes/footer.php'); ?>
</body>
</html>
