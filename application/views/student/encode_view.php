		
<div class = "container">

	<?php 
			if($message == '')
				echo '';
			else
				echo '<div id = "error" class="alert alert-danger ">';
				echo $message;
				echo '</div>';
	?>

	<div class="cont">
	<div class="row">
    	<div class="container" id="formContainer">

          <form class="form-signin" id="login" role="form"  action=<?php echo site_url() . '/mainframe/encode' ?> method=post>
          	<br />
            <h3 class="form-signin-heading">Fill up form</h3>
            <br />
            <a href="#" id="flipToRecover" class="flipLink">
              <div id="triangle-topright"></div>
            </a>
            <input type="text" class="form-control" name="idNumber" id="loginPass" placeholder="ID Number" required>
            <br />
            <button class="btn btn-lg btn-primary btn-block" type="submit">Add to Queue</button>
          </form>
    
          <form class="form-signin" id="recover" role="form" action=<?php echo site_url() . '/mainframe/encode' ?> method=post>
          	<br />
            <h3 class="form-signin-heading">Fill up form</h3>
            <br />
            <a href="#" id="flipToLogin" class="flipLink">
              <div id="triangle-topleft" ></div>
            </a>
            <input type="text" class="form-control" name="idNumber" id="idNumber" placeholder="ID Number" required autofocus>
            <input type="text" class="form-control" name="cellNumber" id="cellNumber" placeholder="Cell Number" required>
            <br />
            <button class="btn btn-lg btn-primary btn-block" type="submit">Add to Queue</button>
          </form>

        </div> <!-- /container -->
	</div>
	</div>
</div>