	<h1>Congratulations!</h1>
	<span>
		You have been added to the waiting list. Your'e priority number is:
	</span>

	<div>
		<h1>
		<?php echo $message ?>
		</h1>
	</div>

	<br><br>
	<a href=<?php echo site_url() . '/mainframe/studentIndex/encode_view' ?>>Enter more ID Numbers </a> <br>
	<a href=<?php echo site_url() . '/mainframe/index' ?>>Reset Priority Number to 0 </a> <br>