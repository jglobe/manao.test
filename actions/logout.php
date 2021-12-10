<?php
    require "../classes/Account.php";
    header('Content-Type: application/json');

    if(isset($_SERVER['HTTP_X_REQUESTED_WITH']) && !empty($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest') {
        //идёт Ajax
        $result = Account::logout();
        echo json_encode($result);
    } else {
        exit();
    }




