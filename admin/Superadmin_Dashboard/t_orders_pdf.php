<?php
	function generateRow(){
        $orderid = $_GET['orderno'];
		$contents = '';
		include('../include/access/connector.php');
		$sql = "SELECT * FROM t_order_details as a 
        LEFT JOIN t_cart as b ON a.order_guest_id = b.guest_id
        LEFT JOIN t_products as c on b.product_id = c.product_id
        LEFT JOIN t_payment_terms as d on a.order_payment_terms = d.terms_id
        LEFT JOIN t_signature as e on a.order_guest_id = e.sign_guest
        where a.order_id = '$orderid'";

		//use for MySQLi OOP
		$query = $con->query($sql);
		while($row = $query->fetch_assoc()){
            
			$contents .= "
			<tr>
        
				<td>".$row['product_code']."</td>
				<td>".$row['product_desc']."</td>
				<td>".$row['product_price']."</td>
				<td>".$row['qty']."</td>
                <td>". number_format($row['product_price'] * $row['qty'],2)."</td>
			</tr>

			";
		}
		////////////////

		//use for MySQLi Procedural
		// $query = mysqli_query($conn, $sql);
		// while($row = mysqli_fetch_assoc($query)){
		// 	$contents .= "
		// 	<tr>
		// 		<td>".$row['id']."</td>
		// 		<td>".$row['firstname']."</td>
		// 		<td>".$row['lastname']."</td>
		// 		<td>".$row['address']."</td>
		// 	</tr>
		// 	";
		// }
		////////////////
		
		return $contents;
	}
    include('../include/access/connector.php');
    $orderid = $_GET['orderno'];
    $amount = 0;
    $resultcart = mysqli_query($con,"select *,DATE(a.order_date) as orderdate from  t_order_details  as a 
    LEFT JOIN t_shipping_details as b on a.order_shipping_id = b.sd_id
    LEFT JOIN t_cart as c on a.order_guest_id = c.guest_id
    LEFT JOIN t_payment_terms as d on a.order_payment_terms = d.terms_id
    where a.order_id = '$orderid' ");
    while($rowcart = mysqli_fetch_array($resultcart)){
     $customername = $rowcart['sd_fullname'];
     $customer_add = $rowcart['sd_address'];
     $price = $rowcart['price'];
     $qty = $rowcart['qty'];
     $amount += $price * $qty;
     $discount = $rowcart['terms_discount'];
     $total_amount = $amount - ($amount * ($discount/100));
	$pay_method = $rowcart['order_payment_method'];
    //  b.price * b.qty - (b.price * b.qty * (d.terms_discount/100))

	 if ($pay_method == "cod"){
        $payment = "Cash on Delivery";
      }
      else if ($pay_method == "paypal"){
        $payment = "Paypal";
      }
      else if ($pay_method == "check"){
        $payment = "Checking Account";
      }
      else if ($pay_method == "bank_transfer"){
        $payment = "Bank Transfer";
      }
      else if ($pay_method == "none"){
        $payment = "No Payment Yet";
      }

     $orderdate = $rowcart['orderdate'];
   
	require_once('tcpdf/tcpdf.php');  
    $pdf = new TCPDF('P', PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);  
    $pdf->SetCreator(PDF_CREATOR);  
    $pdf->SetTitle("Billing Statement");  
    $pdf->SetHeaderData('', '', PDF_HEADER_TITLE, PDF_HEADER_STRING);  
    $pdf->setHeaderFont(Array(PDF_FONT_NAME_MAIN, '', PDF_FONT_SIZE_MAIN));  
    $pdf->setFooterFont(Array(PDF_FONT_NAME_DATA, '', PDF_FONT_SIZE_DATA));  
    $pdf->SetDefaultMonospacedFont('helvetica');  
    $pdf->SetFooterMargin(PDF_MARGIN_FOOTER);  
    $pdf->SetMargins(PDF_MARGIN_LEFT, '10', PDF_MARGIN_RIGHT);  
    $pdf->setPrintHeader(false);  
    $pdf->setPrintFooter(false);  
    $pdf->SetAutoPageBreak(TRUE, 10);  
    $pdf->SetFont('helvetica', '', 8);  
    $pdf->AddPage();  
    $content = '';  
    $content .= '
    <td rowspan="" align="center">
    <img align="center" 
    src="dist/img/logo.jpg" 
    alt="" 
    title="HELLO" 
    width="80" 
    height="80" />

    <h2 align="center">Philippine Timber Valley Trading Corporation</h2>
    <h4 align="center">Billing Statement</h4>
    
    </td>

 
      	<h4>Bill to: '.$customername.'</h4>
        <h4>Billing Address: '.$customer_add.'</h4>
        <h4>Order Date: '.date("F j, Y", strtotime($orderdate)).'</h4>
	<h4>Payment Method: '.$payment.'</h4>
      	<table border="0.5" cellspacing="0" cellpadding="3">  
          
           <tr>  
                <th width="20%">Product Code</th>
				<th width="40%">Description</th>
				<th width="15%">Price</th>
				<th width="10%">Qty</th> 
                <th width="15%">Amount</th> 
           </tr>  
   
      ';  
    }
    $content .= generateRow(); 
    $content .= '  <tr>
    <td style="text-align:right;"><h3>Total Amount:</h3></td>
     <td style="text-align:right;" colspan="4"><h2>'.number_format($total_amount,2).'</h2></td>
    </tr>' ;
    $content .= '</table>';  
    $content .= '
        <br>
        <br>
        <br>
        <br>
        <h4 align="right">Received By:_____________________________</h4>
    '; 
    // <h4 align="right">Total Amount: '.number_format($amount,2).'</h4>

 
    
 







    $pdf->writeHTML($content);  
    $pdf->Output('members.pdf', 'I');
	

?>
