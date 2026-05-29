<?php
session_start();
include('../config/db.php'); // Ensure database connection is included

// Check if the admin is logged in
if (!isset($_SESSION['admin_logged_in']) || $_SESSION['admin_logged_in'] !== true) {
    header("Location: admin_login.php");
    exit;
}

// Ensure request method is POST
if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    die("Invalid request.");
}

// Retrieve and validate form inputs
$buyer_name = trim($_POST['buyer_name']);
$buyer_contact = trim($_POST['buyer_contact']);
$buyer_address = trim($_POST['buyer_address']);
$products = $_POST['products'] ?? [];
$quantities = $_POST['quantities'] ?? [];
$total_amount = trim($_POST['total_amount']);

// Check if all required fields are filled
if (empty($buyer_name) || empty($buyer_contact) || empty($buyer_address) || empty($products) || empty($quantities) || empty($total_amount)) {
    die("Error: Please fill in all required fields.");
}

// Insert into `challans` table
$insert_challan = $conn->prepare("INSERT INTO challans (buyer_name, buyer_contact, buyer_address, total_amount) VALUES (?, ?, ?, ?)");
$insert_challan->bind_param("sssd", $buyer_name, $buyer_contact, $buyer_address, $total_amount);

if (!$insert_challan->execute()) {
    die("Error inserting challan: " . $conn->error);
}

// Get the last inserted challan ID
$challan_id = $conn->insert_id;

// Prepare statements for inserting into `challan_products`
$check_product = $conn->prepare("SELECT id FROM products WHERE id = ?");
$insert_challan_product = $conn->prepare("INSERT INTO challan_products (challan_id, product_id, quantity) VALUES (?, ?, ?)");

// Insert each selected product with its quantity
foreach ($products as $index => $product_id) {
    $check_product->bind_param("i", $product_id);
    $check_product->execute();
    $result = $check_product->get_result();

    if ($result->num_rows === 0) {
        die("Error: Product ID $product_id does not exist in products table.");
    }

    $quantity = intval($quantities[$index]);
    $insert_challan_product->bind_param("iii", $challan_id, $product_id, $quantity);

    if (!$insert_challan_product->execute()) {
        die("Error inserting product into challan_products: " . $conn->error);
    }
}

// Success message & redirection
echo "<script>alert('Challan generated successfully!'); window.location.href='view_challans.php';</script>";
?>
