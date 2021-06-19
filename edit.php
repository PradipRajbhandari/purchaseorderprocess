



<?php session_start();
require_once "include/config.php";
require_once "include/auth.php";

// you have to be logged in to view this page
// This function is in utils.php
require_login();
?>


<!DOCTYPE html>
<html>
<head>
    <title>assignment 1</title>
    <link rel="stylesheet" type="text/css" href="style/main.css">
</head>
<body>
	<?php include "include/nav.php"; ?>

	<div class="content">
	
	<?php 
	
$email=$_SESSION['email'];


$conn = new PDO(("mysql:host=localhost;dbname=pop"),"root","");

// $query= "select * from user where email='$email' ";

$query= "select * from user where email='$email'";

$results =$conn->query($query);

 $row= $results->fetch(PDO::FETCH_ASSOC);
?>


<form method="POST" action="update.php" enctype="multipart/form-data">
		<table><caption><h1> Details of <h2><?php echo $row['name']?></h2> </h1></caption>
							<center><img src="images/user/<?php echo $row['image']?>" style="width: 100px; height: 100px; border-radius: 50%;"></center>
							<tr>
								<td>Email</td>
								<td><input type="text" name="email" value="<?php echo $row['email']?>" ></td>
							</tr>
							<td>Change Image</td>
								<td><input type="file" name="image"></td>
						
							<tr>
								<td>Full Name</td>
								<td><input type="text" name="name" value="<?php echo $row['name']?>"></td>
							</tr>
							
						

						
						<tr><td>
						<input type="submit" name="submit" value="Update "></td>
								</td>
						</table>
			
</form>

	
	
		<h2>Currently logged in as <?php echo htmlentities(logged_in_user()); ?></h2>
		<form action="logout.php" method="POST">
			<button>Log out</button>
		</form> 

	</div>

	<?php include "include/footer.php"; ?>

<script>
	
</script>
</body>
</html>





