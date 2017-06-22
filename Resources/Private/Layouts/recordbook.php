<?php
/**
 * Created by PhpStorm.
 * User: exinit
 * Date: 22.06.2017
 * Time: 11:56
 */


$timestamp = time();
$currentDate = date('Y-m-D', $timestamp);



$header = '
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <meta name="description" content="">
    <meta name="author" content="">


    <title>Berichtsheft-Tool</title>

    <!-- Bootstrap core CSS -->
    <link href="/Berichtsheft/Resources/Public/css/bootstrap.css" rel="stylesheet">
    <link href="/Berichtsheft/Resources/Public/css/bootstrap-theme.css" rel="stylesheet">

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <script src="Resources/Public/js/bootstrap.min.js"></script>


    <!-- Eigene Scripts-->
    <script src="Resources/Public/js/recordbook.js"></script>


  </head>
';


$navigation = ' 
  <body>   
    <nav class="navbar navbar-inverse navbar-fixed-top" role="navigation">
      <div class="container">
        <div class="navbar-header">
          <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </button>
          <a class="navbar-brand" href="#">Berichtsheft-Tool</a>
        </div>
        <div id="navbar" class="navbar-collapse collapse">
          <ul class="nav navbar-nav">
            <li class="active"><a href="#">Home</a></li>
            <li><a href="#overview">Übersicht</a></li>
            <li><a href="#settings">Einstellungen</a></li>
            <li class="dropdown">
              <a href="#" class="dropdown-toggle" data-toggle="dropdown">Berichtsheft <span class="caret"></span></a>
              <ul class="dropdown-menu">
                <li><a href="#">Editieren</a></li>
                <li><a href="#">Drucken</a></li>
                <li><a href="#">Kalender übersicht</a></li>
              </ul>
            </li>
          </ul>
          <form class="navbar-form navbar-right" role="form">
            <div class="form-group">
              <input type="text" placeholder="Benutzer" class="form-control">
            </div>
            <div class="form-group">
              <input type="password" placeholder="Password" class="form-control">
            </div>
            <button type="submit" class="btn btn-success">Sign in</button>
          </form>
        </div><!--/.navbar-collapse -->
      </div>
    </nav>';


$jumbotron = '
    <div class="jumbotron">

    </div>
';


$form = '
<div class="container well">

      <div>
          <form  action="Resources/PHP/view/record.php" method="post">
            <div class="row">
              <div class="col-md-1 col-md-offset-1">' . $currentDate . '</div>
              <div class="col-md-2">
                <label for="status" class="sr-only"></label>
                <select class="form-control" id="status" name="status">
                  <option value="1">Anwesend</option>
                  <option value="2">Urlaub</option>
                  <option value="3">Sonderurlaub</option>
                  <option value="4">Feiertag</option>
                  <option value="5">Krank</option>
                </select>
              </div>
              <div class="col-md-2">
                <label class="sr-only"></label>
                <select class="form-control" name="ort">
                  <option value="1">Schule</option>
                  <option value="2">Betrieb</option>
                  <option value="3">Überbetrieblich</option>
                </select>
              </div>
              <div class="col-md-1">
                <span class="glyphicon glyphicon-paperclip" aria-hidden="true"></span>
              </div>
            </div>
            <div class="row" id="newRecordDiv">
              <div class="col-md-1 col-md-offset-1">
                <button id="addRecordButton" class="form-control" value="+" type="button" onclick="addRecord();">+</button>
              </div>
              <div class="col-md-3">
                <label class="sr-only"></label>
                <input class="form-control" id="record" name="record" type="text" value="Berichtshefteintrag">
              </div>
              <div class="col-md-1">
                <input class="form-control" id="time" name="time" type="text" value="00:h 00:m">
              </div>
              <div class="col-md-4" >
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
';


$end = '    </div>
  </body>
</html>';






echo  $header . $navigation . $jumbotron . $form . $end;

?>






