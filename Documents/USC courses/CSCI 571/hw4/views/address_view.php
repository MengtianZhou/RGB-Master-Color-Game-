<link rel="stylesheet" type="text/css" href="<?php echo base_url();?>css/address.css">
<div class="address">
	<table>
		<caption>Address List</caption>
			<?php
				$num=1;
				foreach($result as $row){
					$fullname=$row->fullname;
					$address=$row->address;
					$city=$row->city;
					$state=$row->state;
					$zipcode=$row->zipcode;
					$phone=$row->phone;
					echo "<tr>";
					echo "<th>Address $num:</th>";
					echo "<td>";
					echo "$fullname,<br>$address, $city, $state, $zipcode,<br>phone: $phone";
					echo "</td>";
					echo "</tr>";
					$num++;
				}
			?>
	</table>
</div>