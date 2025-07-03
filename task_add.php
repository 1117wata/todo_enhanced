<?php
session_start(); 
$pdo = new PDO('mysql:host=mysql304.phy.lolipop.lan;dbname=LAA1602730-php2024;charset=utf8', 'LAA1602730', 'Watabeno1417');
 
$user_id = $_SESSION['user_id'];
$task = $_POST['task'];
$duedate = $_POST['duedate'];
$priority = $_POST['priority'];
if (empty($task) || empty($duedate)) {
    echo "タスク名と期限を入力してください";
    exit();
}
 
$sql = "INSERT INTO todos (user_id, task, status, due_date, priority, created_at)
        VALUES ('$user_id', '$task', 'todo', '$duedate', '$priority', NOW())";
$pdo->exec($sql);
header("Location: index.php");
exit();
?>
 