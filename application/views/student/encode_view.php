	<?php 
			if($message == '')
				echo '';
			else
				echo 'Error: ' . $message ;
	?>

	<form method=post action=<?php echo site_url() . '/MainFrame/encode' ?>>
	ID Number: 
	<input type=text name="idNumber" />
	<br>	
	<input type=submit value="submit">
	</form>