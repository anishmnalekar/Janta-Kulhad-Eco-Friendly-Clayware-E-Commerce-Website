<?php
session_start();
if (!isset($_SESSION['admin_logged_in']) || $_SESSION['admin_logged_in'] !== true) {
    header("Location: admin_login.php");
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard - Janta Kulhad</title>
    <link rel="stylesheet" href="../assets/css/style.css">
</head>
<body>
    <?php include('../includes/admin_navbar.php'); ?>
    <header class="landing-header">
        <img src="../assets/images/landing_bg.jpg" alt="Landing Background" class="landing-bg">
        <div class="overlay">
            <h1 style="color:#FFFDD0;">Welcome Admin</h1>
            <p>The art of terracotta redefined.</p>
        </div>
    </header> <br> <br> 
    <main align="center">
        <div class="admin-actions">
            <a href="generate_challan.php">Generate Challan</a> <br> <br>
            <a href="sales_reports.php">View Sales Reports</a> <br> <br>
            <a href="add_product.php">Add New Product</a> <br> <br>
            <a href="view_challans.php">View Challans</a> <br> <br>
        </div>
    </main>
<br> <br> <br> <br> <br> <br> <br> <br> <br> <br> <br> <br> <br> <br>
<?php include('../includes/admin_footer.php'); ?>

</body>
</html>
