
		<font color = "red">
		<?php 
			if($message == '')
				echo '';
			else
				echo $message;
		?>
		</font>
		
<div class="navbar-collapse">
	<div class="row">
    	<h2>Cashier Queueing Alert System</h2>
        <div class="btn-group btn-breadcrumb">
            <a href="<?php echo site_url('mainframe/index');?>" class="btn btn-primary"><i class="glyphicon glyphicon-home"></i>Home</a>
            <a href="<?php echo current_url();?>" class="btn btn-primary">Sign In</a>
        </div>
	</div>
</div>
			

<div class="container">
	<div class="row">
    	<div class="container" id="formContainer">

          <form action="<?php echo site_url('mainframe/login');?>"class="form-signin" id="login" role="form" method="post">
            <h3 class="form-signin-heading">Cashier Login</h3>
            <input type="text" class="form-control" name="cashierid" id="cashierid" placeholder="Username" required autofocus>
            <input type="password" class="form-control" name="cashierpass" id="cashierpass" placeholder="Password" required>
            <button class="btn btn-lg btn-primary btn-block" type="submit">Sign in</button>
          </form>
    

        </div> <!-- /container -->
	</div>
</div>
