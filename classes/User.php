<?php
    require "../classes/Account.php";
    class User {
        static protected  $db_file = '../users.json';

        static function create ($login,$password,$confirm_password,$email,$username) {
            //базу берем сразу, нужна для валидации
            $db_users = json_decode(file_get_contents(self::$db_file));
            $validate_errors = self::validate($login,$password,$confirm_password,$email,$username,$db_users);

            if (count($validate_errors)>0) {
                return ['success'=>false, 'errors'=>$validate_errors];
            }
            // если валидация прошла успешно, то массив $validate_errors пустой
            $user_data = (object)[
                "login"=>$login,
                "password"=> Account::getHash($password),
                "email"=>$email,
                "username"=>$username
            ];

            $db_users [] = $user_data;
            file_put_contents(self::$db_file, json_encode($db_users));
            return ['success'=>true, 'login'=>$login];
        }
        static function alreadyUsedLogin ($db_users,$login) {
            foreach ($db_users as $db_user) {
                if ($db_user->login === $login) {
                    return true;
                }
            }
            return false;
        }
        static function alreadyUsedEmail ($db_users,$email) {
            foreach ($db_users as $db_user) {
                if ($db_user->email === $email) {
                    return true;
                }
            }
            return false;
        }
        static function validate($login,$password,$confirm_password,$email,$username,$db_users) {
            $login_error = null;
            $password_error = null;
            $confirm_password_error = null;
            $email_error = null;
            $username_error = null;
            $results_validation = [];
            // валидируем по порядку
            if (is_null($login)) {
                $login_error = 'введите логин';
            }elseif (strlen($login)<6) {
                $login_error = 'логин должен содержать 6 и более символов';
            } elseif (preg_match('% +%', $login )) {
                $login_error = 'логин не должен содержать пробельных символов';
            } elseif (self::alreadyUsedLogin($db_users,$login)) {
                $login_error = 'данный логин уже используется';
            }

            if (is_null($password)) {
                $password_error = 'введите пароль';
            } elseif (strlen($password) < 6) {
                $password_error = 'пароль должен содержать 6 и более символов';
            } elseif (!preg_match('/\d/', $password)) {
                $password_error = 'пароль должен содержать хотябы одну цифру';
            } elseif (!preg_match('/\D/', $password)) {
                $password_error = 'пароль должен содержать хотябы одну букву';
            } elseif (preg_match('% +%', $password)) {
                $password_error = 'пароль не должен содержать пробельных символов';
            }

            if (is_null($confirm_password)) {
                $confirm_password_error = 'повторите пароль';
            }elseif ($confirm_password != $password) {
                $confirm_password_error = 'пароли не совпадают';
            }

            if (is_null($email)) {
                $email_error = 'введите email';
            }elseif (!preg_match('%[_a-z0-9-]{4,}@[a-z0-9-]{2,}+\.[a-z0-9-]{2,}%',$email)) {
                $email_error = 'введите корректный email. пример: email123@example.com';
            } elseif (preg_match('% +%', $email)) {
                $email_error = 'email не должен содержать пробельных символов';
            } elseif (self::alreadyUsedEmail($db_users,$email)) {
                $email_error = 'данный email уже используется';
            }

            if (is_null($username)){
                $username_error = 'введите имя';
            } elseif (preg_match('/[0-9]/', $username)) {
                $username_error = 'в имени не должно быть цифр';
            } elseif (strlen($username)<2) {
                $username_error = 'имя должно быть более 2х символов';
            } elseif (preg_match('% +%', $username)) {
                $username_error = 'имя не должно содержать пробельных символов';
            }

            // соберем ошибки
            if (!is_null($login_error))  $results_validation ['login_error'] = $login_error;
            if (!is_null($password_error))  $results_validation ['password_error'] = $password_error;
            if (!is_null($confirm_password_error))  $results_validation ['confirm_password_error'] = $confirm_password_error;
            if (!is_null($email_error))  $results_validation ['email_error'] = $email_error;
            if (!is_null($username_error))  $results_validation ['username_error'] = $username_error;

            return $results_validation;
        }
    }