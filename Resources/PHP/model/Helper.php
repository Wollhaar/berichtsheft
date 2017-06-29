<?php

/**
 * Created by PhpStorm.
 * User: exinit
 * Date: 13.06.2017
 * Time: 12:37
 */
class Helper
{
    public function startSession() {

        if (isset($_REQUEST['PHPSESSID']) || isset($_SESSION['session_id'])) {
//            var_dump($_REQUEST, ' folgt die session', $_SESSION, 'session name', session_name());
            if (isset($_REQUEST['PHPSESSID'])) {
                $session_id = array($_REQUEST['PHPSESSID']);
            } elseif (isset($_SESSION['session_id'])) {
                $session_id = array($_SESSION['session_id']);
            }
            session_start($session_id);
        } else {
            session_start();
            header('location: '.RP.'index.php');
        }
        $_SESSION['session_id'] = $_REQUEST['PHPSESSID'];
    }
}