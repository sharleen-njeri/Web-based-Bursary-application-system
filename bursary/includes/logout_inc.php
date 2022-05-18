<?php
    session_start();

    session_unset();               //Free all session variables from memory
    session_destroy();           // Destroy all session variables

    header("location: ../php/index.php");

    