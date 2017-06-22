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
    <link href="/Berichtsheft/Resources/Public/css/bootstrap.css" rel="stylesheet">
    <link href="/Berichtsheft/Resources/Public/css/bootstrap-theme.css" rel="stylesheet">
    <link href="/Berichtsheft/Resources/Public/css/main.css" rel="stylesheet">

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <script src="/Berichtsheft/Resources/Public/js/bootstrap.min.js"></script>
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
            <form class="navbar-form navbar-right" role="form" method="post" action="/Berichtsheft/index.php?case=login">
                <div class="form-group">
                    <input type="text" placeholder="Benutzer" class="form-control" name="username">
                </div>
                <div class="form-group">
                    <input type="password" placeholder="Password" class="form-control" name="password">
                </div>
                <button type="submit" class="btn btn-success">Sign in</button>
            </form>
        </div><!--/.navbar-collapse -->
    </div>
</nav>

<div class="main">

    <div class="register container">

        <form method="post" action="/Berichtsheft/index.php?case=register&ready=true">

            <div class="form-group">
                <div class="form-block">
                    <label for="username">Username</label>
                    <input type="text" name="username" class="form-control" id="username" placeholder="Username" />
                </div>
                <div class="form-block">
                    <label for="email">Email</label>
                    <input type="text" name="email" class="form-control" id="email" placeholder="email" />
                </div>
            </div>

            <div class="form-group">
                <div class="form-block">
                    <label for="password">Passwort</label>
                    <input type="password" name="password" class="form-control" id="password" placeholder="Passwort" />
                </div>
                <div class="form-block">
                    <label for="hidden_password">Bestätigen</label>
                    <input type="password" name="hidden_password" class="form-control" id="hidden_password" placeholder="Passwort bestätigen" />
                </div>
            </div>

            <div class="form-group">
                <div class="form-block">
                    <label for="first_name">Vorname</label>
                    <input type="text" name="first_name" class="form-control" id="first_name" placeholder="Vorname" />
                </div>
                <div class="form-block">
                    <label for="last_name">Nachname</label>
                    <input type="text" name="last_name" class="form-control" id="last_name" placeholder="Nachname" />
                </div>
            </div>

            <div class="form-group form-block">
                <label for="birthday">Geburtstag</label>
                <input type="date" name="birthday" class="form-control" id="birthday" placeholder="Geburtstag" />
            </div>

            <div class="form-group">
                <div class="form-block">
                    <label for="adress">Adresse</label>
                    <input type="text" name="adress" class="form-control" id="adress" placeholder="Adresse" />
                </div>
                <div class="form-block">
                    <label for="PLZ">PLZ</label>
                    <input type="text" name="PLZ" class="form-control" id="PLZ" placeholder="PLZ" />
                </div>
            </div>

            <div class="form-group">
                <div class="form-block">
                    <label for="place">Ort</label>
                    <input type="text" name="place" class="form-control" id="place" placeholder="Ort" />
                </div>
                <div class="form-block">
                    <label for="country">Land</label>
                    <input type="text" name="country" class="form-control" id="country" placeholder="Land" />
                </div>
            </div>

            <button type="submit">Registrieren</button>

        </form>


    </div>
</div>
</body>
</html>