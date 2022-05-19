<?php
    session_start();       //All files have this session_start() function for session handling...

    if(isset($_SESSION['userID'])) {                   //Checking to see if the session variable has been set

        if($_SESSION['role'] === 'applicant') {  //Confirming that the session role of the user is that of  an applicant
            include "../html/application_form.html";    
?>
<html>
    <div class="section-application">
         <!--*Application Form-->
    <!--TODO: Limit the application only to one, but still display the form-->
    <form action ="../includes/apply_inc.php"method = "POST" enctype="multipart/form-data">
        <div class="university-form">
        <fieldset>
            <legend>UNIVERSITY DETAILS</legend>
        <br><br>
        <label for="university">University</label>
        <select name="applicantUni" id="applicantUni">

            <!--Adding a dropdown of all the schools that have been added-->

            <?php
                require_once "../includes/connection_inc.php";
                $sql = 'SELECT * FROM universities';
                $result = mysqli_query($conn, $sql);
                while($row = mysqli_fetch_assoc($result)) {
                    echo '
                    <option value='.$row['UniID'].'>'.$row['UniName'].'</option>
                    ';
                }
                mysqli_close($conn);
            ?>

        </select>
        <br><br>
        <!--!Change the school field to a dropdown of the registered school in the db-->
        <!--!Ensure all the values are School ID's-->
        <label for="admissionNumber">Admission Number</label>
        <input type="text" id="admissionNumber" name="admissionNumber">
        <br><br>
        <label for="course">Course</label>
        <input type="text" id="course" name="course">
        <br><br>
        <label for="amountNeeded">Amount Needed</label>
        <input id="amountNeeded" name="amountNeeded">
        <br><br>
        <label for="uniIdPicUrl">School ID Picture</label>
        <input type="file"  id="uniIdPicUrl" name="uniIdPicUrl">
        <br><br>
    </fieldset>
          
    </div>
    <div class="family form">
    
    <fieldset>
    <legend>FAMILY DETAILS</legend>
    <br><br>
    <!--*Family Details Section-->

        <label for="familyStatus">Family Status</label>
        <select id="familyStatus" name="familyStatus">
            <option value="Both Parents">Both Parents Present</option>
            <option value="Single Parent">Single Parent</option>
            <option value="guardian">Guardian</option>
        </select> 
        <br><br>

        <!--?Include information that the orphaned child can give details of an adult that can be contacted -->
        <!--?And the rest should give details of either parent -->

        <!--!Change the form according to the family status value selected -->
        <label for="fullName">Parent/ Guardian Full Name</label>
        <input type="text" id="fullName" name="fullName">
        <br><br>
        <label for="phoneNumber">Phone Number</label>
        <input type="number" id="phoneNumber" name="phoneNumber">
        <br><br>
        <label for="occupation">Occupation</label>
        <input type="text" id="occupation" name="occupation">
        <br><br>
        <input type = "submit" id="apply" name = "apply" value = "Submit Application"/>
        </form>
    </fieldset>
            </div>
     </div>
  
  

</html>
<?php
        } else if($_SESSION['role'] === 'bursadmin') {

            require_once "../includes/connection_inc.php";

            include "../html/bursary_confirm.html";
            $sql = "SELECT * FROM applications WHERE ApplicationStatus = 'pending'";
            $result = mysqli_query($conn, $sql);
        
        if(mysqli_num_rows($result) > 0){
            //TODO: To change the URL Picture to an actual image
            echo " 
            <table>
                <tr>
                    <th>Application ID</th>
                    <th>Applicant ID</th>
                    <th>University</th>
                    <th>Admission Number</th>
                    <th>Amount Needed</th>
                   <!-- <th>Picture URL</th-->
                    <th>Confirm Application</th>
                </tr>    
            ";
            while($row = mysqli_fetch_assoc($result)){
                echo '
                <tr>
                    <td>'.$row['ApplicationID'].'</td>
                    <td>'.$row['ApplicantID'].'</td>
                    <td>'.$row['ApplicantUni'].'</td>
                    <td>'.$row['AdmissionNumber'].'</td>
                    <td>'.$row['AmountNeeded'].'</td>
                   <!-- <td><img src="'.$row['IDPictureUrl'].'"/></td-->
                    <td>
                        <form action="../includes/accept_inc.php"  method="POST">
                            <div id = "invisible">
                                <input id="applicationID" type="number" name="applicationID" value="'.$row['ApplicationID'].'">
                            </div>
                                <input id="accept" type="submit" name="accept" value="Accept">
                        </form>
                    </td>
                </tr>
                ';
            }
            echo '</table>
            </body>
            </html>';
        } else {
           echo 'There are no pending applications!';
        }
        
    }

    } else {
        header('location: index.php');
    }