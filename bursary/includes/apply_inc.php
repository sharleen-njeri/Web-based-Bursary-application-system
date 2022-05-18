<?php
    session_start();                              //To access the user id from the session variable
    if(isset($_POST['apply'])) {

        require_once 'connection_inc.php';
        require_once 'functions_inc.php';

        $applicantID = $_SESSION['userID'];
        //Picture Variables 
        //Set the variables to the data received from the application_form.html form
        $applicantUni = $_POST['applicantUni'];
        $admissionNumber = $_POST['admissionNumber'];
        $course = $_POST['course'];
        $amountNeeded = $_POST['amountNeeded'];
        $familyStatus = $_POST['familyStatus'];
        $fullName = $_POST['fullName'];             //Full name of the contact person
        $phoneNumber = $_POST['phoneNumber'];
        $occupation = $_POST['occupation'];

        //ID Picture Input
        $idPic = $_FILES["uniIdPicUrl"];
        $idPicName = $idPic["name"];
        $idPicExt = strtolower(pathinfo($idPicName, PATHINFO_EXTENSION));
        $idPicTmpName = $idPic['tmp_name'];
        $idPicSize = $idPic['size'];
        $idPicError = $idPic['error'];
        $idPicType = $idPic['type'];
        $newIdPicName = uniqid('IMG-', true).".".$idPicExt;
        $idPicDestination = "../uploads/".$newIdPicName;

        if ($idPicError === 0) {
            if ($idPicSize > 5000000 || $idPicSize > 5000000) {
                header("location: ../php/application.php?error=filesizetoobig");
                exit();   
            } else {
                move_uploaded_file($idPicTmpName, $idPicDestination);
                // echo $familyStatus;
                submitApplication($conn, $applicantID, $applicantUni, $admissionNumber, $amountNeeded, $idPicDestination, 
                $familyStatus, $fullName, $phoneNumber, $occupation);
            } 
        }  else {
                header("Location: ../php/status.php?error=erroruploadingfile");
                exit();                      
         }
    } else {
         header('location: ../php/application.php');
    }
    