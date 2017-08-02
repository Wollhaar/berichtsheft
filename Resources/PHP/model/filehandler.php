<?php

class fileHandler
{

    /*
     * Returns Array of all Files in the Profilefolder
     */
    public function getStoredFiles($profileName)
    {

        $profileFolder = $_SERVER['DOCUMENT_ROOT'] . "/Resources/Profiles/" . $profileName . " /";
        if (file_exists($profileFolder)) {
            $folderContent = scandir($profileFolder);
            return $folderContent;
        } else {
            echo '[Error] Profilfolder: ' . $profileFolder . ' doesent exist';
            exit;
        }
    }

    public function uploadFile($profileName)
    {

        if ($_FILES['userfile']['error'] > 0) {
            switch ($_FILES['userfile']['error']) {
                case 1:
                    echo "Die Datei ist größer als die von PHP zugelassene Dateigröße";
                    break;
                case 2:
                    echo "Die Datei ist größer als die im Formular angegeben maximal größe";
                    break;
                case 3:
                    echo "Die Datei wurde unvollständig hochgeladen";
                    break;
                case 4:
                    echo "Es wurde keine Datei hochgeladen";
                    break;
            }
            exit;
        }

        /*
         * Prüfen ob MIME-Type erlaubt ist
         *
         */
        $mimeType = [];
        //MSOffice
        array_push($mimeType, "application/msexcel");
        array_push($mimeType, "application/mshelp");
        array_push($mimeType, "application/mspowerpoint");
        array_push($mimeType, "application/msword");

        //PDF
        array_push($mimeType, "application/pdf");

        //Open Office
        array_push($mimeType,
            "vnd.openxmlformats-officedocument. spreadsheetml.sheet");
        array_push($mimeType,
            "vnd.openxmlformats-officedocument. wordprocessingml.document");

        array_push($mimeType, "application/xhtml+xml");
        array_push($mimeType, "application/xml");
        array_push($mimeType, "application/x-httpd-php");

        //Bilder
        array_push($mimeType, "image/gif");
        array_push($mimeType, "image/ief");
        array_push($mimeType, "image/jpeg");
        array_push($mimeType, "image/png");
        array_push($mimeType, "image/tiff");

        //Texte
        array_push($mimeType, "text/comma-separated-values");
        array_push($mimeType, "text/css");
        array_push($mimeType, "text/javascript");
        array_push($mimeType, "text/plain");
        array_push($mimeType, "text/richtext");
        array_push($mimeType, "text/rtf");
        array_push($mimeType, "text/tab-separated-values");
        array_push($mimeType, "text/xml");

        if (in_array($_FILES['userfile']['type'], $mimeType)) {

            $profileFolder = $_SERVER['DOCUMENT_ROOT'] . "/Resources/Profiles/" . $profileName . "/";
            if (file_exists($profileFolder) == false) {
                echo '[Error] Folder doesent exist';
                exit;
            }

            $upfile = $profileFolder . $_FILES['userfile']['name'];
            if (is_uploaded_file($_FILES['userfile']['tmp_name'])) {
                if (!move_uploaded_file($_FILES['userfile']['tmp_name'],
                    $upfile)) {
                    echo "[Error] Konnte Datei nicht verschieben";
                    exit;
                }
            } else {
                echo '[Error] Möglicher Angriff beim Hochladen Dateiname: ';
                echo $_FILES['userfile']['name'];
                exit;
            }

            echo 'Die Datei wurde erfolgreich hochgeladen';
        }
    }

    public function readProfileFolder($profileName)
    {
        $storedFiles = [];

        $profileFolder = $_SERVER['DOCUMENT_ROOT'] . "/Resources/Profiles/" . $profileName;
        $dir = opendir($profileFolder);
        while ($file = readdir($dir)) {
            if ($file == false) {
                return 'Keine Dateien im Profileverzeichnis vorhanden';
            }

            $user = posix_getpwuid(fileowner($file));
            $group = posix_getgrgid(filegroup($file));

            $storedFiles[] = [
                'fileName'   => $file,
                'lastCall'   => date('j F Y H: i', fileatime($file)),
                'lastChange' => date('j F Y H: i', filemtime($file)),
                'owner'      => $user['name'],
                'userGroup'  => $group['name'],
                'fileRights' => decoct(fileperms($file)),
                'type'       => filetype($file),
                'fileSize'   => filesize($file),
            ];
        }
        closedir($dir);

        return $storedFiles;
    }

    public function serverControll($url, $mail)
    {
        $URL = $url; //"http://recordbook.frankb.exinitdev.de/Resources/Public/recordbook.php";
        $email = $mail; //"f.berdel@exint.de";

        $URL = parse_url($URL);
        $host = $URL['host'];
        if (!($ip = gethostbyname($host))) {
            echo "Der Host dieser URL hat keine gültige IP Adresse";
            exit;
        }

        echo '<pre>';
        echo "Der Host hat die IP-Adresse: " . $ip;
        var_dump($URL);

        $email = explode('@', $email);
        $emailhost = $email[1];
        if (!getmxrr($emailhost, $mxhostsarr)) {
            echo 'In der Mail-Adresse ist kein gültiger Host hinterlegt';
            exit;
        }
        echo 'Mails werden über folgende Host versendet: ';
        foreach ($mxhostsarr as $mx) {
            echo '<li>' . $mx . '</li>';
        }

        echo get_current_user();

//        var_dump(dns_get_mx($emailhost, $mxhostsarr));
        echo '</pre>';
    }

    public function getInstalledExtensions()
    {
        $extArray = get_loaded_extensions();
        foreach ($extArray as $each_ext) {
            echo '<ul>';
            $ext_funcs = get_extension_funcs($each_ext);
            foreach ($ext_funcs as $funcs) {
                echo '<li>' . $funcs . '</li>';
                echo '</ul>';
            }
        }
    }

    public function cookie()
    {
        setcookie('session info', 'eine Information');
    }

}