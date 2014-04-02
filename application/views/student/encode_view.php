		
<div class = "container">
  <div id = "successAlert" class="modal bs-example-modal-sm" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="true">
   <div class="modal-dialog modal-sm">
      <div class="modal-content">
          <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
        <div class="alert-message alert-message-success">
        <h4>Successfully Added</h4>
        <br/>
        <p style = "font-size:20px;">Priority Number:</p><span style = "font-size:100px;" id = "priorityNumber"></span>
        <br/>
        <button type="button" class="btn btn-primary btn-block" data-dismiss="modal" aria-hidden="true">O k a y</button>
        </div>      
      </div>
    </div>
  </div>

	<div class="cont">
	 <div class="row">
    	<div class="container" id="formContainer">
          <form class="form-signin" id="login" role="form"   method="post"> <!--action=<?php// echo site_url() . '/mainframe/encode' ?>-->
            <button id="home" type="button" class="btn btn-default btn-xs" data-toggle="tooltip" data-placement="right" title="Home">
              <span class="glyphicon glyphicon-home"></span>
            </button>
            <h3 class="form-signin-heading">Fill up form</h3>
            <div id="errors" class = "fontErrors">errors</div>
            <br/>
            <input type="text" class="form-control" name="idNumber" id="idNum" placeholder="ID Number" required>
            <div id = "unsubscribe" class="btn btn-xs btn-info">cancel</div>
            <input type="checkbox" name="subscribe" id="subscribe" ><small>&nbspsubscribe to alert system</small></input>
            <br />
            <input type="text" class="form-control" name="cellNum" id="cellNum" placeholder="Cellphone Number" maxlength = "13" required>
            <div id = "addtoQueue" class="btn btn-primary btn-block">Add to Queue</div>
            <div id = "register" class="btn btn-primary btn-block">Add and Register</div>
          </form>
        </div> <!-- /container -->
	   </div>
	</div>
</div>