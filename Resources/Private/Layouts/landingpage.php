<?php
/**
 * Created by PhpStorm.
 * User: exinit
 * Date: 10.07.2017
 * Time: 09:11
 */
require_once '../../PHP/model/config.php';
?>

<!DOCTYPE html>
<html lang="de">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
        <meta name="description" content="">
        <meta name="author" content="">

        <!-- Bootstrap core CSS -->
        <link href="<?php echo RP.PUB_PATH; ?>/css/bootstrap.css" rel="stylesheet">
        <link href="<?php echo RP.PUB_PATH; ?>/css/bootstrap-theme.css" rel="stylesheet">

        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
        <script src="<?php echo RP.PUB_PATH; ?>/js/bootstrap.min.js"></script>


        <title>RecordBook</title>
    </head>

    <body style="background-image: url(img/img/LandingPage_BG.png)">

        <div class="container">
          <div class="row" style="background: transparent">
            <div class="col-md-12 col-md-offset-11">
              <button type="button" class="btn btn-default" aria-label="Links ausrichten" style="background: transparent">
                <span aria-hidden="true"><img src="/Resources/Private/Layouts/img/Icon/Profil_Icon.png"></span>
                <!--<span class="glyphicon glyphicon glyphicon-user" aria-hidden="true"></span>-->
              </button>
              <button type="button" class="btn btn-default" aria-label="Links ausrichten" style="background: transparent">
                <span aria-hidden="true"><img src="/Resources/Private/Layouts/img/Icon/Einstellung_Icon.png"></span>
                <!--<span class="glyphicon glyphicon glyphicon-asterisk" aria-hidden="true"></span>-->
              </button>
              <button type="button" class="btn btn-default" aria-label="Links ausrichten" style="background: transparent">
                <span aria-hidden="true"><img src="/Resources/Private/Layouts/img/Icon/AnmeldenAbmelden_icon" </span>
                <!--<span class="glyphicon glyphicon glyphicon-off" aria-hidden="true"></span>-->
              </button>
              </div>
          </div>
        </div>

      <nav class="navbar navbar-default" style="background: transparent">
        <div class="container">
          <!-- Titel und Schalter werden für eine bessere mobile Ansicht zusammengefasst -->
          <div class="navbar-header col-md-4">
            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
              <span class="sr-only">Navigation ein-/ausblenden</span>
              <span class="icon-bar"></span>
              <span class="icon-bar"></span>
              <span class="icon-bar"></span>
            </button>
            <a class="navbar-brand" href="#" style="font-size: 25pt"><b>Record</b>Book</a>
          </div>

          <!-- Alle Navigationslinks, Formulare und anderer Inhalt werden hier zusammengefasst und können dann ein- und ausgeblendet werden -->
          <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
            <ul class="nav navbar-nav">
              <li><a href="#">Übersicht <span class="sr-only">(aktuell)</span></a></li>
              <li><a href="#">Berichtsheft</a></li>
              <li><a href="">Ausbilder</a> </li>
              <li><a href="">Portfolio</a></li>
            </ul>
          </div><!-- /.navbar-collapse -->
        </div><!-- /.container-fluid -->
      </nav>


      <div class="container" style="padding-top: 200px">
        <div class="row">
          <div class="col-md-4 col-md-offset-4">
            <div class="input-group-lg">
              <input type="text" class="form-control" placeholder="Benutzername" aria-describedby="groessen-addon1" style="background: transparent">
            </div>
          </div>
        </div>
        <br>
        <div class="row">
          <div class="col-md-4 col-md-offset-4">
            <div class="input-group-lg">
              <input type="password" class="form-control" placeholder="Password" aria-describedby="groessen-addon2" style="background: transparent">
            </div>
          </div>
        </div>
        <div class="row">
          <div class="col-md-2 col-md-offset-4">
            <div class="input-group-lg">
              <span><a href="">Neues Konto erstellen</a> </span>
            </div>
          </div>
          <div class="col-md-2">
            <div class="input-group-lg">
              <span><a href="">Password vergessen?</a></span>
            </div>
          </div>
        </div>
      </div>


      <footer class="navbar navbar-default navbar-fixed-bottom" style="background: transparent">
        <div class="row">
          <div class="col-md-12 col-md-offset-10">
            <ul class="nav nav-tabs">
              <li role="presentation"><a href="">Impressum</a></li>
              <li role="presentation"><a href="">Datenschutz</a></li>
            </ul>
          </div>
        </div>
      </footer>
    </body>
</html>
