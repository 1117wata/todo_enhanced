<?php
session_start();
$pdo = new PDO('mysql:host=localhost;dbname=todo_db;charset=utf8', 'root', '');

if (!isset($_SESSION['user_id'])) {
    exit("ログインしてください");
}
$user_id = $_SESSION['user_id'];
$id = $_POST['id'] ?? null;
<<<<<<< HEAD
 
=======

>>>>>>> bbc9629baeb2188e20f865f7c3ec7f21235dac87
$status = isset($_POST['status']) ? 'done' : 'todo';

if ($id) {
    $sql = "UPDATE todos SET status = :status WHERE id = :id AND user_id = :uid";
    $stmt = $pdo->prepare($sql);
    $stmt->execute([
        ':status' => $status,
        ':id' => $id,
        ':uid' => $user_id
    ]);
}

header("Location: index.php");
exit();
?>
