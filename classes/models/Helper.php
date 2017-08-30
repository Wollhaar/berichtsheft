<?php

/**
 * Created by PhpStorm.
 * User: exinit
 * Date: 13.06.2017
 * Time: 12:37
 */
class Helper
{
    private $user;
    private $session;


    public function __construct()
    {
//        $this->user = $_SESSION['user'];
        if (isset($_REQUEST['key'])) {
            $this->session = $_REQUEST['key'];
//            $this->session = $_REQUEST[$_REQUEST['key']];
        }
    }

    public function startSession($user = NULL, $session_id = NULL)
    {
//        var_dump($this->user, $_REQUEST, session_name(), session_id());

        if (!isset($session_id) && !empty($session_id['key'])) {
//            var_dump($_REQUEST, ' folgt die session', $_SESSION, 'session name', session_name());
            session_name($session_id['key']);
        }

//      die session soll erst gestartet werden, wenn sich ein user angemeldet hat.
        elseif (isset($user)) {
//            session_name($user['username'].'_'.$user['user_id']);
            session_start();
            $_SESSION['session_id'] = session_id();

//            $this->sendPost(session_name());
//            $this->sendPost($user['username'].'_'.$user['user_id']);
//            header('location: '.RP.'index.php');
        }

        //  restart einer laufenden session
        if(isset($session_id)) {
            session_start(array($session_id));
        }

        if (isset($_REQUEST['PHPSESSID'])) {
            $_SESSION['session_id'] = $_REQUEST['PHPSESSID'];
        }
    }


    // ------------------------------------------  temporally not in use ------------------------------------------
//https://konsoleh.your-server.de/?domain=report-tool.david.exinitdev.de
    public function sendPost($value) {
        $url = $_SERVER['DOCUMENT_ROOT'].'/index.php';
        $data = array('key' => $value);

// use key 'http' even if you send the request to https://...
        $options = array(
            'http' => array(
                'header'  => "Content-type: application/x-www-form-urlencoded\r\n"
                    . "Content-Length: " . strlen($data['key']) . "\r\n",
                'method'  => 'POST',
                'content' => $data['key']
            )
        );
        $context  = stream_context_create($options);
        $result = file_get_contents($url, false, $context);
        if ($result === FALSE) { echo 'POST failed!'; }
/*echo '<pre>';
        var_dump($result);
        echo '</pre>';*/
    }
    public function getSessionName() {
        return $this->session;
    }

    public function getUserSession() {
        return $this->user;
    }
}
