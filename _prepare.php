<?php
	require_once "include/config.php";
	require_once "include/auth.php";
	//New User Data
	$quantity = $_POST['quantity'];
	$price = $_POST['unit']; 
	$item = $_POST['item'];
	
	$supplier_id = $_POST['supplier_id'];

// 	print_r($quantity[1]);
// print_r($quantity);
	// while (count($quantity) > 0) {
	
	//   }
    $con = mysqli_connect($DB_HOST, $DB_USER, $DB_PASSWORD, $DB_NAME);

	for ($i=0; $i < count($quantity); $i++) { 
		// print_r($quantity[$i]);
			$admin_query = "INSERT INTO admin (quantity, item, price, total, is_approved, is_waiting, supplier_id )VALUES ('$quantity[$i]','$item[$i]','$price[$i]','($price[$i] * $quantity[$i])','0','1','$supplier_id');";
			$admin_result = mysqli_query($con, $admin_query);
			print_r($admin_query);
			// print_r($admin_result);

			if($admin_result){
			echo "New user data added"."<br>";
			// header("location:index.php");
			}else{
				echo "<br>"."New user data not added";
				// header("location:prepare.php");
			}

			$admin_update_query = 'UPDATE admin SET total=quantity*price';
			$admin_update_result = mysqli_query($con, $admin_update_query);

			if($admin_update_result){
				echo "updated"."<br>";
				header("location:prepare.php?data='siddhant'");
				}else{
					echo "<br>"."not updated";
					header("location:prepare.php");
				}

	}


	// $query = "INSERT INTO purchase VALUES('$quantity','$unit','$item','$quantity','$unit','$item')";
	// $run = mysqli_query($con, $query);
	// if($run){
	// 	echo "New user data added"."<br>";
	// 	header("location:index.php");
	// }else{
	// 	echo "<br>"."New user data not added";
	// 	header("location:prepare.php");
	// }

?>