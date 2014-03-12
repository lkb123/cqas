
	<font color = "red">
	<?php 
			if($message == '')
				echo '';
			else
				echo $message;
	?>
	</font>
	<form method=post action=<?php echo site_url() . '/mainframe/encode' ?>>
	ID Number: 
	<input type=text name="idNumber" />
	<input type="checkbox" name="subscribe" value="true" />Subscribe to Alert System
	<br>	
	<input type=submit value="submit" />
	<br><br>
	<a href=<?php echo site_url() . '/mainframe/index' ?>>Reset Priority Number to 0 </a> <br>
	</form>

