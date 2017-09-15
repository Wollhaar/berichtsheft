<?php

session_start();

require_once('../models/instructor/DB_Instructor.php');
require_once('../views/instructorView.php');

/*
 *Datenbank inizialisierung evt ungünstig da mit jedem laden der Seite
 * (praktisch bei jeder interaktion) eine Datenbankverbindung aufgebaut wird
 * und die Inhalte in die variablen geschrieben werden
 *
 * möglich wäre zu beginn abzufragen ob die arrays schon einmal befüllt wurden
 * und dann das neuladen zu übersprinen wobei dann bei jeder interaktion mit der DB
 * nachträglich die arrays neu geladen werden müssten
 */
$instructorDB = new DB_Instructor();
$instructorEnterprise = $instructorDB->getEnterprise();
$instructorSchool = $instructorDB->getSchool();
$instructorExtern = $instructorDB->getExtern();

$instructorView = new instructorView();



//Auswahlmenue
if (isset($_GET['click'])) {
    switch ($_GET['click']) {
        case 'enterprice': {
            $instructorView->render($instructorEnterprise, $_GET['click']);
            break;
        }
        case 'school': {
            $instructorView->render($instructorSchool, $_GET['click']);
            break;
        }
        case 'extern': {
            $instructorView->render($instructorExtern, $_GET['click']);
            break;
        }
        case 'add': {
            $instructorView->render($instructorExtern, $_GET['click']);
            break;
        }
        case 'edit':{
            $instructorView->renderEdit($_POST['info'], $_POST['instId'], $_GET['click']);
            break;
        }
        case 'newSubmit':{
            $instructorDB->writeInstructor(
                $_POST['instructorName'],
                $_POST['instructorVorname'],
                $_POST['location'],
                $_POST['instructorRolle'],
                $_POST['content']);
            $instructorView->loadDefaultPage($instructorView);
            break;

        }
        case 'deleteSubmit':{
            $instructorDB->deleteInstructor($_POST['instructorId']);
            $instructorEnterprise = $instructorDB->getEnterprise();
            $instructorSchool = $instructorDB->getSchool();
            $instructorExtern = $instructorDB->getExtern();
            $instructorView->loadDefaultPage($instructorView);
            break;
        }
        case 'editSubmit':{
            $instructorDB->updateInstructor(
                $_POST['instructorId'],
                $_POST['instructorName'],
                $_POST['instructorVorname'],
                $_POST['location'],
                $_POST['instructorRole'],
                $_POST['instructorImg'],
                $_POST['instructorContent']);
            $instructorView->loadDefaultPage($instructorView);
            break;
        }
        default: {
            $instructorView->loadDefaultPage($instructorView);
//            $instructorView->printSide($instructorView);
        }
    }
} else {
    $instructorView->loadDefaultPage();
}
