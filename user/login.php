<?php
session_start();
include('../config/db.php');

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $username = $_POST['username'];
    $password = $_POST['password'];

    // Fetch the user from the database
    $query = $conn->prepare("SELECT * FROM users WHERE username = ?");
    $query->bind_param('s', $username);
    $query->execute();
    $result = $query->get_result();
    $user = $result->fetch_assoc();

    // Check if user exists and verify the password
    if ($user && password_verify($password, $user['password'])) {
        // Password is correct, create a session
        $_SESSION['username'] = $user['username'];
        header("Location: index.php");  // Redirect to a dashboard or home page
        exit;
    } else {
        $error = "Invalid username or password!";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - Janta Kulhad</title>
    <link rel="stylesheet" href="../assets/css/style.css">
</head>
<body>
    <nav class="navbar">
        <img src="../assets/images/logo.png" alt="Janta Kulhad Logo" class="logo">
        <ul class="nav-links">
            <li><a href="../index.php">Home</a></li>
        </ul>
    </nav>

    <section align="center">
        <h1>User Login</h1>

        <?php
        if (isset($error)) {
            echo "<p style='color:red;'>$error</p>";
        }
        ?>

        <form method="POST">
            <label>Username:</label>
            <input type="text" name="username" placeholder="Enter your username" autofocus required> <br> <br>

            <label>Password:</label>
            <input type="password" name="password" placeholder="Enter your password" required> <br> <br>

            <button type="submit">Login</button>
        </form>
    </section>
        <br> <br> <br> <br> <br> <br> <br> <br> <br> <br> <br> <br> <br> <br> <br> <br> <br>
    <?php include('../includes/footer.php'); ?>
</body>
</html>
