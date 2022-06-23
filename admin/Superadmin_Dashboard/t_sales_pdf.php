<?php
	function generateRow(){
        $datefrom = $_GET['datefrom'];
        $dateto = $_GET['dateto'];
		$contents = '';
		include('../include/access/connector.php');
		$sql = "SELECT a.order_id,b.customer_fname,b.customer_lname,SUM(c.price * c.qty) as total_price,date_format(a.order_date,'%c/%d/%Y') as orderdate,
        a.order_date FROM t_order_details as a LEFT join t_customers as b 
        on a.order_customer_id = b.customer_id 
        left join t_cart as c on c.guest_id = a.order_guest_id where DATE(a.order_date) between '$datefrom' and '$dateto'
        group by a.order_id";

		//use for MySQLi OOP
		$query = $con->query($sql);
		while($row = $query->fetch_assoc()){
            $right = 'style="text-align:right;"';
			$contents .= "
			<tr>
        
				<td>".$row['orderdate']."</td>
				<td>".$row['order_id']."</td>
				<td>".$row['customer_fname']. ' ' . $row['customer_lname'] . " </td>
				<td ".$right.">".number_format($row['total_price'],2) ."</td>
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
    $resulttotal = mysqli_query($con,"SELECT SUM(c.price * c.qty) as total_price,date_format(a.order_date,'%c/%d/%Y') as orderdate,
    a.order_date FROM t_order_details as a
    left join t_cart as c on c.guest_id = a.order_guest_id where DATE(a.order_date) between '$datefrom' and '$dateto'");
while($row2 = mysqli_fetch_array($resulttotal)){
    $totalamount = $row2['total_price'];


   
	require_once('tcpdf/tcpdf.php');  
    $pdf = new TCPDF('P', PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);  
    $pdf->SetCreator(PDF_CREATOR);  
    $pdf->SetTitle("Sales Report");  
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
    <h2 align="center">SALES REPORT</h2>
    
    </td>
    
    
        <h4 align="center">'. date("F j, Y", strtotime($datefrom)) . ' to ' . date("F j, Y", strtotime($dateto)).'</h4>
        <h4 align="right">Run-Date: '. date("F j, Y").'</h4>
      	<table cellspacing="0" cellpadding="3">  
          <hr>
           <tr >  
                <th width="25%">Date</th>
				<th width="25%">Order No.</th>
				<th width="25%">Customer</th>
				<th align="right" width="25%">Amount</th> 
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
