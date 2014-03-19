	<font color = "red">
	<?php 
			if($message == '')
				echo '';
			else
				echo $message;
	?>
	</font>

<div class="container">
	<div class="row well">
		<div class="col-md-2">
    	    <ul class="nav nav-pills nav-stacked well">
              <li class="active"><a href=<?php echo site_url()?>> Home </a></li>
              <li><a href=<?php echo site_url() . '/mainframe/cashierIndex/cashier_home' ?>> Cashier Profile</a></li>
              <li><a href=<?php echo site_url() . '/mainframe/cashierServe/cashier_serve_dash' ?>> Serve Student</a></li>
              <li><a href=<?php echo site_url() . '/mainframe/logout' ?>> Logout </a></li>
          </ul>
    </div>
    <div class="col-md-10">
                <div class="panel">
                    <img class="pic img-circle" src="<?php echo base_url();?>img/defaultpic.jpg" alt="...">
                    <div class="name"><small><?php echo $givenname;?> <?php echo $middlename; ?> <?php echo $lastname; ?></small></div>
                </div>
    </div>

  </div>
</div>