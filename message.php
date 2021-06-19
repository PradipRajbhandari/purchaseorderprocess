<?php
session_start();
require_once "include/auth.php";
?>
<!DOCTYPE html>
<html>
<head>
    <title></title>
    <link rel="stylesheet" type="text/css" href="style/main.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"
></script>
</head>
<body>



	<div class="content">
		<div class="image"></div>

		<h1 style="color:blue;">Welcome </h1>
	


		
	</div>



	<?php
	required_once('PHPMailer/src/PHPMailer.php');
	$mail= new PHPMailer();
	$mail->isSMTP();
$mail->SMTPAuth=true;
$mail->SMTPSecure ='ssl';
$mail->port="465";
$mail->isHTML();
$mail->Username='rajbhandaripradip00@gmail.com';
$mail->Password='Pr@dip0421313042';
$mail->SetFrom()


	?>



	<script src="script/validate_login.js"></script>

</body>
</html>