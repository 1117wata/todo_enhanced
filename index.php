<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Todoリスト</title>
</head>
<body>
    <h1>Todoリスト</h1>
    <p>ログイン者名 <a href="logout.php">ログアウト</a></p>
    <!-- タスク追加 -->
    <form action="./task_add.php" method="post">
        <article> 
            <h2>タスク追加</h2>
                <input type="text" name="task" placeholder="タスク内容">
                <input type="date" name="duedata">
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
     <?php 
        //データベース接続情報

        try {
            //データベース接続
            $pdo = new PDO("mysql:host=localhost;dbname=todo_db;charset=utf8",'root','');

             //SQL文
             $sql = "SELECT * FROM todos";
             $stmt = $pdo->query($sql);

             //データ表示
             while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                echo '状態: <input type="checkbox" name="check"><br>';
                echo 'タスク: ' . htmlspecialchars($row['task']) . '<br>';
                echo '期限: ' . htmlspecialchars($row['due_date']) . '<br>';
                echo '優先度: ' . htmlspecialchars($row['priority']) . '<br>';
                echo '操作: <a href="./task_edit.php?id=' . $row['id'] . '">編集</a> ';
                echo '<a href="./task_delete.php?id=' . $row['id'] . '">削除</a><br><hr>';
            }
        } catch (PDOException $e) {
            echo '接続エラー: ' . $e->getMessage();
        }
    ?>
</body>
</html>