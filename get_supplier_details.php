<?php
   require_once "include/config.php";

   if(isset($_POST["selected"]) && trim($_POST["selected"]) != "") {
        $selectedValue = $_POST["selected"];
    }

    //Get information of supplier
    $conn = mysqli_connect($DB_HOST, $DB_USER, $DB_PASSWORD, $DB_NAME);
    $sql = "SELECT * FROM supplier WHERE Id = '".$selectedValue."'";
    $result = $conn->query($sql);
      

      if ($result->num_rows > 0) {
          while ($row = $result->fetch_assoc()) {
            $arr = array(
                "address" => $row['address'],
                "contact" => $row['contact'],
                "email" => $row['email'],
                "id" =>  $row['Id']
            );
          }
  
        } else {
          echo "0 results";
        }    
      echo json_encode($arr);
?>

