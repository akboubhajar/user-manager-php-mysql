<?php
// Start session
session_start();

// Check if user is logged in
if (!isset($_SESSION['user'])) {
    header('Location: login.php');
    exit;
}

// Check user role
$userRole = $_SESSION['user']['role'];

// Only allow access to authorized roles
if ($userRole !== 'admin') {
    header('Location: unauthorized.php');
    exit;
}

// Check if id is provided and valid
if (!isset($_GET['iddd']) || !is_numeric($_GET['iddd'])) {
    // Handle invalid input
    echo "Invalid user ID";
    exit;
}

$id = $_GET['iddd'];

require_once("./utils/tools.php");

$pdo = new PDO(
    "mysql:dbname=bdcc",
    "root",
    ""
);

// Prepare and execute the DELETE query with parameter binding
$sql = "DELETE FROM users WHERE id = ?";
$stmt = $pdo->prepare($sql);
$stmt->execute([$id]);

// Redirect back to index.php after deleting the user
header("Location: index.php");
exit;
?>
