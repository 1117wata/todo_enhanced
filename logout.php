<?php
session_start(); //セッション開始

//セッション変数を全て解除
$_SESSION = array();

//セッションの破棄
session_destroy();

//ログインページやトップページへリダイレクト
header("Location: login.php");
exit;
?>