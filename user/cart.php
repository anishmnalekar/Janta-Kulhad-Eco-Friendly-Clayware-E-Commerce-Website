<?php
session_start();
include('../config/db.php');

$cart = $_SESSION['cart'] ?? [];
$total_price = 0;
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Shopping Cart</title>
    <link rel="stylesheet" href="../assets/css/style.css">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <style>
        .cart-table {
            width: 85%;
            margin: auto;
            border-collapse: collapse;
        }
        .cart-table th, .cart-table td {
            border: 3px solid #ddd;
            padding: 15px;
            text-align: center;
            vertical-align: middle;
        }
        .cart-table th {
            background-color: #d3d3d3;
        }
        .cart-table img {
            width: 80px;
            height: 80px;
            object-fit: cover;
            border-radius: 5px;
        }
        .cart-actions button {
            padding: 8px 12px;
            border: none;
            cursor: pointer;
        }
        .btn-delete {
            background-color: #f44336;
            color: white;
            border-radius: 5px;
        }
        .quantity-controls {
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 8px;
        }
        .quantity-controls button {
            padding: 5px;
            border: none;
            cursor: pointer;
            background-color: #007bff;
            color: white;
            font-size: 16px;
            border-radius: 3px;
            width: 30px;
            height: 30px;
        }
        .quantity {
            font-size: 16px;
            font-weight: bold;
            width: 30px;
            text-align: center;
            display: inline-block;
        }
        .proceed-btn {
            background-color: #28a745;
            color: white;
            padding: 12px 25px;
            border: none;
            cursor: pointer;
            display: block;
            margin: 20px auto;
            text-align: center;
            text-decoration: none;
            font-size: 18px;
            border-radius: 5px;
        }
    </style>
</head>
<body>

    <nav class="navbar">
        <img src="../assets/images/logo.png" alt="Janta Kulhad Logo" class="logo">
        <ul class="nav-links">
            <li><a href="index.php">Home</a></li>
            <li><a href="about.php">About Us</a></li>
            <li><a href="gallery.php">Gallery</a></li>
            <li><a href="contact.php">Contact Us</a></li>
            <li><a href="logout.php">Logout</a></li>
        </ul>
    </nav>

    <h1 align="center">Shopping Cart</h1>

    <table class="cart-table">
        <tr>
            <th>Product Image</th>
            <th>Product</th>
            <th>Price</th>
            <th>Quantity</th>
            <th>Subtotal</th>
            <th>Action</th>
        </tr>
        <?php if (!empty($cart)) {
            foreach ($cart as $id => $product) {
                $subtotal = $product['price'] * $product['quantity'];
                $total_price += $subtotal;
        ?>
        <tr>
            <td><img src="<?= htmlspecialchars($product['image']) ?>" alt="Product Image"></td>
            <td><?php echo htmlspecialchars($product['name']); ?></td>
            <td>₹<?php echo number_format($product['price'], 2); ?></td>
            <td>
                <div class="quantity-controls">
                    <button class="decrease-quantity" data-id="<?php echo $id; ?>">-</button>
                    <span class="quantity"><?php echo $product['quantity']; ?></span>
                    <button class="increase-quantity" data-id="<?php echo $id; ?>">+</button>
                </div>
            </td>
            <td>₹<?php echo number_format($subtotal, 2); ?></td>
            <td>
                <button class="btn-delete remove-from-cart" data-id="<?php echo $id; ?>">Delete</button>
            </td>
        </tr>
        <?php } } else { ?>
        <tr>
            <td colspan="6">Your cart is empty.</td>
        </tr>
        <?php } ?>
    </table>

    <h2 align="center">Total: ₹<span id="total-price"><?php echo number_format($total_price, 2); ?></span></h2>

    <?php if (!empty($cart)) { ?>
        <a href="checkout.php" class="proceed-btn">Proceed to Payment</a>
    <?php } ?>

    <br><br><br><br><br><br><br><br>
    <?php include('../includes/footer.php'); ?>

    <script>
        $(document).ready(function() {
            $(".increase-quantity").click(function() {
                var product_id = $(this).data("id");
                $.ajax({
                    url: "cart_action.php",
                    method: "POST",
                    data: { product_id: product_id, action: "increase" },
                    success: function() {
                        location.reload();
                    }
                });
            });

            $(".decrease-quantity").click(function() {
                var product_id = $(this).data("id");
                $.ajax({
                    url: "cart_action.php",
                    method: "POST",
                    data: { product_id: product_id, action: "decrease" },
                    success: function() {
                        location.reload();
                    }
                });
            });

            $(".remove-from-cart").click(function() {
                var product_id = $(this).data("id");
                $.ajax({
                    url: "cart_action.php",
                    method: "POST",
                    data: { product_id: product_id, action: "remove" },
                    success: function() {
                        location.reload();
                    }
                });
            });
        });
    </script>

</body>
</html>
