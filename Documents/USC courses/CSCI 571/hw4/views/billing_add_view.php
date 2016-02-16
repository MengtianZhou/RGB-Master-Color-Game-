<link rel='stylesheet' type='text/css' href='<?php echo base_url();?>css/select_add.css'>
		<table>
			<caption>Select a billing address</caption>
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
					echo "<input type='radio' name='billing_add' value='".$fullname.",".$address.",".$city.",".$state.",".$zipcode.",phone: ".$phone."'>";
					echo "</th>";
					echo "<td>";
					echo "$fullname,<br>$address, $city, $state, $zipcode,<br>phone: $phone";
					echo "</td>";
					echo "</tr>";
				}
			?>
		</table>