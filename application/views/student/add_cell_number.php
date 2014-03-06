	You do not have a cellphone number. Please enter your cellphone number.

	<font color = "red">
	<?php 
			if($message == '')
				echo '';
			else
				echo $message;
	?>
	</font>
	
	<br><br>


	<form method=post action=<?php echo site_url() . '/mainframe/encodeWithCellNumber' ?>>
		Cellphone Number: <input  type="text" name="cellNumber" />
		<br>
		<input type="submit" value="submit" />
	</form>

	<a href="">Just do not subscribe</a> <br>