<?php


class fileHandler{


    /*
     * Returns Array of all Files in the Profilefolder
     */
    public function getStoredFiles($profileName){

        $profileFolder = $_SERVER['DOCUMENT_ROOT'] . "/Resources/Profiles/" . $profileName ." /";
        if(file_exists($profileFolder)){
            $folderContent = scandir($profileFolder);
            return $folderContent;
        }else{
            echo '[Error] Profilfolder: ' . $profileFolder . ' doesent exist';
            exit;
        }
    }




    public function uploadFile($profileName){


        if($_FILES['userfile']['error'] > 0){
            switch ($_FILES['userfile']['error']){
                case 1: echo "Die Datei ist größer als upload_max_file_size"; break;
                case 2: echo "Die Datei ist größer als max_file_size"; break;
                case 3: echo "Die Datei wurde unvollständig hochgeladen"; break;
                case 4: echo "Es wurde keine Datei hochgeladen"; break;
            }
            exit;
        }

        /*
         * Prüfen ob MIME-Type erlaubt ist
         *
         */
        $mimeType = array();
        //MSOffice
        array_push($mimeType, "application/msexcel");
        array_push($mimeType, "application/mshelp");
        array_push($mimeType, "application/mspowerpoint");
        array_push($mimeType, "application/msword");

        //PDF
        array_push($mimeType, "application/pdf");

        //Open Office
        array_push($mimeType, "vnd.openxmlformats-officedocument. spreadsheetml.sheet");
        array_push($mimeType, "vnd.openxmlformats-officedocument. wordprocessingml.document");

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

        if(in_array($_FILES['userfile']['type'], $mimeType)){

            $profileFolder = $_SERVER['DOCUMENT_ROOT'] . "/Resources/Profiles/". $profileName ."/";
            if(file_exists($profileFolder)==false){
                echo '[Error] Folder doesent exist';
                exit;
            }

            $upfile = $profileFolder . $_FILES['userfile']['name'];
            if(is_uploaded_file($_FILES['userfile']['tmp_name'])){
                if(!move_uploaded_file($_FILES['userfile']['tmp_name'], $upfile)){
                    echo "[Error] Konnte Datei nicht verschieben";
                    exit;
                }
            }else {
                echo '[Error] Möglicher Angriff beim Hochladen Dateiname: ';
                echo $_FILES['userfile']['name'];
                exit;
            }

            echo 'Die Datei wurde erfolgreich hochgeladen';
        }
    }
}

$test = new fileHandler();
$test->getStoredFiles();






















