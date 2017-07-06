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
    <link href="<?php echo RP.PUB_PATH; ?>css/bootstrap.css" rel="stylesheet">
    <link href="<?php echo RP.PUB_PATH; ?>css/bootstrap-theme.css" rel="stylesheet">
    <link href="<?php echo RP.PUB_PATH; ?>css/main.css" rel="stylesheet">

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <script src="<?php echo RP.PUB_PATH; ?>js/bootstrap.min.js"></script>
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
                <li class="active"><a href="#">Home</a></li> <!-- falls man eingeloggt ist soll der homelink auf den dashboard lenken -->
                <li><a href="<?php echo RP; ?>index.php?case=logged">Übersicht</a></li> <!-- Im Falle: 'ausgeloggt' soll der link zur Loginseite führen.  -->
                <li><a href="<?php echo RP; ?>index.php?case=settings">Einstellungen</a></li>
                <li class="dropdown">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown">Berichtsheft <span class="caret"></span></a>
                    <ul class="dropdown-menu">
                        <li><a href="<?php echo RP; ?>index.php?case=record">Editieren</a></li>
                        <li><a href="#">Drucken</a></li>
                        <li><a href="#">Kalender übersicht</a></li>
                    </ul>
                </li>
            </ul>
            <div class="user-field dropdown">
                <span class="username dropdown-toggle" data-toggle="dropdown">Eingeloggt als <a href="<?php echo RP; ?>index.php?case=logged"><?php echo $_SESSION['user']['username']; ?></a></span>
                <ul class="dropdown-menu">
                    <li><a href="<?php echo RP; ?>index.php?case=logged">home</a></li>
                    <li><a href="<?php echo RP; ?>index.php?case=profile">Profil</a></li>
                    <li><a href="<?php echo RP; ?>index.php?case=status">Status</a></li>
                    <li><a href="<?php echo RP; ?>index.php?case=settings">Einstellungen</a></li>
                    <li><hr/></li>
                    <li><a href="<?php echo RP; ?>index.php?case=logout">Logout</a></li>
                </ul>
            </div>
        </div><!--/.navbar-collapse -->
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