<?php

error_reporting(E_ALL | E_STRICT);
ini_set('display_errors', 'On');

include_once $_SERVER['DOCUMENT_ROOT'] . '/Resources/PHP/model/DBManager/DB_Instructor.php';
include($_SERVER['DOCUMENT_ROOT'] . '/Resources/Private/Layouts/Templates/mainTemplate.html');


$db_instructor = new DB_Instructor();
?>

<div class="container">
  <div class="jumbotron" style="background:transparent">
      <?php
      $test = $db_instructor->getInstructor();
//      var_dump($test);
      var_dump($_SESSION['instructors'])

      ?>
  </div>
</div>

<div class="container">
  <div class="row">
    <div class="col-md-12">
      <ul class="nav nav-pills">
        <li role="presentation"><a href="">Betrieb</a></li>
        <li role="presentation"><a href="">Schule</a></li>
        <li role="presentation"><a href="">Extern</a></li>
      </ul>
    </div>
  </div>

  <div class="container showInstructor">
    <div class="row">
      <div class="col-md-12 col-md-offset-1">
        <label><h2>Betrieblicher Ausbilder</h2></label>
        <form class="form-horizontal">
          <div class="form-group">
            <div class="col-md-6">
              <input type="text" class="form-control" placeholder="Name    Vorname Rolle" readonly="true">
            </div>
            <a href="#" data-toggle="popover"><img src="img/Icon/Informations-Icon.png"></a>
          </div>
        </form>
        <script>
          $(document).ready(function ()
          {
            $('[data-toggle="popover"]')
              .popover({
                title: "<img src='img/img/Profilbild_Ausbilder.png'>",
                content: "Lorem Ipsum",
                placment: "right",
                html: true
              });
          });
        </script>
      </div>
    </div>
  </div>

  <div class="container showInstructor" >
    <div class="row">
      <div class="col-md-12 col-md-offset-1">
        <label><h2>Externe  Ausbilder</h2></label>
        <form class="form-horizontal">
          <div class="form-group">
            <div class="col-md-6">
              <input type="text" class="form-control" placeholder="Name    Vorname Rolle" readonly="true">
            </div>
            <a href="#" data-toggle="popover"><img src="img/Icon/Informations-Icon.png"></a>
          </div>
        </form>
        <script>
          $(document).ready(function ()
          {
            $('[data-toggle="popover"]')
              .popover({
                title: "<img src='img/img/Profilbild_Ausbilder.png'>",
                content: "Lorem Ipsum",
                placment: "right",
                html: true
              });
          });
        </script>
      </div>
    </div>
  </div>

  <div class="container showInstructor">
    <div class="row">
      <div class="col-md-12 col-md-offset-1">
        <label><h2>Schuliche Ausbilder</h2></label>
        <form class="form-horizontal">
          <div class="form-group">
            <div class="col-md-6">
              <input type="text" class="form-control" placeholder="Name    Vorname Rolle" readonly="true">
            </div>
            <a href="#" data-toggle="popover"><img src="img/Icon/Informations-Icon.png"></a>
          </div>
        </form>
        <script>
          $(document).ready(function ()
          {
            $('[data-toggle="popover"]')
              .popover({
                title: "<img src='img/img/Profilbild_Ausbilder.png'>",
                content: "Lorem Ipsum",
                placment: "right",
                html: true
              });
          });
        </script>
      </div>
    </div>
  </div>
</div>

<?php include($_SERVER['DOCUMENT_ROOT'] . '/Resources/Private/Layouts/Partials/footer.html'); ?>
<?php include($_SERVER['DOCUMENT_ROOT'] . '/Resources/Private/Layouts/Partials/javascriptIncludes.html'); ?>
