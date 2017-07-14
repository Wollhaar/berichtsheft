<?php

/**
 * Created by PhpStorm.
 * User: exinit
 * Date: 13.06.2017
 * Time: 12:37
 */
class Helper
{
    public function startSession($user = NULL, $restart = NULL)
    {

        if (isset($restart) && !empty($user['session_id'])) {
//            var_dump($_REQUEST, ' folgt die session', $_SESSION, 'session name', session_name());
            session_name($user['session_id']);
        }

//      die session soll erst gestartet werden, wenn sich ein user angemeldet hat.
        elseif (isset($user)) {
            session_name($user['username'].'_'.$user['user_id']);
            session_start();
//            header('location: '.RP.'index.php');
        }

        //  restart einer laufenden session
        if(isset($session_id)) {
            session_start($session_id);
        }

        $_SESSION['session_id'] = $_REQUEST['PHPSESSID'];
    }
}
