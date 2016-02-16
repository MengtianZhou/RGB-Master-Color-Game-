<link rel="stylesheet" type="text/css" href="<?php echo base_url();?>css/categories.css">
<div class="option">
    <ul class="option">
<?php
	foreach ($categories as $row){
		$pc_id=$row->pc_id;
		$category=$row->category;
		echo "<li class='option'><a class='option' href='".base_url()."index.php/products/show_products_by_category/".$pc_id."'>".$category."</a></li>";
	}
?>
	</ul>
</div>