<?php

session_start();

if (!isset($_SESSION['user'])) {
    header('Location: login.php');
    exit;
}


$userRole = $_SESSION['user']['role'];

if ($userRole !== 'admin') {
    header('Location: unauthorized.php');
    exit;
}

if (!isset($_GET['iddd']) || !is_numeric($_GET['iddd'])) {
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

$sql = "DELETE FROM users WHERE id = ?";
$stmt = $pdo->prepare($sql);
$stmt->execute([$id]);

header("Location: index.php");
exit;
?>
