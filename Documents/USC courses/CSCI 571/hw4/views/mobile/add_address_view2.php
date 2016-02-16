			<div data-role='main' class='content'>	
				<form method="post" action='<?php echo base_url();?>index.php/account/validate_add'>
					<table>
						<h3>Add a new address</h3>
						<p style="color:red;text-align:center"><?php echo $msg;?></p>
						<tr>
							<th>Fullname:</th>
							<td><input type="text" name="fullname" placeholder="New name" value="<?php echo set_value('fullname'); ?>" required></td>
						<tr>
							<th>Address:</th>
							<td><input type="text" name="address" placeholder="Apaetment number, Street"  value="<?php echo set_value('address'); ?>" required></td>
						</tr>
						<tr>
							<th>City:</th>
							<td><input type="text" name="city" placeholder="city"  value="<?php echo set_value('city'); ?>" required></td>
						</tr>
						<tr>
							<th>State:</th>
							<td><input type="text" name="state" placeholder="state"  value="<?php echo set_value('state'); ?>" required></td>
						</tr>
						<tr>
							<th>Zipcode:</th>
							<td><input type="text" name="zipcode" placeholder="5 digits only"  value="<?php echo set_value('zipcode'); ?>" required></td>
						<tr>
							<th>Phone:</th>
							<td><input type="text" name="phone" placeholder="10 digits only"  value="<?php echo set_value('phone'); ?>" required></td>
						</tr>
					</table>
					<input type="submit" name="submit" value="Add address">
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