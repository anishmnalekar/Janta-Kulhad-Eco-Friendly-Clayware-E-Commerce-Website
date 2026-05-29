<?php
session_start();
include('../config/db.php'); // Ensure database connection

if (!isset($_SESSION['cart'])) {
    $_SESSION['cart'] = [];
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $action = $_POST['action'];
    $product_id = $_POST['product_id'];

    // Ensure product_id is a valid number
    if (!is_numeric($product_id)) {
        echo json_encode(['status' => 'error', 'message' => 'Invalid product ID']);
        exit;
    }

    // Fetch product details using correct column names
    $stmt = $conn->prepare("SELECT product_name, price, image FROM products WHERE id = ?");
    $stmt->bind_param("i", $product_id);
    $stmt->execute();
    $result = $stmt->get_result();
    $product = $result->fetch_assoc();
    
    if (!$product) {
        echo json_encode(['status' => 'error', 'message' => 'Product not found']);
        exit;
    }

    $product_name = $product['product_name'];  
    $product_price = $product['price'];
    $product_image = $product['image'];

    if ($action == "add") {
        if (isset($_SESSION['cart'][$product_id])) {
            $_SESSION['cart'][$product_id]['quantity'] += 1;
        } else {
            $_SESSION['cart'][$product_id] = [
                'name' => $product_name,
                'price' => $product_price,
                'image' => $product_image,
                'quantity' => 1
            ];
        }
    } elseif ($action == "increase") {
        $_SESSION['cart'][$product_id]['quantity'] += 1;
    } elseif ($action == "decrease") {
        if ($_SESSION['cart'][$product_id]['quantity'] > 1) {
            $_SESSION['cart'][$product_id]['quantity'] -= 1;
        } else {
            unset($_SESSION['cart'][$product_id]);
        }
    } elseif ($action == "remove") {
        unset($_SESSION['cart'][$product_id]);
    }

    echo count($_SESSION['cart']);
    exit;
}
?>
