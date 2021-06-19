<?php
	require_once "include/config.php";
	require_once "include/auth.php";
	//New User Data
	$order_id = $_GET['order'];
    $purchase_date = $_GET['purchase_date'];
    $supplier_name = $_GET['supplier_name'];
    $purchase_address = $_GET['purchase_address'];
    $contact = $_GET['contact'];
    $email = $_GET['email'];
    $supplier_id = $_GET['supplier_id'];

    

    echo $order_id;
    echo $purchase_date;
    echo $supplier_name;
    echo $purchase_address;
    echo $contact;
    echo $email;
    echo $supplier_id;


        $con = mysqli_connect($DB_HOST, $DB_USER, $DB_PASSWORD, $DB_NAME);
        $draft_query ="INSERT INTO purchase_order 
        (order_id, supplier_id,supplier_name, purchase_date, purchase_address, contact, email, is_approved, is_reject, is_waiting ) VALUES ($order_id,$supplier_id,$supplier_name,$purchase_date,$purchase_address,$contact,$email,'0','0','1');";

        $draft_query_result = mysqli_query($con, $draft_query);
// print_r($draft_query);

    if ($draft_query_result) {
            echo "added";
            
        $delete_query ="DELETE FROM drafts WHERE order_id=$order_id";
        $delete_result = mysqli_query($con, $delete_query);
                if($delete_result){
                        echo "deleted";
                }
            header("location:draft.php");
        }
        else{
            echo "error";
            header("location:draft.php");
        }    

    ?>



