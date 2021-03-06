<?php
ini_set('display_errors', 1);
error_reporting( E_ALL );

//die(substr($_SERVER['DOCUMENT_ROOT'] , 29, 30).DIRECTORY_SEPARATOR);
define('DS', DIRECTORY_SEPARATOR);
//define('RP', substr($_SERVER['DOCUMENT_ROOT'] , 28 , 20).DS); // eventuelle Änderung, bei Wechsel auf anderen Server.
define('RP', $_SERVER['SERVER_NAME'] . DS);
define('PUB_PATH', RP.'Resources'.DS.'Public'.DS); // DIRECTORY_SEPERATOR evtll gegen '/' austauschen
define('PRI_PATH', RP.'Resources'.DS.'Private'.DS.'Layouts'.DS);
define('MOD_PATH', RP.'Resources'.DS.'PHP'.DS.'model'.DS);

// Definierung des Userstatus
define(0, 'ADMIN');
define(1, 'AZUBI');
define(2, 'AUSBILDER');
define(3, 'NOT_ACTIVE');


$user_session = NULL;

if (isset($_REQUEST['PHPSESSID'])) {
    $user_session = $_REQUEST['PHPSESSID'];
}

$session = new Helper();
$session->startSession(NULL, $user_session);
//  isset($session['user']) ? $session_user['user'] : NULL, isset($session_user) ? $session_user['session_id'] : NULL

/*include_once 'DBManager/DB_Connection.php';
include_once 'DBManager/DB_User.php';
include_once 'Helper.php';*/
//echo MOD_PATH;

function __autoload ($classname) {
//    echo $classname.'<br/>';
    if (substr($classname, 0, 2) == 'DB') {
        require 'DBManager'.DS.$classname.'.php';
    }
    elseif ($classname == 'Helper') {
        require_once 'Helper.php';
    }
}


//define('PATH', )