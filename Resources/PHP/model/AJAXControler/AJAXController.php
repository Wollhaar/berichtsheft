<?php
error_reporting(E_ALL | E_STRICT);
ini_set('display_errors', 'On');
require_once('../DBManager/DB_Record.php');

class AJAXController
{

    private $dbr;

    private $request;

    public function __construct()
    {
        $this->dbr = new DB_Record();

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






