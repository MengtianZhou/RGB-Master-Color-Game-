<link rel="stylesheet" type="text/css" href="<?php echo base_url();?>css/product_detail.css">
<?php
foreach($product as $product){
	$p_id=$product->p_id;
	$name=$product->name;
	$image=$product->image;
	$description=$product->description;
}
?>
<div class="back">
	<div class="product">
		<div class="picture">
			<img class="picture" src="<?php echo base_url();?><?php echo $image;?>">
		</div>
		<div class="detail">
			<form action="<?php echo base_url();?>index.php/edit_product/validate" method="post">
				<input type="hidden" name="p_id" value="<?php echo $p_id;?>">
				<table>
					<tr>
						<th>Name:</th>
						<td><?php echo $name;?></td>
					</tr>
					<tr>
						<th>Size:</th>
						<td>
							<select name="ps_id" class="text-field" id="ps_id">
								<option value=''>Choose size</option>
								<?php 
									foreach($size as $size){
										$ps_id=$size->ps_id;
										$size=$size->size;
										echo "<option value='$ps_id'>$size</option>";
									}
								?>
							</select>	
						</td>
					</tr>
					<script>
						//jquery
						$('#ps_id').change(function(){
							var price='';
							var ps_id=$('#ps_id').val();
							if(ps_id==1){
								price='$4.00';
							}
							if(ps_id==2){
								price='$5.00';
							}
							if(ps_id==3){
								price='$6.00';
							}
							if(ps_id==4){
								price='$8.00';
							}
							if(ps_id==5){
								price='$15.00';
							}
							if(ps_id==6){
								price='$20.00';
							}
							if(ps_id==7){
								price='$32.00';
							}
							if(ps_id==8){
								price='$38.00';
							}
							if(ps_id==9){
								price='$58.00';
							}
							if(ps_id==10){
								price='$68.00';
							}
							$('#price').text(price);
						});
					</script>
					<tr>
						<th>Price:</th>
						<td><p id="price" class='price'></p></td>
					</tr>
					<tr>
						<th>Quantity:</th>
						<td>
							<input class="text-field" type="number" name="quantity" value="1" min="1" step="1">
						</td>
					</tr>
					<tr>
						<th>Description:</th>
						<td><?php echo $description; ?></td>
					</tr>
				</table>
				<input type="submit" name="submit" value="Add to Shopping Cart" class="button">	
			</form>
		</div>	
	</div>
</div>