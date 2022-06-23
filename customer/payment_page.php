<?php
session_start();
include('../db/connect.php');
$date = new DateTime("now", new DateTimeZone('Asia/Manila') );
$new = $date->format('Y-m-d H:i:s');
if(isset($_POST['btncheckout'])){
    $customer_id = $_SESSION['customer_id'];
    $guest_id = $_SESSION['guest_id'];
    $shipping_id = $_POST['shipping_id'];
    $payment_terms = $_POST['payment_terms'];
    $payment_method = $_POST['payment_method'];
    $sign = $_POST['base64'];
    $sign = str_replace('data:image/png;base64,', '', $sign);
    $sign = str_replace(' ', '+', $sign);
    $fileData = base64_decode($sign);
    $fileName = 'sign/'.$guest_id.'.png';
    file_put_contents($fileName, $fileData);

    if($payment_method == 'check' ){
        $target_dir = "check/";
    }
    else if($payment_method == 'bank_transfer' ){
        $target_dir = "bank/";
    }
    
    $target_file = $target_dir . basename($_FILES["fileToUpload"]["name"]);
    $uploadOk = 1;
    $imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
    

        if($payment_method == 'paypal'){
            $status = '0';
            $result = mysqli_query($con,"INSERT INTO t_order_details (
                order_guest_id,
                order_customer_id,
                order_shipping_id,
                order_payment_terms,
                order_payment_method,
                order_status,
                order_payment_status,
                order_date
                ) 
            VALUES(
                '$guest_id',
                '$customer_id',
                '$shipping_id',
                '$payment_terms',
                '$payment_method',
                '$status',
                'UNPAID',
                '$new'
                ) ");
            header('location:paypal_payment.php');
        }
        else {
            $newfilename= md5(date('dmYHis')).str_replace(" ", "", basename($_FILES["fileToUpload"]["name"]));
            $new_target = $target_dir . $newfilename;
            move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $new_target);
            $status = '1';
            $result = mysqli_query($con,"INSERT INTO t_order_details (
                order_guest_id,
                order_customer_id,
                order_shipping_id,
                order_payment_terms,
                order_payment_method,
                order_status,
                order_payment_status,
                order_date
                ) 
            VALUES(
                '$guest_id',
                '$customer_id',
                '$shipping_id',
                '$payment_terms',
                '$payment_method',
                '$status',
                'UNPAID',
                '$new'
                ) ");

            $result2 = mysqli_query($con,"INSERT INTO t_attachments (att_guest_id,att_path) VALUES('$guest_id','$new_target') ");
            header('location:order_placed.php');
        }

        $result3 = mysqli_query($con,"INSERT INTO t_signature (sign_guest,sign_path) VALUES('$guest_id','$fileName') ");

}


?>