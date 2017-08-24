<?php

error_reporting(E_ALL | E_STRICT);
ini_set('display_errors', 'On');

include_once $_SERVER['DOCUMENT_ROOT'] . '/Resources/PHP/model/DBManager/DB_Instructor.php';
include($_SERVER['DOCUMENT_ROOT'] . '/Resources/Private/Layouts/Templates/mainTemplate.html');



?>

<link rel="stylesheet" href="css/instructor.css">
<script src="js/instructor.js"></script>

<div class="container">
  <div class="jumbotron" id="jumb"  style="background:transparent">
    <div class="row">
      <p>Zu bearbeitenden Ausbilder per D&D in das untere Feld ziehen</p>
      <div id="jumbDrop" ondrop="drop(event)" ondragover="allowDrop(event)" class="col-md-6">
        <p></p>
      </div>
      <div class="col-md-6">
        <div id="edit"></div>
      </div>
    </div>

    <?php

    ?>

  </div>
</div>

<div class="container">
  <div class="row">
    <div class="col-md-12">
      <ul class="nav nav-pills">
        <li role="presentation" onclick="showIstructors('Betrieb')"><a href="#">Betrieb</a></li>
        <li role="presentation" onclick="showIstructors('Schule')"><a href="#">Schule</a></li>
        <li role="presentation" onclick="showIstructors('Extern')"><a href="#">Extern</a></li>
        <li role="presentation" onclick="addInstructor()"><span class="glyphicon glyphicon glyphicon-plus"></span></li>
      </ul>
    </div>
  </div>

  <div class="container" id="instructorBlog">




<?php include($_SERVER['DOCUMENT_ROOT'] . '/Resources/Private/Layouts/Partials/footer.html'); ?>

