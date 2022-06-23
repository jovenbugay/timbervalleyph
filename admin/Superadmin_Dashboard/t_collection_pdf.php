<?php
	function generateRow(){
        $datefrom = $_GET['datefrom'];
        $dateto = $_GET['dateto'];
		$contents = '';
		include('../include/access/connector.php');
		$sql = " SELECT a.order_id,b.customer_fname,b.customer_lname,SUM(c.price * c.qty) as total_price,d.b_balance,d.billing_date,date_format(d.billing_date,'%c/%d/%Y') as billingdate,
        d.b_amount,b_pay_amt,a.order_payment_method
         FROM t_order_details as a LEFT join t_customers as b 
        on a.order_customer_id = b.customer_id 
        left join t_cart as c on c.guest_id = a.order_guest_id  
        left join t_billing as d on a.order_id = d.order_no and d.deleted='0'
        where DATE(d.billing_date) between '$datefrom' and '$dateto'
        group by a.order_id";

		//use for MySQLi OOP
		$query = $con->query($sql);
		while($row = $query->fetch_assoc()){
            $right = 'style="text-align:right;"';

            if ($row['order_payment_method'] == "cod"){
                $payment = "Cash on Delivery";
              }
              else if ($row['order_payment_method'] == "paypal"){
                $payment = "Paypal";
              }
              else if ($row['order_payment_method'] == "check"){
                $payment = "Checking Account";
              }
              else if ($row['order_payment_method'] == "bank_transfer"){
                $payment = "Bank Transfer";
              }
              else if ($row['order_payment_method'] == "none"){
                $payment = "No Payment Yet";
              }



			$contents .= "
			<tr>
        
				<td>".$row['billingdate']."</td>
				<td>".$row['order_id']."</td>
				<td>".$row['customer_fname']. ' ' . $row['customer_lname'] . " </td>
                <td>".$payment."</td>
                <td>". number_format($row['b_pay_amt'],2) ."</td>
				<td ".$right.">".number_format($row['b_amount'],2) ."</td>
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
    $datefrom = $_GET['datefrom'];
        $dateto = $_GET['dateto'];
    $resulttotal = mysqli_query($con,"SELECT *,SUM(b_pay_amt) as total_amt from t_billing
    where DATE(billing_date) between '$datefrom' and '$dateto' and deleted='0'");
while($row2 = mysqli_fetch_array($resulttotal)){
    $totalamount = $row2['total_amt'];


   
	require_once('tcpdf/tcpdf.php');  
    $pdf = new TCPDF('P', PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);  
    $pdf->SetCreator(PDF_CREATOR);  
    $pdf->SetTitle("Collection Report");  
    $pdf->SetHeaderData('', '', PDF_HEADER_TITLE, PDF_HEADER_STRING);  
    $pdf->setHeaderFont(Array(PDF_FONT_NAME_MAIN, '', PDF_FONT_SIZE_MAIN));  
    $pdf->setFooterFont(Array(PDF_FONT_NAME_DATA, '', PDF_FONT_SIZE_DATA));  
    $pdf->SetDefaultMonospacedFont('helvetica');  
    $pdf->SetFooterMargin(PDF_MARGIN_FOOTER);  
    $pdf->SetMargins(PDF_MARGIN_LEFT, '10', PDF_MARGIN_RIGHT);  
    $pdf->setPrintHeader(false);  
    $pdf->setPrintFooter(false);  
    $pdf->SetAutoPageBreak(TRUE, 10);  
    // $pdf->SetFont('dejavusans', '', 10);
    $pdf->SetFont('helvetica', '', 8);  
    $pdf->AddPage();  
    $content = '';  
    $content .= '
    <head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    </head>

    <td rowspan="" align="center">
    <img align="center" 
    src="dist/img/logo.jpg" 
    alt="" 
    title="HELLO" 
    width="80" 
    height="80" />

    <h2 align="center">Philippine Timber Valley Trading Corporation</h2>
    <h4 align="center">Collection Report</h4>
    
    </td>

        <h4 align="center">'. date("F j, Y", strtotime($datefrom)) . ' to ' . date("F j, Y", strtotime($dateto)).'</h4>
        <h4 align="right">Run-Date: '. date("F j, Y").'</h4>
      	<table cellspacing="0" cellpadding="3">  
          <hr>
           <tr >  
                <th width="15%">Date</th>
				<th width="15%">Order No.</th>
				<th width="25%">Customer</th>
                <th width="20%">Payment</th>
                <th width="15%">Amount</th>
				<th align="right" width="10%">Total</th> 
           </tr>  
   <hr>
      ';  
    }
    $content .= generateRow(); 
    //₱
    $content .= ' <hr> <tr>
    <td></td>
    <td></td>
    <td style="text-align:right;"><h3>Total Amount:</h3></td>
     <td style="text-align:right;" colspan="4"><h2>P '.number_format($totalamount,2).'</h2></td>
    </tr><hr>' ;

    $content .= '</table>';  
    $content .= '
        <br>
        <br>
        <br>
        <br>
        
    '; 
    // <h4 align="right">Total Amount: '.number_format($amount,2).'</h4>

 
    
 





$html = utf8_encode($html);

    $pdf->writeHTML($content);  
    $pdf->Output('Sales_Report_' . $datefrom . '_to_' . $dateto . '.pdf' , 'I');
	

?>
