<?php
$sign = '';
if(isset($_POST['hdnSignature']))
{
 $sign = $_POST['hdnSignature'];
 $path = "signature.png";
 $sign = base64_decode($sign); //convert base64
 file_put_contents($path, $sign); //save to file
 //all done
}
?>
<a href="signature.png">open image</a>