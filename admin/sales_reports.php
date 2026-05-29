<?php
session_start();
include('../config/db.php');
require('../vendor/fpdf/fpdf.php');

if (!isset($_SESSION['admin_logged_in'])) {
    header("Location: admin_login.php");
    exit;
}

// Generate report
if (isset($_GET['start_date']) && isset($_GET['end_date'])) {
    $start_date = $_GET['start_date'];
    $end_date = $_GET['end_date'];

    if ($end_date > date('Y-m-d')) {
        echo "<script>alert('End date cannot be in the future.'); window.location='sales_reports.php';</script>";
        exit;
    }

    // Fetch sales data
    $query = $conn->prepare("SELECT * FROM sales WHERE DATE(sale_date) BETWEEN ? AND ?");
    $query->bind_param('ss', $start_date, $end_date);
    $query->execute();
    $result = $query->get_result();

    if (isset($_GET['download'])) {
        // Create PDF
        $pdf = new FPDF();
        $pdf->AddPage();
        $pdf->SetFont('Arial', 'B', 16);
        $pdf->Cell(190, 10, 'Sales Report', 1, 1, 'C');

        // Customer Information
        $pdf->SetFont('Arial', '', 12);
        $pdf->Cell(190, 10, "Report Duration: $start_date to $end_date", 0, 1);
        $pdf->Ln();

        // Table Header
        $pdf->SetFont('Arial', 'B', 8);
        $pdf->Cell(30, 10, 'Order ID', 1);
        $pdf->Cell(30, 10, 'Customer', 1);
        $pdf->Cell(40, 10, 'Product', 1);
        $pdf->Cell(40, 10, 'Amount (in rupees)', 1);
        $pdf->Cell(40, 10, 'Date', 1);
        $pdf->Ln();

        // Table Data
        $pdf->SetFont('Arial', '', 8);
        while ($row = $result->fetch_assoc()) {
            $pdf->Cell(30, 10, $row['id'], 1);
            $pdf->Cell(30, 10, $row['customer_name'], 1);
            $pdf->Cell(40, 10, $row['product'], 1);
            $pdf->Cell(40, 10, number_format($row['total_amount'], 2), 1);
            $pdf->Cell(40, 10, $row['sale_date'], 1);
            $pdf->Ln();
        }

        $pdf->Output();
        exit;
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <title>Sales Reports</title>
    <link rel="stylesheet" href="../assets/css/style.css">
</head>
<body align="center">
    <?php include('../includes/admin_navbar.php'); ?>
    <h1>Sales Reports</h1>
    <form method="GET">
        <label>Start Date:</label>
        <input type="date" name="start_date" required max="<?= date('Y-m-d') ?>"><br><br>
        <label>End Date:</label>
        <input type="date" name="end_date" required max="<?= date('Y-m-d') ?>"><br><br>
        <button type="submit">Generate Report</button>
        <?php if (isset($_GET['start_date']) && isset($_GET['end_date'])) { ?>
            <a href="?start_date=<?= $start_date ?>&end_date=<?= $end_date ?>&download=true" class="btn">Download PDF</a>
        <?php } ?>
    </form>
<br><br><br><br>
    <!-- View PDF on Webpage -->
    <?php if (isset($_GET['start_date']) && isset($_GET['end_date'])) { ?>
        <h2>Sales Report Preview</h2>
        <iframe src="?start_date=<?= $start_date ?>&end_date=<?= $end_date ?>&download=true" width="100%" height="600px"></iframe>
    <?php } ?>
<br><br><br><br><br><br><br><br><br><br><br><br><br><br>
    <?php include('../includes/admin_footer.php'); ?>
</body>
</html>
