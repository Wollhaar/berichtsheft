<?php
/**
 * Created by PhpStorm.
 * User: exinit
 * Date: 28.06.2017
 * Time: 17:07
 */

require_once ('../DBManager/DB_Record.php');


class AJAXController
{
    private $db_record;

    public function __construct()
    {
        $this->db_record = new DB_Record();
    }

    public function execute(){
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
        }

    }

}