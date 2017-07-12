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


switch ($request['case']) {
    case 'login':

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $login = array('username' => $request['username'], 'password' => $request['password']);
            if (isset($login) && empty($user)) {
                $user = new DB_User();
                $check = $user->login($login['username'], $login['password']);
            } elseif (isset($login) && is_object($user)) {
                $check = $user->login($login['username'], $login['password']);
            }
            if (is_string($check)) {
                die($check);
            }
            if (is_object($user)) {
                $access = $user->checkLogin($check);
                if ($access === TRUE) {
                    $_SESSION['user'] = $login;
//                    $_SESSION['case'] = 'case';
                    header('location: ' . PRI_PATH . 'dashboard.php');
                } elseif (is_array($access)) {
                    $_SESSION['access'] = $access[0];
                    header('location: ' . PRI_PATH . 'login.php');
                }
            }
        }
        break;

    // register-script
    case 'register':
        if (empty($_SESSION['request']) || !isset($request['ready'])) {
            $_SESSION['request'] = $request;
            header('location: ' . RP . PRI_PATH . 'register.php');
        }

        if (isset($session) && !(isset($request['username']) && isset($request['password']) && isset($request['email']))) {
            $request = $_SESSION['request'];
        }

        if (isset($request['username']) && $request['password'] && $request['email']) {

            $regist = array('username' => $request['username'],
                            'password' => $request['password'],
                            'email' => $request['email'],
                            'first_name' => $request['first_name'],
                            'last_name' => $request['last_name'],
                            'adress' => $request['adress'],
                            'PLZ' => $request['PLZ'],
                            'place' => $request['place'],
                            'birthday' => $request['birthday']);

            if (empty($user)) {
                $user = new DB_User();
                $fb = $user->registUser($regist);
            } else {
                $fb = $user->registUser($regist);
            }

            // fb: feedback gets only set, after completed registration
            if ($fb['check'] === true) {
                $_SESSION['user'] = $fb;
                header('location: ' . PRI_PATH . 'dashboard.php');
                break;
            } else {
                die('Sorry, something went wrong. Please try again later. If you have time, give us feedback on david@exinit.de');
            }
        } else {
            echo 'please set all fields';
        }

        break;

    case 'profile':
//        var_dump($_SESSION['user']);
        if (empty($_SESSION['user'])) {
            header('location: ' . PRI_PATH . 'login.php');
            break;
        }
        header('location: ' .  PRI_PATH . 'account.php');
        break;

// get Records through AJAX
    case 'getter':
        if (empty($records)) {
            $records = new DB_Record();
            $records->recordOut($_SESSION['user']['username'], $request['load']);
        }
        else {
            $records->recordOut($_SESSION['user']['username'], $request['load']);
        }
        break;

    case 'record':
        if (empty($_SESSION['user'])) {
            header('location: ' .  PRI_PATH . 'login.php');
            break;
        }
        header('location: '.PRI_PATH.'recordbook.php');
        break;

        // gets an single record to edit
    case 'edit':
        if (empty($_SESSION['user'])) {
            header('location: ' . PRI_PATH . 'login.php');
            break;
        }
        $record =new DB_Record();
        $single_record = $record->getRecord($request['id']);
        $_SESSION['record_id'] = $single_record;
        header('location: '.PRI_PATH.'record.php');
        break;

        // for saving recordchanges and adding records
    case 'save':
        if (empty($_SESSION['user'])) {
            header('location: ' . PRI_PATH . 'login.php');
            break;
        }
        // update record
        if(isset($request['id'])) {
            $record = new DB_Record();
            $_SESSION['bool'] = $record->saveRecord($request['record'], $request['comment'], $request['id']);
        }
        // adding record
        elseif (isset($request['user'])) {
            $record = new DB_Record();
            $_SESSION['bool'] = $record->saveRecord($request['record'], $request['comment'], NULL, $request['user']);
        }
        header('location: '.PRI_PATH.'dashboard.php');
        break;

    case 'logged':
        if (empty($_SESSION['user'])) {
            header('location: ' .PRI_PATH . 'login.php');
            break;
        }

        // detletes the in register setted check
        unset($_SESSION['user']['check']);
        header('location: '.PRI_PATH.'dashboard.php');

        break;

    // immer an letzter Stelle lassen
    case 'logout':
        session_destroy();

    default:
        header('location: '.PRI_PATH.'main.php');
}


/*


$user = 'frankb_7';
$pass = 'eB7NBTH1Xkt7Tamc';
$server = 'dedi3098.your-server.de';
$db = 'recordbook';

*/