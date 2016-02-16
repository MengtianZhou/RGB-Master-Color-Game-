<script>
	$("#login").css('background-color':'black','color':'white');
</script>
<link rel="stylesheet" type="text/css" href="<?php echo base_url();?>css/login.css">
<div class="login">
	<form action="<?php echo base_url();?>index.php/login/process" method="post">
		<h2>Log In</h2>
		<p style="color:red;"><?php echo $msg;?></p>
		<input type="text" class="text-field" name="email" placeholder="Email address" value="<?php echo set_value('email'); ?>" required><br>
		<input type="password" class="text-field" name="password" placeholder="Password" value="<?php echo set_value('password'); ?>" required><br>
		<input type="submit" class="button" name="login" value="Log in">
		<p class="login" style="color:black">Don't have an account, <a href="<?php echo base_url();?>index.php/register/main">register</a> now!</p>
	</form>
</div>