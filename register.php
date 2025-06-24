<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <title>ユーザ登録</title>
</head>
<body>
    <h1>ユーザ登録</h1>

    <form action="" method="post">
        ユーザー名: <input type="text" name="username"><br>
        パスワード: <input type="password" name="password"><br>
        <input type="submit" value="登録">
    </form>

    
<?php
if (!empty($_POST['username']) && !empty($_POST['password'])) {
    $username = $_POST['username'];
    $password = $_POST['password'];

    try {
        $pdo = new PDO('mysql:host=localhost;dbname=todo_db;charset=utf8', 'root', '');
        $sql = $pdo->prepare('INSERT INTO users (username, password) VALUES (?, ?)');
        $sql->execute([$username, $password]);
         header('Location: login.php');
        exit;
    } catch (PDOException $e) {
        echo 'DBエラー：' . $e->getMessage();
    }
}
?>

<p>
    <a href="login.php">ログインはこちら</a>
</p>

</body>
</html>
