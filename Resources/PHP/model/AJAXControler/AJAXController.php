<?php
error_reporting(E_ALL | E_STRICT);
ini_set('display_errors', 'On');


require_once('../DBManager/DB_Record.php');
require_once ('../DBManager/DB_Instructor.php');

class AJAXController
{

    private $dbr;
    private $dbi;

    private $request;

    public function __construct()
    {
        $this->dbr = new DB_Record();
        $this->dbi = new DB_Instructor();

        if (isset($_POST['method'])) {
            $this->request = $_POST['method'];
        } else {
            echo '[Error] method Post Variable is not set';
            return false;
        }

        $this->controll($this->request);

        return true;
    }

    public function controll($request)
    {
        switch ($request) {

            case 'getCurrentMonth': {
                $currentTimestamp = time();
                $currentYear = date('Y', $currentTimestamp);
                $currentMonth = date('m', $currentTimestamp);

                echo $resultObject = json_encode($this->dbr->getRecordMonth((string)$currentYear,
                    (string)$currentMonth));
                break;
            }
            case 'getRecord': {
                if (isset($_POST['selectRec'])) {
                    $selectedDate = $_POST['selectRec'];
                    $date = explode('-', $selectedDate);

                    echo $resultObject = json_encode($this->dbr->readRecordDay($date[0],
                        $date[1], $date[2]));
                } else {
                    $this->debug_console("[Error]case: getRecord");
                    return false;
                }
                break;
            }

            case 'getSpecialRecord':
                $request = $_POST;

                $record = $this->dbr->getSpecialRecord($request['user'], $request['date'], $request['department']);
                return $record;
                die('ups');

            // for saving recordchanges and adding records
            case 'save':
                $request = $_POST;
                // update record
                if(isset($request['id'])) {
                    $bool = $this->dbr->saveRecord($request['record'], $request['id']);
                }
                // adding record
                elseif (isset($request['user'])) {
                    $bool = $this->dbr->saveRecord($request['record'], NULL, $request['user']);
                }
                else {
                    echo false;
                    break;
                }
                echo 'DB_Output: '.$bool;
                break;


            case 'getInstructor':{
                echo $resultObject = json_encode($this->dbi->getInstructor());
//                $this->debug_console($resultObject);

                break;
            }
            case 'writeInstructor':{
                $this->debug_console(var_dump($_POST));


                if(isset($_POST['name']) && isset($_POST['vorname']) && isset($_POST['rolle'])){

                    if($this->dbi->writeInstructor($_POST['name'], $_POST['vorname'], $_POST['location'], $_POST['rolle'],  $_POST['content'])== true){
                        echo "true";
                    }



                    return true;


                }else{
                    $this->debug_console("[Error] SQL Statment");
                    return false;
                }
//                $resultObject = json_encode($this->dbi->writeInstructor())
            }
            default: {
                $this->debug_console("[Error] methode Post variable: " . $request);
                return false;
            }
        }
        return true;
    }

    public function debug_console($data)
    {
        if (isset($data)) {
            if (is_array($data)) {
                $output = "<script>console.log( 'Debug Objects: " . implode(',',
                        $data) . "' );</script>";
            } else {
                $output = "<script>console.log( 'Debug Objects: " . $data . "' );</script>";
            }

            echo $output;
            return true;
        } else {
            return false;
        }
    }
}

$controller = new AJAXController();
