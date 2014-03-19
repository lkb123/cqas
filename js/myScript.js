$(function(){
    
	// Checking for CSS 3D transformation support
	$.support.css3d = supportsCSS3D();
	
	var formContainer = $('#formContainer');
	
	// Listening for clicks on the ribbon links
	$('.flipLink').click(function(e){
		
		// Flipping the forms
		formContainer.toggleClass('flipped');
		
		// If there is no CSS3 3D support, simply
		// hide the login form (exposing the recover one)
		if(!$.support.css3d){
			$('#login').toggle();
		}
		e.preventDefault();
	});
	
	/*
	formContainer.find('form').submit(function(e){
		// Preventing form submissions. If you implement
		// a backend, you might want to remove this code
		e.preventDefault();
	});
	*/
	
	// A helper function that checks for the 
	// support of the 3D CSS3 transformations.
	function supportsCSS3D() {
		var props = [
			'perspectiveProperty', 'WebkitPerspective', 'MozPerspective'
		], testDom = document.createElement('a');
		  
		for(var i=0; i<props.length; i++){
			if(props[i] in testDom.style){
				return true;
			}
		}

		return false;
	}
});




	/*
		$.ajax({
			type: 'POST',
			url: "<?php echo site_url('mainframe/login');?> ",
			data: $('#SubmitForm').serialize()
	});*/
$( "#target" ).click(function(e) {

		e.preventDefault();
		
		$.ajax({
		type: 'POST',
		url: "http://localhost/cqas/index.php/mainframe/validateLogin",
		data: $('#SubmitForm').serialize(),
		dataType: "json",
		success: function(status){

			
			var item = [];
		    $.each(status
		    	, function(key, val) {
		      item.push(val);
		    });
		    
		    if(item =='true'){
		    	$("#SubmitForm").attr("action", "http://localhost/cqas/index.php/mainframe/login").submit();
		    }
		    else if(item =='empty'){
		    	alert('Both ID and Password must be filled');
		    }
		    else{
		    	alert('Incorrect ID number or Password');	
		    }
		}
		});
		/*
		alert(result);}
	/*$("#SubmitForm").attr("action", "index.php/mainframe/login").submit();*/
});

$(document).ready(function() {
	//e.preventDefault();
	//$("#list").append("Hello");
	$.ajax({
		type: 'POST',
		url: "http://localhost/cqas/index.php/mainframe/getToBeServedStudents",
		dataType: "json",
		success: function(pending) {
			if(pending.length == 0)
				;	//do nothing
			else {
<<<<<<< HEAD
				//$("#donebutton").hide();
				var display = "<div id='count'>Number of students to be served: <strong>" + pending.length + "</strong></div>";
=======

				
>>>>>>> Commit
				for(var i = 0; i < pending.length; i++) {
					var student = pending[i];
					var studid = '<strong>ID Number: </strong>' + student.studid + '<br>';
					var pnumber = '<strong>Priority Number: </strong>' + student.pnumber + '<br>';
					var studname = '<strong>Name: </strong>' + student.studname + '<br>';
					var phone = '<strong>Phone: </strong>' + student.phone + '<br>';

					var openDiv = "<div class='media'>";
					var img = "<a class='pull-left' href='#'> <img class='media-object dp img-circle' src='http://img2.wikia.nocookie.net/__cb20111231185619/trigun/images/2/2b/Vash1.jpg' style='width: 100px;height:100px;'> </a>";
					var content = "<div class='media-body'> " + studid + pnumber + studname + phone + "</div>";
					var closeDiv = "</div>";
					display = display + openDiv + img + content + closeDiv;
				}
				$("#list").html(display);
			}
		}
	});
	
});

$("#servebutton").click(function() {
	//alert("Hello World");
	$.ajax({
		type: 'POST',
		url: "http://localhost/cqas/index.php/mainframe/serveStudent",
		dataType: "json",
		success: function(toServe) {
			if(toServe.length == 0) {
				alert("empty");
			}
			else {
				//$.cookie('idnumber', toServe.studid);
				var studid = '<strong>ID Number: </strong>' + toServe.studid + '<br>';
				var name = '<strong>Name: </strong>' + toServe.lastname + ', ' + toServe.givenname + ' ' + toServe.middlename + '<br>';
				var course = '<strong>Course: </strong>' + toServe.course + '<br>';
				var college = '<strong>College: </strong>' + toServe.college + '<br>';

				var display = "";
				var openDiv = "<div class = media";
				var content = "<div class='media-body'> " + studid + name + course + college + "</div>";
				var img = "<a class='pull-left' href='#'> <img class='media-object dp img-circle' src='http://img2.wikia.nocookie.net/__cb20111231185619/trigun/images/2/2b/Vash1.jpg' style='width: 100px;height:100px;'> </a>";
				var button = "<button id='donebutton' class='btn btn-primary'>Done</button>";
				var closeDiv = "</div>";
				display = display + openDiv + img + content + button + closeDiv;
				$("#list").html(display);
				$("#servebutton").remove();

				$(document).on('click', '#donebutton', function() {
					//alert(toServe.studid);
					$.ajax({
						type: 'POST',
						url: "http://localhost/cqas/index.php/mainframe/doneServeStudent",
						data: toServe.studid.val();
						//dataType: 'json',
						//success: function() {
							//do nothing
						//}
					});
				});
			}
		}
	});
});


$(function(){
	$('.queueAlert').show('slow');

	$('#register').hide();

});

/* 
$('#subscribe').click(function(){
	var checked = $('#subscribe').prop("checked") 
	if(checked){
		var newInput = '<input type="text" class="form-control pnum" name="cellNum" id="cellNum" placeholder="Cellphone Number"/>';
		$("#pnum").hide().append(newInput).show('slow');
	}else{
		$(".pnum").remove();
	}
});

*/

$('#addtoQueue').click(function(e){

	e.preventDefault();
	var checked = $('#subscribe').prop("checked");

    if(checked){
    	var idNum = $('#idNum').val();
    	if(idNum==""){
    		alert('ID number must be filled');
    	}else{
    		$.ajax({
    			type: 'POST',
    			url: 'http://localhost/cqas/index.php/mainframe/subscribe',
    			data: $('#login').serialize(),
    			dataType: 'json',
    			success: function(idNumberData){
    				if(idNumberData=='false'){ //wala sa database
    					$("#login").attr("action", "http://localhost/cqas/index.php/mainframe/encode").submit();
    				}else if(idNumberData==''){ //walay phone
    					$("#idNum").prop('disabled', true);
    					$("#subscribe").prop('disabled', true);
    					$("#addtoQueue").hide();
    					$("#register").show();
    					var newInput = '<input type="text" class="form-control pnum" name="cellNum" id="cellNum" placeholder="Cellphone Number"/>';
						$("#pnum").hide().append(newInput).show('slow');
    				}
    				else{
    					$("#idNum").prop('disabled', true);
    					$("#subscribe").prop('disabled', true);
    					$("#addtoQueue").hide();
    					$("#register").show();
    					var newInput = '<input type="text" class="form-control pnum" name="cellNum" id="cellNum" placeholder="Cellphone Number"/>';
						$("#pnum").hide().append(newInput).show('slow');
    				}
    			}	
    		});
    	}
    }
    else{
    	$("#login").attr("action", "http://localhost/cqas/index.php/mainframe/encode").submit();
    }
});



$


/* keeping this for reference purposes
*
*
		success: function(status){

			
			var items = [];
		    $.each(status
		    	, function(key, val) {
		      items.push(key + ' : ' + val + '</br>');
		    });
		    $('body').append(items.join(''));}
		});
*
*/

$('#startServing').click(function(){

		$.ajax({
		url: "http://localhost/cqas/index.php/mainframe/hasSession",
		success: function(hasSession){

			if(hasSession == 'false'){
				$('#cashierLogInForm').addClass('fade').modal('show');
			}
			else{

				window.location.replace("http://localhost/cqas/index.php/mainframe/cashierIndex/cashier_home");
			}
		}
		});
});




