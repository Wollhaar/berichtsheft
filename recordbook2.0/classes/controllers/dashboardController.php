<?php

$record = new DB_Record();
$last_record = $record->lastRecord($_SESSION['user_id']);

$helper = new Helper();
$content = $helper->render();

$dashView = new dashboardView($last_record);



$dashView->loadDefaultPage();