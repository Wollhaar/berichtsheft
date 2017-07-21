<?php
require_once $_SERVER['DOCUMENT_ROOT'] . '/Resources/PHP/model/config.php';
include($_SERVER['DOCUMENT_ROOT'] . "/Resources/Private/Layouts/Templates/mainTemplate.html");

?>

<div class="main">

  <div class="register container">

    <form method="post" action="index.php?case=register&ready=true">

      <div class="form-group">
        <div class="form-block">
          <label for="username">Username</label>
          <input type="text" name="username" class="form-control" id="username" placeholder="Username"/>
        </div>
        <div class="form-block">
          <label for="email">Email</label>
          <input type="text" name="email" class="form-control" id="email" placeholder="email"/>
        </div>
      </div>

      <div class="form-group">
        <div class="form-block">
          <label for="password">Passwort</label>
          <input type="password" name="password" class="form-control" id="password" placeholder="Passwort"/>
        </div>
        <div class="form-block">
          <label for="hidden_password">Bestätigen</label>
          <input type="password" name="hidden_password" class="form-control" id="hidden_password" placeholder="Passwort bestätigen"/>
        </div>
      </div>

      <div class="form-group">
        <div class="form-block">
          <label for="first_name">Vorname</label>
          <input type="text" name="first_name" class="form-control" id="first_name" placeholder="Vorname"/>
        </div>
        <div class="form-block">
          <label for="last_name">Nachname</label>
          <input type="text" name="last_name" class="form-control" id="last_name" placeholder="Nachname"/>
        </div>
      </div>

      <div class="form-group form-block">
        <label for="birthday">Geburtstag</label>
        <input type="date" name="birthday" class="form-control" id="birthday" placeholder="Geburtstag"/>
      </div>

      <div class="form-group">
        <div class="form-block">
          <label for="adress">Adresse</label>
          <input type="text" name="adress" class="form-control" id="adress" placeholder="Adresse"/>
        </div>
        <div class="form-block">
          <label for="PLZ">PLZ</label>
          <input type="text" name="PLZ" class="form-control" id="PLZ" placeholder="PLZ"/>
        </div>
      </div>

      <div class="form-group">
        <div class="form-block">
          <label for="place">Ort</label>
          <input type="text" name="place" class="form-control" id="place" placeholder="Ort"/>
        </div>
        <div class="form-block">
          <label for="country">Land</label>
          <input type="text" name="country" class="form-control" id="country" placeholder="Land"/>
        </div>
      </div>

      <button type="submit">Registrieren</button>

    </form>
  </div>
</div>
</body>
</html>