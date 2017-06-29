<?php
/**
 * Created by PhpStorm.
 * User: exinit
 * Date: 28.06.2017
 * Time: 17:07
 */

//require_once ('../DBManager/DB_Record.php');


if(isset($_POST['methode'])){
    echo '<pre> post methode an controller übergeben </pre>';
}
$request = $_POST['methode'];

switch($request){
    case 'getCurrentMonth': {
        echo 'Do something';
        return '<p>Do something </p>';

//        $req = new AJAXController();
//        $req->getCurrentMonth();
        break;
    }default: echo var_dump($request);
}


class AJAXController
{


    public function __construct()
    {

    }

    public function getCurrentMonth(){
        $dbr = new DB_Record();

        $currentTimestamp = time();
        $currentYear = date('Y', $currentTimestamp);
        $currentMonth = date('m', $currentTimestamp);

        $resultObject = json_encode($dbr->getRecordMonth((string)$currentYear,(string)$currentMonth));

        return $resultObject;

    }


    function execute(){
        /*
         * Benötigte variablen für den Aufruf
         * über JQuery
         */
        $methode = "";
        $jsonObject = NULL;
        $resultObject = "";
        $responseObjectJSON = false;


        //übernahme via $Session Variable möglich ??
        if(isset($_SESSION['methode'])){
            $methode = $_SESSION['methode'];
        }

        //übernahme via Post Variable
        if(isset($_POST['methode'])){
            $methode = $_POST['methode'];
        }

        if(isset($_POST['jsonObject'])){
            $jsonObject = json_decode($_POST['jsonObject']);
            $responseObjectJSON = true;
        }

        switch($methode){
            case 'getMonthrecords':{
                break;
            }
            case 'getCurrentMonth':{
                getCurrentMonth();  //return eines JSONObjektes -> Array mit allen record.recorddate einträgen des aktuellen Monats
                break;
            }
            default:{
                return 'Keine Methode ausgefürht';
            }
        }

    }

}