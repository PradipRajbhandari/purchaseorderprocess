<?php 


/* This is a quick utility to generate passwords
   to use in your database, if necessary
 */
$passwd=$_POST['password'];
function get_hash($pass) {
    $bytes = openssl_random_pseudo_bytes(30);
    $random_data = substr(base64_encode($bytes), 0, 22);
    $random_data = strtr($random_data, '+', '.');

    $local_salt = "$2y$12$" . $random_data;
    return crypt($pass, $local_salt);    


    
    
}

$name =$_POST['name'];
$email=$_POST['email'];
$profile=$_POST['profile'];

$password=get_hash($passwd);
if (!empty($name) || !empty($email) || !empty($password))
{

$DB_HOST = "localhost";

$DB_USER = "root";
$DB_PASSWORD = "";

$DB_NAME = "pop";

//creating conncection

$conn = new mysqli($DB_HOST,$DB_USER,$DB_PASSWORD,$DB_NAME);

if (mysqli_connect_error()){
die('Connect Error('.mysqli_connect_errno().')'.mysqli_connect_error());	
}else{
	
	$SELECT ="SELECT email from user where email=? Limit 1";
	$INSERT ="Insert into user(name ,email,password,profile) values (?,?,?,?)";
	
	//prepared statement
	
	
	$stmt= $conn->prepare($SELECT);
	$stmt->bind_param("s",$email);
	$stmt->execute();
	$stmt->bind_result($email);
	$stmt->store_result();
	$rnum=$stmt->num_rows;
	if($rnum==0){
		$stmt->close();
		$stmt=$conn->prepare($INSERT);
		$stmt->bind_param("ssss",$name,$email,$password,$profile);
		$stmt->execute();
		echo"New record inserted successfully:";
	include 'login.php';
	
	
	}
	else{
		
			
		echo"someone already regiseted with this email";
	
		include 'signup.php';
		
}

$stmt->close();
$conn->close();
}
}
else {
	echo "All  field are required";
	die();
}

?>