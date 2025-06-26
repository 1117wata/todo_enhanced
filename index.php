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
  <link rel="stylesheet" href="style.css">
</head>
<body>
  <h1>Todoリスト</h1>
    <div class="login">
      <?php if(isset($_SESSION['username'])): ?>
        <p><?= htmlspecialchars($_SESSION['username']) ?>さん　
        <a href="logout.php">ログアウト</a></p>
        <?php else: ?>
        <p>ログインしていません。
        <a href="login.php">ログイン</a></p>
      <?php endif; ?>
    </div>
    <!-- タスク追加 -->
    <form action="./task_add.php" method="post">
        <article> 
          <div class="index">
            <h2>タスク追加</h2>
                <input type="text" name="task" placeholder="タスク内容">
                <input type="date" name="duedate">
                <select name="priority">
                    <option value="0">優先度（低）</option>
                    <option value="1">中</option>
                    <option value="2">高</option>
                </select>
            <input type="submit" name="add" value="追加">
          </div>
     </article>
    </form>
      <?php
        $where = "user_id = :user_id";
        $params = [':user_id' => $user_id];
 
      function priorityLabel($val) {
        return [
        0 => '低',
        1 => '中',
        2 => '高'
        ][$val] ?? '？';
        }
 
 
if (!empty($_GET['task'])) {
    $where .= " AND task LIKE :task";
    $params[':task'] = '%' . $_GET['task'] . '%';
}
if (!empty($_GET['status']) && $_GET['status'] !== 'all') {
    $where .= " AND status = :status";
    $params[':status'] = $_GET['status'];
}
if (!empty($_GET['priority']) && $_GET['priority'] !== 'all') {
    $where .= " AND priority = :priority";
    $params[':priority'] = $_GET['priority'];
}
 
  $sql = "SELECT * FROM todos WHERE $where ORDER BY due_date ASC";
  $stmt = $pdo->prepare($sql);
  $stmt->execute($params);
  $tasks = $stmt->fetchAll(PDO::FETCH_ASSOC);
  ?>
     <article>
          <div class="index">
        <!-- フィルタ/検索 -->
        <h2>フィルタ / 検索</h2>
    <form method="get" action="index.php">
  <input type="text" name="task" placeholder="キーワード" value="<?= htmlspecialchars($_GET['task'] ?? '') ?>">
 
  <select name="status">
    <option value="all">すべて</option>
      <option value="todo" <?= ($_GET['status'] ?? '') === 'todo' ? 'selected' : '' ?>>未完了</option>
      <option value="done" <?= ($_GET['status'] ?? '') === 'done' ? 'selected' : '' ?>>完了</option>
   
</select>
<select name="priority">
  <option value="0">優先度(低)</option>
  <option value="1">中</option>
  <option value="2">高</option>
</select>
 
 
  <input type="submit" value="適用">
</form>
          </div>
     </article>

  <div class="task-box">
  <div class="task-header">
    <div>状態</div>
    <div>タスク</div>
    <div>期限</div>
    <div>優先度</div>
    <div>操作</div>
  </div>

  <div class="task-list">
    <?php foreach ($tasks as $task): ?>
      <div class="task-item">
        <div>
          <form method="post" action="task_toggle.php">
            <input type="hidden" name="id" value="<?= $task['id'] ?>">
            <input type="checkbox" name="status" onchange="this.form.submit()" <?= $task['status'] === 'done' ? 'checked' : '' ?>>
          </form>
        </div>
        <div><?= htmlspecialchars($task['task']) ?></div>
        <div><?= htmlspecialchars($task['due_date']) ?></div>
        <div><?= priorityLabel($task['priority']) ?></div>
        <div>
          <a href="task_edit.php?id=<?= $task['id'] ?>">編集</a> /
          <a href="task_delete.php?id=<?= $task['id'] ?>" onclick="return confirm('削除しますか？');">削除</a>
        </div>
      </div>
    <?php endforeach; ?>
  </div>
</div>


</body>
</html>