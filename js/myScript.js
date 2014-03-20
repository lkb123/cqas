$(function(){
    var timeVar = "";
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

$(document).ready(function displayFifteenStudents() {
	$.ajax({
		type: 'POST',
		url: "http://localhost/cqas/index.php/mainframe/getToBeServedStudents",
		dataType: "json",
		success: function(pending) {
			if(pending.length == 0) {
				$("#servebutton").hide();
				var display = "<div id='count' class='alert-success'>Number of students to be served: <strong>" + pending.length + "</strong></div>";
				var openDiv = "<div class='media'>";
				var img = "<a class='pull-left' href='#'></a>";
				var content = "<div class='media-body'> <strong> No students to be served </strong> </div>";
				var closeDiv = "</div>";
				display = display + openDiv + img + content + closeDiv;
				$("#list").html(display);
				timeVar = setTimeout(displayFifteenStudents, 1000);
			}
			else {
				var display = "<div id='count'>Number of students to be served: <strong>" + pending.length + "</strong></div>";
				$("#servebutton").show();
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
				timeVar = setTimeout(displayFifteenStudents, 1000);
			}
		},
	});	
});

$("#servebutton").click(function displayToBeServedStudent() {
	clearTimeout(timeVar);
	$.ajax({
		type: 'POST',
		url: "http://localhost/cqas/index.php/mainframe/serveStudent",
		dataType: "json",
		success: function(toServe) {
			if(toServe.length == 0) {
				; //do nothing
			}
			else {
				var studid = '<strong>ID Number: </strong>' + toServe.studid + '<br>';
				var name = '<strong>Name: </strong>' + toServe.lastname + ', ' + toServe.givenname + ' ' + toServe.middlename + '<br>';
				var course = '<strong>Course: </strong>' + toServe.course + '<br>';
				var college = '<strong>College: </strong>' + toServe.college + '<br>';
				var button = "<button onclick = doneButton('" + toServe.studid + "') id='donebutton' class='btn btn-primary'>Done</button>";

				var display = "";
				var openDiv = "<div class = 'media'>";
				var content = "<div class='media-body'> " + studid + name + course + college + "</div>";
				var img = "<a class='pull-left' href='#'> <img class='media-object dp img-circle' src='http://img2.wikia.nocookie.net/__cb20111231185619/trigun/images/2/2b/Vash1.jpg' style='width: 100px;height:100px;'> </a>";
				var closeDiv = "</div>";
				display = display + openDiv + img + content + closeDiv;
				$("#list").html(display);
				$("#servebutton").replaceWith(button);
			}
		}
	});
});

function doneButton(idNumber) {
	$(document).ready(function() {
		$("#confirm").slideDown("slow", function() {
			var display = "";
			var openDiv = "<div class='container'>";
			var question = "<div class='alert-info'> <strong> Are you sure you are done serving this student? </strong><br>";
			var yes = "<button id='yes' class='btn btn-success'> Yes </button>";
			var no = "<button id='no' class='btn btn-warning'> No </button>";
			var closeDiv = "</div></div>";
			var display = display + openDiv + question + yes + no + closeDiv;
			$("#confirm").html(display);

			$(document).on('click', '#yes', function() {
				window.location.assign('http://localhost/cqas/index.php/mainframe/doneServeStudent?idnumber=' + idNumber);
			});

			$(document).on('click', '#no', function() {
				$("#confirm").slideUp();
			});
		});
	});
	//naa pa gamay na bug..dili mu slide down on first click
}


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




