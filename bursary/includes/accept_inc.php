<?php
    if(isset($_POST['accept'])) {

        require_once 'connection_inc.php';
        require_once 'functions_inc.php';

        $applicationID = $_POST['applicationID'];

        acceptApplication($conn, $applicationID);

    } else {

        header('location: ../php/application.php');
        exit();
    }