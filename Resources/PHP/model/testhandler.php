<?php
/**
 * Created by PhpStorm.
 * User: exinit
 * Date: 07.07.2017
 * Time: 08:32
 */






?>

<html>
    <head>

    </head>
    <body>
        <form enctype="multipart/form-data" action="filehandler.php.php" method="post">
            <input type="hidden" name="MAX_FILE_SIZE" value="1000000">
            <input type="file" name="userfile">
            <input type="submit" value="Hochladen">
        </form>
    </body>
</html>