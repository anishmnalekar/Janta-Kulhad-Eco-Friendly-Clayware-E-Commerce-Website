<?php
session_start();

// Check if the admin is logged in
if (!isset($_SESSION['admin_logged_in']) || $_SESSION['admin_logged_in'] !== true) {
    header("Location: admin_login.php");
    exit;
}

// Include the database connection
include('../config/db.php');

// Initialize error and success messages
$error = "";
$success = "";

// Handle the form submission
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Get form inputs
    $customer_name = trim($_POST['customer_name']);
    $product = trim($_POST['product']);
    $quantity = trim($_POST['quantity']);
    $rate = trim($_POST['rate']);
    
    // Validate inputs
    if (empty($customer_name) || empty($product) || empty($quantity) || empty($rate)) {
        $error = "All fields are required!";
    } else {
        // Calculate the total amount
        $total_amount = $quantity * $rate;

        // Insert sale details into the sales table
        $query = $conn->prepare("INSERT INTO sales (customer_name, product, quantity, rate, total_amount, sale_date) VALUES (?, ?, ?, ?, ?, NOW())");
        $query->bind_param('ssidi', $customer_name, $product, $quantity, $rate, $total_amount);
        
        // Execute query and handle success or failure
        if ($query->execute()) {
            $success = "Sale added successfully!";
        } else {
            $error = "Error adding sale: " . $conn->error;
        }
    }
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sales Panel - Add Sale</title>
    <link rel="stylesheet" href="../assets/css/style.css">
</head>
<body>
    <?php include('../includes/admin_navbar.php'); ?>

    <h1>Sales Panel</h1><br><br>

    <!-- Sales form -->
    <form action="sales_action.php" method="POST" align="center">
        <label>Customer Name:</label>
        <input type="text" name="customer_name" required><br><br>

        <label>Product:</label>
        <input type="text" name="product" required><br><br>

        <label>Quantity:</label>
        <input type="number" name="quantity" required><br><br>

        <label>Rate:</label>
        <input type="number" step="0.01" name="rate" required><br><br>

        <button type="submit">Add Sale</button>
    </form>

<!-- Display success or error messages -->
    <?php if ($error) { ?>
        <p align="center" class="error"><?php echo $error; ?></p>
    <?php } ?>
    <?php if ($success) { ?>
        <p align="center"class="success"><?php echo $success; ?></p>
    <?php } ?>

    <br><br><br><br><br><br><br><br><br><br><br>

    <?php include('../includes/admin_footer.php'); ?>

</body>
</html>
