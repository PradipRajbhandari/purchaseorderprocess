<?php session_start();
require_once "include/config.php";
require_once "include/auth.php";
require_login();

$order_id = $_GET['order_id'];
$supplier_name = $_GET['supplier_name'] ;
$contact = $_GET['contact'];
$address = $_GET['address'];
$email = $_GET['email'];
$date = $_GET['date'];


$conn = mysqli_connect($DB_HOST, $DB_USER, $DB_PASSWORD, $DB_NAME);

$invoice_query = "SELECT * FROM process_order WHERE order_id = '$order_id'";

$invoice_query_result = mysqli_query($conn, $invoice_query);


?>


<!DOCTYPE html>
<html>
<head>
    <title>Generate Invoice</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.0.0-beta.2/css/bootstrap.css">
    <link rel="stylesheet" type="text/css" href="style/main.css">
</head>
<body>

        <div class="content">
                <div class="container">
  <div class="card">
<div class="card-header">
<strong>Invoice</strong>
<?php echo $date;?>
<!-- <strong></strong>  -->
  <span class="float-right"> 
  <strong>Order ID:</strong> #<?php echo $order_id;?>
  
  <strong>Status:</strong> Approved
  </span>

</div>
<div class="card-body">
<div class="row mb-4">
<div class="col-sm-6">
<!-- <h6 class="mb-3">From:</h6> -->
<div>
<strong>Purchase Order Process</strong>
</div>
<div><?php echo $supplier_name?></div>
<div><?php echo $address?></div>
<div>Email: <?php echo $email?></div>
<div>Phone: <?php echo $contact?></div>
</div>

<!-- <div class="col-sm-6">
<h6 class="mb-3">To:</h6>
<div>
<strong>Bob Mart</strong>
</div>
<div>Attn: Daniel Marek</div>
<div>43-190 Mikolow, Poland</div>
<div>Email: marek@daniel.com</div>
<div>Phone: +48 123 456 789</div>
</div> -->



</div>

<div class="table-responsive-sm">
<table class="table table-striped">
<thead>
<tr>
    <!-- <th class="center">Order-id</th> -->
    <th>Item</th>
    <th class="right">Unit Cost</th>
    <th class="center">Qty</th>
    <th class="right">Total</th>
</tr>
</thead>
<tbody>
<?php  

$total = 0;
if($invoice_query_result->num_rows > 0){
    while($row = $invoice_query_result->fetch_assoc()){
            // print_r($row);
            $total = $total+$row['total'];
?>
    <tr>
        <td class="left strong"><?php echo $row['item']?></td>
        <td class="right">$<?php echo $row['price']?></td>
        <td class="center">$<?php echo $row['quantity']?></td>
        <td class="right">$<?php echo $row['total']?></td>
    </tr>
<?php 
 }
}
?>

</tbody>
</table>
</div>
<div class="row">
<div class="col-lg-4 col-sm-5">

</div>

<div class="col-lg-4 col-sm-5 ml-auto">
<table class="table table-clear">
<tbody>

<td class="left">
<strong>Total</strong>
</td>
<td class="right">
<strong>$<?php echo $total;?></strong>
</td>
</tr>
</tbody>
</table>

</div>

</div>

</div>
</div>
</div>
        </div>

	<?php include "include/footer.php"; ?>

</body>
</html>





