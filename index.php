<!DOCTYPE html>
<html lang="de">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <meta name="description" content="">
    <meta name="author" content="">


    <title>Berichtsheft-Tool</title>

    <!-- Bootstrap core CSS -->
    <link href="Resources/Public/css/bootstrap.css" rel="stylesheet">
    <link href="Resources/Public/css/bootstrap-theme.css" rel="stylesheet">

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <script src="Resources/Public/js/bootstrap.min.js"></script>
  </head>



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
          <form class="navbar-form navbar-right" role="form" method="post" action="?<?php header('location: Resources/Private/layouts/dashboard.html'); ?>">
            <div class="form-group">
              <input type="text" placeholder="Benutzer" class="form-control" name="username">
            </div>
            <div class="form-group">
              <input type="password" placeholder="Password" class="form-control" name="password">
            </div>
            <button type="submit" class="btn btn-success">Sign in</button>
          </form>
            <a href="?case=register">Registrieren</a>
        </div><!--/.navbar-collapse -->
      </div>
    </nav>


    <div class="jumbotron">
      <div class="container">
        <h1>Aktuelles!</h1>
        <button value="Reset Box" class="btn-default" data-toggle="collapse" data-target="#jumbo">Collapse Information</button>
        <div id="jumbo">
          <div>
              <?php
              ini_set('display_errors', 1);
              error_reporting( E_ALL );
              /**
               * Created by PhpStorm.
               * User: exinit
               * Date: 14.06.2017
               * Time: 10:42
               */
              include "Resources/PHP/model/database.php";


              $user = 'frankb_7';
              $pass = 'eB7NBTH1Xkt7Tamc';
              $server = 'dedi3098.your-server.de';
              $db = 'recordbook';


              $connection = new database();
              if($connection)
              //$connection->deleteDatabase($server, $db, $user, $pass);
              //$connection->createDatabase($server, $db, $user, $pass);
              $connection->restoreTabels($server, $db, $user, $pass);
              ?>
          </div>


        </div>

        <form class="form-control" action="index.php" method="post">
          <div class="form-group">
            <label></label>
            <input type="submit" class="btn-danger" value="Create New Database">

          </div>

        </form>

      </div>
    </div>




  </body>

</html>
