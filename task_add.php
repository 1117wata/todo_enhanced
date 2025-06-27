<?php
session_start();
$pdo = new PDO('mysql:host=localhost;dbname=todo_db;charset=utf8', 'root', '');
 
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
 