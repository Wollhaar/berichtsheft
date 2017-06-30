<?php
/**
 * Created by PhpStorm.
 * User: exinit
 * Date: 28.06.2017
 * Time: 17:07
 */

require_once ('../DBManager/DB_Record.php');


//if(isset($_POST['methode']))
//    echo 'methode ist gesetzt';
$request = $_POST['methode'];

//if(isset($_GET['getCurrentMonth']))
//    echo 'Ist gesetzt';
//else
//    echo var_dump($_GET);



switch($request){
    case 'getCurrentMonth': {

        $dbr = new DB_Record();

        $currentTimestamp = time();
        $currentYear = date('Y', $currentTimestamp);
        $currentMonth = date('m', $currentTimestamp);

        $resultObject = $dbr->getRecordMonth($currentYear, $currentMonth);



        echo $resultObject = json_encode($dbr->getRecordMonth((string)$currentYear,(string)$currentMonth));

        break;
    }default: echo var_dump($request);
}


//class AJAXController
//{
//
//
//    public function __construct()
//    {
//
//    }
//
//    public function getCurrentMonth(){
//        $dbr = new DB_Record();
//
//        $currentTimestamp = time();
//        $currentYear = date('Y', $currentTimestamp);
//        $currentMonth = date('m', $currentTimestamp);
//
//        $resultObject = json_encode($dbr->getRecordMonth((string)$currentYear,(string)$currentMonth));
//
//        return $resultObject;
//
//    }
//}