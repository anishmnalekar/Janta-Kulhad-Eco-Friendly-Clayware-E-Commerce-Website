<?php
require('razorpay-php/Razorpay.php');
use Razorpay\Api\Api;

include('../config.php');
session_start();

// Razorpay API credentials
$apiKey = 'YOUR_RAZORPAY_KEY';
$apiSecret = 'YOUR_RAZORPAY_SECRET';

$api = new Api($apiKey, $apiSecret);

// Order details
$orderAmount = $_SESSION['total_amount'];
$orderCurrency = "INR";
$orderReceipt = "JANTA_KULHAD_" . time();

// Create an order
$order = $api->order->create([
    'receipt' => $orderReceipt,
    'amount' => $orderAmount * 100, // Convert to paisa
    'currency' => $orderCurrency
]);

$_SESSION['razorpay_order_id'] = $order['id'];
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Payment - Janta Kulhad</title>
    <script src="https://checkout.razorpay.com/v1/checkout.js"></script>
</head>
<body>
    <h1>Proceed to Payment</h1>
    <button id="rzp-button1">Pay Now</button>

    <script>
        var options = {
            "key": "<?php echo $apiKey; ?>", 
            "amount": "<?php echo $orderAmount * 100; ?>", 
            "currency": "INR",
            "name": "Janta Kulhad",
            "description": "Purchase of Products",
            "order_id": "<?php echo $order['id']; ?>",
            "handler": function (response){
                window.location.href = "success.php?payment_id=" + response.razorpay_payment_id;
            },
            "prefill": {
                "name": "<?php echo $_SESSION['user_name']; ?>",
                "email": "<?php echo $_SESSION['user_email']; ?>",
                "contact": "<?php echo $_SESSION['user_contact']; ?>"
            },
            "theme": {
                "color": "#F37254"
            }
        };
        var rzp1 = new Razorpay(options);
        document.getElementById('rzp-button1').onclick = function(e){
            rzp1.open();
            e.preventDefault();
        }
    </script>
</body>
</html>
