    <!DOCTYPE html>
    <html lang="en">

    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>CurePathy</title>
        <style>
            * {
                font-family: math;
                margin: 0px;
            }
            
            .navbar {
                background-color: #5f9ea0;
                font-size: large;
                font-family: math;
                padding: 10px 20px;
                /* Adjust padding */
            }
            
            .navbar ul {
                overflow: auto;
                padding: 0;
                /* Reset padding */
                margin: 0;
                /* Reset margin */
            }
            
            .navbar li {
                display: inline-block;
                /* Change to inline-block for better responsiveness */
                list-style: none;
                margin: 0 10px;
                /* Adjust margin */
            }
            
            .navbar li a {
                padding: 5px 10px;
                /* Adjust padding */
                text-decoration: none;
                color: white;
            }
            
            .navbar li a:hover {
                color: black;
                font-weight: 600;
            }
            
            #heading {
                text-align: center;
                margin: 15px auto;
            }
            
            .Intro {
                display: flex;
                flex-wrap: nowrap;
                /* Prevent wrapping */
                justify-content: space-between;
                align-items: flex-start;
                background-color: ghostwhite;
                border-radius: 10px;
            }
            
            .DoctorIntro {
                margin-left: 18px;
            }
            
            #Photo {
                margin-right: 30px;
                max-width: 100%;
            }
            
            .content {
                margin-left: 40px;
                font-size: large;
            }
            
            #AppointmentButton,
            #CheckAvailability,
            button {
                margin: auto 20px;
                border-radius: 30px;
                background-color: transparent;
                color: white;
                padding: 6px 15px;
                border-color: darkgrey;
            }
            
            .PopUp {
                background-color: ghostwhite;
                border-radius: 6px;
                position: absolute;
                top: 0;
                left: 50%;
                transform: translate(-50%, -50%) scale(0.1);
                text-align: center;
                padding: 0 30px 30px;
                color: #333;
                visibility: hidden;
                transition: transform 0.4s, top 0.4s;
            }
            
            .openPopup {
                visibility: visible;
                top: 50%;
                transform: translate(-50%, -50%) scale(1);
            }
            
            .PopUp img {
                width: 100px;
                margin-top: -50px;
                border-radius: 50%;
                box-shadow: 0 2px 5px rgba(0, 0, 0, 0.2)
            }
            
            .PopUp h2 {
                font-size: 38px;
                font-weight: 500;
                margin: 30px 0 10px;
            }
            
            .PopUp button {
                width: 100%;
                margin-top: 50px;
                padding: 10px 0;
                background-color: #5f9ea0;
                color: #fff;
                border: 0;
                outline: none;
                font-size: 18px;
                border-radius: 4px;
                cursor: pointer;
                box-shadow: 0 5px 5px rgba(0, 0, 0, 0.2);
            }
            
            #About {
                text-align: center;
                font-size: 30px;
                margin: 20px auto;
            }
            
            #AboutTxt {
                text-align: center;
                font-size: large;
                margin: 20px;
                font-family: math;
            }
            
            #ConatctHeading {
                text-align: center;
            }
            
            .Location {
                display: flex;
                flex-wrap: wrap;
                justify-content: space-between;
                align-items: flex-start;
                background-color: ghostwhite;
                border-radius: 10px;
            }
            
            .map {
                width: 100%;
                max-width: 600px;
            }
            
            .ClinicInfo {
                flex: 1;
                margin: 0 20px;
                max-width: 400px;
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


            #Dr{
                margin-left:650px;
            }

            input:hover{
                cursor: pointer;
            }
            /* Media Queries */
            
            @media only screen and (max-width: 768px) {
                .navbar li {
                    margin: 5px 5px;
                    /* Adjust margin for smaller screens */
                }
                .navbar {
                    padding: 10px;
                    /* Adjust padding */
                }
                .DoctorIntro {
                    flex: 1;
                    /* Occupy remaining space */
                    max-width: initial;
                    /* Remove max-width for smaller screens */
                }
            }
            
            @media only screen and (max-width: 600px) {
                .navbar li {
                    margin: 5px 3px;
                    /* Further reduce margin for smaller screens */
                }
            }
        </style>
    </head>

    <body>
        <header>
            <nav class="navbar">
                <ul>
                    <li><form method="post"> <input type="submit" id="CheckAvailability" name="CheckAvailability" value="Check Doctor Availability"></form></li>
                    <li> <input type="button" id="AppointmentButton" value="Book Appointment" onclick="openPopup()"></li>
                    <li><button><a href="login.php">Login</a></button></li>
                    <li><a href="#" id="Dr">Dr.Saunil Malvania</a></li>
                </ul>
            </nav>
        </header>
        <?php
            if(isset($_POST["CheckAvailability"])){
                $server="localhost:3307";
                $username="root";
                $password=""; 
                $database="clinic management"; // Assuming your database name is clinic_management

                // Create connection
                $conn = new mysqli($server, $username, $password, $database);

                // Check connection
                if ($conn->connect_error) {
                    die("Connection failed: " . $conn->connect_error);
                }

                $sql = "SELECT * FROM availability ORDER BY id DESC LIMIT 1";
                $result = $conn->query($sql);

                if ($result->num_rows > 0) {
                    echo '<br>
                    <br>
                    <h1 id="heading">Doctor Availability</h1>
                    <table class="table" id="outputTable" border="3" style="background-color: white;">
                        <thead>
                            <tr>
                                <th style="padding: 8px;">Date</th>
                                <th style="padding: 8px;">Availability</th>
                                <th style="padding: 8px;">Date</th>
                                <th style="padding: 8px;">Availability</th>
                                <th style="padding: 8px;">Date</th> 
                                <th style="padding: 8px;">Availability</th>  
                            </tr>
                        </thead>
                        <tbody>
                        ';

                    while($row = $result->fetch_assoc()) {
                        echo '<tr>
                                <td style="padding: 8px;">' . $row['date'] . '</td>
                                <td style="padding: 8px;">' . $row['availability'] . '</td>
                                <td style="padding: 8px;">' . $row['date1'] . '</td>
                                <td style="padding: 8px;">' . $row['availability1'] . '</td>
                                <td style="padding: 8px;">' . $row['date2'] . '</td>
                                <td style="padding: 8px;">' . $row['availability2'] . '</td>
                            </tr>';
                    }
                    echo '</tbody></table><br><br>';
                } else {
                    echo "0 results";
                }
                $conn->close();
            }
?>

        <h1 id="heading">Meet Our Doctor</h1>
        <div class="Intro">
            <div class="DoctorIntro">
                <h2>Dr Saumil Malvania</h2>
                <strong><p>(MD Homeopathy)</p></strong>
                <br>
                <div class="content">
                    <p>Completed M.D. in homoeopathy in 2009</p>
                    <br>
                    <p>Associated with Institute of Clinical Research in Mumbai</p>
                    <br>
                    <p>Published scientific papers in various Homoeopathic journals</p>
                    <br>
                    <p>Has presented papers in various state & national level conferences & symposias</p>
                    <br>
                    <p>Worked with various institutes & hospitals, & then started private practice in Rajkot since 1986</p>
                    <br>
                    <p>Currently professor & H.O.D in Homoeopathic philosophy at post graduate course in Rajkot Homoeopathy medical College, Parul university</p>
                </div>
            </div>
            <div class="PopUp" id="PopUP">
                <h2>Thank You!</h2>
                <p>To Book an Appointment Contact</p>
                <p>Dr.Saunil Malvania :- 8780484294</p>
                <p>Call in between 11AM to 4PM</p>
                <p> Don't Call on Sunday</p>
                <button type="button" onclick="closePopup()">Ok</button>
            </div>


            <div class="DoctorPhoto">
                <img src="Dr. Saunil Malvania.jpeg" id="Photo">
            </div>
        </div>

        <strong><p id="About">Our Homeopathy Clinic can cure 120+ Diseases Naturally</p></strong>
        <div id="AboutTxt">
            <p> we specialize in various homeopathic treatments for Allergies, Bed-Wetting, Eczema, Female Disorders, Hormonal Imbalance, Lifestyle Disorders, PCOD, Pediatrics, Skin/Hair Problems, Thyroid, and many more.Get your personalised homeopathic treatment
                today from the Afecto homeopathic clinic. Our remedies are safe, non-toxic, and free from side effects. Our experienced homeopathic doctors provide personalized treatments to address your unique health concerns.</p>
        </div>
        <h1 id="ConatctHeading">Contact Us</h1>
        <div class="Location">
            <div class="ClinicInfo">
                <br>
                <h3>Address</h3>
                <p>117, Amrut Com. Complex, 1st Floor, Above Poojara Telecom, Sardarnagar Main Road, Rajkot - 360 001. India</p>
                <br><br>
                <h3>Contact No:-</h3>
                <p>(0281) (O)2468902 (R)2445585</p>
                <p>+91 87804 84294</p>
                <br>
                <br>
                <h3>E-mail</h3>
                <p>drsaunilmalvania@gmail.com</p>
                <br>
                <br>
                <h3>Time</h3>
                <p>10:00 am to 4:30 pm</p>
            </div>
            <div class="map">
                <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d326.2973526420825!2d70.78923816120614!3d22.29188285473356!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x3959ca186bd1a12d%3A0x8d401c05e5b0c247!2sPoojara%20Telecom%20Pvt.%20Ltd.!5e0!3m2!1sen!2sin!4v1709910582078!5m2!1sen!2sin"
                    width="600" height="450" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
            </div>
        </div>

        <script>
            let popup = document.getElementById("PopUP");

            function openPopup() {
                popup.classList.add("openPopup");
            }

            function closePopup() {
                popup.classList.remove("openPopup")
            }


        </script>

    </body>

    </html>

