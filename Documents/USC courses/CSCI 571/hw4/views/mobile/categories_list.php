<div data-role="panel" id="categories_list">
<?php
	foreach ($categories as $row){
		$pc_id=$row->pc_id;
		$category=$row->category;
		echo "<a class='ui-btn ui-corner-all' href='".base_url()."index.php/products/show_products_by_category/".$pc_id."'>".$category."</a><br>";
	}
?>
</div>
<div data-role="main" class="ui-content">
  	<div data-role="main" class="ui-content">
		<a href="#categories_list" class='ui-btn ui-shadow ui-corner-all'>switch category</a>
	</div>


