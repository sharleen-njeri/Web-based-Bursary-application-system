<?php

    if(isset($_POST['signup'])) {

        require_once 'connection_inc.php';
        require_once 'functions_inc.php';

        //Set the variables to the data received from the signup.html form
        $applicantID = $_POST['applicantID'];
        $firstName = $_POST['firstName'];
        $surName = $_POST['surName'];
        $email =  $_POST['email'];
        $userName = $_POST['userName'];
        $password1 = $_POST['password1'];
        // $password2 = $_POST['applicantID'];

        createUser($conn, $applicantID, $firstName, $surName, $email, $userName, $password1);
    } else if(isset($_POST['burssignup'])) {
        
        require_once 'connection_inc.php';
        require_once 'functions_inc.php';

        //Set the variables to the data received from the signup.html form
        $bursAdminID = $_POST['bursAdminID'];
        $bursFirstName = $_POST['bursFirstName'];
        $bursSurName = $_POST['bursSurName'];
        $bursEmail =  $_POST['bursEmail'];
        $bursUserName = $_POST['bursUserName'];
        $bursPassword1 = $_POST['bursPassword1'];

        createBursaryAdmin($conn, $bursAdminID, $bursFirstName, $bursSurName, $bursEmail, $bursUserName , $bursPassword1);
    }
    else {
        header('location: ../php/signup.php');
    }