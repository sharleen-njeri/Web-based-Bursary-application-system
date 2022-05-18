<?php

    $dbhost = 'localhost';
    $dbuser = 'root';
    $dbpassword = '';
    $dbname = 'bursary';
    
    
    try {
        //Creating the mysqli connection
        $conn = mysqli_connect($dbhost, $dbuser, $dbpassword, $dbname);

    } catch (Exception $e) {                 //Catch the error and display the error if the connection fails

        echo "Connection failed! ". $e->getMessage();
        exit();

    }
