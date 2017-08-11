<?php
/**
 * Created by PhpStorm.
 * User: exinit
 * Date: 10.07.2017
 * Time: 09:11
 */
require_once '../PHP/model/config.php';
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
        <link href="<?php echo PUB_PATH; ?>css/bootstrap.css" rel="stylesheet">
        <link href="<?php echo PUB_PATH; ?>css/bootstrap-theme.css" rel="stylesheet">
        <link href="<?php echo PUB_PATH; ?>css/main.css" rel="stylesheet">

        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
        <script src="<?php echo PUB_PATH; ?>js/bootstrap.min.js"></script>


        <title>RecordBook</title>
    </head>

    <body style="background-image: url(img/img/LandingPage_BG.png)">

    <div class="container">
        <div class="row" style="background: transparent">
            <div class="col-md-12 col-md-offset-11 dropdown">
                <div class="dropdown-menu" id="arrow"></div>
                <div class="profile-box dropdown-menu" style="top: 140%; display: none">
                    <div class="img-box"><img src="img/img/Profilbild_elisa_meier.png" /></div>
                    <span><?php echo !empty($_SESSION['user']['username']) ? $_SESSION['user']['first_name'].' '.$_SESSION['user']['last_name'] : '<i>no user</i>'; ?></span>
                    <ul>
                        <li><span><?php if(!empty($_SESSION['user']['career_name'])){echo $_SESSION['user']['career_name'];} ?></span></li>
                        <li><a href="<?php echo RP; ?>index.php?case=messenger"><span>Nachrichten</span></a></li>
                        <li><a href="<?php echo RP; ?>index.php?case=logged"><span>Ausbilder</span></a></li>
                    </ul>
                </div>
                <button type="button" class="dropdown-toggle btn btn-default" data-toggle="dropdown" id="profile" onclick="" aria-label="Links ausrichten" style="background: transparent; position:relative;">
                    <span aria-hidden="true"><img src="<?php echo PRI_PATH; ?>img/Icon/Profil_Icon.png"></span>
                    <span class="username"><?php echo empty($_SESSION['user']['username']) ? ' ' : $_SESSION['user']['username']; ?></span>
                    <!--<span class="glyphicon glyphicon glyphicon-user" aria-hidden="true"></span>-->
                </button>
                <button type="button" class="btn btn-default" aria-label="Links ausrichten" style="background: transparent">
                    <a href="<?php echo RP; ?>index.php?case=settings"><span aria-hidden="true"><img src="/Resources/Public/img/Icon/Einstellung_Icon.png"></span></a>
                    <!--<span class="glyphicon glyphicon glyphicon-asterisk" aria-hidden="true"></span>-->
                </button>
                <button type="button" class="btn btn-default" aria-label="Links ausrichten" style="background: transparent">
                    <a href="<?php echo RP; ?>index.php?case=logout"><span aria-hidden="true"><img src="/Resources/Public/img/Icon/AnmeldenAbmelden_icon" </span></a>
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
        <form method="post" action="<?php echo RP.'index.php?case=login'; ?>">
        <div class="row">
          <div class="col-md-4 col-md-offset-4">
            <div class="input-group-lg">
              <input type="text" class="form-control" name="username" placeholder="Benutzername" aria-describedby="groessen-addon1" style="background: transparent">
            </div>
          </div>
        </div>
        <br>
        <div class="row">
          <div class="col-md-4 col-md-offset-4">
            <div class="input-group-lg">
              <input type="password" class="form-control" name="password" placeholder="Password" aria-describedby="groessen-addon2" style="background: transparent">
            </div>
          </div>
        </div>
            <button type="submit" style="display: none"></button>
        </form>
        <div class="row">
          <div class="col-md-2 col-md-offset-4">
            <div class="input-group-lg">
              <span><a href="<?php echo RP; ?>index.php?case=register">Neues Konto erstellen</a> </span>
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
