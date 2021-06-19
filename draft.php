<?php session_start();
require_once "include/config.php";
require_once "include/auth.php";
require_login();



 $conn = mysqli_connect($DB_HOST, $DB_USER, $DB_PASSWORD, $DB_NAME);

  $drafts_query = "SELECT * FROM drafts";

	$drafts_query_result = mysqli_query($conn, $drafts_query);

     
	// if ($notification_query_result->num_rows > 0) {

  // }
  // print_r($drafts_query_result);


?>


<!DOCTYPE html>
<html>
<head>
    <title>Drafts</title>
    <link rel="stylesheet" type="text/css" href="style/main.css">
</head>
<body>
	<?php include "include/nav.php"; ?>

	<div class="content">
  
<style>
table, th, td {
  border: 1px solid black;
  border-collapse: collapse;
}

th, td {
  padding: 2px;
}
</style>

  <h3 style="text-align:center">----- draft -------</h3>

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
        
	if ($drafts_query_result->num_rows > 0) {
    // output data of each row
      while($row = $drafts_query_result->fetch_assoc()) {
        ?>
                <tr>
                    <td><?php echo $row['purchase_date']?></td>
                    <td><?php echo $row['supplier_name']?></td>
                    <td><?php echo $row['purchase_address']?></td>
                    <td><?php echo $row['contact']?></td>
                    <td><?php echo $row['email']?></td>
                    <td>#<?php echo $row['order_id']?></td>
                    <td>
                        <button style="color: white;background: blue;margin-top:10px"><a href="manage_draft.php?order='<?php echo $row['order_id']?>'&&supplier_name='<?php echo $row['supplier_name']?>'&&purchase_date='<?php echo $row['purchase_date']?>'&&contact='<?php echo $row['contact']?>'&&purchase_address='<?php echo $row['purchase_address']?>'&&email='<?php echo $row['email']?>'&&supplier_id='<?php echo $row['supplier_id']?>'" style="color:white">Purchase</a></button><br><br>
                    </td>
                </tr>

                <?php   
                 }
                } else {
                  ?>
                  <h4 style="color:blue;text-align:center">************* NO DRAFTS *************</h4>
                  <?php
                }
                ?>
        </tbody>
  </table>
  </div>

	<?php include "include/footer.php"; ?>
</body>
</html>





