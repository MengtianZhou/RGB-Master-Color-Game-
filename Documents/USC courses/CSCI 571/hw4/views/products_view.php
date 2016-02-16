<link rel="stylesheet" type="text/css" href="<?php echo base_url();?>css/products.css">
<div class="products">
<?php
	foreach($products as $row){
		$p_id=$row->p_id;
		$image=$row->image;
	
?>
	<a href="<?php echo base_url();?>index.php/product_detail/show_product_by_id/<?php echo $p_id;?>">
	<img class="product" src="http://cs-server.usc.edu:12123/CodeIgniter/<?php echo $image?>">
	</a>
<?php
	}	
?>
</div>