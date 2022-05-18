<?php
session_start();       //All files have this session_start() function for session handling...

if(isset($_GET['info'])) {
    if($_GET['info'] === 'modify'){
        echo '<script>alert("Your have already filled in the application!")</script>';
    } elseif ($_GET['info'] === 'successful') {
        echo '<script>alert("Application filled successfully!")</script>';
    }
}

if (isset($_SESSION['userID'])) {                   //Checking to see if the session variable has been set

    if ($_SESSION['role'] === 'applicant') {  //Confirming that the session role of the user is that of  an applicant
        include "../html/application_status.html";
        require_once "../includes/connection_inc.php";
        $sql = "SELECT ApplicationStatus FROM applications WHERE ApplicantID = ".$_SESSION['userID'];
        $result = mysqli_fetch_assoc(mysqli_query($conn, $sql));
        if($result === null) {
            echo '<div class="mid-section">
            <p>You have not yet submitted an application</p>.
             <p>Click <a href="application.php">here</a> to fill the application form</p>
        </div>
        <div class="footer">      
            Copyright &copy;Sharleen Njeri                     
        </div>';
        } else {
            if($result['ApplicationStatus'] === 'accepted') {
        
                echo '<div class="mid-section"><p> id="accepted">Your application has been accepted</p></div>';

            } else if ($result['ApplicationStatus'] === 'pending') {

                //Only display the Withdraw and Refill Applications if the application status is pending

            echo '<div class="mid-section">
                    <p id="pending">Your application is pending confirmation</p>
                    <br>'
                    .'<form method="POST" action="../includes/modify_inc.php">
                        <input type="password" name="withdrawPassword" 
                        id="withdrawPassword" placeholder="Enter Password" required>
                        <br><br>
                        <input type="submit" value="Withdraw Application" id="withdraw" name="withdraw">
                    </form>
                    <br>'.

                    '<form method="POST" action="../includes/modify_inc.php">
                        <input type="password" name="refillPassword" 
                        id="refillPassword" placeholder="Enter Password" required>
                        <br><br>
                        <input type="submit" value="Refill Application" id="refill" name="refill">
                    </form>
                    </div>';

        }
        
?>
        <div class="footer">
            Copyright &copy;Sharleen Njeri
        </div>

        </body>

        </html>
<?php
    }
} else {
    include "../html/index.html";
}
}
