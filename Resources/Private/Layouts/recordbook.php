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
  <div class="jumbotron">
    <div class="row">
      <div class="col-md-2">
        <div class="list-group">
          <button class="list-group-item">Montag</button>
          <button class="list-group-item"></button>
          <button class="list-group-item"></button>
          <button class="list-group-item"></button>
          <button class="list-group-item"></button>
          <button class="list-group-item"></button>
          <button class="list-group-item"></button>
        </div>
      </div>
      <div class="col-md-2">
        <div class="list-group">
          <button class="list-group-item">Dienstag</button>
          <button class="list-group-item"></button>
          <button class="list-group-item"></button>
          <button class="list-group-item"></button>
          <button class="list-group-item"></button>
          <button class="list-group-item"></button>
          <button class="list-group-item"></button>
        </div>
      </div>
      <div class="col-md-2">
        <div class="list-group">
          <button class="list-group-item">Mittwoch</button>
          <button class="list-group-item"></button>
          <button class="list-group-item"></button>
          <button class="list-group-item"></button>
          <button class="list-group-item"></button>
          <button class="list-group-item"></button>
          <button class="list-group-item"></button>
        </div>
      </div>
      <div class="col-md-2">
        <div class="list-group">
          <button class="list-group-item">Donnerstag</button>
          <button class="list-group-item"></button>
          <button class="list-group-item"></button>
          <button class="list-group-item"></button>
          <button class="list-group-item"></button>
          <button class="list-group-item"></button>
          <button class="list-group-item"></button>
        </div>
      </div>
      <div class="col-md-2">
        <div class="list-group">
          <button class="list-group-item">Freitag</button>
          <button class="list-group-item"></button>
          <button class="list-group-item"></button>
          <button class="list-group-item"></button>
          <button class="list-group-item"></button>
          <button class="list-group-item"></button>
          <button class="list-group-item"></button>
        </div>
      </div>
      <div class="col-md-2">
        <div class="list-group">
          <button class="list-group-item">Samstag</button>
          <button class="list-group-item"></button>
          <button class="list-group-item"></button>
          <button class="list-group-item"></button>
          <button class="list-group-item"></button>
          <button class="list-group-item"></button>
          <button class="list-group-item"></button>
        </div>
      </div>
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



