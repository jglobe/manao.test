<?php
if (isset($_COOKIE['PHPSESSID'])) {
    session_start();
} else {
    header('Location: login.php');
    exit();
}
?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>ТЗ</title>
    <link rel="stylesheet" href="resources/style.css">
</head>
<body>
<header class="header">
    <div class="header_nav_block">
        <ul>
            <li><a href="index.php">Page1</a></li>
            <li><a href="page2.php">Page2</a></li>
        </ul>
    </div>
    <div class="header_user_block" style='display: <?php if($_SESSION['username']) echo "flex" ?>'>
        <p class="header_username">
            Hello,
            <?php if($_SESSION['username']) echo $_SESSION['username']; ?>
        </p>
        <span>|</span>
        <form action="actions/logout.php">
            <button id="logout_submit" form="logout_form" type="button">Выход</button>
        </form>
    </div>
    <div class="header_login" style='display: <?php if(!$_SESSION['username']) echo "flex" ?>'>
        <a href="login.php">Войти</a>
    </div>
</header>
<div class="page_content">
    <h3 class="title">Page2</h3>
    <p class="description">видна авторизированным пользователям</p>
</div>

<form style="display:none;" id="logout_form"></form>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
<script src="resources/scripts.js"></script>
</body>
</html>
