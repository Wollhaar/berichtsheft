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
    <link href="/Berichtsheft/Resources/Public/css/main.css" rel="stylesheet">

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <script src="Berichtsheft/Resources/Public/js/bootstrap.min.js"></script>
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
            <div class="user-field">
                <span class="username">Eingeloggt als <a href="/Berichtsheft/index.php?case=logged" class="dropdown-toggle" data-toggle="dropdown"><?php echo $login['username']; ?></a></span>
                <ul class="dropdown-menu">
                    <li><a href="/Berichtsheft/index.php?case=profile"></a>Profil</li>
                    <li><a href="/Berichtsheft/index.php?case=status">Status</a></li>
                    <li><a href="/Berichtsheft/index.php?case=settings">Einstellungen</a></li>
                </ul>
            </div>
        </div><!--/.navbar-collapse -->
    </div>
</nav>

<div class="main">
    <div class="board">
        <?php if($_SESSION['user']['check'] === true): ?>
        <div class="welcome">
            <h2 style="color: #00ff00">Sie wurden erfolgreich registriert.<br/>Willkommen im Berichtstoolheft!</h2>
            <p style="color: lime">Wir wünschen eine erfolgreiche Ausbildung.</p>
        </div>
        <?php endif; ?>
        <?php var_dump($_SESSION); ?>
        <div class="dashboard">
            <h3>Dein Dashboard</h3>
            <p>Alle relevanten Dinge sind, hier für dich notiert.</p>
        </div>
    </div>

</div>
</body>
</html>