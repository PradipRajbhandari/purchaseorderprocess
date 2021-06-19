<?php session_start();
require_once "include/config.php";
require_once "include/auth.php";
require_login();
?>


<!DOCTYPE html>
<html>
<head>
    <title>Notification</title>
    <link rel="stylesheet" type="text/css" href="style/main.css">
</head>
<body>
	<?php include "include/nav.php"; ?>

	<div class="content">
	
	<?php 

$login_email = htmlentities(logged_in_user());

	
$email=$_SESSION['email'];

try {
$conn = mysqli_connect($DB_HOST, $DB_USER, $DB_PASSWORD, $DB_NAME);
$conn = new PDO("mysql:host=$DB_HOST;dbname=$DB_NAME", $DB_USER, $DB_PASSWORD);

$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
  } catch(PDOException $e) {
  }

// $query= "select b.title , u.*
// from boardgame as b, user as u , likes 
// where boardgame_id = b.id and user_id=u.id and u.email='ali@fed.edu.au'";

$q = "select * from user where email='".$login_email."'";
$res=$conn->query($q);
$row1= $res->fetch(PDO::FETCH_ASSOC);
$id = $row1['id']; 

$_SESSION['user_id'] = $id;


$profile_query = "select * from user where email='".$login_email."'"; 

$results =$conn->query($profile_query);

$row = $results->fetch(PDO::FETCH_ASSOC);

if(htmlentities(logged_in_user()) === 'Admin'){
  $conn = mysqli_connect($DB_HOST, $DB_USER, $DB_PASSWORD, $DB_NAME);

  $notification_query = "SELECT * FROM purchase_order WHERE is_waiting=1";

	$notification_query_result = mysqli_query($conn, $notification_query);

?>  

<style>
table, th, td {
  border: 1px solid black;
  border-collapse: collapse;
}

th, td {
  padding: 2px;
}
</style>

  <h3 style="text-align:center">------- Notification -------</h3>

  <table style="width:100%">
        <thead>
                <th>Date</th>
                <th>Supplier Name</th>
                <th>Address</th>
                <th>Contact</th>
                <th>Email</th>
                <th>Order-id</th>
                <th>Action</th>
        </thead>
        <tbody>
        <?php 
        
	if ($notification_query_result->num_rows > 0) {
    // output data of each row
      while($row = $notification_query_result->fetch_assoc()) {
        ?>
                <tr>
                    <td><?php echo $row['purchase_date']?></td>
                    <td><?php echo $row['supplier_name']?></td>
                    <td><?php echo $row['purchase_address']?></td>
                    <td><?php echo $row['contact']?></td>
                    <td><?php echo $row['email']?></td>
                    <td>#<?php echo $row['order_id']?></td>
                    <td>
                        <button style="color: white;background: green;"><a href="manage_order.php?order='<?php echo $row['order_id']?>'&&action='<?php echo 'accept'?>'" style="color:white">Accept</a></button><br><br>
                        <button style="color: white;background: red;"><a href="manage_order.php?order='<?php echo $row['order_id']?>'&&action='<?php echo 'decline'?>'" style="color:white">Decline</a></button>
                    </td>
                </tr>

                <?php   
                 }
                } else {
                  ?>
                  <h4 style="color:blue;text-align:center">************* NO NOTIFICATIONS *************</h4>
                  <?php
                }
                ?>
        </tbody>
  </table>


<?php
}
?>
	
			


	
	
		<!-- <h2>Currently logged in as <?php echo htmlentities(logged_in_user()); ?></h2> -->
	 

	</div>

	<?php include "include/footer.php"; ?>

<script>
	
</script>
</body>
</html>





