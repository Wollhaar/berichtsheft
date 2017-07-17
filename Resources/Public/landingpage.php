<?php
/**
 * Created by PhpStorm.
 * User: exinit
 * Date: 10.07.2017
 * Time: 09:11
 */
require_once $_SERVER['DOCUMENT_ROOT'] .'/Resources/PHP/model/config.php';



include ($_SERVER['DOCUMENT_ROOT'] . "/Resources/Private/Layouts/Templates/mainTemplate.html");
echo '<pre>';
var_dump($_SESSION);
echo '</pre>';

?>

    <div class="container" style="padding-top: 200px">
      <div class="row">
        <form action="/Resources/Public/index.php?case=login" method="post">
          <div class="col-md-4 col-md-offset-4">
            <div class="input-group-lg">
              <input type="text" class="form-control" name="username" placeholder="Benutzername" aria-describedby="groessen-addon1">
            </div>
          </div>
      </div>
      <br>
      <div class="row">
        <div class="col-md-4 col-md-offset-4">
          <div class="input-group-lg">
            <input type="password" class="form-control" name="password" placeholder="Password" aria-describedby="groessen-addon2">
          </div>
        </div>
      </div>
      <div class="row">
        <div class="col-md-2 col-md-offset-4">
          <div class="input-group-lg">
            <span><a href="register.php">Neues Konto erstellen</a> </span>
          </div>
        </div>
        <div class="col-md-2">
          <div class="input-group-lg">
            <span><a href="">Password vergessen?</a></span>

          </div>
        </div>
      </div>
      <div class="row">
        <div class="col-md-2 col-md-offset-5">
          <div class="input-group-lg">
            <span><input type="submit" class="form-control" value="Login" style="background: transparent"></span>
            </form>
          </div>
        </div>
      </div>
    </div>


    <?php include ($_SERVER['DOCUMENT_ROOT'] . "/Resources/Private/Layouts/Partials/footer.html")?>



