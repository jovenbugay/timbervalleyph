<div class="table-responsive">
      <table class="table">
      <tr>
          <th>ITEM</th>
          <th>QTY</th>
          <th>PRICE</th>
          <th>SUBTOTAL</th>
          <th>ACTION</th>
          
          
        </tr>
        <?php 

include('db/connect.php');
        $gid = $_SESSION['id'];        
        $empty = 'Cart is Empty'; 
        $sumquantity = 0;
        $sumprice = 0;               
        $result = mysqli_query($con,"SELECT * FROM `cart` as a LEFT JOIN products as b ON a.product_id = b.product_id where guest_id = '$gid' ");
        $result2 = mysqli_query($con,"SELECT COUNT(*) FROM `cart` where guest_id = '$gid' ");
        $row2 = mysqli_fetch_array($result2);
        $count = $row2[0];
        if($count < 1)
        {
          echo '<tr><td colspan="5" style="text-align:center; padding:20px 0 20px">Your cart is empty</td></tr>';
        }
        else if ($count >= 1) {
        while($row = mysqli_fetch_array($result)){

          $qty = $row['qty'];
          $price = $row['product_price'];
          $subtotal = $price * $qty;
          $sumquantity += $row['qty'];
          $sumprice += $subtotal; 
          
        ?>

<tr>
          
          <td><?php echo $row['product_name']; ?></td>
          <td>x  <?php echo $row['qty']; ?></td>
          <td>&#8369; <?php echo $row['product_price']; ?></td>
          <td>&#8369; <?php echo number_format($subtotal,2); ?></td>
          <td>
          <form method="POST">
          <input type="hidden" name="pid" value="<?php echo $row['product_id']; ?>" required>
          <input type="hidden" name="cid" value="<?php echo $row['cart_id']; ?>" required>
          <button style="color:white;"type="submit" class="btn btn-danger" name="btnremove" id="cart_remove"><i class="fa fa-times"></i></button>
          </form>
          </td>
        
        </tr>

         <?php 
        }
         }
         echo '
         <tr>
         <td style="font-weight:600;">TOTAL</td>
         <td style="font-weight:600;">'.$sumquantity.'</td>
         <td></td>
         <td></td>
         <td style="font-weight:600;">&#8369; &nbsp;'.number_format($sumprice,2).'</td>
         </tr>
         ';
         ?>
        
      </table>
    </div>
     