<?php

require_once $_SERVER['DOCUMENT_ROOT'] .'/Resources/PHP/model/config.php';
include ($_SERVER['DOCUMENT_ROOT'] . "/Resources/Private/Layouts/Templates/mainTemplate.html");


?>
<div class="main">
    <div class="jumbotron" style="background: transparent">
      <?php
      echo '<pre>';
      var_dump($_SESSION);
      echo '</pre>';

      ?>

        <?php if($_SESSION['user']['check'] === true): ?>
            <?php include_once ($_SERVER['DOCUMENT_ROOT'] .'/Resources/Private/Layouts/Partials/welcome.html'); ?>
        <?php endif; ?>

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
//                 getting records for displaying
//                $recordOutput = $records->recordOut($_SESSION['user']['username']);
                foreach($recordOutput as $item => $value): ?>
<!--                    --><?php //var_dump($value);?>
                    <div class="records">
                    <span><?php echo $value['record_id']; ?></span>
                        <label class="">Bericht</label><span ><?php echo $value['recorddate']; ?></span>
                    <div class="record"><?php echo $value['records']; ?></div>
                        <label>Kommentar</label>
                    <div class="comment"><?php echo $value['comment']; ?></div>
                        <span><a href="<?php echo RP; ?>index.php?case=edit&id=<?php echo $value['record_id']; ?>" class="btn btn-link" id="record-link-<?php echo $value['record_id']; ?>">Editieren</a></span>
                </div>
                <?php endforeach; ?>
<!--        add new records        -->
                <div class="add-record container">
                    <!-- form sendet zum speichern und hinzufügen der Berichte, die Daten            -->
                    <h3>Neuen Bericht hinzufügen:</h3>
                    <form class="form-group" action="<?php echo RP; ?>index.php?case=save&user=<?php echo $_SESSION['user']['username']; ?>" method="post">
                        <!--                Inhalt des Berichts und das Datum        -->
                        <label class="">Bericht</label>
                        <textarea class="record" name="record"></textarea>
                        <!--                Und ein Kommentar zum Bericht       -->
                        <label>Kommentar</label>
                        <textarea class="comment" name="comment"></textarea>
                        <button type="submit">Speichern</button>
                        <!--                Abbruch und zurück zum Dashboard        -->
                        <span><a href="<?php echo RP; ?>index.php?case=logged">Abbrechen</a></span>
                    </form>
                </div>
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


<?php include ($_SERVER['DOCUMENT_ROOT'] . 'Resources/Private/Layouts/Partials/footer.html');?>
