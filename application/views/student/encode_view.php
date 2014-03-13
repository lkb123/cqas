		<button class="btn btn-primary btn-lg" data-toggle="modal" data-target="#myModal">
		  TEST MODAL
		</button>

		<!-- Modal -->
		<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
		  <div class="modal-dialog">
			<div class="modal-content">
			  <div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
				<h4 class="modal-title" id="myModalLabel">Modal title</h4>
			  </div>
			  <div class="modal-body">
				...
			  </div>
			  <div class="modal-footer">
				<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
				<button type="button" class="btn btn-primary">Save changes</button>
			  </div>
			</div>
		  </div>
		</div>	

	<font color = "red">

	<br><br>
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
