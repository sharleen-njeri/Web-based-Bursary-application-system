<?php
    if(isset($_POST['addschool'])) {

        require_once 'connection_inc.php';
        require_once 'functions_inc.php';

        $uniID = $_POST['uniID'];
        $uniName = $_POST['uniName'];
        $uniEmail = $_POST['uniEmail'];
        $uniLocation = $_POST['uniLocation'];

        addSchool($conn, $uniID, $uniName, $uniEmail, $uniLocation);

    } else {

        header('location: ../php/schools.php');
        exit();
    }