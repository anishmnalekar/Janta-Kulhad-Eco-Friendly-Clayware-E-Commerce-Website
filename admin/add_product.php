<?php
session_start();
include('../config/db.php'); // Include database connection

// Check if admin is logged in
if (!isset($_SESSION['admin_logged_in']) || $_SESSION['admin_logged_in'] !== true) {
    header("Location: admin_login.php");
    exit;
}

// Initialize error and success messages
$error = "";
$success = "";

// Handle Add/Edit Product Form Submission
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $product_id = isset($_POST['product_id']) ? intval($_POST['product_id']) : 0;
    $product_name = trim($_POST['product_name']);
    $product_description = trim($_POST['description']);
    $product_price = trim($_POST['price']);
    $stock_quantity = trim($_POST['stock']);
    $image_path = trim($_POST['image']); 

    if (empty($product_name) || empty($product_description) || empty($product_price) || empty($stock_quantity) || empty($image_path)) {
        $error = "All fields are required!";
    } else {
        if ($product_id > 0) {
            // Update existing product
            $query = $conn->prepare("UPDATE products SET product_name=?, description=?, price=?, stock=?, image=? WHERE id=?");
            $query->bind_param('ssdiss', $product_name, $product_description, $product_price, $stock_quantity, $image_path, $product_id);
        } else {
            // Insert new product
            $query = $conn->prepare("INSERT INTO products (product_name, description, price, stock, image) VALUES (?, ?, ?, ?, ?)");
            $query->bind_param('ssdis', $product_name, $product_description, $product_price, $stock_quantity, $image_path);
        }

        if ($query->execute()) {
            $success = $product_id > 0 ? "Product updated successfully!" : "Product added successfully!";
        } else {
            $error = "Error: " . $conn->error;
        }
        $query->close();
    }
}

// Handle Delete Request
if (isset($_GET['delete_id'])) {
    $delete_id = intval($_GET['delete_id']);
    $query = $conn->prepare("DELETE FROM products WHERE id=?");
    $query->bind_param('i', $delete_id);
    if ($query->execute()) {
        $success = "Product deleted successfully!";
    } else {
        $error = "Error deleting product: " . $conn->error;
    }
    $query->close();
}

// Fetch all products
$result = $conn->query("SELECT * FROM products");
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manage Products - Admin</title>
    <link rel="stylesheet" href="../assets/css/style.css">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
</head>
<body>
    <?php include('../includes/admin_navbar.php'); ?>

    <h1 align="center">Manage Products</h1>

    <?php if ($error) { ?>
        <p class="error" style="color:red; text-align:center;"><?php echo $error; ?></p>
    <?php } ?>
    <?php if ($success) { ?>
        <p class="success" style="color:green; text-align:center;"><?php echo $success; ?></p>
    <?php } ?>

    <!-- Add / Edit Product Form -->
    <form action="add_product.php" method="POST" align="center">
        <input type="hidden" name="product_id" id="product_id">
        <label>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Product Name:</label>
        <input type="text" name="product_name" id="product_name" placeholder="Enter product name" autofocus required><br><br>

        <label>Product Description:</label>
        <textarea name="description" id="description" placeholder="Enter description" required></textarea><br><br>

        <label>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Product Price:</label>
        <input type="number" name="price" id="price" step="0.01" placeholder="Enter product price" required><br><br>

        <label>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Stock Quantity:</label>
        <input type="number" name="stock" id="stock" placeholder="Enter no of items" required><br><br>

        <label>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Image Path:</label>
        <input type="text" name="image" id="image" placeholder="e.g. foldername/filename" required><br><br>

        <button type="submit" id="submit-button">Add Product</button>
    </form>

    <br><br>

    <!-- Display Existing Products -->
    <h2 align="center">Existing Products</h2>
    <table align="center" border="1" cellpadding="10" cellspacing="0">
        <thead>
            <tr>
                <th>ID</th>
                <th>Image</th>
                <th>Product Name</th>
                <th>Description</th>
                <th>Price</th>
                <th>Stock</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            <?php while ($row = $result->fetch_assoc()) { ?>
                <tr>
                    <td><?= $row['id'] ?></td>
                    <td><img src="<?= htmlspecialchars($row['image']) ?>" alt="<?= htmlspecialchars($row['product_name']) ?>" width="60"></td>
                    <td><?= htmlspecialchars($row['product_name']) ?></td>
                    <td><?= htmlspecialchars($row['description']) ?></td>
                    <td>₹<?= htmlspecialchars($row['price']) ?></td>
                    <td><?= htmlspecialchars($row['stock']) ?></td>
                    <td>
                        <button class="edit-button" 
                            data-id="<?= $row['id'] ?>"
                            data-name="<?= htmlspecialchars($row['product_name']) ?>"
                            data-description="<?= htmlspecialchars($row['description']) ?>"
                            data-price="<?= $row['price'] ?>"
                            data-stock="<?= $row['stock'] ?>"
                            data-image="<?= htmlspecialchars($row['image']) ?>">
                            Edit
                        </button>
                        <button class="delete-button" data-id="<?= $row['id'] ?>">Delete</button>
                    </td>
                </tr>
            <?php } ?>
        </tbody>
    </table>

    <br><br>
    <?php include('../includes/admin_footer.php'); ?>

    <script>
        $(document).ready(function() {
            // Populate form for editing
            $(".edit-button").click(function() {
                $("#product_id").val($(this).data("id"));
                $("#product_name").val($(this).data("name"));
                $("#description").val($(this).data("description"));
                $("#price").val($(this).data("price"));
                $("#stock").val($(this).data("stock"));
                $("#image").val($(this).data("image"));
                $("#submit-button").text("Update Product");
            });

            // Delete confirmation popup
            $(".delete-button").click(function() {
                var productId = $(this).data("id");
                if (confirm("Are you sure you want to delete this product?")) {
                    if (confirm("This action is irreversible. Are you absolutely sure?")) {
                        window.location.href = "add_product.php?delete_id=" + productId;
                    }
                }
            });
        });
    </script>

</body>
</html>
