<div data-role='main' class='content'>
	<table style='margin-left:25px;'>
		<h3>Address List</h3>
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
</div>
<div data-role="footer" style='text-align:center;font-size:0.5em'>
	<p>Copyrigth &copy; 2014-2024 by Mengtian Zhou</p>
	<p>All Rights Reserved.</p>
</div>
</div> 
</body>
</html>