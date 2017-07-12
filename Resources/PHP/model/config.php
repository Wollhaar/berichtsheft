<?php
ini_set('display_errors', 1);
error_reporting( E_ALL );

//die(substr($_SERVER['DOCUMENT_ROOT'] , 29, 30).DIRECTORY_SEPARATOR);
define('DS', DIRECTORY_SEPARATOR);
define('RP', substr($_SERVER['DOCUMENT_ROOT'] , 29, 30).DS); // eventuelle Änderung, bei Wechsel auf anderen Server.
define('PUB_PATH', RP.'Resources'.DS.'Public'.DS); // DIRECTORY_SEPERATOR evtll gegen '/' austauschen
define('PRI_PATH', RP.'Resources'.DS.'Private'.DS.'Layouts'.DS);
define('MOD_PATH', RP.'Resources'.DS.'PHP'.DS.'Model'.DS);

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