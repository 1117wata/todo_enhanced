<?php
session_start();
$pdo = new PDO('mysql:host=mysql304.phy.lolipop.lan;dbname=LAA1602730-php2024;charset=utf8', 'LAA1602730', 'Watabeno1417');

if (!isset($_SESSION['user_id'])) {
    exit("ログインしてください");
}
$user_id = $_SESSION['user_id'];
$id = $_POST['id'] ?? null;
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
