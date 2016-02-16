		<tr>
			<form action='<?php echo base_url();?>index.php/order/detail' method='post'>
				<input type='hidden' name='o_id' value="<?php echo $o_id;?>">
				<td><?php echo $order_date;?></td>
				<td><?php echo $shipping_add;?></td>
				<td><?php echo $billing_add;?></td>
				<td><input class='button' type='submit' name='submit' value='detail' style='background-color:#FF4000; border-radiux:5px; color:white; padding:6px;font-size:18px;cursor: pointer;'></td>
			</form>
		</tr>