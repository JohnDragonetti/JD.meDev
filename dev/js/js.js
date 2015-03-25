$(document).ready(function() {
	$("#content-b").hide();							//hide the folio section
	//show bio, hide folio
	$("#item-1").click(function() {
		if($("#content-b").is(":visible")) {
			$("#content-b").hide();
		}
		if($("#content-a").is(":hidden")) { 		//if #content-a is hidden, 
			$("#content-a").slideDown("slow");		//slideDown slow 
		} else {									//Otherwise..
			$("#content-b").hide();					//hide it.
		}
		});


	//show folio, hide bio
	$("#item-2").click(function() {
		if($("#content-a").is(":visible")) {
			$("#content-a").hide();
		}
		if($("#content-b").is(":hidden")) { 		//if #content-b is hidden, 
			$("#content-b").slideDown("slow");		//slideDown slow 

		} else {									//Otherwise..
			$("#content-a").hide();					//hide it.
		}
		});

	//this will hide the screenshots on the folio page
	$("#hideme").click(function(){
		if($("#screens-1").is(":visible")) {
			$("#screens-1").slideUp("slow");
			$("#hideme").html("(show)");
			}
		}
	);
	$("#hideme").click(function(){
		if($("#screens-1").is(":hidden")) {
			$("#screens-1").slideDown("slow");
			$("#hideme").html("(hide)");
			}
		}
	);
	$("#heyyou").click(function() {
		window.location ="screens.html";
	});

});
