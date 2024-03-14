<?php
$id = $_POST['iddd'];
$email = $_POST['email'];
$pass = md5($_POST['pass']);
$role = $_POST['role'];

$pdo = new PDO(
    "mysql:dbname=bdcc",
    "root",
    ""
);

$sql = "UPDATE users SET email=?,password=?, role=? WHERE id=? ";
$stmt = $pdo->prepare($sql);

$stmt->bindValue(1, $email, PDO::PARAM_STR);
$stmt->bindValue(2, $pass, PDO::PARAM_STR);
$stmt->bindValue(3, $role, PDO::PARAM_STR);
$stmt->bindValue(4, $id, PDO::PARAM_INT);
$stmt->execute();



header('location:/')
?>