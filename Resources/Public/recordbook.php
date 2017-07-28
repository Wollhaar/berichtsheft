<?php
error_reporting(E_ALL | E_STRICT);
ini_set('display_errors', 'On');

require_once($_SERVER['DOCUMENT_ROOT'] .'/Resources/PHP/model/DBManager/DB_Record.php');
require_once($_SERVER['DOCUMENT_ROOT'] .'/Resources/PHP/model/config.php');

require_once ($_SERVER['DOCUMENT_ROOT'].'/Resources/PHP/model/filehandler.php');
$recordDBConection = new DB_Record();


//$_SESSION['recordMonth'] = $recordDBConection->getRecordMonth(2017, 06);

include ($_SERVER['DOCUMENT_ROOT'] . "/Resources/Private/Layouts/Templates/mainTemplate.html");

?>


<div class="container">
  <div class="row">
    <div class="col-md-12">
        <?php

        $test = new fileHandler();
//        $out = $test->readProfileFolder('frank0019');
//        echo '<pre>';
//        var_dump($out);
//        echo '</pre>';

        $test->serverControll("http://recordbook.frankb.exinitdev.de/Resources/Public/recordbook.php", "f.berdel@exinit.de");


        ?>

    </div>
  </div>
</div>




<div class="container well">
  <div>
    <form action="" method="post" class="form-horizontal">
      <div class="row">
        <div class="col-md-1 col-md-offset-1">Datum</div>
        <div class="col-md-2" class="form-group">
          <label for="status" class="sr-only"></label>
          <select class="form-control" id="status" name="status">
            <option id="statusOption1" value="1">Anwesend</option>
            <option id="statusOption2" value="2">Urlaub</option>
            <option id="statusOption3" value="3">Sonderurlaub</option>
            <option id="statusOption4" value="4">Feiertag</option>
            <option id="statusOption5" value="5">Krank</option>
          </select>
        </div>
        <div class="col-md-2 form-group">
          <label class="sr-only"></label>
          <select class="form-control" name="ort">
            <option id="placeOption1" value="1">Schule</option>
            <option id="placeOption2" value="2">Betrieb</option>
            <option id="placeOption3" value="3">Überbetrieblich</option>
          </select>
        </div>
        <div class="col-md-1 form-group">
          <span class="glyphicon glyphicon-paperclip" aria-hidden="true"></span>
        </div>
      </div>
      <div class="row" id="newRecordDiv">
        <div class="col-md-1 col-md-offset-1 form-group">
          <label class="sr-only"></label>
          <button id="addRecordButton" class="form-control" value="+" type="button" onclick="addRecord();">
            +
          </button>
        </div>
        <div class="col-md-3 form-group">
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
      <div id="end" class="form-group"></div>
      <div class="row">
        <div class="col-md-12">
          <input type="submit" value="Save">
        </div>
      </div>
    </form>
  </div>
</div>

<!-- Eigene JavaScripte -->
<script src="<?php $_SERVER['DOCUMENT_ROOT']?>/Resources/Public/js/recordbook.js"></script>

<?php include ($_SERVER['DOCUMENT_ROOT'] . "/Resources/Private/Layouts/Partials/footer.html")?>




