<?php
if(isset($_POST['submitMedicalCertificate'])) {
header('content-type:image/jpeg');
$font = "NotoSans-Variable.ttf"; // Make sure this path is correct
$image = imagecreatefromjpeg("Medical Certificate.jpg");
$color = imagecolorallocate($image,116,112,67);
$name = $_POST['name'];
$date = $_POST['date'];
imagettftext($image, 30, 0, 1000, 770, $color, $font, $name);
imagettftext($image, 25, 0, 400, 940, $color, $font, $date);

// Remove invalid characters from the filename
$name = preg_replace("/[^A-Za-z0-9]/", "", $name);

// Save the image with the name provided
imagejpeg($image, "Certificates/{$name}.jpg");
imagejpeg($image);
imagedestroy($image);
}
?>
