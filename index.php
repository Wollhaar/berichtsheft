<?php
require_once 'Resources/PHP/model/config.php';

$request = array('case' => '');
if(isset($_POST['username']) || isset($_GET['case'])) {
    $request = $_REQUEST;
//    echo 'post';
}
elseif (empty($session) && !isset($_POST)) {
    $session = $_SESSION;
//    echo 'session';
}
//var_dump($request);
/*
if ((isset($_SESSION['request']) || isset($_SESSION['user'])) && false) {
    var_dump($_SESSION);
}*/

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
//                    $_SESSION['case'] = 'case';
                    header('location: /Berichtsheft/Resources/Private/Layouts/dashboard.php');
                }
            }
        }
        break;

    case 'register':
        if (empty($_SESSION['request']) || !isset($request['ready'])) {
            $_SESSION['request'] = $request;
            header('location: /Berichtsheft/Resources/Private/Layouts/register.php');
        }

        if (isset($session) && !(isset($request['username']) && isset($request['password']) && isset($request['email']))) {
            $request = $_SESSION['request'];
        }

        if (isset($request['username'])&& $request['password'] && $request['email']) {
            $regist = array('username' => $request['username'], 'password' => $request['password'], 'email' => $request['email'],
                'first_name' => $request['first_name'], 'last_name' => $request['last_name'], 'adress' => $request['adress'],
                'PLZ' => $request['PLZ'], 'place' => $request['place'], 'birthday' => $request['birthday']);
            if (empty($user)) {
                $user = new DB_User();
                $fb = $user->registUser($regist);
            } else {
                $fb = $user->registUser($regist);
            }
            if ($fb['check'] === true) {
                $_SESSION['user'] = $fb;
                header('location: /Berichtsheft/Resources/Private/Layouts/dashboard.php');
            }
            else {
                die('Sorry, something went wrong. Please try again later. If you have time, give us feedback on david@exinit.de');
            }
        }
        else {
            echo 'please set all fields';
        }

        break;

    case 'logged':
        header('location: /Berichtsheft/Resources/Private/Layouts/dashboard.php');

        break;

    case 'profile':
        header('location: /Berichtsheft/Resources/Private/Layouts/account.php');
        break;

    default:
        header('location: Resources/Private/Layouts/main.php');
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
