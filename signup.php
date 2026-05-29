<?php
include('config/db.php');

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $username = $_POST['username'];
    $email = $_POST['email'];  // Add email
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT); // Hash the password before storing

    // Check if the username already exists
    $check_query = $conn->prepare("SELECT * FROM users WHERE username = ?");
    $check_query->bind_param('s', $username);
    $check_query->execute();
    $check_result = $check_query->get_result();

    if ($check_result->num_rows > 0) {
        $error = "Username already exists. Please choose another.";
    } else {
        // Insert new user into the database, including the hashed password
        $query = $conn->prepare("INSERT INTO users (username, email, password) VALUES (?, ?, ?)");
        $query->bind_param('sss', $username, $email, $password);

        if ($query->execute()) {
            $success = "Signup successful! You can now log in.";
        } else {
            $error = "Signup failed! Please try again.";
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Signup - Janta Kulhad</title>
    <link rel="stylesheet" href="assets/css/style.css">
</head>
<body>
    <nav class="navbar">
        <img src="assets/images/logo.png" alt="Janta Kulhad Logo" class="logo">
        <ul class="nav-links">
            <li><a href="index.php">Home</a></li>
            <li><a href="about.php">About Us</a></li>
            <li><a href="gallery.php">Gallery</a></li>
            <li><a href="contact.php">Contact Us</a></li>
        </ul>
    </nav>

    <section align="center">
        <h1>Sign Up</h1>
        <?php if (isset($error)) { ?>
            <p class="error"><?php echo $error; ?></p>
        <?php } ?>
        <?php if (isset($success)) { ?>
            <p class="success"><?php echo $success; ?></p>
        <?php } ?>
        <form method="POST">
             <label>Email ID: &nbsp;</label>
             <input type="email" name="email" placeholder="Enter your Email ID" autofocus required> <br><br>
             <label>Username:</label>
             <input type="text" name="username" placeholder="Enter username" required> <br><br>   
             <label>Password:</label>
             <input type="password" name="password" placeholder="Enter password" required> <br><br>
             <button type="submit">Sign Up</button>
        </form>

    </section>
	<br> <br> <br> <br> <br> <br> <br> <br> <br> <br> <br> <br> <br> <br> <br>
    <?php include('includes/footer.php'); ?>
</body>
</html>
