<?php
    session_start();       //All files have this session_start() function for session handling...

    if(isset($_SESSION['userID'])) {                   //Checking to see if the session variable has been set

        if($_SESSION['role'] === 'applicant') {  //Confirming that the session role of the user is that of  an applicant
            include "../html/applicant.html";    
        } elseif ($_SESSION['role'] === 'bursadmin') {
            include "../html/bursaryadmin.html";
        } elseif ($_SESSION['role'] === 'sysadmin') {
            include "../html/sysadmin.html";
        }
        
    } else {
        include "../html/index.html"; 
    }
    