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
	<a href=<?php echo site_url() . '/mainframe/cashierIndex/cashier_home' ?>> Cashier </a>
	<a href=<?php echo site_url() . '/mainframe/cashierIndex/cashier_serve_dash' ?>> Serve </a>
	<a href=<?php echo site_url() . '/mainframe/logout' ?>> Logout </a>