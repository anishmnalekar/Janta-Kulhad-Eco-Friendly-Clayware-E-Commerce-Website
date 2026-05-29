<?php
include('../config/db.php');

// Set default admin credentials
$username = "admin";
$password = password_hash("admin123", PASSWORD_DEFAULT); // Hash the password

// Insert the admin account into the database
$query = $conn->prepare("INSERT INTO admins (username, password) VALUES (?, ?)");
$query->bind_param('ss', $username, $password);

if ($query->execute()) {
    echo "Admin account created successfully!";
} else {
    echo "Failed to create admin account!";
}
?>
