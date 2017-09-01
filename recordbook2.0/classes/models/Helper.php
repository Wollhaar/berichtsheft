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

    function render($dbArray, $classname, $templateName)
    {
// switch case, was angezeigt werden soll (Betrieb/Schule/Extern) - z.B. über Request-Parameter
// (die Seite wird ja neu geladen, wenn man auf der Seite einen der Links angeklickt, da kann man dann den Parameter ranhängen.
//        $dbEntries = $dbArray; // deine DB-Methode, um die Daten zu holen
//        $content = '';

        foreach ($dbArray as $array) {

//          $recordTemplate = readfile($_SERVER['DOCUMENT_ROOT'] . '/recordbook2.0/resources/templates/partials/recordDbInstructor.html');
//          readFile liest die datei als file ein daher kann kein String replace über die Variable gemacht werden
//          file_get_cotent liest die file als String ein

//            muss dynamisch gehalten werden je nachdem welches partial geladen werden soll.
//            also den namen des gefordert partial mit übergeben und worauf hier dann nach dem pfad gesucht wird
            $template = file_get_contents($_SERVER['DOCUMENT_ROOT'] . TEMP_PATH.$classname.$templateName.'.html');

//            schleife bauen um die richtigen marker zu finden und diese in einem array zu verstauen

//            $find = array();

/*
//            je nachdem wie viele marker im HTML gefunden werden, sollen genauso viele durch str_replace mit daten ersetzt werden
            $search = [
//                foreach ($find as $marker):
                $marker,
                'prop2' => '###VORNAME###',
                'prop3' => '###ROLE###',
//            endforech;
            ];
            $replace = [
                $array[$content],
                $array['vorname'],
                $array['role'],
            ];
//   ^^^^ ^^  ^^  ^^  nach Lösung wird gesucht ^^^^
//
            $template = str_replace($search, $replace, $template);
//            $content .= $recordTemplate;*/

            foreach ($array as $key => $value) {
                $template = preg_replace('###' . strtoupper($key) . '###', $value, $template);
            }
        }
//        das durch daten ersetzte template wird zur view zurückgegeben
        return $template;

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
