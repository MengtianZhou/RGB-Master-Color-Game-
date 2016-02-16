<div data-role='main' class='content'>

	<form action='<?php echo base_url();?>index.php/account/validate_profile' method='post'>

		<table>
			<h3 style='text-align:center'>Edit Profile</h3>
			<p style="color:red;text-align:center"><?php echo $msg;?></p>
			<tr>
				<th>Fullname:</th>
				<td><input type='text' name='fullname' value="<?php echo set_value('fullname',$fullname); ?>" required></td>
			</tr>
			<tr>
				<th>Email:</th>
				<td><input type='email' name='email' value="<?php echo set_value('email',$email); ?>" required></td>
			</tr>
			<tr>
				<th>Password:</th>
				<td><input type='password' name='password' value="<?php echo set_value('password',$password); ?>" required></td>
			</tr>
		</table>
		<input type='submit' name='submit' value='update'>
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