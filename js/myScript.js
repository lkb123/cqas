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
		    	$("#SubmitForm").attr("action", "index.php/mainframe/login").submit();
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

$("#serve").click(function(e) {
	e.preventDefault();
	//$("#list").append("Hello");
	$.ajax({
		type: 'POST',
		url: "http://localhost/cqas/index.php/mainframe/getToBeServedStudents",
		dataType: "json",
		success: function(pending) {
			if(pending.length == 0)
				alert("empty");
			else {
				
				for(var i = 0; i < pending.length; i++) {
					var student = pending[i];
					var studid = '<strong>ID Number: </strong>' + student.studid + '<br>';
					var pnumber = '<strong>Priority Number: </strong>' + student.pnumber + '<br>';
					var studname = '<strong>Name: </strong>' + student.studname + '<br>';
					var phone = '<strong>Phone: </strong>' + student.phone + '<br>';

					var openDiv = "<div class='media'>";
					var img = "<a class='pull-left' href='#'> <img class='media-object dp img-circle' src='http://img2.wikia.nocookie.net/__cb20111231185619/trigun/images/2/2b/Vash1.jpg' style='width: 100px;height:100px;'> </a>";
					var content = "<div class='media-body'> " + studid + pnumber + studname + phone + "</div>";
					var serveButton = "<button class='btn btn-primary'>Serve</button>";
					var closeDiv = "</div>";
					$("#list").append(openDiv + img + content + serveButton + closeDiv);
				}
					
			}
		}
	});
	
});



$('document').ready(function(){
	$('.queueAlert').slideToggle('slow')
});



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