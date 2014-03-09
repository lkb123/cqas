	<font color = "red">
	<?php 
			if($message == '')
				echo '';
			else
				echo $message;
	?>
	</font>

	<br>
	
	<a href=<?php echo site_url() . '/mainframe/cashierIndex/cashier_home' ?>> Home </a>
	<a href=<?php echo site_url() . '/mainframe/logout' ?>> Logout </a>