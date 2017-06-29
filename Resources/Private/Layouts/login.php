<?php

require_once '../../PHP/model/config.php';
?>
<!-- im Falle eines funktionierenden Routings wird, das hier zum template -->
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
                <li class="active"><a href="<?php echo RP; ?>index.php">Home</a></li> <!-- falls man eingeloggt ist soll der homelink auf den dashboard lenken -->
                <li><a href="<?php echo RP; ?>index.php?case=logged">Übersicht</a></li> <!-- Im Falle: 'ausgeloggt' soll der link zur Loginseite führen.  -->
                <li><a href="<?php echo RP; ?>index.php?case=settings">Einstellungen</a></li>
                <li class="dropdown">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown">Berichtsheft <span class="caret"></span></a>
                    <ul class="dropdown-menu">
                        <li><a href="#">Editieren</a></li>
                        <li><a href="#">Drucken</a></li>
                        <li><a href="#">Kalender übersicht</a></li>
                    </ul>
                </li>
            </ul>

        </div><!--/.navbar-collapse -->
    </div>
</nav>

<div class="main">
    <div class="container"
        <form class="form-horizontal" role="form" method="post" action="<?php echo RP; ?>index.php?case=login">
            <div class="form-group">
                <?php if(is_array($access) && !empty($access)): ?>
                    <span class="wrong"><?php echo($access[0]); ?></span>
                <?php endif; ?>
                <input type="text" placeholder="Benutzer" class="form-control" name="username">
            </div>
            <div class="form-group">
                <input type="password" placeholder="Password" class="form-control" name="password">
            </div>
            <button type="submit" class="btn btn-success">Sign in</button>
        </form>
        <a href="<?php echo RP; ?>index.php?case=register" class="btn btn-link">Registrieren</a>

    </div>
</div>




</body>

</html>
