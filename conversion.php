
<?php session_start();
require_once "include/config.php";
require_once "include/auth.php";
require_login();

?>
<html>
<head>

<title> Conversion</title>
<link rel="stylesheet" type="text/css" href="style/main.css">
</head>


<body>



<?php 
include "include/nav.php"; 
//Get Dates
$conn = mysqli_connect($DB_HOST, $DB_USER, $DB_PASSWORD, $DB_NAME);
$dates_query = "SELECT DISTINCT purchase_date FROM purchase_order ORDER BY `purchase_order`.`purchase_date` ASC";
$dates_query_result = mysqli_query($conn, $dates_query);

?>

    <h3 style="text-align:center">Conversion</h3>
    <br><br>
    
<style>
table, th, td {
  border: 1px solid black;
  border-collapse: collapse;
}

th, td {
  padding: 2px;
}
</style>
<!-- ------------- Dates Table -->

 <select >
    <?php
      if ($dates_query_result->num_rows > 0) {
        while($date_row = $dates_query_result->fetch_assoc()) {
    ?>
            <option style="display: flex;justify-content: center;"><a style="cursor:pointer" id="<?php echo $date_row['purchase_date']; ?>" onclick="getConversionData(this)"><?php echo "   ".$date_row['purchase_date']. "   "; ?></a></option><br>
            <div class="<?php echo $date_row['purchase_date']; ?>">

            </div><br><br>
            
            <?php 
             }
            }
            ?>
    </select>



<script>
function getConversionData(date){
console.log(date.id);
var purchase_date = date.id;

$.ajax({
			url:"get_conversion.php",    //the page containing php script
			dataType: "json",
            type: "post",    //request type,
            data: {date: purchase_date},
            success:function(myres){
              $("."+date).append('');

			    	console.log(myres);
				for(var i=0; i<myres.length; i++){
        var date = myres[i].purchase_date;
        var address = myres[i].purchase_address;
        var email = myres[i].email;
        var contact = myres[i].contact;
        var supplier_name = myres[i].supplier_name;
        var order_id = myres[i].order_id;
					
          
          var table_str = '';


          table_str = `  <table style="width:70%; margin-left: auto;margin-right: auto;">
              <thead>
                <th>Date</th>
                <th>Supplier Name</th>
                <th>Address</th>
                <th>Contact</th>
                <th>Email</th>
                <th>Order Id</th>
                <th>Generate Bill</th>
                <th>Generate Invoice</th>
              </thead>
              <tbody>`+ 

        
                    "<tr  id='"+date+"'>" +
                    "<td>"+date+"</td>" +
                    "<td>"+supplier_name+"</td>" +
                    "<td>"+address+"</td>" +
                    "<td>"+contact+"</td>" +
                    "<td>"+email+"</td>" +
                    "<td>"+order_id+"</td>" +
                    "<td><button style='background: blue;'><a href='generate_bill.php?order_id="+order_id+"&&date="+date+"&&supplier_name="+supplier_name+"&&address="+address+"&&contact="+contact+"&&email="+email+"' style='color: white;'>Generate Bill</a></button></td>" +
                    "<td><button style='background: blue;'><a href='generate_invoice.php?order_id="+order_id+"&&date="+date+"&&supplier_name="+supplier_name+"&&address="+address+"&&contact="+contact+"&&email="+email+"' style='color: white;'>Generate Invoice</a></button></td>" +
                    "</tr>"+
                    `  </tbody>
                      </table> <br><br>`;

        
              // console.log(table_str);           


            }

              var ele = $("."+date+" tbody");
              // console.log(ele);
 
                $("."+date).append(table_str);
                $("#"+date).css('pointer-events', 'none');
                // $("#listoforder tbody").append(tr_str);
			}	
		});
}
</script>
 
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

</body>
</html>