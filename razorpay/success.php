<?php
include('../config.php');
session_start();

$paymentId = $_GET['payment_id'];
$orderId = $_SESSION['razorpay_order_id'];
$userId = $_SESSION['user_id'];

// Save payment details to database
$query = $conn->prepare("INSERT INTO payments (user_id, razorpay_payment_id, razorpay_order_id) VALUES (?, ?, ?)");
$query->bind_param('iss', $userId, $paymentId, $orderId);
if ($query->execute()) {
    echo "Payment Successful!";
    echo "<a href='index.php'>Return to Home</a>";
} else {
    echo "Error saving payment details.";
}
?>
