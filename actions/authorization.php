<?php
    require "../classes/Account.php";
    header('Content-Type: application/json');

    if(isset($_SERVER['HTTP_X_REQUESTED_WITH']) && !empty($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest') {
        //идёт Ajax
        $login = $_REQUEST['auth_login']? $_REQUEST['auth_login'] : null;
        $password = $_REQUEST['auth_password']? $_REQUEST['auth_password'] : null;
    } else {
        // если это не Ajax дальше не выполняем
        exit();
    }

    $result = Account::authorize($login,$password);

    if ($result['success']){
        session_start();
        $_SESSION ['username']= $result['username'];
    }
    echo json_encode($result);



