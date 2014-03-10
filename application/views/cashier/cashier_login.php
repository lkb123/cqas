	<font color = "red">
	<?php 
			if($message == '')
				echo '';
			else
				echo $message;
	?>
	</font>

	<br>
	
	<a href=<?php echo site_url() . '/mainframe/index' ?>> Home </a>
	
	<br><br>
	</font>

	<form method = "post" action = "cashier_home.php">
		Cashier ID: <input type="text" name = "cashierid" />
		<br>
		Password; <input type="password" name="cashierpass" />
		<br>
		<input type="submit" value="login" />
	</form>
