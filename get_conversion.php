<?php
	require_once "include/config.php";
	require_once "include/auth.php";
	$date = $_POST['date'];
    

    
    //Purchase_order

	$con = mysqli_connect($DB_HOST, $DB_USER, $DB_PASSWORD, $DB_NAME);
	$conversion_query = "SELECT * FROM purchase_order WHERE purchase_date='$date'";
	$conversion_query_result = mysqli_query($con, $conversion_query);
	

	//print_r($conversion_query_result);
	// die();
	// print_r($conversion_query_result);

	if ($conversion_query_result->num_rows > 0) {
		$conversion_resultSet = array();

		// output data of each row
		while($row = $conversion_query_result->fetch_assoc()) {
		//   $supplier_name = $row["name"];
		  $conversion_resultSet[] = $row;
		}
	  } else {
		// echo "0 results";
	  }

  
		//   while ($cRecord = $order_result->fetch_assoc()) {
		// 	$conversion_resultSet[] = $cRecord;
		//   }
  
		echo json_encode($conversion_resultSet);

// if ($date) {
//     # code...
//     echo "hgfhgf";
// }

// 	if ($conversion_query_result->num_rows > 0) {
// 		// output data of each row
// 		while($row = $conversion_query_result->fetch_assoc()) {
// 		//   echo $row["name"];
// 		  $supplier_name = $row["name"];
// 		}
// 	  } else {
// 		// echo "0 results";
// 	  }


// 	$purchase_query = "INSERT INTO purchase_order 
// 	(order_id, supplier_id,supplier_name, purchase_date, purchase_address, contact, email, is_approved, is_reject, is_waiting ) VALUES ('$order_id','$supplier_id','$supplier_name','$date','$address','$contact','$email','0','0','1');";

// 	$purchase_result = mysqli_query($con, $purchase_query);
// 			if($purchase_result){
// 			// echo "New order added"."<br>";
// 			}else{
// 				// echo "<br>"."Something went wrong";
// 			}


// 		//Purchase_order
		
// 		for ($i=0; $i < count($quantity); $i++) { 

// 			$total = ( number_format($quantity[$i]) * number_format($price[$i]) ); 
// 			// print_r($total);

// 				$processorder_query = "INSERT INTO process_order (order_id, supplier_id, quantity, item, price, total ) VALUES ('$order_id','$supplier_id','$quantity[$i]','$item[$i]','$price[$i]','$total');";

// 				$processorder_result = mysqli_query($con, $processorder_query);
// 				if($processorder_result){
// 						// echo "New process order added"."<br>";
// 				}else{
// 						// echo "<br>"."Something went wrong";
// 				}
// 		}

// $total = array();
// foreach ($price as $key=>$price1) {
//     $total[] = $price1 * $quantity[$key];
// }

// echo array_sum($total);


    ?>



