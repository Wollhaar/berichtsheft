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
    <script src="<?php echo RP.PUB_PATH; ?>js/main.js"></script>
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
        <?php if($_SESSION['user']['check'] === true): ?>
            <?php include_once RP.PRI_PATH.'Partials/welcome.html'; ?>
        <?php endif; ?>
<!--        --><?php //var_dump($_SESSION); ?>
        <div class="dashboard">
            <h3>Dein Dashboard</h3>
            <p>Alle relevanten Dinge sind, hier für dich notiert.</p>
            <div class="records col-md-9">
                <?php if($_SESSION['bool'] === TRUE): ?>
                <span>Bericht <?php echo $_SESSION['record_id']['record_id']; ?> aktualisiert.</span>
                <?php endif; ?>
<!--          Ausgabe der berichte und Anzeige fehlender Berichte       -->
                <?php
                if($_SESSION['bool'] === TRUE){echo $_SESSION['bool'];}
                $records = new DB_Record();
                // getting records for displaying
                $recordOutput = $records->recordOut($_SESSION['user']['username']);
                foreach($recordOutput as $item => $value): ?>
                    <?php var_dump($item);?>
                    <div class="records">
                    <span><?php echo $value['record_id']?></span>
                        <label class="">Bericht</label><span ><?php echo $value['recorddate']; ?></span>
                    <div class="record"><?php echo $value['record']; ?></div>
                        <label>Kommentar</label>
                    <div class="comment"><?php echo $value['comment']; ?></div>
                        <span><a href="<?php echo RP; ?>index.php?case=edit&id=<?php echo $value['record_id']; ?>" class="btn btn-link" id="record-link-<?php echo $value['record_id']; ?>">Editieren</a></span>
                </div>
                <?php endforeach; ?>
            </div>
            <div class="calendar col-md-3">
<!--         ausgabe des Kalenders    -->
                <ul class="calendar-list">
                <?php $days = $records->getRecordMonth(2017, 6);
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