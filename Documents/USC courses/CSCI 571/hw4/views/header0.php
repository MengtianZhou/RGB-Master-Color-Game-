<html>
<head>
	<!-- <link rel="stylesheet" type="text/css" href="<?php  base_url();?>mystyle.css"> -->
	<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
	<script>
		$(document).ready(function(){
		  $("#ps_id").change(get_price);
		});
		// $('#ps_id').change(function(){
		// 	alert('hi');
		// });
		function get_price(){
			var ps_id=$("#ps_id").val();
			$.ajax({
		        type:'post',// 
		        url:'http://cs-server.usc.edu:12123/CodeIgniter/index.php/product_detail/get_price',// 
		        data:'ps_id='+ps_id;// 
		        success:function(txt){
		            $("#price").text(txt); 
		        }
		    })
		}
	</script>
	<title><?php echo $title;?></title>
</head>
<body>
	<link rel="stylesheet" type='text/css' href='<?php echo base_url();?>css/header.css'>
	<div class="top1">
		<a id="shoppingCart" class="top1" href="<?php echo base_url();?>index.php/shopping_cart/show"><img class="top1" src="<?php echo base_url();?>img/website/shoppingCart.png"/></a>
		<a id="login" class="top1" href="<?php echo base_url();?>index.php/login/main">Log in</a>
		<a id="register" class="top1" href="<?php echo base_url();?>index.php/register/main">Register</a>
	</div>



