jQuery(document).ready(function($){		
	
	$('input[type=radio][name=txbrand], input[name="colors[]').change(function(event) {							  
		//event.preventDefault();
		/*var useremail = $("input[name='gatedemail").val();
		if (!useremail) {
			alert("please enter your email");
			return false;
		}else if( !isEmail(useremail) ){
			alert("please enter valid email");
			return false;
		}*/
		var brand  = $('input[name="txbrand"]:checked').val();
		var color  = $('input[name="colors[]"]:checked').val();
		var colors = $('input[name="colors[]"]:checked').serialize();
		
		var colorsArray = [];
		$('input[name="colors[]"]:checked').each(function() 
		{
		   // add $(this).val() to your array
		   //alert($(this).val());
		   colorsArray.push($(this).val());
		});
		var allcolors = colorsArray.toString();
		//alert(colorsArray);
		
		
		jQuery.ajax({
			type: "post",
			dataType: "html",
			url: my_ajax_object.ajax_url,
			 data : {action: "get_filter_products", brand: brand, colors:allcolors},
			success: function(data){
				
				$('.products').html(data); 
			}
		});
	  
	  //$(".gatedcontent").show();
	  //$(".gatedpostform").hide();
	});
});
	