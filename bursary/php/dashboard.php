<!DOCTYPE html>
<html>
	<head>
		<title> Bursary application</title>
		<meta charset="utf=8">
		<meta name="keywords" content="Bursary,application," />
		<meta name="description" content="Allowing online bursary application." />
		<meta name="author" content="Sharleen Njeri" />
		<link rel = "stylesheet"   type = "text/css" href = "../css/main.css">
		<link rel = "stylesheet"   type = "text/css" href = "../css/new.css">
	
	</head>
	<body>
        <nav class = "nav">
            <ul class="ul-nav">
                <li><a href ="index.php">HOME</a></li>
                <li><a href ="dashboard.php">DASHBOARD</a></li>
                <li><a href ="../includes/logout_inc.php">LOG OUT</a></li>
            </ul>
        </nav>

            <div class="dashcards">
            <?php 

            require_once "../includes/connection_inc.php";
            //Add php dashboard information as cards      <<Flex>>

            //Querries
            $sql = "SELECT * FROM applicants";
            $numberOfApplicants = mysqli_num_rows(mysqli_query($conn, $sql));

            $sql = "SELECT * FROM applications";
            $numberOfApplications = mysqli_num_rows(mysqli_query($conn, $sql));

            $sql = "SELECT * FROM applications WHERE ApplicationStatus = 'accepted'";
            $acceptedApplications = mysqli_num_rows(mysqli_query($conn, $sql));

            $sql = "SELECT * FROM bursaryadmins";
            $numberOfBursaryAdmins = mysqli_num_rows(mysqli_query($conn, $sql));

            $sql = "SELECT * FROM universities";
            $numberOfUnis = mysqli_num_rows(mysqli_query($conn, $sql));

            $sql = "SELECT SUM(AmountNeeded) as TotalAmount FROM applications WHERE ApplicationStatus = 'accepted'";
            $totalAmtAllocated = mysqli_fetch_assoc(mysqli_query($conn, $sql));
            
            echo '
            <div class=mid-section-cards>
                <div class="dashcard">
                    <p>APPLICANTS</p>
                    <span>'.$numberOfApplicants.'</span>
                    <br>
                </div>

                <div class="dashcard">
                    <p>APPLICATIONS</p>
                    <span>'.$numberOfApplications.'</span>
                    <br>
                </div>

                <div class="dashcard">
                    <p>ACCEPTED APPLICATIONS</p>
                    <span>'.$acceptedApplications.'</span>
                    <br>
                </div>

                <div class="dashcard">
                    <p>BURSARY ADMINS</p>
                    <span>'.$numberOfBursaryAdmins.'</span>
                    <br>
                </div>

                <div class="dashcard">
                    <p>UNIVERSITIES</p>
                    <span>'.$numberOfUnis.'</span>
                    <br>
                </div>

                <div class="dashcard">
                    <p>AMOUNT ALLOCATED</p>
                    <span>'.$totalAmtAllocated['TotalAmount'].'</span>
                    <br>
                </div>
            </div>
            ';
            // $sql = "SELECT (UniID, UniName, UniEmail) FROM applications
            // JOIN SELECT
            // ";
            // $result = mysqli_query($conn, $sql);

            // if(mysqli_num_rows($result) > 0){
            //     echo " 
            //     <table>
            //         <tr>
            //             <th>Application ID</th>
            //             <th>Applicant ID</th>
            //             <th>University</th>
            //             <th>Admission Number</th>
            //             <th>Amount Needed</th>
            //             <th>Picture URL</th>
            //             <th>Confirm Application</th>
            //         </tr>    
            //     ";
            //     while($row = mysqli_fetch_assoc($result)){
            //         echo '
            //         <tr>
            //             <td>'.$row['ApplicationID'].'</td>
            //             <td>'.$row['ApplicantID'].'</td>
            //             <td>'.$row['ApplicantUni'].'</td>
            //             <td>'.$row['AdmissionNumber'].'</td>
            //             <td>'.$row['AmountNeeded'].'</td>
            //             <td><img src="'.$row['IDPictureUrl'].'"/></td>
            //             <td>
            //                 <form action="../includes/accept_inc.php"  method="POST">
            //                     <div id = "invisible">
            //                         <input id="applicationID" type="number" name="applicationID" value="'.$row['ApplicationID'].'">
            //                     </div>
            //                         <input id="accept" type="submit" name="accept" value="Accept">
            //                 </form>
            //             </td>
            //         </tr>
            //         ';
            //     }
            // } else {
            //     echo 'There are no registered universities';
            // }
            ?>
            </div>
            <div class="footer">
                Copyright &copy;Sharleen Njeri   
                              
                </div>
    
        </body>
    </html>                   