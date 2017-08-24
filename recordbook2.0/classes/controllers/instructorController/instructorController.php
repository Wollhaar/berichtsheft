<?php

require_once('../../models/instructor/DB_Instructor.php');
require_once('../../views/instructorView.php');

/*
 * Obejekte mit den gearbeitet werden soll:
 * Arrays mit Instructoren die nach 'location' sortiert sind
 * $InstructorsEnterprise[] $instructorsSchool[] $instructorsExtern[]
 */
$instructorDB = new DB_Instructor();
$instructorEnterprise = $instructorDB->getEnterprise();
$instructorSchool = $instructorDB->getSchool();
$instructorExtern = $instructorDB->getExtern();

$instructorView = new instructorView();
$instructorView->loadDefaultPage();

if (isset($_GET['click'])) {
    switch ($_GET['click']) {
        case 'enterprice': {
            $instructorView->render($instructorView, $instructorEnterprise);
            break;
        }
        default: {
            $instructorView->loadDefaultPage();
        }
    }
}



