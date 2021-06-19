<?php
   require_once "include/config.php";

   if(isset($_POST["selected"]) && trim($_POST["selected"]) != "") {
        $selectedValue = $_POST["selected"];
    }

    //Get information of supplier
    $conn = mysqli_connect($DB_HOST, $DB_USER, $DB_PASSWORD, $DB_NAME);
    $sql = "SELECT * FROM supplier WHERE id = '".$selectedValue."'";
    $result = $conn->query($sql);

    //Get Order List
    $conn1 = mysqli_connect($DB_HOST, $DB_USER, $DB_PASSWORD, $DB_NAME);
    $order_sql = "SELECT * FROM product WHERE SupplierId = '".$selectedValue."'";
    $order_result = $conn1->query($order_sql);


    if ($order_result->num_rows > 0) {
      $resultSet = array();

        while ($cRecord = $order_result->fetch_assoc()) {
          $resultSet[] = $cRecord;
        }

      } else {
        echo "0 results";
      }
      echo json_encode($resultSet);
 
?>

