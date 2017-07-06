<?php
ini_set('display_errors', 1);
error_reporting( E_ALL );

define('RP', DIRECTORY_SEPARATOR); // eventuelle Änderung, bei Wechsel auf anderen Server.
define('PUB_PATH', 'Resources/Public/'); // DIRECTORY_SEPERATOR evtll gegen '/' austauschen
define('PRI_PATH', 'Resources/Private/Layouts/');
define('MOD_PATH', 'Resources/PHP/Model/');

$session = new Helper();
$session->startSession();

/*include_once 'DBManager/DB_Connection.php';
include_once 'DBManager/DB_User.php';
include_once 'Helper.php';*/

function __autoload ($classname) {
//    echo $classname.'<br/>';
    if (substr($classname, 0, 2) == 'DB') {
        require 'DBManager/'.$classname.'.php';
    }
    elseif ($classname == 'Helper') {
        require_once 'Helper.php';
    }
}


//define('PATH', )