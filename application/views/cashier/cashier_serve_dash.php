



<div class="container">
  <div class="row well">
    <div class="col-md-2">
          <ul class="nav nav-pills nav-stacked well">
              <li class="active"><a href=<?php echo site_url() . '/mainframe/index' ?>> Home </a></li>
              <!-- <li class="active"><a href="#"> Reset Priority to 0 </a></li> -->
              <li><a href=<?php echo site_url() . '/mainframe/cashierIndex/cashier_home' ?>> Cashier Profile</a></li>
              <li><a href=<?php echo site_url() . '/mainframe/cashierIndex/cashier_serve_dash' ?> id="serve"> Serve Student</a></li>
              <li><a href=<?php echo site_url() . '/mainframe/logout' ?>> Logout </a></li>
            </ul>
        </div>
        <div class="col-md-10">
                <div class="panel">
                   <div class="row">
           <div class="col-lg-5">
              <button id='servebutton' class='btn btn-primary'>Serve</button>
                <div class="media" id="confirm">
                </div>     
                
                <div class="media" id="list">  
                </div>
             </div>
           </div>
        </div>
      </div>
    </div>
</div>