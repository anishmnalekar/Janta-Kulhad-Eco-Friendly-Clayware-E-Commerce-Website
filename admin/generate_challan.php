<?php
session_start();
include('../config/db.php');
require('../vendor/fpdf/fpdf.php'); // Include FPDF for PDF generation

if (!isset($_SESSION['admin_logged_in']) || $_SESSION['admin_logged_in'] !== true) {
    header("Location: admin_login.php");
    exit;
}

// Fetch products
$products = [];
$query = $conn->query("SELECT id, product_name, price FROM products");
while ($row = $query->fetch_assoc()) {
    $products[] = $row;
}

// Generate PDF if form is submitted
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $buyer_name = $_POST['buyer_name'];
    $buyer_contact = $_POST['buyer_contact'];
    $buyer_address = $_POST['buyer_address'];
    $product_id = $_POST['products'];
    $quantity = $_POST['quantities'];
    $total_amount = $_POST['total_amount'];

    // Fetch product details
    $product_query = $conn->query("SELECT product_name, price FROM products WHERE id='$product_id'");
    $product = $product_query->fetch_assoc();
    $product_name = $product['product_name'];
    $price = $product['price'];

    // Create PDF
    $pdf = new FPDF();
    $pdf->AddPage();
    $pdf->SetFont('Arial', 'B', 16);
    $pdf->Cell(190, 10, 'Janta Kulhad - Challan', 1, 1, 'C');

    // Buyer Details
    $pdf->SetFont('Arial', '', 12);
    $pdf->Cell(190, 10, "Buyer: $buyer_name", 0, 1);
    $pdf->Cell(190, 10, "Contact: $buyer_contact", 0, 1);
    $pdf->Cell(190, 10, "Address: $buyer_address", 0, 1);
    $pdf->Ln();

    // Table Header
    $pdf->SetFont('Arial', 'B', 12);
    $pdf->Cell(80, 10, 'Product', 1);
    $pdf->Cell(30, 10, 'Quantity', 1);
    $pdf->Cell(40, 10, 'Price (in rupees)', 1);
    $pdf->Cell(40, 10, 'Total (in rupees)', 1);
    $pdf->Ln();

    // Table Row
    $pdf->SetFont('Arial', '', 12);
    $pdf->Cell(80, 10, $product_name, 1);
    $pdf->Cell(30, 10, $quantity, 1);
    $pdf->Cell(40, 10, number_format($price, 2), 1);
    $pdf->Cell(40, 10, number_format($total_amount, 2), 1);
    $pdf->Ln();

    // Output PDF
    $pdf->Output();
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <title>Generate Challan</title>
    <link rel="stylesheet" href="../assets/css/style.css">
</head>
<body>
    <?php include('../includes/admin_navbar.php'); ?>
    <h1 align="center">Generate Challan</h1>
    <form action="" method="POST" align="center">
        <label>&nbsp;&nbsp;&nbsp;&nbsp;Buyer Name:</label>
        <input type="text" name="buyer_name" placeholder="Enter name of buyer" autofocus required><br><br>

        <label>&nbsp;Buyer Contact:</label>
        <input type="text" name="buyer_contact" placeholder="Enter contact no of buyer" required><br><br>

        <label>Buyer Address:</label>
        <textarea name="buyer_address" placeholder="Enter address of buyer" required></textarea><br><br>

        <label>Product:</label>&nbsp;&nbsp
        <select name="products">
            <?php foreach ($products as $product) { ?>
                <option value="<?= $product['id'] ?>"><?= htmlspecialchars($product['product_name']) ?></option>
            <?php } ?>
        </select><br><br>
        <label>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Quantity:</label>
        <input type="number" name="quantities" placeholder="Enter no of products" required><br><br>

        <label>&nbsp;&nbsp;&nbsp;&nbsp;Total Amount:</label>
        <input type="text" name="total_amount" placeholder="Enter total amount payable" required><br><br>

        <button type="submit">Generate Challan</button>
    </form>
<br><br><br><br><br><br><br><br>
<?php include('../includes/admin_footer.php'); ?>
</body>
</html>
