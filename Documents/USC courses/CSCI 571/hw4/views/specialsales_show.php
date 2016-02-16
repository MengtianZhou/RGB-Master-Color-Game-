<link rel="stylesheet" type="text/css" href="<?php echo base_url();?>css/specialsales.css">
<div class="specialsales">
	<?php
		foreach($specialsales as $row){
			$p_id=$row->p_id;
			$image=$row->image;
			$discount=$row->discount;
			$discount=$discount*100;
			echo "<div class='specialsale'>";
			echo "<a class='specialsale' href='".base_url()."index.php/product_detail/show_product_by_id/".$p_id."'>";
			echo "<img class='specialsale' src='http://cs-server.usc.edu:12123/CodeIgniter/".$image."'>";
			echo "</a>";
			echo "<p class='discount'><span style='font-size:5em'>$discount</span> %OFF</p>";
			echo "</div>";
		}
	?>
</div>	