<div class="content" data-role='main'>
	<form action='<?php echo base_url();?>index.php/checkout/validate_card' method='post'>
		<table>
			<h3>Select a shipping address</h3>
			<?php
				foreach($result as $row){
					$fullname=$row->fullname;
					$address=$row->address;
					$city=$row->city;
					$state=$row->state;
					$zipcode=$row->zipcode;
					$phone=$row->phone;
					echo "<tr>";
					echo "<th>";
					echo "<input type='radio' name='shipping_add' value='".$fullname.",".$address.",".$city.",".$state.",".$zipcode.",phone: ".$phone."'>";
					echo "</th>";
					echo "<td style='padding-left:70px'>";
					echo "$fullname,<br>$address, $city, $state, $zipcode,<br>phone: $phone";
					echo "</td>";
					echo "</tr>";
				}
			?>
		</table>