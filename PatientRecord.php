
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Patient Records</title>
    <style>
    * {
    font-family: math;
    margin:0px;
    padding: 0px;
    }

    body {
        background: #ffff;
    }

    input {
        margin: 10px;
    }

    label {
        font-size: medium;
    }

    #allRec,
    #Rec3,
    #addVisitBtn,
    #Submitbtn,
    #Dr,
    button{
        padding: 7px;
        border-radius: 20px;
        margin:9px 40px;

    }

    #Dr{
    color:#ffff;
    text-decoration: none;    
    }

    #Dr{
        margin-left:260px;
        font-size:larger;   
    }
    #AdminPage{
        text-decoration: none;
        color: inherit;
    }

    #input{
        background-color: #5f9ea0;
        padding-left: 15px;
    }

    #visitInputs {
        background-color: #d7dbda;
        border-radius: 20px;
        padding-left: 8px;
        margin-right: 600px;
        margin-top: 37px;
    }

    table {
    border-collapse: collapse;
    width: 100%;
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
    </style>
</head>

<body>

<form method="post">
    <div id="input">
        <b><label for="P-id">Patient ID:-</label></b>
            <input type="text" name="P-id" id="P-id" placeholder="Enter Patient Id">
            <input type="submit" name="allRec" id="allRec" value="See All Records">
            <input type="submit" name="Rec3" id="Rec3" value="See Last 3 Records">
            <input type="button" value="Add New Visit" id="addVisitBtn">
            <button><a href="Admin.php" id="AdminPage">Admin Page</a></button>
            <a href="#" id="Dr">Dr.Saunil Malvania</a>
    </div>

    <div id="visitInputs"></div>
    </form>
    <script>var visitInputCreated = false;

document.getElementById("addVisitBtn").addEventListener("click", function() {
    if (!visitInputCreated) {
        var visitInputsDiv = document.getElementById("visitInputs");
        var newVisitInput = document.createElement("div");
        newVisitInput.innerHTML = '<br><br>' +
            '<b><label for="visitDate">Visit Date:</label></b>' +
            '<input type="date" name="visitDate" id="visitDate">' +
            '<br><br>' +
            '<b><label for="visitDetails">Visit Details:</label></b>' +
            '<textarea name="visitDetails" id="visitDetails" rows="4" cols="50"></textarea>' +
            '<br><br>' +
            '<b><label for="prescription">Prescription:</label></b>' +
            '<textarea name="prescription" id="prescription" rows="2" cols="30"></textarea>' +
            '<br><br>' +
            '<b><label>Payment Mode:</label></b>'+
            '<input type="radio" name="Payment" value="Online">'+
            '<b><label for="Paymet">Online </label></b>'+
            '<input type="radio" name="Payment" value="Cash">'+
            '<b><label for="Paymet">Cash </label></b>'+
            '<br><br>' +
            '<b><label for="PayAmount">Payment Amount:</label></b>' +
            '<textarea name="PayAmount" id="PayAmount" rows="1" cols="10"></textarea>' +
            '<input type="submit" id="Submitbtn" name="Submitbtn" value="Submit">';
        visitInputsDiv.appendChild(newVisitInput);
        visitInputCreated = true;
    }
});

document.getElementById("addVisitBtn").addEventListener("click", function() {
    var outputTable = document.getElementById("outputTable");
    if (outputTable) {
        outputTable.remove();
    }
});


document.getElementById("allRec ").addEventListener("click", function() {
    var outputTable = document.getElementById("outputTable");
    if (outputTable) {
        outputTable.remove();
    }
});

</script>
</body>

</html>

<?php
if(isset($_POST['Submitbtn'])){
    $server="localhost:3307";
    $username="root";
    $password=""; 

    $con=mysqli_connect($server, $username, $password);

    if(!$con){
        die("Connection to this database failed due to". mysqli_connect_error());
    }

    $pid=$_POST['P-id'];
    $visitDate=$_POST['visitDate'];
    $visitRecord=$_POST['visitDetails'];
    $prescription=$_POST['prescription'];
    $PaymentMode=$_POST['Payment'];
    $PaymentAmount=$_POST['PayAmount'];

    $sql="INSERT INTO `clinic management`.`visittable` (`pid`, `date`, `visit`,`prescription`,`mop`,`amount`)
    VALUES('$pid','$visitDate','$visitRecord','$prescription','$PaymentMode','$PaymentAmount')";

    if($con->query($sql) == true){
        echo '<h1 style="color: green;">Record saved successfully</h1>';
    }else{
        echo "Error: $sql <br>" . $con->error;
    }

    $con->close();
}

elseif(isset($_POST['Rec3'])){
    $server="localhost:3307";
    $username="root";
    $password=""; 

    $con=mysqli_connect($server, $username, $password);

    $id=$_POST['P-id'];

    $retrive3="SELECT * FROM `clinic management`.`visittable`
    WHERE `pid`='$id'
    ORDER BY `date` DESC
    LIMIT 3";

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
        echo '<h1 style="color:red;">No Data Found!!</h1>';
        echo '<h2 style="color:red;">Kindly Check Patient Id</h2>';
    }
    mysqli_close($con);
}

elseif(isset($_POST['allRec'])){
    $server="localhost:3307";
    $username="root";
    $password=""; 

    $con=mysqli_connect($server, $username, $password);

    $id=$_POST['P-id'];

    $retriveall="SELECT * FROM `clinic management`.`visittable`
    WHERE `pid`='$id'
    ORDER BY `date` DESC";

    $result = mysqli_query($con, $retriveall);

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
        echo '<h1 style="color:red;">No Data Found!!</h1>';
        echo '<h2 style="color:red;">Kindly Check Patient Id</h2>';
    }
    mysqli_close($con);
}
?>