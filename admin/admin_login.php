<?php
session_start();
include('../config/db.php');

// Check if the admin is already logged in
if (isset($_SESSION['admin_logged_in']) && $_SESSION['admin_logged_in'] === true) {
    header('Location: index.php'); // Redirect to the admin dashboard
    exit;
}

// Initialize error variable
$error = "";

// Handle form submission
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $username = trim($_POST['username']);
    $password = trim($_POST['password']);

    if (empty($username) || empty($password)) {
        $error = "Please fill in all fields.";
    } else {
        // Validate admin credentials
        $query = $conn->prepare("SELECT * FROM admins WHERE username = ?");
        $query->bind_param('s', $username);
        $query->execute();
        $result = $query->get_result();

        if ($result->num_rows > 0) {
            $admin = $result->fetch_assoc();
            if (password_verify($password, $admin['password'])) {
                // Secure session handling
                session_regenerate_id(true);
                $_SESSION['admin_logged_in'] = true;
                $_SESSION['admin_id'] = $admin['id'];
                $_SESSION['admin_username'] = $admin['username'];

                // Redirect to admin dashboard
                header('Location: index.php');
                exit;
            } else {
                $error = "Invalid username or password.";
            }
        } else {
            $error = "Invalid username or password.";
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Login - Janta Kulhad</title>
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
        <h1>Admin Login</h1>
        <?php if (!empty($error)) { ?>
            <p class="error"><?php echo htmlspecialchars($error); ?></p>
        <?php } ?>
        <form action="" method="POST">
            <div class="form-group">
                <label for="username">Username: </label>
                <input type="text" name="username" id="username" placeholder="Enter your username" autofocus required> <br> <br>
            </div>
            <div class="form-group">
                <label for="password">Password: </label>
                <input type="password" name="password" id="password" placeholder="Enter your password" required> <br> <br>
            </div>
            <button type="submit" class="btn">Login</button>
        </form>
    </section>
    
    <br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br>
    <?php include('../includes/footer.php'); ?>
</body>
</html>
