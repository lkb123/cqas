		
<div class = "container">


	<div class="cont">
	<div class="row">


    	<div class="container" id="formContainer">


          <form class="form-signin" id="login" role="form"   method="post"> <!--action=<?php// echo site_url() . '/mainframe/encode' ?>-->
          <button id="home" type="button" class="btn btn-default btn-xs" data-toggle="tooltip" data-placement="right" title="Home">
            <span class="glyphicon glyphicon-home"></span>
          </button>
            <h3 class="form-signin-heading">Fill up form</h3>
            <input type="text" class="form-control" name="idNumber" id="idNum" placeholder="ID Number" required>
            <input type="checkbox" name="subscribe" id="subscribe" ><small>&nbspsubscribe to alert system</small></input>
            <div id = "unsubscribe" class="btn btn-xs btn-info">cancel</div>
            <br />
            <input type="text" class="form-control" name="cellNum" id="cellNum" placeholder="Cellphone Number" required>
            <div id = "addtoQueue" class="btn btn-primary btn-block">Add to Queue</div>
            <div id = "register" class="btn btn-primary btn-block">Add and Register</div>
          </form>
        </div> <!-- /container -->
	   </div>
	</div>
</div>