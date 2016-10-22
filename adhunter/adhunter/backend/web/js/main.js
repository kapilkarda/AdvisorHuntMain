 
$(function()
{
	function getURLParameter(url, name) {
	    return (RegExp(name + '=' + '(.+?)(&|$)').exec(url)||[,null])[1];
	}

	var path = window.location.href; // because the 'href' property of the DOM element is the absolute path
	   	$('.sidebar-menu li a').each(function() {
	   		 // var index = getURLParameter(path, 'r').indexOf('/');
	   		 // alert(this.href.indexOf('#'));
	   		 // getURLParameter(path, 'r').substr(0,index);
	   		 // if(getURLParameter(this.href, 'r') != null){
	   		 // 	alert(getURLParameter(path, 'r')+"---"+getURLParameter(this.href, 'r'));
	   		 	// if (this.href === path || (getURLParameter(path, 'r').indexOf(getURLParameter(this.href, 'r').substr(0,index)) >= 0)) { 
	   		 	if (this.href === path) { 
				     $(this).closest( "li" ).addClass('active');
				     $(this).closest( "li" ).parent().parent("li:first").addClass('active');
	   		 	}
			// }
	});

	$("#add-service-btn").click(function(){
    		$("#add-service-modal").modal('show')
		    .find("#add-service-modal-content")
		    .load($(this).attr('value'));
	});

    $("#add-area-btn").click(function(){
    $("#add-area-modal").modal('show')
            .find("#add-area-modal-content")
            .load($(this).attr('value'));
	});

    $("#add-license-btn").click(function(){
    $("#license-modal").modal('show')
            .find("#license-modal-content")
            .load($(this).attr('value'));
	});

    $("#add-back-check-btn").click(function(){
    $("#back-check-modal").modal('show')
            .find("#back-check-modal-content")
            .load($(this).attr('value'));
	});

    $(".add-service-btn").click(function(){
    	var company_id = $(this).attr('company');
		$("#add-service-modal-"+company_id).modal('show')
	    .find("#add-service-modal-content-"+company_id)
	    .load($(this).attr('value'));
	});

 	$(".add-area-btn").click(function(){
 		var company_id = $(this).attr('company');
    	$("#add-area-modal-"+company_id).modal('show')
            .find("#add-area-modal-content-"+company_id)
            .load($(this).attr('value'));
	});

    $(".add-license-btn").click(function(){
    	var company_id = $(this).attr('company');
    	$("#license-modal-"+company_id).modal('show')
            .find("#license-modal-content-"+company_id)
            .load($(this).attr('value'));
	});

    $(".add-back-check-btn").click(function(){
    	var company_id = $(this).attr('company');
    	$("#back-check-modal-"+company_id).modal('show')
            .find("#back-check-modal-content-"+company_id)
            .load($(this).attr('value'));
	});

	$('.bid-status-select').change(function(){
		if (confirm('Are you sure?')) {
   			$.ajax({
			    type     :'POST',
			    cache    : false,
			    data     : {bid_id: $(this).attr('bid-id'), 'status': $(this).val()},
			    url      : $(this).attr('action'),
			    success  : function(response) {
			    	if(response == 1)
			        	alert('Status Changed!!!');
			        else
			        	console.log("something wrong");
			    }
		   	});
		} 
		  	
	});

 	$("#emailcriteria-btn").click(function(){
    	$("#emailcriteria-modal").modal('show')
            .find("#emailcriteria-modal-content")
            .load($(this).attr('value'));
	});
 	
 	$("#textphonecriteria-btn").click(function(){
    	$("#criteria-modal").modal('show')
            .find("#criteria-modal-content")
            .load($(this).attr('value'));
	});

 	$(document).on( "addQuery", function( event, query ) {
		var userQuery = $.parseJSON(query).user_query;
		var companyQuery = $.parseJSON(query).company_query;
		// alert(userQuery);
		$("#emailcriteria-modal").modal('hide')
		$('textarea#user_query_txt').val(userQuery);
		$('textarea#company_query_txt').val(companyQuery);
	});

	$(document).on( "addQueryforPhone", function( event, query ) {
		var userQuery = $.parseJSON(query).user_query;
		var companyQuery = $.parseJSON(query).company_query;
		// alert(userQuery);
		$("#criteria-modal").modal('hide')
		$('textarea#user_query_txt').val(userQuery);
		$('textarea#company_query_txt').val(companyQuery);
	});

	// $('.add-promo').click(function(){
	// 	alert($(this).attr('id'));
	// 	console.log($(this).attr('id'));
   			// $.ajax({
			   //  type     :'POST',
			   //  cache    : false,
			   //  data     : {company_id: $(this).attr('company')},
			   //  url      : $(this).attr('action'),
			   //  success  : function(response) {
			   //  	if(response == 1)
			   //      	alert('Status Changed!!!');
			   //      else
			   //      	console.log("something wrong");
			   //  }
		   	// });
		  	
	// });
	
});

