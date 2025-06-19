<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Todoリスト</title>
</head>
<body>
    <h1>Todoリスト</h1>
    <article><!-- タスク追加 -->
        <h2>タスク追加</h2>
            <input type="text" name="task">
            <input type="datetime-local" name="duedate">
            <select name="priority" size="3">
                <option value="low">優先度（低）</option>
                <option value="medium">中</option>
                <option value="high">高</option>
            </select>
            <input type="submit" name="add" value="追加">
     </article>
     <article>
        <h2>フィルタ / 検索</h2>
            <input type="text" name="task" placeholder="タスク内容">
            <input type="datetime-local" name="duedate">
            <select name="priority" size="3">
                <option value="low">優先度（低）</option>
                <option value="medium">中</option>
                <option value="high">高</option>
            </select>
            <input type="submit" name="add" value="追加">
     </article>
</body>
</html>