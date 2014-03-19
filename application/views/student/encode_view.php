		
<div class = "container">


	<div class="cont">
	<div class="row">


    	<div class="container" id="formContainer">


          <form class="form-signin" id="login" role="form"   method="post"> <!--action=<?php// echo site_url() . '/mainframe/encode' ?>-->
          	<br />
            <div class = "queueAlert" hidden>
              <?php 
                        if($messageType == '')
                          echo '';
                        elseif ($messageType === 'Error') {
                          echo '<div class="alert-danger alert-dismissable btn btn-default btn-xs btn-block">';
                          echo '<button type="button" class="close " data-dismiss="alert" aria-hidden="true">&times;</button><br><small>';
                          echo $message;
                          echo '</small></div>';
                        }
                        elseif ($messageType === 'Success') {
                          echo '<div class="alert-success alert-dismissable btn btn-default btn-xs">';
                          echo '<button type="button" class="close text-center" data-dismiss="alert" aria-hidden="true a">&times;</button><small>';
                          echo $message.'<br><h3>&nbsp;&nbsp;&nbsp;&nbsp;Priority Number : '.$pnumber.'</h3>';
                          echo '</small></div>';
                        }

                    ?>
            </div>
            <h3 class="form-signin-heading">Fill up form</h3>
            <br />
            <input type="text" class="form-control" name="idNumber" id="idNum" placeholder="ID Number" required>
            <input type="checkbox" name="subscribe" id="subscribe" ><small>&nbspsubscribe to alert system</small></input>
            <br />
            <div id ="pnum"></div>
            <button id = "addtoQueue" class="btn btn-primary btn-block">Add to Queue</button>
            <button id = "register" class="btn btn-primary btn-block">Add and Register</button>
          </form>
        </div> <!-- /container -->
	   </div>
	</div>
</div>