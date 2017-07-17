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
        if (isset($_REQUEST)) {
            $this->session = $_REQUEST['key'];
//            $this->session = $_REQUEST[$_REQUEST['key']];
        }
    }

    public function startSession($user = NULL, $session_id = NULL)
    {
//        var_dump($this->user, $_REQUEST, session_name(), session_id());

        if (!isset($session_id) && !empty($this->session)) {
//            var_dump($_REQUEST, ' folgt die session', $_SESSION, 'session name', session_name());
            session_name($this->getSessionName());
        }

//      die session soll erst gestartet werden, wenn sich ein user angemeldet hat.
        elseif (isset($user)) {
            session_name($user['username'].'_'.$user['user_id']);
            session_start();

//            $this->sendPost($user['username'].'_'.$user['user_id']);
//            header('location: '.RP.'index.php');
        }

        //  restart einer laufenden session
        if(isset($session_id)) {
            session_start($session_id);
        }

        if (isset($_REQUEST['PHPSESSID'])) {
            $_SESSION['session_id'] = $_REQUEST['PHPSESSID'];
        }
    }

    public function getUserSession() {
        return $this->user;
    }

    public function sendPost($value) {
        $url = 'https://report-tool.david.exinitdev.de/index.php';
        $data = array('key' => $value);

// use key 'http' even if you send the request to https://...
        $options = array(
            'http' => array(
                'header'  => "Content-type: application/x-www-form-urlencoded\r\n",
                'method'  => 'POST',
                'content' => http_build_query($data)
            )
        );
        $context  = stream_context_create($options);
        $result = file_get_contents($url, false, $context);
        if ($result === FALSE) { echo 'POST failed!'; }

        var_dump($result);
    }

    public function getSessionName() {
        return $this->session;
    }
}
