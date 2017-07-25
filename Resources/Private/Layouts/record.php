<?php
require_once '../../PHP/model/config.php';
?>
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
    <link href="<?php echo PUB_PATH; ?>css/bootstrap.css" rel="stylesheet">
    <link href="<?php echo PUB_PATH; ?>css/bootstrap-theme.css" rel="stylesheet">
    <link href="<?php echo PUB_PATH; ?>css/main.css" rel="stylesheet">

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <script src="<?php echo PUB_PATH; ?>js/bootstrap.min.js"></script>
</head>
<body>
<nav class="navbar navbar-inverse navbar-fixed-top" role="navigation">
<div class="container">
    <div class="row" style="background: transparent">
        <div class="col-md-12 col-md-offset-11 dropdown">
<!--            <div class="dropdown-menu" id="arrow"></div>-->
            <div class="profile-box dropdown-menu" style="top: 140%; background: url(img/img/Profil_Hover.png);">
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
                <span class="username"><?php echo empty($_SESSION['user']['username']) ? 'Elisa' : $_SESSION['user']['username']; ?></span>
                <!--<span class="glyphicon glyphicon glyphicon-user" aria-hidden="true"></span>-->
            </button>
            <button type="button" class="btn btn-default" aria-label="Links ausrichten" style="background: transparent">
                <a href="<?php echo RP; ?>index.php?case=settings"><span aria-hidden="true"><img src="/Resources/Private/Layouts/img/Icon/Einstellung_Icon.png"></span></a>
                <!--<span class="glyphicon glyphicon glyphicon-asterisk" aria-hidden="true"></span>-->
            </button>
            <button type="button" class="btn btn-default" aria-label="Links ausrichten" style="background: transparent">
                <a href="<?php echo RP; ?>index.php?case=logout"><span aria-hidden="true"><img src="/Resources/Private/Layouts/img/Icon/AnmeldenAbmelden_icon" </span></a>
                <!--<span class="glyphicon glyphicon glyphicon-off" aria-hidden="true"></span>-->
            </button>
        </div>
    </div>
</div>
</nav>

<div class="main">
    <div class="board">
        <!--        --><?php //var_dump($_SESSION); ?>
        <div class="container">
            <div class="records col-md-9">
                <span><?php echo $_SESSION['record_id']; ?></span>

<!--            form sendet zum speichern und hinzufügen der Berichte, die Daten            -->
                    <form class="form-group" action="<?php echo RP; ?>index.php?case=save&id=<?php echo $_SESSION['record_id']['record_id']; ?>" method="post">
                        <span><?php echo $_SESSION['record_id']['record_id']?></span>
<!--                Inhalt des Berichts und das Datum        -->
                        <label class="">Bericht</label><span><?php echo $_SESSION['record_id']['recorddate']; ?></span>
                        <textarea class="record" name="record"><?php echo $_SESSION['record_id']['record']; ?></textarea>
<!--                Und ein Kommentar zum Bericht       -->
                        <label>Kommentar</label>
                        <textarea class="comment" name="comment"><?php echo $_SESSION['record_id']['comment']; ?></textarea>
                        <button type="submit">Speichern</button>
<!--                Abbruch und zurück zum Dashboard        -->
                        <span><a href="<?php echo RP; ?>index.php?case=logged">Abbrechen</a></span>
                    </form>
            </div>
            <div class="calendar col-md-3">
                <!--         ausgabe des Kalenders    -->
                <ul class="calendar-list">
                    <?php $records = new DB_Record();
                    $days = $records->getRecordMonth(2017, 6);
                    foreach ($days as $day) { ?>
                        <li><?php echo $day; ?> </li>
                    <?php } ?>
                </ul>
            </div>
        </div>
    </div>
</div>
</body>
</html>