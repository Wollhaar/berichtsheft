<?php
session_start();



require_once('../models/user/DB_User.php');
require_once('../views/loginView.php');

$loginDB = new DB_User();

$loginView = new loginView();
//$loginView->loadDefaultPage();


if(isset($_GET['click']) == true){
    switch ($_GET['click']){
        case 'login':{
            if($loginDB->login($_POST['user'], $_POST['password'])==true){
                var_dump($_POST);
                $loginView->render('password');
                break;
            }else{
                $loginView->render('wrongPassword');
                break;
            }

        }
        case 'createAccount':{
            $loginView->render('createAccount');
            break;
        }
        case 'logout':{
            session_regenerate_id(true);
            session_destroy();

            $loginView->loadDefaultPage();
            break;
        }
        default:{
            $loginView->loadDefaultPage();
        }

    }
}else{
    $loginView->loadDefaultPage();
}
