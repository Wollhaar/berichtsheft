<?php
ini_set('display_errors', 1);
error_reporting( E_ALL );

$session = new DB_Record();
$session->startSession();

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