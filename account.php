<?php session_start();
require_once "include/config.php";
require_once"include/auth.php";
require_login();

// Waiting Account
$conn = mysqli_connect($DB_HOST, $DB_USER, $DB_PASSWORD, $DB_NAME);
$accountwaiting_query = "SELECT * FROM purchase_order WHERE is_waiting=1";
$accountwaiting_result = mysqli_query($conn, $accountwaiting_query);
$wait_total=0;
if ($accountwaiting_result->num_rows > 0) {
  while($row = $accountwaiting_result->fetch_assoc()) {
      $orderid = $row['order_id'];
      $sum_query = "SELECT * FROM process_order WHERE order_id = $orderid";
      $sum_result = mysqli_query($conn, $sum_query);
      if ($sum_result->num_rows > 0) {
        while($row1 = $sum_result->fetch_assoc()) {
            $wait_total = $wait_total + $row1['total']; 
        }
      }
  } 
  // print_r("total --- >".$wait_total);
}
else{}



// Approved Account
$conn = mysqli_connect($DB_HOST, $DB_USER, $DB_PASSWORD, $DB_NAME);
$approved_query = "SELECT * FROM purchase_order WHERE is_approved=1";
$approved_result = mysqli_query($conn, $approved_query);
$approved_total=0;
if ($approved_result->num_rows > 0) {
  while($row = $approved_result->fetch_assoc()) {
      $orderid = $row['order_id'];
      $approved_sum_query = "SELECT * FROM process_order WHERE order_id = $orderid";
      $approved_sum_result = mysqli_query($conn, $approved_sum_query);
    //  print_r($approved_sum_result);
      if ($approved_sum_result->num_rows > 0) {
        while($row2 = $approved_sum_result->fetch_assoc()) {
            $approved_total = $approved_total + $row2['total']; 
        }
      }
  } 
  // print_r("total --- >".$approved_total);
}
else{}


// drafts Account
$conn = mysqli_connect($DB_HOST, $DB_USER, $DB_PASSWORD, $DB_NAME);
$draft_query = "SELECT * FROM drafts WHERE is_waiting=1";
$draft_query_result = mysqli_query($conn, $draft_query);
$draft_total=0;
if ($draft_query_result->num_rows > 0) {
  while($row = $draft_query_result->fetch_assoc()) {
      $orderid = $row['order_id'];
      $draftsum_query = "SELECT * FROM process_order WHERE order_id = $orderid";
      $draftsum_query_result = mysqli_query($conn, $draftsum_query);
      if ($draftsum_query_result->num_rows > 0) {
        while($row3 = $draftsum_query_result->fetch_assoc()) {
            $draft_total = $draft_total + $row3['total']; 
        }
      }
  } 
  // print_r("total --- >".$draft_total);
}
else{}


?>

<! DOCTYPE html>
<html>
<head>
<title> POP</title>
<link rel="stylesheet" type="text/css" href="style/main.css">



</head>


<body>
<?php include "include/nav.php"; ?>

<style>
table, th, td {
  border: 1px solid black;
  border-collapse: collapse;
}

th, td {
  padding: 2px;
}
</style>
<h3 style="text-align:center">Accounts</h3><br><br>

<table style="width:40%; margin-left: auto;
  margin-right: auto;">
  <thead>
      <th style="background:white">
          <h2 style="margin:20px">Draft</h5>
          <h3>$ <?php echo $draft_total ?></h3>
      </th>
      <th style="background:green">
          <h2 style="margin:20px;color:white">Approved</h5>
          <h3>$  <?php echo $approved_total ?></h3>
      </th>
      <th style="background:lightblue">
          <h2 style="margin:20px;color:black">Awaiting</h5>
          <h3>$ <?php echo $wait_total ?></h3>
      </th>

</thead>
</table>





</body>
</html>