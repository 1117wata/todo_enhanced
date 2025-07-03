<?php
//　セッション開始
session_start();

//　データベース接続情報
$pdo = new PDO('mysql:host=mysql304.phy.lolipop.lan;dbname=LAA1602730-php2024;charset=utf8', 'LAA1602730', 'Watabeno1417');
 
// ログイン中のユーザーIDをセッションから取得
$user_id = $_SESSION['user_id'] ?? null;

//POST処理（フォームに入力した値でDBを更新して index.phpに戻る）
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // フォームから受け取る値（タスクID・内容・期限・優先度）
    $id = $_POST['id'] ?? null;
    $task = $_POST['task'] ?? '';
    $due_date = $_POST['due_date'] ?? '';
    $priority = $_POST['priority'] ?? 0;
    $status = $_POST['status'] ?? 'todo';

    // IDとユーザーIDがある場合のみ更新処理を行う
    if ($id && $user_id) {
        // UPDATE文
        $stmt = $pdo->prepare("UPDATE todos SET task = :task, due_date = :duedate,
         priority = :priority, status = :status WHERE id = :id AND user_id = :user_id");

        $stmt->execute([
            ':task' => $task,
            ':duedate' => $due_date,
            ':priority' => $priority,
            ':status' => $status,
            ':id' => $id,
            ':user_id' => $user_id
        ]);

        //更新後は index.phpにリダイレクト
        header("Location: index.php");
        exit();
    }
}

// 編集するタスクのIDをURLパラメータから取得
$id = $_GET['id'] ?? null;

// IDまたはログイン情報がなければエラー扱いでリダイレクト
if (!$id || !$user_id) {
    $_SESSION['flash'] = "⚠️ 編集対象が見つかりません。";
    header("Location: index.php");
    exit();
}

// 該当タスクをDBから取得（ログイン中のタスクしか取得できないように'user_id'も条件に)
$stmt = $pdo->prepare("SELECT * FROM todos WHERE id = :id AND user_id = :user_id");
$stmt->execute([':id' => $id, ':user_id' => $user_id]);
$taskData = $stmt->fetch(PDO::FETCH_ASSOC);

// タスクが存在しない場合リダイレクト
if (!$taskData) {
    $_SESSION['flash'] = "⚠️ 編集対象が見つかりません。";
    header("Location: index.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>タスク編集</title>
    <link rel = "stylesheet" href="style.css">
</head>
<body>
    <h1>タスク編集</h1>
    
    <form method="post" action="task_edit.php">
        <input type="hidden" name="id" value="<?= htmlspecialchars($taskData['id']) ?>">
        <div>
            <label>タスク内容：
                <input type="text" name="task" value="<?= htmlspecialchars($taskData['task']) ?>"required>
            </label>
        </div>
        <div>
            <label>期限：
                <input type="date" name="due_date" value="<?= htmlspecialchars($taskData['due_date']) ?>"required>
            </label>
        </div>
        <div>
            <label>優先度：
                <select name="priority">
                    <option value="0"<?=$taskData['priority'] == 0 ? 'selected' : ''?>>低</option>
                    <option value="1"<?=$taskData['priority'] == 1 ? 'selected' : ''?>>中</option>
                    <option value="2"<?=$taskData['priority'] == 2 ? 'selected' : ''?>>高</option>
                </select>
            </label>
        </div>
        <div>
            <label>状態：
                <select name="status">
                    <option value="todo" <?=$taskData['status'] === 'todo' ? 'selected' : '' ?>>未完了</option>
                    <option value="done" <?=$taskData['status'] === 'done' ? 'selected' : '' ?>>完了</option>
                </select>
            </label>
        </div>
        <div>
            <button type="submit">保存</button>
            <a href="index.php">キャンセル</a>
        </div>
    </form>
</body>
</html>