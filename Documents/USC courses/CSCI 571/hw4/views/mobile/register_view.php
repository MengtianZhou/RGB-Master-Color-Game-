<div data-role="main" class="ui-content">
	<form action="<?php echo base_url();?>index.php/register/process" method="post">
		<h2 style="text-align:center">Register</h2>
		<p style="color:red;text-align:center"><?php echo $msg;?></p>
		<input type="text" name="fullname" placeholder="Full name" value="<?php echo set_value('fullname'); ?>" required><br>
		<input type="email" name="email" placeholder="Email address" value="<?php echo set_value('email'); ?>" required><br>
		<input type="password" name="password" placeholder="Password" value="<?php echo set_value('password'); ?>" required><br>
		<input type="password" name="con_password" placeholder="confrim password" value="<?php echo set_value('con_password'); ?>" required><br>
		<input type="submit"name="register" value="submit">
	</form>
</div>
<div data-role="footer" style='text-align:center;font-size:0.5em'>
	<p>Copyrigth &copy; 2014-2024 by Mengtian Zhou</p>
	<p>All Rights Reserved.</p>
</div>
 </div>
</body>
</html>