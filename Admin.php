<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Page</title>
    <style>
    *{
        margin:0px;
    }
    .navbar {
    background-color: #5f9ea0;
    font-size: larger;
    padding-top: 10px;
    padding-bottom: 10px;
    }

.navbar a {
    padding: 40px;
    text-decoration: none;
    color: #fff;
    font-family: math;
    justify-content: center;
}

.Daily {
    display: inline-block;
}

.headers{
    display: flex;
    margin-top:15px;
}

#ScheduleHeading {
    width: 300px;
    text-align: center;
    margin-left: 100px;
    margin-top: 14px;   
    padding: 18px 5px;
    font-family: math;
    background-color: rgb(231, 231, 248);
    border-radius: 30px;
}

#Cash {
    width: 300px;
    text-align: center;
    margin-left: 200px;
    margin-top: 18px;
    padding: 3px;
    font-family: math;
    background-color: rgb(231, 231, 248);
    border-radius: 30px;
}

#Online {
    width: 300px;
    text-align: center;
    margin-left: 200px;
    margin-top: 18px;
    padding: 3px;
    font-family: math;
    background-color: rgb(231, 231, 248);
    border-radius: 30px;
}

#appointmentsContainer {
    height: 500px;
    width: 500px;
    background-color: rgb(241, 211, 171);
    border-radius: 30px;
    margin-top: 20px;
    font-family: math;
    padding-top: 30px;
    font-size: large;
    text-align: center;
}

a:hover {
        color: black;
        font-weight: 500;
        }

table {
    border-collapse: collapse;
    width: 130%;
    height:93%
    }

    th, td {
    text-align: left;
    padding: 8px;
    }

    tr:nth-child(even){
    background-color: #d7dbda;
    }

    th {
    background-color: #5f9ea0;
    color: white;
    }

.modal {
    display: none;
    position: fixed;
    z-index: 1;
    left: 0;
    top: 0;
    width: 100%;
    height: 100%;
    overflow: auto;
    background-color: rgba(0, 0, 0, 0.4);
}

.modal-content {
    background-color: #97c4c6;
    margin: 15% auto;
    padding: 20px;
    border: 1px solid #888;
    width: 40%;
    border-radius: 20px;
}

.close {
    color: #aaa;
    float: right;
    font-size: 28px;
    font-weight: bold;
}

.close:hover,
.close:focus {
    color: black;
    text-decoration: none;
    cursor: pointer;
}

#admin{
    display:flex;
    margin:20px ;

}

#latestvisits{
    margin-left:130px;
    margin-right:20px;
}

    </style>
</head>
<body>
    <div class="navbar">
        <!-- <img src="CurePathy1.png" id="logo"> -->
        <a href id="MedicalCertificate">Medical Certificate</a>
        <a href id="OverseasCertificate">Overseas Certificate</a>
        <a href id="addAppointmentLink">Add Appointment</a>
        <a href="NewPatient.php" id="NewPatient">Add New Patient</a>
        <a href="PatientRecord.php" id="P-Id">Visit</a>
        <a href="#" id="Availability">Update Availability</a>
        <a href="#" id="Dr">Dr.Saunil Malvania</a>  
    </div>

    <div class="headers">
    <div class="Daily" id="ScheduleHeading">
        <h2>Appointment Schedule</h2>
    </div>
    <div class="Daily" id="Cash">
        <h2>Cash Payment</h2>
        <h3><?php
            $server="localhost:3307";
            $username="root";
            $password=""; 

            $con=mysqli_connect($server, $username, $password);

           // Get today's date
            $today = date("Y-m-d");

            // Query to get sum of cash payments for today
            $amountQuery = "SELECT COALESCE(SUM(amount), 0) AS total_amount FROM `clinic management`.`visittable` WHERE mop='Cash' AND date='$today'";
            $result = mysqli_query($con, $amountQuery);
            
            if ($result) {
                $row = mysqli_fetch_assoc($result);
                $totalAmount = $row['total_amount'];
                echo $totalAmount; // Output the total amount
            } else {
                echo "0";
            }

            // Close connection
            mysqli_close($con);
        ?></h3>
    </div>
    <div class="Daily" id="Online">
        <h2>Online Payment</h2>
        <h3><?php
            $server="localhost:3307";
            $username="root";
            $password=""; 

            $con=mysqli_connect($server, $username, $password);

            // Get today's date
            $today = date("Y-m-d");

            // Query to get sum of cash payments for today
            $amountQuery = "SELECT COALESCE(SUM(amount), 0) AS total_amount FROM `clinic management`.`visittable` WHERE mop='Online' AND date='$today'";
            $result = mysqli_query($con, $amountQuery);
            
            if ($result) {
                $row = mysqli_fetch_assoc($result);
                $totalAmount = $row['total_amount'];
                echo $totalAmount; // Output the total amount
            } else {
                echo "0";
            }

            // Close connection
            mysqli_close($con);
        ?></h3>
    </div>
    </div>
    
    <div id="admin">
    <div class="Container" id="appointmentsContainer">
            <!-- This is where the appointments will be displayed -->
        </div>

    <div class="Container" id="latestvisits">
        <h1 id="visitRecords">Latest Visit Records:-</h1>
            <?php
             $server="localhost:3307";
             $username="root";
             $password=""; 
         
             $con=mysqli_connect($server, $username, $password);
         
             $retrive3="SELECT * FROM `clinic management`.`visittable`
             ORDER BY `date` DESC
             LIMIT 10";
         
             $result = mysqli_query($con, $retrive3);
         
             if(mysqli_num_rows($result) > 0){
             echo '<table class="table" id="outputTable" border="3" style="background-color: white;">
                 <thead>
                     <tr>
                         <th style="padding: 8px;">Patient ID</th>
                         <th style="padding: 8px;">Visit Date</th>
                         <th style="padding: 8px;">Record</th>
                         <th style="padding: 8px;">prescription</th>
                         <th style="padding: 8px;">Mode Of Payment</th> 
                         <th style="padding: 8px;">Payment Amount</th>  
                     </tr>
                 </thead>
                 <tbody>';
         
                 while ($fetched_data = mysqli_fetch_assoc($result)) {
                     echo '<tr>
                             <td style="padding: 8px;">' . $fetched_data['pid'] . '</td>
                             <td style="padding: 8px;">' . $fetched_data['date'] . '</td>
                             <td style="padding: 8px;">' . $fetched_data['visit'] . '</td>
                             <td style="padding: 8px;">' . $fetched_data['prescription'] . '</td>
                             <td style="padding: 8px;">' . $fetched_data['mop'] . '</td>
                             <td style="padding: 8px;">' . $fetched_data['amount'] . '</td>
                           </tr>';
                 }
             }else{
                 echo '<html>
                 <head></head>
                 <title></title>
                 <body></body>
                 <script>
                 alert("Data Not Found!!");
                 </script>';
             }
             mysqli_close($con);
         
            ?>
    </div>
</div>
    <!-- The Modal -->
    <div id="myModal" class="modal">
        <!-- Modal content -->
        <div class="modal-content">
            <span class="close">&times;</span>
            <label for="patientName">Patient Name:</label>
            <input type="text" id="patientName">
            <label for="appointmentTime">Appointment Time:</label>
            <input type="text" id="appointmentTime">
            <button type="submit" id="submitAppointment">Submit</button>
        </div>
    </div>


    <div id="MedicalCertificateName" class="modal">
        <div class="modal-content">
            <form method="POST" action="MedicalCertificate.php">
                <span class="close">&times;</span>
                <label for="enterPatientName">Enter Patient Name:</label>
                <input type="text" id="enterPatientName" name="name" require>
                <br>
                <br>
                <label for="date">Enter Date:</label>
                <input type="text" id="date" name="date">
                <br>
                <button type="submit" name="submitMedicalCertificate">Submit</button>
            </form>
        </div>
    </div>

    <div id="OverseasCertificateName" class="modal">
        <div class="modal-content">
            <form method="POST" action="OverseasCertificate.php">
                <span class="close">&times;</span>
                <label for="enterPatientName">Enter Patient Name:</label>
                <input type="text" id="EnterPatientName" name="name">
                <br>
                <br>
                <label for="MedicinesName">Enter Medicine Name:</label>
                <input type="text" id="MedicinesName" name="medicines">
                <br>
                <button type="submit" name="submitOverseasCertificate">Submit</button>
            </form>
        </div>
    </div>

    <div id="UpdateAvailability" class="modal">
        <div class="modal-content">
            <form method="POST">
                <span class="close">&times;</span>
                <label for="Date">Date:-</label>
                <input type="Date" id="Date" name="Date">
                <br>
                <br>
                <label for="Reason">Availability:</label>
                <input type="text" id="Reason" name="Reason">
                <br>
                <br>
                <br>
                <label for="Date1">Date:-</label>   
                <input type="Date" id="Date1" name="Date1">
                <br>
                <br>
                <label for="Reason1">Availability:</label>
                <input type="text" id="Reason1" name="Reason1">
                <br>
                <br>
                <br>
                <label for="Date2">Date:-</label>
                <input type="Date" id="Date2" name="Date2">
                <br>
                <br>
                <label for="Reason2">Availability:</label>
                <input type="text" id="Reason2" name="Reason2">
                <br>                                                            
                <button type="submit" name="submitAvailability">Submit</button>
            </form>
        </div>
    </div>

    <script>
        // Get the modals
var modal = document.getElementById("myModal");
var modal1 = document.getElementById("UpdateAvailability");
var modal2 = document.getElementById("MedicalCertificateName");
var modal3 = document.getElementById("OverseasCertificateName");

// Get the link that opens the modals
var AvailabilityLink=document.getElementById("Availability");
var addAppointmentLink = document.getElementById("addAppointmentLink");
var MedicalCertificateLink = document.getElementById("MedicalCertificate");
var OverseasCertificateLink = document.getElementById("OverseasCertificate");

// Get the close buttons
var closeButtons = document.querySelectorAll(".close");

// Get the modal backdrops
var modalBackdrops = document.querySelectorAll(".modal");

// When the user clicks on the link, open the modal
addAppointmentLink.onclick = function() {
    event.preventDefault();
    modal.style.display = "block";
}

AvailabilityLink.onclick = function(event) {
    event.preventDefault();
    modal1.style.display = "block";
}

MedicalCertificateLink.onclick = function(event) {
    event.preventDefault();
    modal2.style.display = "block";
}

OverseasCertificateLink.onclick = function(event) {
    event.preventDefault();
    modal3.style.display = "block";
}



closeButtons.forEach(function(closeButton) {
    closeButton.onclick = function() {
        var modalToClose = this.closest('.modal');
        modalToClose.style.display = "none";
    }
});



window.onclick = function(event) {
        modalBackdrops.forEach(function(modalBackdrop) {
            if (event.target === modalBackdrop) {
                modalBackdrop.style.display = "none";
            }
        });
    }
    document.addEventListener("DOMContentLoaded", function() {
    // Retrieve appointments from storage
    var savedAppointments = JSON.parse(localStorage.getItem("appointments")) || [];
    var appointmentsContainer = document.getElementById("appointmentsContainer");

    // Display saved appointments
    savedAppointments.forEach(function(appointment) {
        createAppointmentDiv(appointment);
    });

    // Handle submit button click
    document.getElementById("submitAppointment").addEventListener("click", function() {
        var patientName = document.getElementById("patientName").value;
        var appointmentTime = document.getElementById("appointmentTime").value;
        var appointmentNumber = appointmentsContainer.getElementsByClassName("appointment").length + 1; // Calculate the appointment number

        if (appointmentNumber > 10) {
            alert("Maximum number of appointments reached. Cannot add more appointments.");
            return; // Exit the function without adding a new appointment
        }

        var newAppointment = appointmentNumber + ") Patient Name: " + patientName + ", Appointment Time: " + appointmentTime;
        createAppointmentDiv(newAppointment);

        // Save appointment to storage
        savedAppointments.push(newAppointment);
        localStorage.setItem("appointments", JSON.stringify(savedAppointments));
    });

    // Function to create appointment div
    function createAppointmentDiv(appointmentText) {
        var appointmentDiv = document.createElement("div");
        appointmentDiv.classList.add("appointment");
        appointmentDiv.textContent = appointmentText;
        appointmentsContainer.appendChild(appointmentDiv);

        var cancelBtn = document.createElement("button");
        cancelBtn.textContent = "x";
        cancelBtn.addEventListener("click", function() {
            appointmentsContainer.removeChild(appointmentDiv);
            savedAppointments = savedAppointments.filter(function(appointment) {
                return appointment !== appointmentText;
            });
            localStorage.setItem("appointments", JSON.stringify(savedAppointments));
        });

        appointmentDiv.appendChild(cancelBtn);
    }
});
 </script>
</body>
</html>


<?php

if(isset($_POST["submitAvailability"])){
$server="localhost:3307";
$username="root";
$password=""; 

$con=mysqli_connect($server, $username, $password);

if(!$con){
    die("Connection to this database failed due to". mysqli_connect_error());
}

$Date=$_POST["Date"];
$Avaibility=$_POST["Reason"];
$Date1=$_POST["Date1"];
$Avaibility1=$_POST["Reason1"];
$Date2=$_POST["Date2"];
$Avaibility2=$_POST["Reason2"];

$sql="INSERT INTO `clinic management`.`availability` (`date`,`availability`,`date1`,`availability1`,`date2`,`availability2`)
VALUES ('$Date','$Avaibility','$Date1','$Avaibility1','$Date2','$Avaibility2')";


if($con->query($sql) == true){
}else{
    echo "Error: $sql <br>" . $con->error;
}


$con->close();
}

?>