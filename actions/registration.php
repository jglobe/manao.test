<?php
    require "../classes/User.php";
    header('Content-Type: application/json');

    if(isset($_SERVER['HTTP_X_REQUESTED_WITH']) && !empty($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest') {
        //идёт Ajax
        $login = $_REQUEST['reg_login']? $_REQUEST['reg_login'] : null;
        $password = $_REQUEST['reg_password']? $_REQUEST['reg_password'] : null;
        $confirm_password = $_REQUEST['reg_confirm_password']? $_REQUEST['reg_confirm_password'] : null;
        $email = $_REQUEST['reg_email']? $_REQUEST['reg_email'] : null;
        $username = $_REQUEST['reg_username']? $_REQUEST['reg_username'] : null;
    } else {
        // если это не Ajax дальше не выполняем
        exit();
    }

    $result = User::create($login,$password,$confirm_password,$email,$username);

    if ($result['success']){
        session_start();
        $_SESSION ['username']= $result['username'];
    }

    echo json_encode($result);