<?php
    session_start();       //*All files have this session_start() function for session handling...

    if(isset($_GET['error'])) {
        if($_GET['error'] === 'schoolexists'){
            echo '<script>alert("The school exists!")</script>';
        } 
    }

    if(isset($_SESSION['userID'])) {                   //?Checking to see if the session variable has been set

        if($_SESSION['role'] === 'bursadmin') {  //*Confirming that the session role of the user is that of  an applicant
            include "../html/schools_form.html";
        } else {
            header('location: index.php');
        }
        
    } else {
        header('location: index.php');
    }