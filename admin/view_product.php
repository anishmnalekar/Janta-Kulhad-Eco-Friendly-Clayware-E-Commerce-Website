<?php
session_start();
include('../config/db.php');

// Check if the admin is logged in
if (!isset($_SESSION['admin_logged_in']) || $_SESSION['admin_logged_in'] !== true) {
    header("Location: admin_login.php");
    exit;
}

// Fetch products from the database
$query = $conn->query("SELECT * FROM products");

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>View Products - Admin</title>
    <link rel="stylesheet" href="../assets/css/style.css">
</head>
<body>
    <?php include('../includes/admin_navbar.php'); ?>

    <h1 align="center">View Products</h1>
    
    <table border="1" align="center">
        <tr>
            <th>Product Name</th>
            <th>Product Description</th>
            <th>Price</th>
            <th>Stock Quantity</th>
        </tr>

        <?php while ($product = $query->fetch_assoc()) { ?>
            <tr>
                <td><?php echo htmlspecialchars($product['product_name']); ?></td>
                <td><?php echo htmlspecialchars($product['description']); ?></td>
                <td><?php echo number_format($product['price'], 2); ?></td>
                <td><?php echo $product['stock_quantity']; ?></td>
            </tr>
        <?php } ?>
    </table>

    <br><br><br>
    <?php include('../includes/admin_footer.php'); ?>
</body>
</html>
