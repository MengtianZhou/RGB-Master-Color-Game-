<html>
<head>
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
	<div class="top1"><p class="top1">Welcome&nbsp;<?php echo htmlspecialchars($fullname); ?>&nbsp;!</p>
		<a id="myAccount" class="top1" href="<?php echo base_url();?>index.php/account/show">My Account</a>
		<a id="shoppingCart" class="top1" href="<?php echo base_url();?>index.php/shopping_cart/show"><img class="top1" src="<?php echo base_url();?>img/website/shoppingCart.png"/></a>
		<a class="top1" href="<?php echo base_url();?>index.php/logout">Log out</a>
	</div>