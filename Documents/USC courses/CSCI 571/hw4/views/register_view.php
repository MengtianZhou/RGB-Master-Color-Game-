<script>
	$("#login").css('background-color':'black','color':'white');
</script>
<link rel="stylesheet" type="text/css" href="<?php echo base_url();?>css/register.css">
<div class="register">
	<form action="<?php echo base_url();?>index.php/register/process" method="post">
		<h2>Register</h2>
		<p style='color:red;'><?php echo $msg;?></p>
		<input type="text" class="text-field" name="fullname" placeholder="Full name" value="<?php echo set_value('fullname'); ?>" required><br>
		<input type="email" class="text-field" name="email" placeholder="Email address" value="<?php echo set_value('email'); ?>" required><br>
		<input type="password" class="text-field" name="password" placeholder="Password" value="<?php echo set_value('password'); ?>" required><br>
		<input type="password" class="text-field" name="con_password" placeholder="confrim password" value="<?php echo set_value('con_password'); ?>" required><br>
		<input type="submit" class="button" name="register" value="Register">
		<p style="color:black">Already have an account, <a href="<?php echo base_url();?>index.php/login/main">log in</a> now!</p>
	</form>
</div>