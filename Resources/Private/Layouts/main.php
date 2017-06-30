<?php

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


  <title>Berichtsheft-Tool</title>

  <!-- Bootstrap core CSS -->
<<<<<<< HEAD:Resources/Private/Layouts/main.html
  <link href="/Berichtsheft/Resources/Public/css/bootstrap.css" rel="stylesheet">
  <link href="/Berichtsheft/Resources/Public/css/bootstrap-theme.css" rel="stylesheet">

  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
  <script src="/Berichtsheft/Resources/Public/js/bootstrap.min.js"></script>
=======
  <link href="<?php echo RP.PUB_PATH; ?>css/bootstrap.css" rel="stylesheet">
  <link href="<?php echo RP.PUB_PATH; ?>css/bootstrap-theme.css" rel="stylesheet">
  <link href="<?php echo RP.PUB_PATH; ?>css/main.css" rel="stylesheet">

  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
  <script src="<?php echo RP.PUB_PATH; ?>js/bootstrap.min.js"></script>
>>>>>>> 0787f1a72d73f465f3d6899013c03cd2d63982ef:Resources/Private/Layouts/main.php
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
      <form class="navbar-form navbar-right" role="form" method="post" action="<?php echo RP; ?>index.php?case=login">
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
<<<<<<< HEAD:Resources/Private/Layouts/main.html
      <a href="/Berichtsheft/index.php?case=register" class="btn btn-default">Registrieren</a>
=======
      <a href="<?php echo RP; ?>index.php?case=register" class="btn btn-link">Registrieren</a>
>>>>>>> 0787f1a72d73f465f3d6899013c03cd2d63982ef:Resources/Private/Layouts/main.php
    </div><!--/.navbar-collapse -->
  </div>
</nav>


<div class="jumbotron">
  <div class="container">
    <h1>Aktuelles!</h1>
    <button value="Reset Box" class="btn-default" data-toggle="collapse" data-target="#jumbo">Collapse Information</button>
    <div id="jumbo">
      <div>
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
