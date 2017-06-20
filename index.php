<?php
require_once 'Resources/PHP/model/config.php';

$request = $_REQUEST;
if (empty($request['request'])) {
    $request['request'] = $_SESSION['request'];
}
//? isset($_POST['case']) : array('case' => '');
//var_dump($request);

switch ($request['case']) {
    case 'login':

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $login = array( 'username' => $request['username'], 'password' => $request['password']);
            if (isset($login)) {
                $user = new DB_User();
                $check = $user->login($login['username'], $login['password']);
            }
            elseif (isset($login) && is_object($user)) {
                $check = $user->login($login['username'], $login['password']);
            }
            if(is_string($check)) {
                die($check);
            }
            if (is_object($user)) {
                $access = $user->checkLogin($check);
                if ($access === TRUE) {
                    $_SESSION['user'] = $login;
                    header('location: Resources/Private/layouts/dashboard.html');
                }
            }
        }
        break;

    case 'register':
        if (empty($_SESSION['request'])) {
            $_SESSION['request'] = $request;
            header('location: /Resources/Private/layout/register.html');
        }

        if (isset($request['request']) && !(isset($request['username']) && isset($request['password']) && isset($request['email']))) {
            $request = $_SESSION['request'];
        }

        if (isset($request['username'])&& $request['password'] && $request['email']) {
            $regist = array('username' => $request['username'], 'password' => $request['password'], 'email' => $request['email'],
                'first_name' => $request['first_name'], 'last_name' => $request['last_name'], 'adress' => $request['adress'],
                'PLZ' => $request['PLZ'], 'place' => $request['place'], 'birthday' => $request['birthday']);
            if (is_object($user)) {
                $fb = $user->registUser($regist);
            } else {
                $user = new DB_User();
                $fb = $user->registUser($regist);
            }
        }
        else {
            echo 'please set all fields';
        }

        break;

    default:
        header('location: Resources/Private/Layouts/main.html');
}


/*
include "Resources/PHP/model/database.php";


$user = 'frankb_7';
$pass = 'eB7NBTH1Xkt7Tamc';
$server = 'dedi3098.your-server.de';
$db = 'recordbook';


$connection = new database();
if($connection)
//$connection->deleteDatabase($server, $db, $user, $pass);
//$connection->createDatabase($server, $db, $user, $pass);
$connection->restoreTabels($server, $db, $user, $pass);*/
