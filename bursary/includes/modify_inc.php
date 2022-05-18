<?php
    session_start(); 

    require_once 'connection_inc.php';
    require_once 'functions_inc.php';   

    if(isset($_POST['withdraw'])) {

        $withdrawPwd = $_POST['withdrawPassword'];
        $redirectRoute = '../php/status.php?error=none';

        modifyApplication($conn, $_SESSION['userID'], $withdrawPwd, $redirectRoute);

    } else if(isset($_POST['refill'])){

        $refillPwd = $_POST['refillPassword'];
        $redirectRoute = '../php/application.php?error=none';

        modifyApplication($conn, $_SESSION['userID'], $refillPwd, $redirectRoute);

    } else {

        header('location: ../php/status.php');
        exit();
    }