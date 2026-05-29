<?php
session_start(); // Ensure session starts
include('../config/db.php');

if (!isset($_SESSION['user_logged_in'])) {
    header("Location: login.php");
    exit;
}

$user_id = $_SESSION['user_id'];

// Fetch user details
$user_query = $conn->prepare("SELECT name, email FROM users WHERE id = ?");
$user_query->bind_param("i", $user_id);
$user_query->execute();
$user_result = $user_query->get_result();
$user = $user_result->fetch_assoc();

// Fetch cart items
$cart = $_SESSION['cart'] ?? [];

if (empty($cart)) {
    echo "<script>alert('Your cart is empty!'); window.location.href = 'cart.php';</script>";
    exit;
}

// Calculate total amount
$total_amount = array_sum(array_map(fn($product) => $product['price'] * $product['quantity'], $cart));

// Process order
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $shipping_address = trim($_POST['shipping_address']);
    $payment_method = $_POST['payment_method'];

    // Start transaction
    $conn->begin_transaction();

    try {
        // Insert order details into database
        $order_query = $conn->prepare("INSERT INTO orders (user_id, total_amount, shipping_address, payment_method) VALUES (?, ?, ?, ?)");
        $order_query->bind_param("idss", $user_id, $total_amount, $shipping_address, $payment_method);
        $order_query->execute();
        $order_id = $conn->insert_id;

        // Insert order items
        $item_query = $conn->prepare("INSERT INTO order_items (order_id, product_id, quantity, price) VALUES (?, ?, ?, ?)");

        foreach ($cart as $product) {
            $item_query->bind_param("iiid", $order_id, $product['id'], $product['quantity'], $product['price']);
            $item_query->execute();
        }

        // Clear only cart, keep session active
        unset($_SESSION['cart']);

        // Commit transaction
        $conn->commit();

        // Redirect user after successful order
        header("Location: order_success.php?order_id=$order_id");
        exit;
    } catch (Exception $e) {
        $conn->rollback();
        echo "<script>alert('Error processing order: " . $e->getMessage() . "');</script>";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <title>Checkout - Janta Kulhad</title>
    <link rel="stylesheet" href="../assets/css/style.css">
</head>
<body>
    <?php include('../includes/user_navbar.php'); ?>

    <h1 align="center">Checkout</h1>
    <form method="POST" action="" align="center">
        <h2>Shipping Details</h2>
        <p><strong>Name:</strong> <?= htmlspecialchars($user['name']) ?></p>
        <p><strong>Email:</strong> <?= htmlspecialchars($user['email']) ?></p>

        <label>Shipping Address:</label>
        <textarea name="shipping_address" required></textarea><br><br>

        <label>Payment Method:</label>
        <select name="payment_method">
            <option value="COD">Cash on Delivery</option>
            <option value="Online">Online Payment</option>
        </select><br><br>

        <h2>Order Summary</h2>
        <table border="1" align="center" cellspacing="0" cellpadding="10">
            <tr>
                <th>Product</th>
                <th>Quantity</th>
                <th>Price (₹)</th>
                <th>Total (₹)</th>
            </tr>
            <?php foreach ($cart as $product) { ?>
                <tr>
                    <td><?= htmlspecialchars($product['name']) ?></td>
                    <td align="center"><?= $product['quantity'] ?></td>
                    <td align="center"><?= number_format($product['price'], 2) ?></td>
                    <td align="center"><?= number_format($product['price'] * $product['quantity'], 2) ?></td>
                </tr>
            <?php } ?>
        </table>
        <h3>Total Amount: ₹<?= number_format($total_amount, 2) ?></h3>

        <button type="submit">Proceed to Payment</button>
    </form>

    <?php include('../includes/user_footer.php'); ?>
</body>
</html>
