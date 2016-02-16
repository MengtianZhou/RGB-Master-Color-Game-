<div data-role='main' class="content">
<?php
	foreach($products as $row){
		$p_id=$row->p_id;
		$image=$row->image;
	
?>
	<a href="<?php echo base_url();?>index.php/product_detail/show_product_by_id/<?php echo $p_id;?>">
	<img style='width:100px; height:70px;padding:7px;border:solid black 5px; box-shadow:0 0 5px black;background-color: #F3E2A9;float:left;margin:10px' src="http://cs-server.usc.edu:12123/CodeIgniter/<?php echo $image?>">
	</a>
<?php
	}	
?>
</div>
</div>
<div data-role="footer" style='text-align:center;font-size:0.5em'>
	<p>Copyrigth &copy; 2014-2024 by Mengtian Zhou</p>
	<p>All Rights Reserved.</p>
</div>
</body>
</html>