<?php

    //*APPLICANT FUNCTIONS
    function userExists ($conn, $email, $userName) {

        $sql = 'SELECT * FROM applicants WHERE Email = ? OR UserName = ?';
        $stmt = mysqli_prepare($conn, $sql);

        if(!$stmt) {
            header('location: ../php/signup.php?error=stmtfailed');
            exit();
        }

        mysqli_stmt_bind_param($stmt, 'ss', $email, $userName);
        mysqli_stmt_execute($stmt);

        $resultData = mysqli_stmt_get_result($stmt);

        if($row = mysqli_fetch_assoc($resultData)) {
            return $row;
        } else {
            return false;
        }

    }


    function createUser($conn, $applicantID, $firstName, $surName, $email, $userName, $password) {

        $userExists = userExists($conn, $email, $userName);

        if($userExists) {               //Redirect the user to the signup.php page if a user with such a name or email exists
            header('location: ../php/signup.php?error=userexists');
            exit();
        }

        $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

        $sql = 'INSERT INTO applicants(ApplicantID, FirstName, SurName, Email, UserName, Password) VALUES (?, ?, ?, ?, ?, ?)';
        $stmt = mysqli_prepare($conn, $sql);

        if(!$stmt) {
            header('location: ../php/signup.php?error=stmtfailed');
            exit();
        }

        mysqli_stmt_bind_param($stmt,'isssss', $applicantID, $firstName, $surName, $email, $userName, $hashedPassword);
        mysqli_stmt_execute($stmt);

        header('location: ../php/login.php?error=none');
        exit();

    }
    

    function loginUser($conn, $emailOrUsername, $password) {

        $userExists = userExists($conn,$emailOrUsername, $emailOrUsername);

        if($userExists === false) {    
            header('location: ../php/login.php?error=wronglogin');
            exit();
        } 

        $hashedPassword = $userExists['Password'];

        $checkPassword = password_verify($password, $hashedPassword);

        if($checkPassword === false) {

            header('location: ../php/login.php?error=wronglogin');
            exit();         

        } else if($checkPassword === true) {

            session_start();                        //Start a session if the password is correct
            //Set the session variables that will be used in the session
            $_SESSION["userID"] = $userExists['ApplicantID'];
            $_SESSION["role"] = "applicant";
            $_SESSION["FirstName"] = $userExists['FirstName'];
            header("location: ../php/index.php");
            exit();
        }

    }
    function applicationExists ($conn, $applicantID) {

        $sql = 'SELECT * FROM applications WHERE applicantID = ?';
        $stmt = mysqli_prepare($conn, $sql);

        if(!$stmt) {
            header('location: ../php/application.php?error=stmtfailed');
            exit();
        }

        mysqli_stmt_bind_param($stmt, 'i', $applicantID);
        mysqli_stmt_execute($stmt);

        $resultData = mysqli_stmt_get_result($stmt);

        if($row = mysqli_fetch_assoc($resultData)) {
            return $row;
        } else {
            return false;
        }

    }

    function submitApplication($conn, $applicantID, $applicantUni, $admissionNumber, $amountNeeded, $uniIdPicUrl, 
    $familyStatus, $fullName, $phoneNumber, $occupation) {

        $applicationExists = applicationExists($conn, $applicantID);
        if($applicationExists) {               
            header('location: ../php/status.php?info=modify');
            exit();
        }

        $sql = 'INSERT INTO applications(ApplicantID, ApplicantUni, AdmissionNumber, AmountNeeded, IDPictureUrl) VALUES (?, ?, ?, ?, ?)';
        $stmt = mysqli_prepare($conn, $sql);

        if(!$stmt) {
            header('location: ../php/application.php?error=stmtfailed');
            exit();
        }

        mysqli_stmt_bind_param($stmt,'iiiis', $applicantID, $applicantUni, $admissionNumber, $amountNeeded, $uniIdPicUrl);
        mysqli_stmt_execute($stmt);

        //*Filling in the family details table

        $sql2 = 'INSERT INTO familydetails(ApplicantID, FamilyStatus, CPFullName, PhoneNumber, Occupation) VALUES (?, ?, ?, ?, ?)';
        $stmt2 = mysqli_prepare($conn, $sql2);

        if(!$stmt2) {
            header('location: ../php/application.php?error=stmtfailed');
            exit();
        }

        mysqli_stmt_bind_param($stmt2,'issis', $applicantID, $familyStatus, $fullName, $phoneNumber, $occupation);
        mysqli_stmt_execute($stmt2);

        header('location: ../php/status.php?info=successful');
        exit();
    }

    function modifyApplication($conn, $applicantID, $applicantPassword, $redirectRoute) {

        //Check if the password is correct before deleting the application

        $sql = 'SELECT * FROM applicants WHERE ApplicantID = '.$applicantID;
        $result = mysqli_query($conn, $sql);
        $row = mysqli_fetch_assoc($result);
        $hashedPassword = $row['Password'];

        $checkPassword = password_verify($applicantPassword, $hashedPassword);

        if($checkPassword === false) {
            header('location: ../php/status.php?error=wrongpassword');
            exit();
        }

        $sql = 'DELETE FROM applications WHERE ApplicantID = '.$applicantID;
        mysqli_query($conn, $sql);

        header('location: '.$redirectRoute);
        exit();

    }

    //*BURSARY ADMIN FUNCTIONS

    function bursAdminExists ($conn, $email, $userName) {

        $sql = 'SELECT * FROM bursaryadmins WHERE Email = ? OR UserName = ?';
        $stmt = mysqli_prepare($conn, $sql);

        if(!$stmt) {
            header('location: ../php/signup.php?error=stmtfailed');
            exit();
        }

        mysqli_stmt_bind_param($stmt, 'ss', $email, $userName);
        mysqli_stmt_execute($stmt);

        $resultData = mysqli_stmt_get_result($stmt);

        if($row = mysqli_fetch_assoc($resultData)) {
            return $row;
        } else {
            return false;
        }

    }

    function createBursaryAdmin($conn, $bursAdminID, $bursFirstName, $bursSurName, $bursEmail, 
    $bursUserName , $bursPassword) {

        $bursAdminExists = bursAdminExists($conn, $bursEmail, $bursSurName);

        if($bursAdminExists) {               //Redirect the user to the signup.php page if a user with such a name or email exists
            header('location: ../php/signup.php?error=userexists');
            exit();
        }

        $hashedPassword = password_hash($bursPassword, PASSWORD_DEFAULT);

        $sql = 'INSERT INTO bursaryadmins(BursID, FirstName, SurName, Email, UserName, Password) VALUES (?, ?, ?, ?, ?, ?)';
        $stmt = mysqli_prepare($conn, $sql);

        if(!$stmt) {
            header('location: ../php/signup.php?error=stmtfailed');
            exit();
        }

        mysqli_stmt_bind_param($stmt,'isssss', $bursAdminID, $bursFirstName, $bursSurName, $bursEmail, 
        $bursUserName , $hashedPassword);
        mysqli_stmt_execute($stmt);

        header('location: ../php/login.php?error=none');
        exit();

    }

    function loginBursAdmin($conn, $emailOrUsername, $password) {

        $bursAdminExists = bursAdminExists($conn,$emailOrUsername, $emailOrUsername);

        if($bursAdminExists === false) {    
            header('location: ../php/login.php?error=wronglogin');
            exit();
        } 

        $hashedPassword = $bursAdminExists['Password'];

        $checkPassword = password_verify($password, $hashedPassword);

        if($checkPassword === false) {

            header('location: ../php/login.php?error=wronglogin');
            exit();         

        } else if($checkPassword === true) {

            session_start();                        //Start a session if the password is correct
            //Set the session variables that will be used in the session
            $_SESSION["userID"] = $bursAdminExists['BursID'];
            $_SESSION["role"] = "bursadmin";
            $_SESSION["FirstName"] = $bursAdminExists['FirstName'];
            header("location: ../php/index.php");
            exit();
        }

    }

    function acceptApplication($conn, $applicationID) {
        $sql = "UPDATE applications SET ApplicationStatus = 'accepted' WHERE ApplicationID = $applicationID";
        $result = mysqli_query($conn, $sql);

        if(!$result) {
            header('location: ../php/application.php?error=stmtfailed'); //?Something went wrong.
            exit();
        }

        header('location: ../php/application.php?error=none');
        exit();

    }

    function schoolExists ($conn, $UniID) {

        $sql = 'SELECT * FROM universities WHERE UniID = ?';
        $stmt = mysqli_prepare($conn, $sql);

        if(!$stmt) {
            header('location: ../php/schools.php?error=stmtfailed');
            exit();
        }

        mysqli_stmt_bind_param($stmt, 'i', $UniID);
        mysqli_stmt_execute($stmt);

        $resultData = mysqli_stmt_get_result($stmt);

        if($row = mysqli_fetch_assoc($resultData)) {
            return $row;
        } else {
            return false;
        }

    }

    function addSchool($conn, $uniID, $uniName, $uniEmail, $uniLocation) {

        $schoolExists = schoolExists($conn, $uniID);
        if($schoolExists) {               
            header('location: ../php/schools.php?error=schoolexists');
            exit();
        }

        $sql = 'INSERT INTO universities(UniID, UniName, UniEmail, UniLocation) VALUES (?, ?, ?,?)';
        $stmt = mysqli_prepare($conn, $sql);

        if(!$stmt) {
            header('location: ../php/schools.php?error=stmtfailed');
            exit();
        }

        mysqli_stmt_bind_param($stmt,'isss', $uniID, $uniName, $uniEmail, $uniLocation);
        mysqli_stmt_execute($stmt);

        header('location: ../php/schools.php?error=none');
        exit();
    }

    //*SYSTEM ADMIN FUNCTIONS

    function sysAdminExists ($conn, $email, $userName) {

        $sql = 'SELECT * FROM systemadmins WHERE Email = ? OR UserName = ?';
        $stmt = mysqli_prepare($conn, $sql);

        if(!$stmt) {
            header('location: ../php/signup.php?error=stmtfailed');
            exit();
        }

        mysqli_stmt_bind_param($stmt, 'ss', $email, $userName);
        mysqli_stmt_execute($stmt);

        $resultData = mysqli_stmt_get_result($stmt);

        if($row = mysqli_fetch_assoc($resultData)) {
            return $row;
        } else {
            return false;
        }

    }

    function loginSysAdmin($conn, $emailOrUsername, $password) {

        $sysAdminExists = sysAdminExists($conn,$emailOrUsername, $emailOrUsername);

        if($sysAdminExists === false) {    
            header('location: ../php/login.php?error=wronglogin');
            exit();
        } 

        if($password !== $sysAdminExists['Password']) {

            header('location: ../php/login.php?error=wronglogin');
            exit();         

        } else {

            session_start();                        //Start a session if the password is correct
            //Set the session variables that will be used in the session
            $_SESSION["userID"] = $sysAdminExists['SysID'];
            $_SESSION["role"] = "sysadmin";
            header("location: ../php/index.php");
            exit();
        }

    }