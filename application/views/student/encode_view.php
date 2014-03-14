		
<div class = "container">

	<?php 
			if($message == '')
				echo '';
			else
				echo '<div class="alert alert-danger">';
				echo $message;
				echo '</div>';
	?>

	<form method=post action=<?php echo site_url() . '/mainframe/encode' ?>>
	ID Number: 
	<input type=text name="idNumber" />
	<input type="checkbox" name="subscribe" value="true" />Subscribe to Alert System
	
	<input type=submit value="submit" />

	<a href=<?php echo site_url() . '/mainframe/index' ?>>Reset Priority Number to 0 </a> <br>
	</form>
</div>