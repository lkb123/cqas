	<body>

		<form action=<?php echo site_url('mainframe/encode'); ?> method=post>
		<table border=0>
		<p><?php echo validation_errors();?></p>
		<tr>
			<td>Student ID Number:</td>
			<td><input type=text name="idNumber" /></td>
		</tr>
		<tr>
			<td></td>
			<td><input type=submit value="submit"></td>
		</tr>
		</table>
		</form>
	</body>