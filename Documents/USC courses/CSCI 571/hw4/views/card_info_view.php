		<table>
			<caption>Credit card information</caption>
				<tr>
					<th>Card number:</th>
					<td><input type='text' class='text-field' name='card_number' value="<?php echo set_value('card_number'); ?>" placeholder='16 digits only'></td>
				</tr>
				<tr>
					<th>CVV number:</th>
					<td><input type='text' class='text-field' name='cvv_number' value="<?php echo set_value('cvv_number'); ?>" placeholder='3 digits only'></td>
				</tr>
				<tr>
					<th>Expiration date</th>
					<td>
						<select>
							<?php 
								$month=1;
								while($month<13){
									echo "<option value='$i'>$month</option>";
									$month++;
								}
							?>
						</select>
						<select>
							<?php
								$year=2014;
								while($year<2034){
									echo "<option value='$year'>$year</option>";
									$year++;
								}
							?>
						</select>
					</td>
				</tr>
		</table>
		<input type='submit' class='button' name='submit' value='submit'>
	</form>
</div>
