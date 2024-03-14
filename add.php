<?php
// Start session
session_start();

// Check if user is logged in
if (!isset($_SESSION['user'])) {
    header('Location: login.php');
    exit;
}

$userRole = $_SESSION['user']['role'];

if ($userRole !== 'admin') {
    header('Location: unauthorized.php');
    exit;
}

$email = $_POST['email'];
$pass = md5($_POST['pass']);
$role = $_POST['role'] ? $_POST['role'] : 'guest';

require_once("./utils/tools.php");

$pdo = new PDO(
    "mysql:dbname=bdcc",
    "root",
    ""
);

$sql = "INSERT INTO users VALUES(NULL, '$email','$pass','$role')";
$stmt = $pdo->exec($sql);

header("location:/");
?>
