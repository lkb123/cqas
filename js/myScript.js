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
						data: toServe.studid.val(),
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

	$('#unsubscribe').hide();

   	$('#cellNum').hide();

   	$('#register').hide();

});

$('#home').click(function(e){

	window.location.replace("http://localhost/cqas");
	e.preventDefault
});


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
    			success: function(resultData){
    				if(resultData['idValidFormat']==false){ //wala sa database 
    					alert('ID not valid');
    				}else if(resultData['idExist']===false){
    					alert('Not in database');
    				}else if(resultData['idValidToQueue']==false){
    					alert('pending');   				
    				}else{
    					$("#idNum").prop('disabled', true);
    					$("#subscribe").prop('disabled', true);
    					$("#addtoQueue").hide();
    					$("#register").show();
    					$('#unsubscribe').show();
						$("#cellNum").show('slow').val(resultData['idExist']);
    				}
    			}	
    		});
    	}
    }
    else{
    	$.ajax({
    		type: 'POST',
    		url: 'http://localhost/cqas/index.php/mainframe/encode',
    		data: $('#login').serialize(),
    		dataType: 'json',
    		success: function(result){
    			if(result['flag']){
    				alert(result['pmessage']+' '+result['pnumber']);
    			}
    			else{
    				alert(result['errormessage']);
    			}
    	}
 
		});
     }  	
});

$('#unsubscribe').click(function(e){


	$("#idNum").prop('disabled', false);
	$("#subscribe").prop('disabled', false);
	$("#subscribe").prop("checked", false);
	$("#addtoQueue").show();
	$("#register").hide();
	$('#unsubscribe').hide();
	$("#register").hide("slow")
	$("#cellNum").hide("slow")
	
	e.preventDefault();
});

$('#register').click(function(e){
	

	//var cellNum = $('#cellNum').val();
   		
    $.ajax({
		type: 'POST',
		url: 'http://localhost/cqas/index.php/mainframe/encodeWithNumber',
		data: $('#login').serialize(),
		dataType: 'json',
		success : function(result){
			if(result['flag']===true){
				alert(result['pmessage']+" "+result["pnumber"]);
			}else{
				alert(result['error']);
			}
		}
	});

	e.preventDefault();	
});

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




