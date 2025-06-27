<?php
<<<<<<< HEAD
session_start();
=======
session_start(); 
>>>>>>> bbc9629baeb2188e20f865f7c3ec7f21235dac87
$pdo = new PDO('mysql:host=localhost;dbname=todo_db;charset=utf8', 'root', '');
 
$user_id = $_SESSION['user_id'];
$task = $_POST['task'];
$duedate = $_POST['duedate'];
$priority = $_POST['priority'];
<<<<<<< HEAD
 
=======

>>>>>>> bbc9629baeb2188e20f865f7c3ec7f21235dac87
if (empty($task) || empty($duedate)) {
    echo "タスク名と期限を入力してください";
    exit();
}
 
$sql = "INSERT INTO todos (user_id, task, status, due_date, priority, created_at)
        VALUES ('$user_id', '$task', 'todo', '$duedate', '$priority', NOW())";
<<<<<<< HEAD
 
=======

>>>>>>> bbc9629baeb2188e20f865f7c3ec7f21235dac87
$pdo->exec($sql);
header("Location: index.php");
exit();
?>
 