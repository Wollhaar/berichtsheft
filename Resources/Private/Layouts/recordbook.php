<?php
/**
 * Created by PhpStorm.
 * User: exinit
 * Date: 22.06.2017
 * Time: 11:56
 */

error_reporting(E_ALL | E_STRICT);
ini_set('display_errors', 'On');

require_once('../../PHP/model/DBManager/DB_Record.php');
$recordDBConection = new DB_Record();

$recordDBConection->startSession();

//$_SESSION['recordMonth'] = $recordDBConection->getRecordMonth(2017, 06);

include('html/recordbook.html');

?>


<div class="container">
    <div class="jumbotron" >
      <div class="row" id="jumb">
        <button class="bg-danger" onclick="displaySelectedButton();">Display</button>



    <?php
//    function displayCurrentMonth(){
//
//        $recordDBConection = new DB_Record();
//
//        $currentTimestamp = time();
//
//        $currentYear = date('Y', $currentTimestamp);
//        $currentMonth = date('m', $currentTimestamp);
//
//
//        $_SESSION['recordMonth'] = $recordDBConection->getRecordMonth((string)$currentYear,(string)$currentMonth);
//
//
//
//
//        $thursday = array();
//        array_push($thursday, '<div class="col-md-2">');
//        array_push($thursday, '<div class="list-group">');
//        array_push($thursday, '<button class="list-group-item">Donnerstag</button>');
//
//        $friday = array();
//        array_push($friday, '<div class="col-md-2">');
//        array_push($friday, '<div class="list-group">');
//        array_push($friday, '<button class="list-group-item">Freitag</button>');
//
//        $saturday = array();
//        array_push($saturday, '<div class="col-md-2">');
//        array_push($saturday, '<div class="list-group">');
//        array_push($saturday, '<button class="list-group-item">Samstag</button>');
//
//        $sunday = array();
//        array_push($sunday, '<div class="col-md-2">');
//        array_push($sunday, '<div class="list-group">');
//        array_push($sunday, '<button class="list-group-item">Sonntag</button>');
//
//        $monday = array();
//        array_push($monday, '<div class="col-md-2">');
//        array_push($monday, '<div class="list-group">');
//        array_push($monday, '<button class="list-group-item" onclick="displaySelectedButton();">Montag</button>');
//
//        $tuesday = array();
//        array_push($tuesday, '<div class="col-md-2">');
//        array_push($tuesday, '<div class="list-group">');
//        array_push($tuesday, '<button class="list-group-item">Dienstag</button>');
//
//        $wednesday = array();
//        array_push($wednesday, '<div class="col-md-2">');
//        array_push($wednesday, '<div class="list-group">');
//        array_push($wednesday, '<button class="list-group-item">Mittwoch</button>');
//
//        for($i=0; $i<count($_SESSION['recordMonth']); $i++){
//
//            $day = substr($_SESSION['recordMonth'][$i]['recorddate'], 0,10);
//            $formatDay = DateTime::createFromFormat('Y-m-d', $day);
//            $newFormatDay = $formatDay->format('D');
//
//
//
//            switch($newFormatDay) {
//                case 'Thu': {
//                    $sth = '<button class="list-group-item" id="selectDay'. $i . '">' . $_SESSION['recordMonth'][$i]['recorddate'] . '</button>';
//                    array_push($thursday, $sth);
//                    break;
//                }
//                case 'Fri': {
//                    $sth  = '<button class="list-group-item" id="selectDay'. $i . '">' . $_SESSION['recordMonth'][$i]['recorddate'] . '</button>';
//                    array_push($friday, $sth);
//                    break;
//                }
//                case 'Sat': {
//                    $sth = '<button class="list-group-item" id="selectDay'. $i . '">' . $_SESSION['recordMonth'][$i]['recorddate'] . '</button>';
//                    array_push($saturday, $sth);
//                    break;
//                }
//                case 'Sun':{
//                    $sth = '<button class="list-group-item" id="selectDay'. $i . '">' . $_SESSION['recordMonth'][$i]['recorddate'] . '</button>';
//                    array_push($sunday, $sth);
//                    break;
//                }
//                case 'Mon':{
//                    $sth = '<button class="list-group-item" id="selectDay'. $i . '">' . $_SESSION['recordMonth'][$i]['recorddate'] . '</button>';
//                    array_push($monday, $sth);
//                    break;
//                }
//                case 'Tue':{
//                    $sth  = '<button class="list-group-item" id="selectDay'. $i . '">' . $_SESSION['recordMonth'][$i]['recorddate'] . '</button>';
//                    array_push($tuesday, $sth);
//                    break;
//                }
//                case 'Wed':{
//                    $sth = '<button class="list-group-item">' . $_SESSION['recordMonth'][$i]['recorddate'] . '</button>';
//                    array_push($wednesday, $sth);
//                    break;
//                }
//
//            }
//
//        }
//
//        array_push($thursday,'</div>');
//        array_push($thursday,'</div>');
//
//        array_push($friday,'</div>');
//        array_push($friday,'</div>');
//
//        array_push($saturday,'</div>');
//        array_push($saturday,'</div>');
//
//        array_push($sunday,'</div>');
//        array_push($sunday,'</div>');
//
//        array_push($monday,'</div>');
//        array_push($monday,'</div>');
//
//        array_push($tuesday,'</div>');
//        array_push($tuesday,'</div>');
//
//        array_push($wednesday,'</div>');
//        array_push($wednesday,'</div>');
//
//
//        foreach($monday AS $out){
//            echo $out;
//        }
//        foreach($tuesday AS $out){
//            echo $out;
//        }
//
//        foreach($wednesday AS $out){
//            echo $out;
//        }
//
//        foreach($thursday AS $out){
//            echo $out;
//        }
//
//        foreach($friday AS $out){
//            echo $out;
//        }
//    }
//    displayCurrentMonth();

    ?>

      </div>
  </div>
</div>



<div class="container well">
  <div>
    <form action="" method="post">
      <div class="row">
        <div class="col-md-1 col-md-offset-1">Datum</div>
        <div class="col-md-2">
          <label for="status" class="sr-only"></label>
          <select class="form-control" id="status" name="status">
            <option id="statusOption1" value="1">Anwesend</option>
            <option id="statusOption2" value="2">Urlaub</option>
            <option id="statusOption3" value="3">Sonderurlaub</option>
            <option id="statusOption4" value="4">Feiertag</option>
            <option id="statusOption5" value="5">Krank</option>
          </select>
        </div>
        <div class="col-md-2">
          <label class="sr-only"></label>
          <select class="form-control" name="ort">
            <option id="placeOption1" value="1">Schule</option>
            <option id="placeOption2" value="2">Betrieb</option>
            <option id="placeOption3" value="3">Überbetrieblich</option>
          </select>
        </div>
        <div class="col-md-1">
          <span class="glyphicon glyphicon-paperclip" aria-hidden="true"></span>
        </div>
      </div>
      <div class="row" id="newRecordDiv">
        <div class="col-md-1 col-md-offset-1">
          <button id="addRecordButton" class="form-control" value="+" type="button" onclick="addRecord();">
            +
          </button>
        </div>
        <div class="col-md-3">
          <label class="sr-only"></label>
          <input class="form-control" id="record" name="record" type="text" value="Berichtshefteintrag">
        </div>
        <div class="col-md-1">
          <input class="form-control" id="time" name="time" type="text" value="00:h 00:m">
        </div>
        <div class="col-md-4">
          <label class="sr-only"></label>
          <input class="form-control" id="comment" name="comment" type="text" value="Kommentare zum Eintrag">
        </div>
      </div>
      <div id="end"></div>
      <div class="row">
        <div class="col-md-12">
          <input type="submit" value="Save">
        </div>
      </div>
    </form>
  </div>

</div>
</body>
</html>



