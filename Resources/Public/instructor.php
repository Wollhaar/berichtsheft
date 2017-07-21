<?php

error_reporting(E_ALL | E_STRICT);
ini_set('display_errors', 'On');

//include_once $_SERVER['DOCUMENT_ROOT'] . '/Resources/PHP/model/DBManager/DB_Instructor.php';
include($_SERVER['DOCUMENT_ROOT'] . '/Resources/Private/Layouts/Templates/mainTemplate.html');
//$db_instructor = new DB_Instructor();
?>

<link rel="stylesheet" href="css/instructor.css">
<script src="js/instructor.js"></script>

<div class="container">
  <div class="jumbotron" id="jumb" style="background:transparent">

  </div>
</div>

<div class="container">
  <div class="row">
    <div class="col-md-12">
      <ul class="nav nav-pills">
        <li role="presentation" onclick="showIstructors('Betrieb')"><a href="#">Betrieb</a></li>
        <li role="presentation" onclick="showIstructors('Schule')"><a href="#">Schule</a></li>
        <li role="presentation" onclick="showIstructors('Extern')"><a href="#">Extern</a></li>
      </ul>
    </div>
  </div>

  <div class="container" id="instructorBlog">
<!--    <div class="row">-->
<!--      <div class="col-md-12 col-md-offset-1">-->
<!--        <label><h2>Betrieblicher Ausbilder</h2></label>-->
<!--        <form class="form-horizontal">-->
<!--          <div class="form-group">-->
<!--            <div class="col-md-6">-->
<!--              <input type="text" class="form-control" placeholder="Name    Vorname Rolle" readonly="true">-->
<!--            </div>-->
<!--            <a href="#" data-toggle="popover"><img src="img/Icon/Informations-Icon.png"></a>-->
<!--          </div>-->
<!--        </form>-->
<!--        <script>-->
<!--          $(document).ready(function ()-->
<!--          {-->
<!--            $('[data-toggle="popover"]')-->
<!--              .popover({-->
<!--                title: "<img src='img/img/Profilbild_Ausbilder.png'>",-->
<!--                content: "Lorem Ipsum",-->
<!--                placment: "right",-->
<!--                html: true-->
<!--              });-->
<!--          });-->
<!--        </script>-->
<!--      </div>-->
<!--    </div>-->
<!--  </div>-->
<!---->
<!---->
<!---->
<!---->
<!--</div>-->

<?php include($_SERVER['DOCUMENT_ROOT'] . '/Resources/Private/Layouts/Partials/footer.html'); ?>

