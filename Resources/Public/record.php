<?php
require_once $_SERVER['DOCUMENT_ROOT'] .'/Resources/PHP/model/config.php';
include ($_SERVER['DOCUMENT_ROOT'] . "/Resources/Private/Layouts/Templates/mainTemplate.html");
?>

<div class="main">
    <div class="board">
        <!--        --><?php //var_dump($_SESSION); ?>
        <div class="container">
            <div class="records col-md-9">
                <span><?php echo $_SESSION['record_id']; ?></span>

<!--            form sendet zum speichern und hinzufügen der Berichte, die Daten            -->
                    <form class="form-group" action="<?php echo RP; ?>index.php?case=save&id=<?php echo $_SESSION['record_id']['record_id']; ?>" method="post">
                        <span><?php echo $_SESSION['record_id']['record_id']?></span>
<!--                Inhalt des Berichts und das Datum        -->
                        <label class="">Bericht</label><span><?php echo $_SESSION['record_id']['recorddate']; ?></span>
                        <textarea class="record" name="record"><?php echo $_SESSION['record_id']['record']; ?></textarea>
<!--                Und ein Kommentar zum Bericht       -->
                        <label>Kommentar</label>
                        <textarea class="comment" name="comment"><?php echo $_SESSION['record_id']['comment']; ?></textarea>
                        <button type="submit">Speichern</button>
<!--                Abbruch und zurück zum Dashboard        -->
                        <span><a href="<?php echo RP; ?>index.php?case=logged">Abbrechen</a></span>
                    </form>
            </div>
            <div class="calendar col-md-3">
                <!--         ausgabe des Kalenders    -->
                <ul class="calendar-list">
                    <?php $records = new DB_Record();
                    $days = $records->getRecordMonth(2017, 6);
                    foreach ($days as $day) { ?>
                        <li><?php echo $day; ?> </li>
                    <?php } ?>
                </ul>
            </div>
        </div>
    </div>
</div>
</body>
</html>