<link rel="stylesheet" type="text/css" href="<?php echo base_url();?>css/product_detail.css">
<?php
foreach($product as $product){
	$p_id=$product->p_id;
	$name=$product->name;
	$image=$product->image;
	$description=$product->description;
}
foreach($special as $s){
	$discount=$s->discount;
	$start=$s->start;
	$end=$s->end;
}
?>
<div class="back">
	<div class="product">
		<div class="picture">
			<img class="picture" src="<?php echo base_url();?><?php echo $image;?>">
		</div>
		<div class="detail">
			<form action="<?php echo base_url();?>index.php/product_detail/validate" method="post">
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
					<p id="discount" style='display:none'><?php echo $discount;?></p>
					<script>
						//jquery
						$('#ps_id').change(function(){
							var price='';
							var new_price='';
							var ps_id=$('#ps_id').val();
							var discount=$('#discount').text();
							if(ps_id==1){
								price=4.00;
							}
							if(ps_id==2){
								price=5.00;
							}
							if(ps_id==3){
								price=6.00;
							}
							if(ps_id==4){
								price=8.00;
							}
							if(ps_id==5){
								price=15.00;
							}
							if(ps_id==6){
								price=20.00;
							}
							if(ps_id==7){
								price=32.00;
							}
							if(ps_id==8){
								price=38.00;
							}
							if(ps_id==9){
								price=58.00;
							}
							if(ps_id==10){
								price=68.00;
							}
							price=price.toFixed(2);
							new_price=price-price*discount;
							new_price=new_price.toFixed(2);
							$('#price').text(price);
							$('#new_price').text(new_price);
						});
					</script>
					<tr>
						<th>Price:</th>
						<td>$<p id="price" class="price" style='color:red; text-decoration: line-through'></p>&nbsp;&nbsp;<p id="new_price" class='price'></p></td>
					</tr>
					<tr>
						<th>Quantity:</th>
						<td>
							<input class="text-field" type="number" name="quantity" value="1" min="1" step="1">
						</td>
					</tr>
					<tr>
						<th>Sale period:</th>
						<td><?php echo $start;?>~<?php echo $end;?></td>
					</tr>
					<tr>
						<th>Description:</th>
						<td id="last_td"><?php echo $description; ?></td>
					</tr>
				</table>
				<input class="button" type="submit" name="submit" value="Add to Shopping Cart" class="pd_btn">	
			</form>
		</div>	
	</div>
</div>
