<?php
require_once 'Resources/PHP/model/config.php';

$request = array('case' => '');
if(isset($_POST['username']) || isset($_GET['case']) || isset($_POST['load'])) {
    $request = $_REQUEST;
//    var_dump($_REQUEST);
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
            if (is_object($user)) {
                $access = $user->checkLogin($check);
                if ($access === TRUE) {
//                   übergabe der userdaten zur session
                    if (empty(session_id())) {
                        $session = new Helper();
                        $session->startSession($check['data']);
                    }
//var_dump($_REQUEST['PHPSESSID']);
//                    need to set,  to get logged in
                    if (isset($_REQUEST['PHPSESSID'])) {
                        $_SESSION['session_id'] = $_REQUEST['PHPSESSID'];
                    }

//               setting users session: get set session_id from session, through session variable or with the userspefic set sessionname
                    if (isset($_SESSION['session_id']) && session_status() == PHP_SESSION_ACTIVE) { //  || session_name() == $check['data']['username'].'_'.$check['data']['user_id']

//              userdaten werden in die user_id in der session abgespeichert
                        $_SESSION[$check['data']['user_id']] = $check['data'];
                        $_SESSION['user'] = $check['data']['user_id'];
//var_dump($_SESSION);
//                        $_SESSION[$check['data']['user_id']]['session_id'] = isset($_SESSION['session_id']) ? $_SESSION['session_id'] : $_REQUEST[session_name()];
//                    $_SESSION['case'] = 'case';

                        header('location: ' . PUB_PATH . 'dashboard.php');
                    }

                } elseif (is_array($access)) {
                    $_SESSION['access'] = $access[0];
                }
                echo '<pre>';
                var_dump($_SESSION, $_GET, $_POST, $_REQUEST);
                echo '</pre><br/>session status: '.session_status();
        //      back to login, when login was not successful
                header('location: ' . PUB_PATH . 'login.php');
            }
        }
        break;

    // register-script
    case 'register':
        if (empty($_SESSION['request']) || !isset($request['ready'])) {
            $_SESSION['request'] = $request;
            header('location: ' . PUB_PATH . 'register.php');
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
                $session = new Helper();
                $session->startSession($fb);

//                setting users session
                $_SESSION['user'] = $fb;
                $_SESSION['user']['session_id'] = $_SESSION['session_id'];

                header('location: ' . PUB_PATH . 'dashboard.php');
                break;
            } else {
                die('Sorry, something went wrong. Please try again later. If you have time, give us feedback on info@report-tool.david.exinitdev.de');
            }
        } else {
            echo 'please set all fields';
        }

        break;

    case 'profile':
//        var_dump($_SESSION['user']);
        if (empty($_SESSION['user'])) {
            header('location: ' . PUB_PATH . 'login.php');
            break;
        }
        header('location: ' .  PUB_PATH . 'account.php');
        break;

// get Records through AJAX
    case 'getter':
        if (empty($records)) {
            $records = new DB_Record();
            $records->gettingRecords($_SESSION[$_SESSION['user']]['user_id'], $request['load']);
        }
        else {
            $records->gettingRecords($_SESSION[$_SESSION['user']]['user_id'], $request['load']);
        }
        break;

    case 'record':
        if (empty($_SESSION['user'])) {
            header('location: ' .  PUB_PATH . 'login.php');
            break;
        }
        header('location: '.PUB_PATH.'recordbook.php');
        break;


        // gets an single record to edit
    case 'edit':
        if (empty($_SESSION['user'])) {
            header('location: ' . PUB_PATH . 'login.php');
            break;
        }
        if (isset($request['id'])) {
            $record = new DB_Record();
            $single_record = $record->getRecord($request['id']);
            $_SESSION[$_SESSION['user']]['user_record'] = $single_record;
//            unset($_SESSION[$_SESSION['user']]['user_record']);

            if (false) {
                header('location: ' . PUB_PATH . 'record.php');
            }
        }
        header('location: '.PUB_PATH.'recordbook.php');
        break;


    // logged user getting send to dashboard
    case 'logged':
        if (empty($_SESSION['user'])) {
            header('location: ' .PUB_PATH . 'login.php');
            break;
        }

        // detletes the in register setted check
        if (isset($_SESSION['user']['check'])) {
            unset($_SESSION['user']['check']);
        }
        header('location: '.PUB_PATH.'dashboard.php');

        break;

    // immer an letzter Stelle lassen
    case 'logout':
        session_destroy();
//        echo session_name().' + '.session_id();
        unset($_REQUEST['PHPSESSID']);
        if (session_status() == PHP_SESSION_DISABLED){
            header('location: '.PUB_PATH.'dashboard.php');
        }

    default:
        header('location: '.PUB_PATH.'landingpage.php');
}


/*


$user = 'frankb_7';
$pass = 'eB7NBTH1Xkt7Tamc';
$server = 'dedi3098.your-server.de';
$db = 'recordbook';

*/