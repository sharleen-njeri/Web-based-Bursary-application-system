<?php
    if(isset($_POST['login'])) {

        require_once 'connection_inc.php';
        require_once 'functions_inc.php';

        $emailOrUsername = $_POST['emailOrUsername'];
        $role = $_POST['role'];
        $password = $_POST['password'];

        if($role === 'applicant') {
            loginUser($conn, $emailOrUsername, $password);
        } else if ($role === 'sysadmin') {
            loginSysAdmin($conn, $emailOrUsername, $password);
        } else if ($role === 'bursadmin') {
            loginBursAdmin($conn, $emailOrUsername, $password);
        }

    } else {

        header('location: ../php/login.php');
        exit();
    }