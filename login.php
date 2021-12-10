<?php
if (isset($_COOKIE['PHPSESSID'])) {
    header('Location: index.php');
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
    <title>Manao test</title>
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
    <div class="header_user_block" style='display: <?php if($_SESSION['login']) echo "flex" ?>'>
        <p class="header_username">
            Hello,
            <?php if($_SESSION['login']) echo $_SESSION['login']; ?>
        </p>
        <span>|</span>
        <form action="actions/logout.php">
            <button id="logout_submit" form="logout_form" type="button">Выход</button>
        </form>
    </div>
    <div class="header_login" style='display: <?php if(!$_SESSION['login']) echo "flex" ?>'>
        <a href="login.php">Войти</a>
    </div>
</header>
<div class="page_content">
    <div class="authorization_block">
        <h3 class="title">Авторизация</h3>
        <form id="authorization_form">
            <div class="form_row">
                <p class="auth_login auth_error has-error"></p>
                <label for="authorization_login">Логин:</label>
                <input id="authorization_login" name="auth_login" type="text">
            </div>
            <div class="form_row">
                <p class="auth_password auth_error has-error"></p>
                <label for="authorization_pass">Пароль:</label>
                <input id="authorization_pass" name="auth_password" type="password">
            </div>
            <div class="form_row">
                <button id="authorization_submit" type="button">Войти</button>
            </div>
        </form>
    </div>
    <div class="registration_block">
        <h3 class="title">Регистрация</h3>
        <form id="registration_form" action="actions/registration.php">
            <div class="form_row">
                <p class="has-error reg_error login_error"></p>
                <label for="reg_login">Введите логин:</label>
                <input type="text" id="reg_login" name="reg_login">
            </div>
            <div class="form_row">
                <p class="has-error reg_error password_error"></p>
                <label for="reg_password">Введите пароль:</label>
                <input type="password" id="reg_password" name="reg_password">
            </div>
            <div class="form_row">
                <p class="has-error reg_error confirm_password_error"></p>
                <label for="reg_confirm_password">Повторите пароль:</label>
                <input type="password" id="reg_confirm_password" name="reg_confirm_password">
            </div>
            <div class="form_row">
                <p class="has-error reg_error email_error"></p>
                <label for="reg_email">Введите email:</label>
                <input type="email" id="reg_email" name="reg_email">
            </div>
            <div class="form_row">
                <p class="has-error reg_error username_error"></p>
                <label for="reg_username">Введите имя:</label>
                <input type="text" id="reg_username" name="reg_username">
            </div>
            <div class="form_row">
                <button type="button" id="registration_submit">Зарегистрироваться</button>
            </div>
        </form>
    </div>
</div>

<form style="display:none;" id="logout_form"></form>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
<script src="resources/scripts.js"></script>
</body>
</html>