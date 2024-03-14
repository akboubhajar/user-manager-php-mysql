<?php
// Start session
session_start();

// Check if user is logged in
if (!isset($_SESSION['user'])) {
    // Redirect to the login page or handle unauthorized access
    header('Location: login.php');
    exit;
}

// Retrieve user role from session
$userRole = isset($_SESSION['user']['role']) ? $_SESSION['user']['role'] : null;

// Now you can use $userRole variable in your code as needed

require_once("./utils/tools.php");

$id = $_GET['id'];
$pdo = new PDO(
    "mysql:dbname=bdcc",
    "root",
    ""
);

$sql = "SELECT * FROM users WHERE id=?";
$stmt = $pdo->prepare($sql);

$stmt->bindValue(1, $id, PDO::PARAM_INT);
$stmt->execute();

$user = $stmt->fetch(PDO::FETCH_ASSOC);

if (!$user) {
    header('location: /');
    exit;
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Handle form submission
    $email = $_POST['email'];
    $password = $_POST['pass'];
    $role = $_POST['role'];

    $sql = "UPDATE users SET email=?, password=?, role=? WHERE id=?";
    $stmt = $pdo->prepare($sql);
    $stmt->execute([$email, $password, $role, $id]);

    header('Location: index.php');
    exit;
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit User</title>
    <link rel="stylesheet" href="https://bootswatch.com/5/cerulean/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.2/font/bootstrap-icons.min.css">
</head>
<body>
    <div class="container">
        <h1>Edit User</h1>
        <form action="edit.php?id=<?= $id ?>" method="post">
            <input type="email" name="email" placeholder="Email" class="form-control mb-3" value="<?= $user['email'] ?>" required>
            <input type="password" name="pass" placeholder="Password" class="form-control mb-3" value="<?= $user['password'] ?>" required>
            <select name="role" class="form-select mb-3">
                <option value="">Select a role</option>
                <option value="admin" <?= $user['role'] === 'admin' ? 'selected' : '' ?>>Admin</option>
                <option value="author" <?= $user['role'] === 'author' ? 'selected' : '' ?>>Author</option>
                <option value="editor" <?= $user['role'] === 'editor' ? 'selected' : '' ?>>Editor</option>
                <option value="guest" <?= $user['role'] === 'guest' ? 'selected' : '' ?>>Guest</option>
            </select>
            <button class="btn btn-outline-primary mb-4 d-block w-100">Submit</button>
        </form>
    </div>
</body>
</html>
