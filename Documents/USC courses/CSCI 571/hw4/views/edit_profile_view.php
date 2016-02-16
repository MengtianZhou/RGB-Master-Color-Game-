<link rel="stylesheet" type="text/css" href="<?php echo base_url();?>css/edit_profile.css">
<div class='edit_profile'>
	<form action='<?php echo base_url();?>index.php/account/validate_profile' method='post'>
		<table>
			<caption>Edit Profile</caption>
			<tr>
				<th>Fullname:</th>
				<td><input class='text-field' type='text' name='fullname' value="<?php echo set_value('fullname',$fullname); ?>" required></td>
			</tr>
			<tr>
				<th>Email:</th>
				<td><input class='text-field' type='email' name='email' value="<?php echo set_value('email',$email); ?>" required></td>
			</tr>
			<tr>
				<th>Password:</th>
				<td><input class='text-field' type='password' name='password' value="<?php echo set_value('password',$password); ?>" required></td>
			</tr>
		</table>
		<input class='button' type='submit' name='submit' value='update'>
	</form>
</div>