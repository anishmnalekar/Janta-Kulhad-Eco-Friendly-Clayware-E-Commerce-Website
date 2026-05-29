<?php
session_start();
include('../config/db.php'); // Database connection

// Check if the admin is logged in
if (!isset($_SESSION['admin_logged_in']) || $_SESSION['admin_logged_in'] !== true) {
    header("Location: admin_login.php");
    exit;
}

// Fetch all challans
$query = "SELECT * FROM challans ORDER BY created_at DESC"; // Adjust according to your table structure
$result = $conn->query($query);

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>View Challans - Janta Kulhad</title>
    <link rel="stylesheet" href="../assets/css/style.css">
</head>
<body>
    <?php include('../includes/admin_navbar.php'); ?>

    <h1 align="center">View Challans</h1>

    <table align="center" border="1">
        <thead>
            <tr>
                <th>Challan ID</th>
                <th>Buyer Name</th>
                <th>Buyer Contact</th>
                <th>Total Amount</th>
                <th>Created At</th>
            </tr>
        </thead>
        <tbody>
            <?php while ($row = $result->fetch_assoc()) { ?>
                <tr>
                    <td><?= $row['id'] ?></td>
                    <td><?= htmlspecialchars($row['buyer_name']) ?></td>
                    <td><?= htmlspecialchars($row['buyer_contact']) ?></td>
                    <td><?= htmlspecialchars($row['total_amount']) ?></td>
                    <td><?= htmlspecialchars($row['created_at']) ?></td>
                </tr>
            <?php } ?>
        </tbody>
    </table>

    <br><br>
    <?php include('../includes/admin_footer.php'); ?>
</body>
</html>
