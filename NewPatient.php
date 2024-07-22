<?php
if(isset($_POST['Submitbtn'])){
    $server="localhost:3307";
    $username="root";
    $password=""; 
    
    $con=mysqli_connect($server, $username, $password);
    
    if(!$con){
        die("Connection to this database failed due to". mysqli_connect_error());
    }


    //fecting data from html form and store in variables
    $patientId=$_POST['patient_id'] ?? '';
    $Pname=$_POST['patient_name'] ?? '';
    $fathername=$_POST['father_name'] ?? '';
    $mothername=$_POST['mother_name'] ?? '';
    $dob=$_POST['date_of_birth'] ?? '';
    $gender=$_POST['gender'] ?? '';
    $mobileNo=$_POST['mobile_number'] ?? '';
    $email=$_POST['email'] ?? '';
    $currAddress=$_POST['current_address'] ?? '';
    $bornPlace=$_POST['place_of_birth'] ?? '';
    $veg=$_POST['veg/non-veg'] ?? '';
    $addication=$_POST['Addication'] ?? '';
    $cosumeAmt=$_POST['CosumeAmount'] ?? '';
    $wakeup=$_POST['WakeUpTime'] ?? '';
    $sleep=$_POST['SleepingTime'] ?? '';
    $dieat=$_POST['DieatSchedule'] ?? '';
    $nature=$_POST['Nature'] ?? '';
    $responsibilites=$_POST['Resposibilites'] ?? '';
    $dreams=$_POST['Dream'] ?? '';
    $GEnv=$_POST['GEnv'] ?? '';
    $Gcomments=$_POST['Comments'] ?? '';
    $Diagnosis=$_POST['Diagnosis'] ?? '';
    $food=$_POST['Food'] ?? '';
    $PreviousIllness=$_POST['PreviousIllness'] ?? '';
    $Enclosures=$_POST['Enclosures'] ?? '';
    
    
    
    //insert data into database
    $sql="INSERT INTO `clinic management`.`new patient data` (`pid`, `pname`, `pfname`, `pmname`, `pdob`, `pgender`, `pmn`, `peid`, 
    `paddress`, `pbornplace`, `pvn`, `padd`, `addamount`, `pwt`, `pst`, `pdieat`, `pnature`, `pres`, `pdreams`, `pge`, `gc`, `diagnosis`, 
    `pfood`, `pi`, `enclosures`)
    VALUES('$patientId','$Pname','$fathername','$mothername','$dob','$gender','$mobileNo','$email','$currAddress','$bornPlace','$veg','$addication',
    '$cosumeAmt','$wakeup','$sleep','$dieat','$nature','$responsibilites','$dreams','$GEnv','$Gcomments','$Diagnosis','$food','$PreviousIllness',
    '$Enclosures')";
 
    if($con->query($sql) == true){
    }else{
        echo "Error: $sql <br>" . $con->error;
    }

    $con->close();
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>New Patient</title>
    <style>* {
    padding: 0px;
    margin: 0px;
    font-family: math;
}

body {
    align-items: center;
    justify-content: center;
    background-color: #bfedf1;
    background: linear-gradient(to right, #5f9ea0, #c6f0f7);
}

img {
    width: 600px;
    height: 200px;
    border-radius: 20px;
    padding-bottom: 8px;
}

.registration {
    width: 600px;
    margin: 50px auto;
    background-color: ghostwhite;
    border-radius: 20px;
    padding: 15px;
}

label {
    font-weight: bold;
}

form,
input,
label,
textarea {
    background-color: ghostwhite;
}

h3 {
    text-align: center;
}

#address {
    width: 265px;
    height: 70px;
}

#health_info,
#DieatSchedule,
#Nature,
#Resposibilites {
    width: 250px;
    height: 60px;
}

#Diagnosis,
#Food,
#Sleep {
    width: 250px;
    height: 60px;
}

#PreviousIllness,
#Comments,
#GEnv {
    width: 250px;
    height: 60px;
}

label {
    margin-right: 3px;
}

#Submitbtn {
    padding: 5px;
    border-radius: 20px;
    background-color: #e2e9ed;
    font-size: medium;
}
</style>

</head>

<body>

    <div class="registration">
        <img src="Game On.png">
        <form onsubmit="return validateForm()" method="post" >
            <hr>
            <h3>PRELIMINARY INFORMATION</h3>
            <hr>
            <br>
            <label>Last Patient Id:-
            <?php
                $server="localhost:3307";
                $username="root";
                $password=""; 
                
                $con=mysqli_connect($server, $username, $password);
                
                if(!$con){
                    die("Connection to this database failed due to". mysqli_connect_error());
                }
            // Fetch the last inserted PID
                $lastInsertedIdQuery = "SELECT pid FROM `clinic management`.`new patient data` ORDER BY pid DESC LIMIT 1";
                $result = mysqli_query($con, $lastInsertedIdQuery);
                if($result && mysqli_num_rows($result) > 0) {
                    $row = mysqli_fetch_assoc($result);
                    $lastInsertedPid = $row['pid'];
                    echo $lastInsertedPid;
                } else {
                    // Handle error if query fails or if there are no existing records
                    $lastInsertedPid = '0';
                }
            ?>
            </label>
            
            <br>
            <br>
            <label for="Pid">Patient ID:</label>
            <input type="text" id="Pid" name="patient_id" placeholder="Enter Patient ID">
            <br>
            <br>
            <label for="PName">Patient Name:</label>
            <input type="text" id="PName" name="patient_name" placeholder="Enter Patient Name">
            <br>
            <br>
            <label for="PFatherName">Patient's Father Name:</label>
            <input type="text" id="PFatherName" name="father_name" placeholder="Enter Patient's Father Name">
            <br>
            <br>
            <label for="PMotherName">Patient's Mother Name:</label>
            <input type="text" id="PMotherName" name="mother_name" placeholder="Enter Patient's Mother Name">
            <br>
            <br>
            <label for="PDOB">Date Of Birth:</label>
            <input type="date" id="PDOB" name="date_of_birth">
            <br>
            <br>
            <label>Gender:</label>
            <input type="radio" id="male" name="gender" value="male">
            <label for="male">Male</label>
            <input type="radio" id="female" name="gender" value="female">
            <label for="female">Female</label>
            <br>
            <br>
            <label for="mobile">Mobile No:</label>
            <input type="tel" id="mobile" name="mobile_number" placeholder="Enter Patient's Mobile Number">
            <br>
            <br>
            <label for="email">Email id:</label>
            <input type="email" id="email" name="email" placeholder="Enter Patient's Email-id">
            <br>
            <br>
            <label for="address">Current Address:</label>
            <textarea id="address" name="current_address" placeholder="Enter Patient's Current Address"></textarea>
            <br>
            <br>
            <label for="birthplace">Born Place:</label>
            <input type="text" id="birthplace" name="place_of_birth" placeholder="Enter Patient's Born Place">
            <br>
            <br>
            <label>Vegetarian/Non-vegetarian:</label>
            <input type="radio" id="veg" name="veg/non-veg" value="Vegetarian">
            <label for="veg">Vegetarian</label>
            <input type="radio" id="non-veg" name="veg/non-veg" value="Non-vegetarian">
            <label for="non-veg">Non-vegetarian</label>
            <input type="radio" id="eggs" name="veg/non-veg" value="Eggs">
            <label for="eggs">Eggs</label>
            <br>
            <br>
            <label>Addictions:</label>
            <br>
            <input type="checkbox" id="Tobacco" name="Addication" value="Tobacco">
            <label for="Tobacco">Tobacco</label>
            <br>
            <input type="checkbox" id="Smoking" name="Addication" value="Smoking">
            <label for="Smoking">Smoking</label>
            <br>
            <input type="checkbox" id="Coffee" name="Addication" value="Coffee">
            <label for="Coffee">Coffee</label>
            <br>
            <input type="checkbox" id="Tea" name="Addication" value="Tea">
            <label for="Tea">Tea</label>
            <br>
            <input type="checkbox" id="Beer" name="Addication" value="Beer">
            <label for="Beer">Beer</label>
            <br>
            <input type="checkbox" id="Wisky" name="Addication" value="Wisky">
            <label for="Wisky">Wisky</label>
            <br>
            <input type="checkbox" id="Liqueors" name="Addication" value="Liqueors">
            <label for="Liqueors">Liqueors</label>
            <br>
            <br>
            <label for="CosumeAmount">Consume Amount:</label>
            <input type="text" name="CosumeAmount" id="CosumeAmount" placeholder="Quantity Cosumed Daily">
            <br>
            <br>
            <label for="WakeUpTime">Wakeup Time:</label>
            <input type="text" name="WakeUpTime" id="WakeUpTime" placeholder="Enter Patient's Morning Wakeup Time">
            <br>
            <br>
            <label for="SleepingTime">Sleeping Time:</label>
            <input type="text" name="SleepingTime" id="SleepingTime" placeholder="Enter Patient's SleepingTime">
            <br>
            <br>
            <label for="DieatSchedule">Dieat Schedule:</label>
            <input type="text" name="DieatSchedule" id="DieatSchedule" placeholder="Enter Patient's Dieatry Schedule">
            <br>
            <br>
            <hr>
            <h3>Patient Personal Data</h3>
            <hr>
            <br>
            <br>
            <label for="Nature">Patient Nature:</label>
            <input type="text" name="Nature" id="Nature" placeholder="About Patient's Nature">
            <br>
            <br>
            <label for="Resposibilites">Resposibilites:</label>
            <input type="text" name="Resposibilites" id="Resposibilites" placeholder="About Patient's Resposibilites">
            <br>
            <br>
            <label for="Sleep">About Sleep & Dreams:</label>
            <input type="text" name="Dream" id="Dream" placeholder="About Patient's Dream">
            <br>
            <br>
            <label for="GEnv">General Environment:</label>
            <input type="text" name="GEnv" id="GEnv" placeholder="weather, temperature, bath, addictions etc.">
            <br>
            <br>
            <label for="Comments">General Comments:</label>
            <input type="text" name="Comments" id="Comments" placeholder="Info which have not been included above">
            <br>
            <br>
            <hr>
            <h3>CHIEF COMPLAINTS</h3>
            <hr>
            <br>
            <br>
            <label for="Diagnosis">Diagnosis:</label>
            <input type="text" name="Diagnosis" id="Diagnosis" placeholder="About Patient's Health">
            <br>
            <br>
            <label for="Food">FOOD:</label>
            <input type="text" name="Food" id="Food" placeholder="Food that do not suit">
            <br>
            <br>
            <label for="PreviousIllness">Previous Illness:</label>
            <input type="text" name="PreviousIllness" id="PreviousIllness" placeholder="Enter About Patient's Previous Illness">
            <br>
            <br>
            <label for="Enclosures">Enclosures:</label>
            <input type="file" name="Enclosures" id="Enclosures">
            <br>
            <br>
            <input type="submit" id="Submitbtn" name="Submitbtn" value="Submit">
        </form>
    </div>

<script>
    function validateForm() {
    var pid = document.getElementById("Pid").value;
    var pname = document.getElementById("PName").value;
    var fatherName = document.getElementById("PFatherName").value;
    var motherName = document.getElementById("PMotherName").value;
    var mobile = document.getElementById("mobile").value;
    var email = document.getElementById("email").value;
    var birthplace = document.getElementById("birthplace").value;

    var pidPattern = /^.{1,10}$/;
    var namePattern = /^[A-Za-z ]{1,20}$/;
    var mobilePattern = /^\d{10}$/;
    var emailPattern = /^[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}$/;
    var birthplacePattern = /^.{1,15}$/;

    if (!pidPattern.test(pid)) {
        alert("Please enter a valid Patient ID (less than 11 characters).");
        return false;
    }
    if (!namePattern.test(pname) || !namePattern.test(fatherName) || !namePattern.test(motherName)) {
        alert("Please enter valid names (less than 21 characters, only letters and spaces allowed).");
        return false;
    }
    if (!mobilePattern.test(mobile)) {
        alert("Please enter a valid mobile number (exactly 10 digits, no letters or special characters).");
        return false;
    }
    if (!emailPattern.test(email)) {
        alert("Please enter a valid email address (less than 31 characters).");
        return false;
    }
    if (!birthplacePattern.test(birthplace)) {
        alert("Please enter a valid birthplace (less than 16 characters).");
        return false;
    }
    return true;
}
</script>
</body>

</html>