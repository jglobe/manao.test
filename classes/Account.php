<?php

class Account {
    static protected  $db_file = '../users.json';

    static function logout () {
        session_start();
        session_destroy();
        setcookie('PHPSESSID', '', time(), '/');
        return ['success'=>true];
    }
    static function getHash ($password) {
        return md5('соль'.$password);
    }
    static function authorize ($login,$password) {
        $results_array['success'] =  false;

        if (is_null($login)) {
            $results_array['errors']['auth_login'] = 'введите логин';
            //не будем заходить в базу если ввода логина нет
            return $results_array;
        }
        $results_array['errors']['auth_login'] = 'пользователь не найден';
        $db_users = json_decode(file_get_contents(self::$db_file));

        foreach ($db_users as $user) {
            if ($user->login === $login) {
                unset($results_array['errors']['auth_login']);
                //юзер найден, проверим пароль
                 if ($user->password === self::getHash($password)) {
                    $results_array['success'] = true;
                    $results_array['username'] = $user->username;
                } else {
                    $results_array['errors']['auth_password'] = 'неверный пароль';
                }
                break;
            } else {
                // не найден
                continue;
            }
        }

        return $results_array;
    }
}