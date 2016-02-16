<!DOCTYPE html>
<html>
<head>
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="http://code.jquery.com/mobile/1.4.2/jquery.mobile-1.4.2.min.css">
<script src="http://code.jquery.com/jquery-1.10.2.min.js"></script>
<script src="http://code.jquery.com/mobile/1.4.2/jquery.mobile-1.4.2.min.js"></script>
</head>
<body>

<div data-role="page">
  <div data-role="header" data-position="fixed">
  	<a href="<?php echo base_url();?>index.php/register/main" class="ui-btn ui-corner-all">register</a>
  	<h1>Photo&nbsp;<img src='<?php echo base_url();?>img/website/003.png' style='width:25px;height:20px'>&nbsp;Shop</h1>
  	<a href="<?php echo base_url();?>index.php/login/main" class="ui-btn ui-corner-all">log in</a>
  	<div data-role="navbar">
  		<ul>
		  	<li><a href="<?php echo base_url();?>index.php/products/show_products_by_category/1" data-icon="grid" data-iconpos="top">Products</a></li>
		    <li><a href="<?php echo base_url();?>index.php/home" data-icon="home" data-iconpos="top">Home</a></li>
		    <li><a href="<?php echo base_url();?>index.php/shopping_cart/show" data-icon="shop" data-iconpos="top">Shopping Bag</a></li>
		</ul>
  	</div>
  </div>