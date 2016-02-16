<div class='content' data-role='main'>	
			<p style="color:#0174DF; text-align:center;">Dear customer, you do not have any address in your acount, please add one first!</p>
				<form method="post" action='<?php echo base_url();?>index.php/checkout/validate_add'>
					<table>

						<caption>Add a new address</caption>
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