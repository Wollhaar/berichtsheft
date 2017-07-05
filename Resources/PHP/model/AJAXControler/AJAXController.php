<?php
error_reporting(E_ALL | E_STRICT);
ini_set('display_errors', 'On');
require_once ('../DBManager/DB_Record.php');



$dbr= new DB_Record();

 if(isset($_POST['method']))
   $request = $_POST['method'];
 else
     return '[Error] method Post Variable is not set';


function debug_console($data){
    if(is_array($data))
        $output = "<script>console.log( 'Debug Objects: " . implode( ',', $data) . "' );</script>";
    else
        $output = "<script>console.log( 'Debug Objects: "  . $data . "' );</script>";

    echo $output;
}


switch($request){

    case 'getCurrentMonth': {
        $currentTimestamp = time();
        $currentYear = date('Y', $currentTimestamp);
        $currentMonth = date('m', $currentTimestamp);


        echo $resultObject = json_encode($dbr->getRecordMonth((string)$currentYear,(string)$currentMonth));
        break;
    }
    case 'getRecord': {
        if(isset($_POST['selectRec'])){
            $selectedDate = $_POST['selectRec'];
            $date = explode('-', $selectedDate);

            echo $resultObject = json_encode($dbr->readRecordDay($date[0], $date[1], $date[2]));

        }else{
            debug_console("[Error]case: getRecord");
        }
        break;

    }
    default: debug_console("[Error] methode Post variable: " . $request);
}




