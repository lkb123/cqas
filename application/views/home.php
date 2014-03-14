
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
		      <img src="<?php echo base_url();?>img/cashier.png" alt="Cashier Image" style="height:129px;">
		      <div class="caption">
		        <h3>Cashier</h3>
		        <p><a data-toggle="modal" data-target=".bs-example-modal-sm" class="btn btn-primary" role="button">Start Serving</a></p>
		      </div>
		    </div>
		  </div>
		</div>


		<div class="modal fade bs-example-modal-sm" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="true">
		  <div class="modal-dialog modal-sm">
		    <div style = "padding:20px" class="modal-content">
		      <form action="<?php echo site_url('mainframe/login');?>" class="form-horizontal" role="form">
				  <div class="form-group">
				    <label for="inputtext3" class="col-sm-2 control-label">Username</label>
				    <div class="col-sm-offset-1 col-sm-9">
				      <input type="text" class="form-control" id="username" placeholder="Username">
				    </div>
				  </div>
				  <div class="form-group">
				    <label for="inputPassword3" class="col-sm-2 control-label">Password</label>
				    <div class="col-sm-offset-1 col-sm-9">
				      <input type="password" class="form-control" id="inputPassword3" placeholder="Password">
				    </div>
				  </div>
				  <div class="form-group">
				    <div class="col-sm-offset-3 col-sm-10">
				      <button type="submit" class="btn btn-default">Sign in</button>
				    </div>
				  </div>
				</form>
		    </div>
		  </div>
		</div>

	</div>                                          