<?php
session_start();
$pdo = new PDO('mysql:host=localhost;dbname=todo_db;charset=utf8', 'root', '');
$user_id = $_SESSION['user_id'] ?? 1; // テスト用に仮ユーザーIDも設定

// タスク一覧を取得
$sql = "SELECT * FROM todos WHERE user_id = $user_id ORDER BY due_date ASC";
$tasks = $pdo->query($sql)->fetchAll(PDO::FETCH_ASSOC);
?>

<!-- HTML部分 -->
<!DOCTYPE html>
<html lang="ja">
<head>
  <meta charset="UTF-8">
  <title>タスク管理</title>
</head>
<body>
  <h1>Todoリスト</h1>
    <p>ログイン者名 <a href="logout.php">ログアウト</a></p>
    <!-- タスク追加 -->
    <form action="./task_add.php" method="post">
        <article> 
            <h2>タスク追加</h2>
                <input type="text" name="task" placeholder="タスク内容">
                <input type="date" name="duedate">
                <select name="priority">
                    <option value="low">優先度（低）</option>
                    <option value="medium">中</option>
                    <option value="high">高</option>
                </select>
            <input type="submit" name="add" value="追加">
     </article>
    </form>
     <article>
        <!-- フィルタ/検索 -->
        <h2>フィルタ / 検索</h2> 
            <input type="text" name="task" placeholder="キーワード">
            <select name="datetime">
                <option value="alltime">すべて</option> 
            </select>
            <select name="priority">
                <option value="all">優先度（全て）</option>
                <option value="low">低</option>
                <option value="medium">中</option>
                <option value="high">高</option>
            </select>
            <input type="submit" name="search" value="適用">
     </article>

<div class="task-list">
  <?php foreach ($tasks as $task): ?>
    <div class="task-item">
      <p>状態: <input type="checkbox" <?= htmlspecialchars($task['status']) ?>></p>
      <p>タスク：<?= htmlspecialchars($task['task']) ?></p>
      <p>期限：<?= htmlspecialchars($task['due_date']) ?></p>
      <p>優先度：<?= htmlspecialchars($task['priority']) ?></p>
      <p>
        操作:
        <a href="task_edit.php?id=<?= $task['id'] ?>">編集</a> /
        <a href="task_delete.php?id=<?= $task['id'] ?>" onclick="return confirm('削除しますか？');">削除</a>
      </p>
    </div>
  <?php endforeach; ?>
</div>



</div>

</body>
</html>
