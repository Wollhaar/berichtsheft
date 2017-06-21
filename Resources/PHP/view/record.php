<?php



session_start();


function setSessionPost(){


    if(!isset($_SESSION['status']))
        $_SESSION['status'] = $_POST['status'];
    if(!isset($_SESSION['ort']))
        $_SESSION['ort'] = $_POST['ort'];

    if(!isset($_SESSION['record']))
        $_SESSION['record'] = $_POST['record'];



    $i=0;
    while (isset($_POST['record' . $i])){
        $_SESSION['record' . $i] = $_POST['record' . $i];
        echo $_SESSION['record' . $i] . '<br>';
        $i++;
    }
}


?>