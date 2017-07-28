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
require_once('../../PHP/model/config.php');
$recordDBConection = new DB_Record();


//$_SESSION['recordMonth'] = $recordDBConection->getRecordMonth(2017, 06);

include('html/recordbook.html');

?>

 <?php

//    $something = $recordDBConection->readRecordDay(2017,06,05);
//    var_dump($something);





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

$records = new DB_Record();
$user = new DB_User();
$year = $user->getYears($_SESSION[$_SESSION['user']]['user_id']);
if (isset($single_record)) {
    $date = $records->getDate();
}

if(empty($_SESSION['record_id'])) {
    if (isset($id)) {
        $records->getRecord(Sid);
    }
}

if (isset($_SESSION[$_SESSION['user']]['user_record'])){
    $date = $_SESSION[$_SESSION['user']]['user_record']['recorddate'];
}
    ?>

<div class="container well" style="background: transparent;">
  <div>
      <div class="row recordbook">
        <div class="col-md-4">
            <div>
              <label for="timetype" class="sr-only">Schreibanzahl</label>
              <select class="form-control" id="timetype" name="timetype">
                <option value="1">täglich</option>
                <option value="2">wöchentlich</option>
                <option value="3">monatlich</option>
              </select>
            </div>
            <div>
              <label for="year" class="sr-only">Ausbildungsjahr</label>
              <select class="form-control" id="year" name="year">
                <?php if(isset($year[0])){ echo '<option value="1">erstes</option>';} ?>
                <?php if(isset($year[1])){ echo '<option value="2">zweites</option>';} ?>
                <?php if(isset($year[2])){ echo '<option value="3">drittes</option>';} ?>
              </select>
            </div>
        </div>
        <div class="col-md-4">
            <div>
              <label class="sr-only" for="recorddate">Berichtsdatum</label>
              <input class="form-control" id="recorddate" name="recorddate" type="date" />
            </div>
            <div>
              <label class="sr-only" for="department">Berichtsdatum</label>
              <input class="form-control" id="departemnt" name="department" type="text" placeholder="Abteilung" />
            </div>
        </div>
        <div class="col-md-4">
            <div class="name-box" style="text-align: center">
                <?php echo $_SESSION[$_SESSION['user']]['first_name'].' '.$_SESSION[$_SESSION['user']]['last_name']; ?>
        </div>
            <div class="time-box" style="text-align: center">
                <?php if (isset($date)){ echo $date; }?>
            </div>
        </div>
      </div>
  </div>
</div>
      <div class="container" style="display: block; background: #bbb">
          <div class="inner-box">
              <div class="record-box" style="border: 1px solid black">
                  <div class="work">
                      <h3>Betrieb</h3>
                      <p><?php echo $_SESSION[$_SESSION['user']]['user_record']['record']; ?></p>
                  </div>
                  <div class="school">
                      <h3>Berufsschule</h3>
                      <p ></p>
                  </div>
                  <div class="extern">
                      <h3>sonstiges)</h3>
                      <p></p>
                  </div>
              </div>
              <div class="" style="border: 1px solid black">
                  <div class="col-md-4 autograph-box">
                      <span>Azubi/Vetreter</span>
                      <hr style="margin-top: 3rem"/>
                      <span>Datum, Unterschrift</span>
                  </div>
                  <div class="col-md-4 autograph-box" style="border: 1px solid black">
                      <span>Ausbilder</span>
                      <hr style="margin-top: 3rem"/>
                      <span>Datum, Unterschrift</span>
                  </div>
                  <div class="col-md-4 autograph-box">
                      <span>Berufsschule</span>
                      <hr style="margin-top: 3rem"/>
                      <span>Datum, Unterschrift</span>
                  </div>
              </div>
          </div>
      </div>

</body>
</html>



