<div data-role='main' class='content'>
	<?php
		foreach($specialsales as $row){
			$p_id=$row->p_id;
			$image=$row->image;
			$discount=$row->discount;
			$discount=$discount*100;
			echo "<div style='border:solid #a6a6a6 1px;height:125px'>";
			echo "<a href='".base_url()."index.php/product_detail/show_product_by_id/".$p_id."'>";
			echo "<img style='width:120px; height:80px;padding:8px;border:solid black 6px; box-shadow:0 0 5px black;background-color: #F3E2A9;float:left;margin:10px' src='http://cs-server.usc.edu:12123/CodeIgniter/".$image."'>";
			echo "</a>";
			echo "<h3 style='color:red;text-align:center'>SALE</h3>";
			echo "<p style='display:inline; padding:10px'><span style='font-size:1.5em'>$discount</span> %OFF</p>";
			echo "</div>";
		}
	?>
</div>	