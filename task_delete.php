<?php
session_start();
$pdo = new PDO('mysql:host=localhost;dbname=todo_db;charset=utf8', 'root', '');
 
$id = $_POST['id'] ?? $_GET['id'] ?? null; // ← GETからも受け取るようにした
$user_id = $_SESSION['user_id'] ?? null;
 
if ($id && $user_id) {
    $stmt = $pdo->prepare("DELETE FROM todos WHERE id = :id AND user_id = :user_id");
    $stmt->execute([':id' => $id, ':user_id' => $user_id]);
} else {
    $_SESSION['flash'] = "⚠️ 削除に失敗しました。";
}
 
header("Location: index.php");
exit();
?>
 
 