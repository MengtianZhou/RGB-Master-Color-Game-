<div data-role="main" class="ui-content">
	<form action="<?php echo base_url();?>index.php/login/process" method="post">
		<h2 style="text-align:center">Log In</h2>
		<p style="color:red; text-align:center"><?php echo $msg;?></p>
		<input type="text" name="email" placeholder="Email address" value="<?php echo set_value('email'); ?>" required><br>
		<input type="password" name="password" placeholder="Password" value="<?php echo set_value('password'); ?>" required><br>
		<input type="submit"name="login" value="submit">
	</form>
</div>
<div data-role="footer" style='text-align:center;font-size:0.5em'>
	<p>Copyrigth &copy; 2014-2024 by Mengtian Zhou</p>
	<p>All Rights Reserved.</p>
</div>
 </div>
</body>
</html>