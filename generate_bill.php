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
    <title>Generate Bill</title>
    <link rel="stylesheet" type="text/css" href="style/main.css">
</head>
<body class="flex-col center">

    <div class="container flex-col">

<div class="inner-container flex-col">

    <div class="title flex-row center">
            <h2 style="    font-size: 30px;
    margin-bottom: -34px;">Purchase Order Process</h2>
    </div>
    <div class="title flex-row center">
        <h2>- Bill Receipt -</h2>
    </div>

    <div>
    <h3 style="color: gray;
    font-size: 1.2rem;
    margin: -3px;">Name :<?php echo $supplier_name;?></h3>
    <h3 style="color: gray;
    font-size: 1.2rem;
    margin: -3px;">Date :<?php echo $date;?></h3>
    <h3 style="color: gray;
    font-size: 1.2rem;
    margin: -3px;">Contact :<?php echo $contact;?></h3>
    <h3 style="color: gray;
    font-size: 1.2rem;
    margin: -3px;">Address :<?php echo $address;?></h3>

    </div>
    <br><hr>
    
    <table>
        <thead>
            <tr class="row-heading">
                <!-- <th class="item-desc"> Order-id </th> -->
                <th > Item </th>
                <th> Price </th>
                <th> Quantity </th>
                <th> Total </th>
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

            <tr class="row-data">
            <!-- <td class="center"><?php echo '#'.$row['order_id']?></td> -->
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
        <tfoot>
            <tr>
                <td>&nbsp;</td>
                <td>&nbsp;</td>
                <th> Grand Total: </th>
                <td class="total">$<?php echo $total;?></td>
            </tr>
        </tfoot>
    </table>

    <!-- <div class="btn-container center flex-row"><button> Pay</button> </div> -->
</div>

</div>




<style>
/* general styling */

* {
    box-sizing: border-box;
}

body {
    background-color: #fffeec;
    line-height: 1.5;
    min-height: 100vh;
    font-family: 'Open Sans', sans-serif;
}

a {
    text-decoration: none;
}

button {
    color: #fff;
    font-family: 'Abril Fatface', cursive;
    letter-spacing: .8px;
    text-transform: uppercase;
    border-radius: 16px;
    padding: 5px;
    font-size: 1.2rem;
    background-color: #e4508f;
    width: 12rem;
    height: 3rem;
    border-width: 0px 2px 4px;
    border-style: solid;
    border-color: #d04982;
    transition: .1s;
}

button:hover {
    background-color: #e65f99;
    border-color: #e4508f;
    cursor: pointer;
}

button:focus {
    outline: 0;
}

button:active {
    transition: .2s;
    border-width: 2px;
}

h2 {
    color: #e4508f;
    font-size: 1.5rem;
}

h3 {
    color: #facf5a;
    font-size: 1.2rem;
}

h2,
h3 {
    font-family: 'Abril Fatface', cursive;
}


/* utility */

.flex-row {
    display: flex;
    flex-direction: row;
}

.flex-col {
    display: flex;
    flex-direction: column;
}

.center {
    justify-content: center;
    align-items: center;
}


/* structure */

.container {
    background-color: #fff;
    border: thick dashed #556fb5;
    padding: 2rem;
    width: 100%;
    max-width: 600px;
}

.title {
    text-align: center;
    padding: 1rem 0;
}

.container table {
    width: 100%;
    color: #e4508f;
    font-weight: 300;
}

.row-data td {
    width: 25%;
    text-align: center;
    padding: 1rem;
}

tfoot {
    text-align: center;
}

tfoot tr * {
    padding: 1rem;
}

.row-data {
    border-bottom: 1px dashed #556fb5;
}

.row-heading th {
    color: #e65f99;
    width: 25%;
    text-align: center;
    padding: 1rem;
    text-transform: uppercase;
    font-size: 0.9rem;
}

.item-desc {
    width: 50%;
    text-align: left;
}

.item-total,
.total {
    font-weight: 400;
}

.btn-container {
    padding: 1rem 0 0;
}


/* footer */

footer {
    background-color: #0d1321;
    box-shadow: 0 5px 20px 0 #101111;
    position: fixed;
    bottom: 0;
    left: 0;
    text-align: center;
    padding: 1rem 0;
    width: 100%;
}

footer p {
    font-size: 14px;
    color: #fffafb;
    text-align: center;
}

footer a {
    border-bottom: 1px dashed #fffafb;
    letter-spacing: 0.5px;
    padding: 0 2px;
    font-weight: bold;
    font-size: 14px;
    color: #c51c53;
}

footer a:hover {
    color: #d45981;
    border-bottom: 1px solid #fffafb;
}
</style>





</body>
</html>





