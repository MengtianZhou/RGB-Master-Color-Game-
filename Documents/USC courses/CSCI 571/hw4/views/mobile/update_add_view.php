<?php 
	foreach ($result as $row){
		$add_id=$row->add_id;
		$fullname=$row->fullname;
		$address=$row->address;
		$city=$row->city;
		$state=$row->state;
		$zipcode=$row->zipcode;
		$phone=$row->phone;
	}
?>
<div class='content' data-role='main'>
	<form action='<?php echo base_url();?>index.php/account/validate_add2' method='post'>
		<input type='hidden' name='add_id' value='<?php echo $add_id;?>'>
		<table>
			<h3>Update the address</h3>
			<tr>
				<th>Fullname:</th>
				<td><input class='text-field' type='text' name='fullname' value="<?php echo set_value('fullname',$fullname); ?>" required></td>
			</tr>
			<tr>
				<th>Address:</th>
				<td><input class='text-field' type='text' name='address' value="<?php echo set_value('address',$address); ?>" required></td>
			</tr>
			<tr>
				<th>City:</th>
				<td><input class='text-field' type='text' name='city' value="<?php echo set_value('city',$city); ?>" required></td>
			</tr>
			<tr>
				<th>State:</th>
				<td><input class='text-field' type='text' name='state' value="<?php echo set_value('state',$state); ?>" required></td>
			</tr>
			<tr>
				<th>Zipcode:</th>
				<td><input class='text-field' type='text' name='zipcode' value="<?php echo set_value('zipcode',$zipcode); ?>" required></td>
			</tr>
			<tr>
				<th>Phone:</th>
				<td><input class='text-field' type='text' name='phone' value="<?php echo set_value('phone',$phone); ?>" required></td>
			</tr>
		</table>
		<input type='submit' name='submit' value='update' class='button'>
	</form>
</div>
</div>
<div data-role="footer" style='text-align:center;font-size:0.5em'>
	<p>Copyrigth &copy; 2014-2024 by Mengtian Zhou</p>
	<p>All Rights Reserved.</p>
</div>
</div>
</body>
</html>