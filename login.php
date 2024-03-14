<?php
session_start();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = $_POST['email'];
    $password = md5($_POST['pass']); // Hashing the password

    // Validate user credentials and set session variables upon successful login
    // You need to implement the logic to validate credentials against your database
    // For simplicity, let's assume a dummy admin user with email 'admin00@example.com' and password 'pas1'
    // Note: This is a placeholder, replace it with your actual database query
    if ($email === 'admin00@example.com' && $password === md5('pas1')) { // Compare hashed password
        $_SESSION['user'] = [
            'email' => $email,
            'role' => 'admin'
        ];
        header('Location: index.php');
        exit;
    } else {
        // Handle invalid credentials
        $error = "Invalid email or password";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
</head>
<body>
    <h1>Login</h1>
    <?php if (isset($error)): ?>
        <p><?php echo $error; ?></p>
    <?php endif; ?>
    <form action="" method="post">
        <input type="email" name="email" placeholder="Email" required>
        <input type="password" name="pass" placeholder="Password" required>
        <button type="submit">Login</button>
    </form>
</body>
</html>
