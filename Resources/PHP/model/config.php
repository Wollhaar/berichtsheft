<?php
ini_set('display_errors', 1);
error_reporting( E_ALL );

if (isset($_REQUEST['PHPSESSID']) || isset($_SESSION['session_id'])) {
    if (isset($_REQUEST['PHPSESSID'])) {
        $session_id = $_REQUEST['PHPSESSID'];
    } elseif (isset($_SESSION['session_id'])) {
        $session_id = $_SESSION['session_id'];
    }
    session_start($session_id);
} else {
    session_start();
}
$_SESSION['session_id'] = $_REQUEST['PHPSESSID'];

/*include_once 'DBManager/DB_Connection.php';
include_once 'DBManager/DB_User.php';
include_once 'Helper.php';*/

function __autoload ($classname) {
//    echo $classname.'<br/>';
    if (substr($classname, 0, 2) == 'DB') {
        require 'DBManager/'.$classname.'.php';
    }
}


//define('PATH', )