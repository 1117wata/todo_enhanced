<?php
session_start();

$pdo = new PDO('mysql:host=localhost;dbname=todo_db;chareset=utf8','root','');
$sql = $pdo->prepare('SELECT * FROM users WHERE username = ?');
$sql->execute([$_POST['username']]);
$result = $sql->fetch(PDO::FETCH_ASSOC);

if($result && $_POST['pass'] === $result['password']){
    $update_sql = $pdo->prepare('UPDATE users SET created_at = NOW() WHERE id = ?');
    $update_sql->execute([$result['id']]);//ログイン時間更新

    $_SESSION['users'] = [
        'id' => $result['id'],
        'name' => $result['username'],
        'created_at' => date('y-m-d H:i:s')
    ];
    //ユーザー名をセッション
    $_SESSION['username'] = $result['username'];
    $_SESSION['user_id'] = $result['id'];

    header("Location: index.php");
    exit();
} else {
    echo "ログイン認証に失敗しました。<br>UsernameまたはPasswordが違います。";

}
?>
<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <form action="" method="post">
    <h1>ログイン</h1>
        ユーザー名:
        <input type="text" name="name" required><br>
        パスワード:
        <input type="password" name="pass" required><br>
        <input type="submit" value="ログイン"><br><br>
        <a href="register.php">新規登録</a>
    </form>
</body>
</html>