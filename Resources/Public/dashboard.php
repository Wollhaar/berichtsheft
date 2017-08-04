<?php
require_once '../PHP/model/config.php';
?>
<!DOCTYPE html>
<html lang="en" xmlns="http://www.w3.org/1999/html">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <meta name="description" content="">
    <meta name="author" content="">


    <title>Berichtsheft-Tool</title>

    <!-- Bootstrap core CSS -->
    <link href="<?php echo PUB_PATH; ?>css/bootstrap.css" rel="stylesheet">
    <link href="<?php echo PUB_PATH; ?>css/bootstrap-theme.css" rel="stylesheet">
    <link href="<?php echo PUB_PATH; ?>css/main.css" rel="stylesheet">

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <script src="<?php echo PUB_PATH; ?>js/bootstrap.min.js"></script>
</head>

<body style="background-image: url(img/img/uebersichts_Seite_BG.png); position: fixed; overflow-y: scroll">

<div class="container">
    <div class="row" style="background: transparent">
      <div class="col-md-12 col-md-offset-11 dropdown">
        <div class="dropdown-menu" id="arrow" style="min-width: 0; padding 0; border solid; border-left: 5rem transparent; border-right: 5rem transparent; border-bottom: 5rem #eee; background: none; width: 0; "></div>
        <div class="profile-box dropdown-menu" style="top: 140%; display: none">
          <div class="img-box"><img src="img/img/Profilbild_elisa_meier.png" /></div>
          <span><?php echo !empty($_SESSION['user']['username']) ? $_SESSION['user']['first_name'].' '.$_SESSION['user']['last_name'] : '<i>no user</i>'; ?></span>
          <ul>
            <li><span><?php if(!empty($_SESSION['user']['career_name'])){echo $_SESSION['user']['career_name'];} ?></span></li>
            <li><a href="<?php echo RP; ?>index.php?case=messenger"><span>Nachrichten</span></a></li>
            <li><a href="<?php echo RP; ?>index.php?case=logged"><span>Ausbilder</span></a></li>
          </ul>
        </div>
          <span aria-hidden="true"><img src="<?php echo PRI_PATH; ?>img/Icon/Profil_Icon.png"></span>
          <span class="username"><?php echo empty($_SESSION['user']['username']) ? 'Elisa' : $_SESSION['user']['username']; ?></span>
          <!--<span class="glyphicon glyphicon glyphicon-user" aria-hidden="true"></span>-->

          <a href="<?php echo RP; ?>index.php?case=settings"><span aria-hidden="true"><img src="/Resources/Private/Layouts/img/Icon/Einstellung_Icon.png"></span></a>
          <!--<span class="glyphicon glyphicon glyphicon-asterisk" aria-hidden="true"></span>-->


          <a href="<?php echo RP; ?>index.php?case=logout"><span aria-hidden="true"><img src="/Resources/Private/Layouts/img/Icon/AnmeldenAbmelden_icon" </span></a>
          <!--<span class="glyphicon glyphicon glyphicon-off" aria-hidden="true"></span>-->

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
                <li><a href="<?php echo RP; ?>index.php?case=logged">Übersicht <span class="sr-only">(aktuell)</span></a></li>
                <li><a href="<?php echo RP; ?>index.php?case=edit">Berichtsheft</a></li>
                <li><a href="">Ausbilder</a> </li>
                <li><a href="">Portfolio</a></li>
            </ul>
        </div><!-- /.navbar-collapse -->
    </div>
</nav>
<!----------------------  Navbar Ende ----------------->
<?php $records = new DB_Record(); ?>

<div class="container main">
    <div class="col-md-12 row" style="margin: 2rem 0">

    </div>
    <div class="col-md-12 row" style="margin: 2rem 0">
        <div class="col-md-6 last-record">
            <div class="img-box" style="display: inline-block;">
                <img src="img/img/Letzter_Beitrag_Bild.png" id="" />
                </div>
            <div style="display: inline-block">
                <h3><b>Letzter Beitrag</b></h3>
                <?php $user = isset($_SESSION[$_SESSION['user']]['user_id']) ? $_SESSION[$_SESSION['user']]['user_id'] : NULL;
                $last_record = $records->lastRecord($user); ?>
                <span style="font-size: 1.5rem;">Bericht:
                <a style="text-decoration: none; color: #2acbd2" href="<?php echo RP.'index.php?case=edit&id='.$last_record['record_id']; ?>">
                    <?php echo date('l, d.F', strtotime($last_record['recorddate'])); ?></a>
            </span>
            </div>
        </div>
        <div class="col-md-6 recordbook">
            <div class="img-box" style="display: inline-block"><img src="img/img/Zum_Editor_Bild.png" /></div>
            <div style="display: inline-block">
                <h3><b>Zum Editor</b></h3>
                <span>Schreibe hier deinen <a href="<?php echo RP; ?>index.php?case=edit">Bericht</a></span>
            </div>
        </div>
    </div>
<?php ?>

<!------------------------   dashboard ENDE    -------------------->

<!--    check wird nur nach erfolgreicher registrierung gesetzt    -->
        <?php if(!empty($_SESSION[$_SESSION['user']]['check']) && $_SESSION[$_SESSION['user']]['check'] === true): ?>
            <?php include_once PRI_PATH.'Partials/welcome.html'; ?>
        <?php endif; ?>
        <!--        --><?php //var_dump($_SESSION); ?>

        <div class="dashboard">
            <h3>Dein Dashboard</h3>
            <p>Alle relevanten Dinge sind, hier für dich notiert.</p>

            <div class="col-md-9">
                <div class="records" id="dump-record">

<!--                Falls ein einzelner Bericht bearbeitet wurde, wird hier die Erfolgsmeldung angezeigt.    -->
                    <?php if(isset($_SESSION['bool']) && $_SESSION['bool'] === TRUE): ?>
                        <span>Bericht <?php echo $_SESSION['record_id']['record_id']; ?> aktualisiert.</span>
                    <?php endif; ?>

                    <!--          Ausgabe der berichte und Anzeige fehlender Berichte       -->
                    <?php
                    // if(isset($_SESSION['bool']) && $_SESSION['bool'] === TRUE){echo $_SESSION['bool'];}
                    $records = new DB_Record();

                    // getting records for displaying
//                    echo '<br/>'.$_SESSION[$_SESSION]
                    $recordOutput = array_reverse($records->recordOut($_SESSION[$_SESSION['user']]['user_id']), TRUE);

/*                    echo '<pre>';
                    var_dump($_SESSION,$_REQUEST, $recordOutput);
                    echo '</pre>';*/

//                begin of output
                foreach($recordOutput as $item => $value): ?>
                    <!--                    --><?php //var_dump($value);?>
                    <div class="records">
                        <span>       <?php echo $value['record_id']; ?>      </span>
                        <label class="">Bericht</label><span >    <?php echo $value['recorddate']; ?>      </span>
                        <div class="record">     <?php echo $value['records']; ?>         </div>
                        <label>Kommentar</label>
                        <div class="comment">   <?php echo $value['comment']; ?></div>
                        <span><a href="<?php echo RP; ?>index.php?case=edit&id=<?php echo $value['record_id']; ?>" class="btn btn-link" id="record-link-<?php echo $value['record_id']; ?>">Editieren</a></span>
                    </div>
                <?php endforeach; ?>

                    <div id="dump-record"><!--- output zusätzlicher records ----></div>

                    <hr/>
                    <?php if($_SESSION[ $_SESSION['user'] ]['counter'] == $_SESSION[ $_SESSION ['user']]['rows']): ?>
                        <button id="btn-back" onclick="backLoadRecords('back');">Zurück</button>     <?php endif;
                if($_SESSION[ $_SESSION['user'] ]['counter'] > 6): ?>
                    <button id="btn-forward" onclick="forwardLoadRecords('forward');">Weiter</button>  <?php endif; ?>
                </div>

                <!--        add new records        -->
                <div class="add-record container">
                    <!-- form sendet zum speichern und hinzufügen der Berichte, die Daten            -->
                    <h3>Neuen Bericht hinzufügen:</h3>
                    <form class="form-group" action="<?php echo RP; ?>index.php?case=save&user=<?php echo $_SESSION[ $_SESSION['user'] ]['username']; ?>" method="post">
                        <!--                Inhalt des Berichts und das Datum        -->
                        <label class="">Bericht</label>
                        <textarea class="record" name="record"></textarea>
                        <!--                Und ein Kommentar zum Bericht       -->
                        <label>Kommentar</label>
                        <textarea class="comment" name="comment"></textarea>
                        <button type="submit">Speichern</button>
                    </form>
                </div>
            </div>
            <div class="calendar col-md-3">
                <!--         ausgabe des Kalenders    -->
                <ul class="calendar-list">
                    <?php $days = $records->getRecordMonth(2017, 7);
                    var_dump($days);
                foreach ($days as $day) {
                    echo '<li>'.$day['recorddate'].'</li>';
                 } ?>
                </ul>
            </div>
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
<script type="text/javascript" src="<?php echo PUB_PATH; ?>js/main.js"></script>
</footer>
</body>
</html>
