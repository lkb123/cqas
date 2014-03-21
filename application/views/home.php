
<div class = "container">
	<div class="row text-center" style="width:500px; margin:auto">
	<div><h1>C Q A S</h1>
		<h5><small>Cashier Queuing Alert System</small></h5>
	</div>
	  <div class="col-sm-6 col-md-4" style="width:250px;padding:5px">
	    <div class="thumbnail">
	      <img src="<?php echo base_url();?>img/queue.png" alt="Queuing Image" >
	      <div class="caption">
	        <h3>Student Queue</h3>
	        <p><a href="<?php echo site_url() . '/mainframe/studentIndex/encode_view';?>" class="btn btn-primary" role="button">Start Queue</a></p>
	      </div>
	    </div>
	  </div>
	  <div class="col-sm-6 col-md-4" style="width:250px;padding:5px">
	    <div class="thumbnail">
	      <img src="<?php echo base_url();?>img/cashier.png" alt="Cashier Image" style="height:128px;">
	      <div class="caption">
	        <h3>Cashier</h3>
	        <p><a id = "startServing" class="btn btn-primary" >Start Serving</a></p> <!-- data-toggle="modal" data-target="#cashierLogInForm" -->
	      </div>
	    </div>
	  </div>
	</div>


	<div id = "cashierLogInForm" class="modal bs-example-modal-sm" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="true">
	  <div class="modal-dialog modal-sm">
	    <div style = "padding:20px" class="modal-content">
	      <form  id = "SubmitForm" class="form-horizontal" role="form" action="" method="post"> <!--action="<?php //echo site_url('mainframe/login');?>"  method="post""-->
			  <div id="errors" class = "fontErrors">errors</div>
			  <div class="form-group">
			    <label for="inputtext3" class="col-sm-2 control-label">Username</label>
			    <div class="col-sm-offset-1 col-sm-9">
			      <input type="text" class="form-control" name = "cashierid" id="cashierid" placeholder="Username">
			    </div>
			  </div>
			  <div class="form-group">
			    <label for="inputPassword3" class="col-sm-2 control-label">Password</label>
			    <div class="col-sm-offset-1 col-sm-9">
			      <input type="password" class="form-control" name = "cashierpass" id="cashierpass" placeholder="Password">
			    </div>
			  </div>
			  <div class="form-group">
			    <div id = "yes" class="col-sm-offset-3 col-sm-10">
			      <button  id = "cashierSignIn" typeclass="btn btn-default">Sign in</button>
			    </div>
			  </div>
			</form>
	    </div>
	  </div>
	</div>
</div>                                   