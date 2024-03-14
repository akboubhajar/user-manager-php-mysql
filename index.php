<?php
// Start session
session_start();

// Check if user is logged in
if (!isset($_SESSION['user'])) {
    // Redirect to the login page or handle unauthorized access
    header('Location: login.php');
    exit;
}

// Now we assume the user is logged in
// You can retrieve user role and other necessary info from the session if needed

require_once("./utils/tools.php");

$pdo = new PDO(
    "mysql:dbname=bdcc",
    "root",
    ""
);

$sql = "SELECT * FROM users";
$stmt = $pdo->query($sql);

$users = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Manager</title>
    <link rel="stylesheet" href="https://bootswatch.com/5/cerulean/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.2/font/bootstrap-icons.min.css">
</head>
<body>
    <div class="container">
        <h1>User Manager</h1>
        <table class="table table-stripped table-bordered align-middle">
            <thead class="table-dark">
                <tr>
                    <th>ID</th>
                    <th>MAIL</th>
                    <th>PASSWORD</th>
                    <th>ROLE</th>
                    <th></th>
                    <th></th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($users as $user): ?>
                    <tr>
                        <td class="text-center"><?= $user['id'] ?></td>
                        <td><?= $user['email'] ?></td>
                        <td><?= $user['password'] ?></td>
                        <td><?= $user['role'] ?></td>
                        <td class="text-center">
                            <a onclick="valider(event)" href="del.php?iddd=<?= $user['id'] ?>" class="btn btn-outline-danger text-center"><i class="bi bi-trash"></i></a>
                        </td>
                        <td class="text-center">
                            <a href="edit.php?id=<?= $user['id'] ?>" class="btn btn-outline-primary text-center"><i class="bi bi-pencil"></i></a>
                        </td>
                    </tr>
                <?php endforeach ?>
            </tbody>
        </table>
    </div>
    <script>
        function valider(evt) {
            evt.preventDefault();
            if (confirm('Are you sure you want to delete this user?')) {
                location.href = evt.target.href;
            }
        }
    </script>
</body>
</html>
