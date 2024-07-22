<?php
if(isset($_POST['submitOverseasCertificate'])) {
    header('content-type:image/jpeg');
    $font = "NotoSans-Variable.ttf"; // Make sure this path is correct
    $image = imagecreatefromjpeg("Medical Overseas.jpg");
    $color = imagecolorallocate($image,116,112,67);
    $name = $_POST['name'];
    $medicine = $_POST['medicines'];
    imagettftext($image, 45, 0, 1500, 1345, $color, $font, $name);
    imagettftext($image, 35, 0, 800, 1540, $color, $font, $medicine);

    // Remove invalid characters from the filename
    $name = preg_replace("/[^A-Za-z0-9]/", "", $name);

    // Save the image with the name provided
    imagejpeg($image, "Overseas Certificates/{$name}.jpg");
    imagejpeg($image);
    imagedestroy($image);
}
?>
