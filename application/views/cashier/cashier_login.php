
		<font color = "red">
		<?php 
			if($message == '')
				echo '';
			else
				echo $message;
		?>
		</font>
		<link rel="stylesheet" href="css/bootstrap.css"/>
		<link rel="stylesheet" href="css/bootstrap.min.css"/>
		<div class="container">    
			<div id="loginbox" style="margin-top:50px;" class="mainbox col-md-6 col-md-offset-3 col-sm-8 col-sm-offset-2">                    
				<div class="panel panel-info" >
						<div class="panel-heading">
							<div class="panel-title">Cashier Login</div>
						</div>     

						<div style="padding-top:30px" class="panel-body" >

							<div style="display:none" id="login-alert" class="alert alert-danger col-sm-12"></div>
                            
							<form method = post action=<?php echo site_url() . '/mainframe/login' ?> id="loginform" class="form-horizontal" role="form">
                                    
								<div style="margin-bottom: 25px" class="input-group">
											<span class="input-group-addon"><i class="glyphicon glyphicon-user"></i></span>
											<input id="login-username" type="text" class="form-control" name="cashierid" value="" placeholder="username">                                        
										</div>
                                
								<div style="margin-bottom: 25px" class="input-group">
											<span class="input-group-addon"><i class="glyphicon glyphicon-lock"></i></span>
											<input id="login-password" type="password" class="form-control" name="cashierpass" placeholder="password">
										</div>


									<div style="margin-top:10px" class="form-group">
										<!-- Button -->

										<div class="col-sm-12 controls">
										<input id="btn-login" href="#" class="btn btn-success" type=submit>

										</div>
									</div>

								</form>     



							</div>                     
						</div>  
					</div>    
			</div> 
		</div>
    