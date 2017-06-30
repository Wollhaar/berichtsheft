<?php
<<<<<<< HEAD



session_start();


function setSessionPost(){


=======
require_once ('../model/DBManager/DB_Record.php');

session_start();




$init = new DB_Record();

//$init->createRecordMonth(6, 2017);
//$init->dropTabels();
//$init->restoreTabels();
//$init->recordOut();


//writeRecordDatabase();
//setSessionPost();

function writeRecordDatabase(){
    $init = new DB_Record();
    setSessionPost();

    $y = 0;

    while (isset($_SESSION['record' . $y])){
        $init->writeRecord(1, $_SESSION['record' . $y], $_SESSION['comment' . $y]);
        $y++;
    }

    $init->recordOut();
}



function setSessionPost(){
>>>>>>> 0787f1a72d73f465f3d6899013c03cd2d63982ef
    if(!isset($_SESSION['status']))
        $_SESSION['status'] = $_POST['status'];
    if(!isset($_SESSION['ort']))
        $_SESSION['ort'] = $_POST['ort'];

    if(!isset($_SESSION['record']))
        $_SESSION['record'] = $_POST['record'];

<<<<<<< HEAD


    $i=0;
    while (isset($_POST['record' . $i])){
        $_SESSION['record' . $i] = $_POST['record' . $i];
        echo $_SESSION['record' . $i] . '<br>';
=======
    $i=0;
    if(isset($_POST['record'])){
        $_SESSION[record] = $_POST['record'];
        echo $_SESSION['record'] . '<br>';
    }

    while (isset($_POST['record' . $i])){
        $_SESSION['record' . $i] = $_POST['record' . $i];
        $_SESSION['comment' . $i] = $_POST['comment' . $i];

>>>>>>> 0787f1a72d73f465f3d6899013c03cd2d63982ef
        $i++;
    }
}


<<<<<<< HEAD
?>
=======


>>>>>>> 0787f1a72d73f465f3d6899013c03cd2d63982ef
