<?php
	require_once "include/config.php";
	require_once "include/auth.php";
	//New User Data
	$order_id = $_GET['order'];
    $action = $_GET['action']; 

    if ($action == "'accept'") {
            $con = mysqli_connect($DB_HOST, $DB_USER, $DB_PASSWORD, $DB_NAME);
    $accept_query = "UPDATE purchase_order SET is_waiting=0,is_approved=1 WHERE order_id=$order_id";
    $accept_result = mysqli_query($con, $accept_query);
    echo $accept_query;


if ($accept_result) {
        echo "accepted";
        header("location:notification.php");
    }
    else{
        echo "error";
        header("location:notification.php");
    }

    }
    else{
        $con = mysqli_connect($DB_HOST, $DB_USER, $DB_PASSWORD, $DB_NAME);
        $reject_query = "UPDATE purchase_order SET is_waiting=0,is_reject=1 WHERE order_id=$order_id";
        $reject_result = mysqli_query($con, $reject_query);
    

    if ($reject_result) {
            echo "rejected";
            header("location:notification.php");
        }
        else{
            echo "error";
            header("location:notification.php");
        }    }

    ?>



