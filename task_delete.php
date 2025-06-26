<?php
session_start();
$pdo = new PDO('mysql:host=localhost;dbname=todo_db;charset=utf8', 'root', '');

$id = $_POST['id'] ?? null;
$user_id = $_SESSION['user_id'] ?? null;

if ($id && $user_id) {
    $pdo->exec("DELETE FROM todos WHERE id = '$id' AND user_id = '$user_id'");
    
} else {
    $_SESSION['flash'] = "⚠️ 削除に失敗しました。";
}

header("Location: index.php");
exit();
?>
