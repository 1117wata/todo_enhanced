<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>タスク編集</title>
</head>
<body>
    <h1>タスク編集</h1>
    内容:<input type="text" name="content"><br>
    期限:<input type="datetime-local" name="duedate"><br>
    優先度:
    <select name="priority">
        <option value="low">低</option>
        <option value="medium">中</option>
        <option value="high">高</option>
    </select><br>
    状態:
    <select name="priority">
        <option value="incomplete">未完了</option>
        <option value="complete">完了</option>
    </select><br>
    <input type="submit" value="保存">
    <a href="index.php">キャンセル</a>
</body>
</html>