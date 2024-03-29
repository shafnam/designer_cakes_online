
/* MULTIPLE LEVEL NAVIGATION */

$(document).ready(function() {
	$(".megamenu").on("click", function(e) {
		e.stopPropagation();
	});
});

$(document).ready(function(){
	$('[data-toggle="tooltip"]').tooltip(); 
});

/* FIXED HEADER ON SCROLL */
 
$(window).scroll(function() {
  if ($(this).scrollTop() > 150) {
		$('#mainHeader').addClass("sticky");
  } else {
		$('#mainHeader').removeClass("sticky");
  }
});

/* 
---------------------	
CAKE DESIGN ORDER FORM 
----------------------	
*/

$(document).ready(function(){

	$('#order-design-form #Step_1').hide();
	$('#order-design-form #Step_2').hide();
	$('#order-design-form #Step_3').hide();

	/*-------------- 
		STEP 1
	----------------*/

	// show sub flavours
	$('#order-design-form input[name="flavour"]').click(function(){
		var inputValue = $(this).attr("id");
		var targetDiv = inputValue + "-flavour";
		$('.hide').hide();
		$("#"+ targetDiv).show('slow');
	});

	// dynamic dependent filling fields
	$('#order-design-form input[name="flavour"]').change(function (){	

		var inputValue = $(this).attr("id");
		var targetDiv = inputValue + "-flavour";
		var targetRadioID = inputValue + "-sub-flavour";
		var radioValue;

		// alert(inputValue);

		if($("#"+inputValue).is(':checked')) {
			
			if(($("#" + targetDiv).length == 1)) {

				// radio button has child elements make them required.
				$("#"+targetRadioID).attr('required', true);
				$('#Step_1').fadeOut(100);
				
				$('#order-design-form input[name="sub_flavour"]').change(function () {
					
					if($('#order-design-form input[name="sub_flavour"]').is(':checked')){

						radioValue = $("input[name='sub_flavour']:checked").val();
						$('#Step_1').fadeIn(100);	

						// find the relevent cake fillings with selected id
						$.ajax({
							type: "POST",
							url: "inc/get-fillings.php",
							data: { 
								id: radioValue
							},
							cache: false,
							success: function(result) {
								$(".cakeFillings").html(result);
								// console.log(result);
							},
							error: function(result) {
								alert('error');
							}
						});

					}

				});

			}
			else {
				
				radioValue = $("input[name='flavour']:checked").val();
				// remove required from child elements.
				$('#Step_1').fadeIn(100);

				// find the relevent cake fillings with selected id
				$.ajax({
					type: "POST",
					url: "inc/get-fillings.php",
					data: { 
						id: radioValue
					},
					cache: false,
					success: function(result) {
						$(".cakeFillings").html(result);
					},
					error: function(result) {
						alert('error');
					}
				});

			}

		}
   	
	});

	/*-------------- 
		STEP 2  
	----------------*/

	/* CAKE DESIGN ORDER FORM DYNAMICALLY GENERATED CAKE FILLING FIELDS */
	$(document).on('click','#order-design-form input[name="filling"]',function (){
		if ($(this).is(':checked')) {			
			$('#Step_2').fadeIn(100);
			//alert($(this).val());
		}
	});

	/*-------------- 
		STEP 3  
	----------------*/

	var tier_id;

	// show multiple tiers
	$('#order-design-form input[name="tiers"]').click(function(){
		if ($(this).attr('id') === 'multiple'){			
			$('#multiple-tier').show(800);
			$('.cakeSizes').hide();
			$('.cakeShapes').hide();
			$('input[name="multiple_tiers"]').attr('required', true);
		}
		else if ($(this).attr('id') === 'single'){
			$('#multiple-tier').hide(800);
			$('.cakeSizes').show(800);
			$('.cakeShapes').hide();
			$('input[name="multiple_tiers"]').attr('required', false);
		}	
	});

	// Show single tier sizes
	$('#order-design-form input[name="tiers"]').change(function (){

		if ($(this).attr('id') === 'single'){

			var inputValue = $(this).attr("id");
			var radioValue;

			if($("#"+inputValue).is(':checked')) {
				
				radioValue = $("input[name='tiers']:checked").val();

				// find the relevent cake sizes with selected id
				$.ajax({
					type: "POST",
					url: "inc/get-sizes.php",
					data: { 
						id: radioValue
					},
					cache: false,
					success: function(result) {
						$(".cakeSizes").html(result).fadeIn(500);
						$('.cakeSizes').show(800);
					},
					error: function(result) {
						alert('error');
					}
				});

				// get tier id
				tier_id = radioValue;
				//alert(tier_id);

			}
		}

	});

	// Show multi tier sizes
	$('#order-design-form input[name="multiple_tiers"]').change(function (){

		$('.cakeSizes').hide();
		$('.cakeShapes').hide();
		$('.cakeServings').hide();

		var inputValue = $(this).attr("id");
		var radioValue;

		if($("#"+inputValue).is(':checked')) {
			
			radioValue = $("input[name='multiple_tiers']:checked").val();

			// find the relevent cake sizes with selected id
			$.ajax({
				type: "POST",
				url: "inc/get-sizes.php",
				data: { 
					id: radioValue
				},
				cache: false,
				success: function(result) {
					$(".cakeSizes").html(result).fadeIn(500);
					$('.cakeSizes').show(800);
				},
				error: function(result) {
					alert('error');
				}
			});
			// get tier id
			tier_id = radioValue;
			//alert('tier_id: '+tier_id);
		}

	});

	/* CAKE DESIGN ORDER FORM DYNAMICALLY GENERATED CAKE SIZES FIELDS */
	$(document).on('change','#order-design-form #size',function (){

		$('.cakeShapes').hide();
		$('.cakeServings').hide();
		$('#Step_2').fadeOut();
		
		var radioValue = this.value;

		// find the relevent cake shapes with selected id
		$.ajax({
			type: "POST",
			url: "inc/get-shapes.php",
			data: { 
				id: radioValue
			},
			cache: false,
			success: function(result) {
				$(".cakeShapes").html(result).fadeIn(500);
				$('.cakeShapes').show(800);
			},
			error: function(result) {
				alert('error');
			}
		});
		
	});

	/* CAKE DESIGN ORDER FORM DYNAMICALLY GENERATED CAKE SHAPES FIELDS */
	$(document).on('click','#order-design-form input[name="shape"]',function (){

		$('.cakeServings').hide();
		
		// Get the selected value from the size dropdown
		var size_id = $( "#order-design-form #size option:checked" ).val();
		//alert('size id val '+size_id);
		var id = this.value;
		//alert('id val '+id);	
		//alert('t: '+tier_id+'s: '+size_id+'sh: '+id);

		// find the relevent cake servings with selected id (also we need size_id and tier_id)
		$.ajax({
			type: "POST",
			url: "inc/get-servings.php",
			data: { 
				id: id,
				size_id: size_id,
				tier_id: tier_id
			},
			cache: false,
			success: function(result) {
				$(".cakeServings").html(result).fadeIn(500);
				$('.cakeServings').show(800);
				$('#Step_3').fadeIn(100);
			},
			error: function(result) {
				alert('error');
			}
		});

	});

	$("#order-design-form #Step_3").click(function(e) {
		e.preventDefault();
	});

	/*-------------- 
		STEP 4  
	----------------*/

	$('#order-design-form input[name="method"]').click(function(){
		if ($(this).attr('id') === 'deliver'){			
			$('#venuAddress').show(800);
			$('#venue_address').attr('required', true);
		}
		else {
			$('#venuAddress').hide(800);
			$('#venue_address').attr('required', false);
		}	
	});

	$('#order-design-form input[name="add_details_on_cake"]').click(function(){
		if($(this).is(':checked')) {
			$('#nameAgeBox').show(800);
			$('#cake_name').attr('required', true);
			$('#cake_age').attr('required', true);;
		} else {
			$('#nameAgeBox').hide(800);
			$('#cake_name').attr('required', false);
			$('#cake_age').attr('required', false);
		}
	});

});

/* Cake Flavours Page */

$(document).ready(function(){
	
	$(".showFlavours").click(function(){
		var $toggle = $(this); 
		var id = "#flavourOptions-" + $toggle.data('id'); 
		$( id ).toggle(500);
	});

	$("#dLabel").change(function () {
		var $aval = $(this).find(':selected').data('id');
		console.log($aval);		
    	$("#OrderLinkOne").attr('href', 'order-flavour.php?flavour_id='+$aval);
  	});

});

/* 
---------------------	
CAKE FLAVOUR ORDER FORM 
----------------------	
*/

$(document).ready(function(){

	$('#order-flavour-form #Step_1').hide();
	$('#order-flavour-form #Step_2').hide();
	$('#order-flavour-form #Step_3').hide();

	/*-------------- 
		STEP 1  
	----------------*/

	$('#order-flavour-form input[name="filling"]').change(function (){	
		if ($(this).is(':checked')) {			
			$('#Step_1').fadeIn(100);
			//alert($(this).val());
		}
	});

	/*-------------- 
		STEP 2  
	----------------*/

	var tier_id;

	// show multiple tiers
	$('#order-flavour-form input[name="tiers"]').click(function(){
		if ($(this).attr('id') === 'multiple'){			
			$('#multiple-tier').show(800);
			$('.cakeSizes').hide();
			$('.cakeShapes').hide();
			$('input[name="multiple_tiers"]').attr('required', true);
		}
		else if ($(this).attr('id') === 'single'){
			$('#multiple-tier').hide(800);
			$('.cakeSizes').show(800);
			$('.cakeShapes').hide();
			$('input[name="multiple_tiers"]').attr('required', false);
		}	
	});

	// Show single tier sizes
	$('#order-flavour-form input[name="tiers"]').change(function (){

		if ($(this).attr('id') === 'single'){

			var inputValue = $(this).attr("id");
			var radioValue;

			if($("#"+inputValue).is(':checked')) {
				
				radioValue = $("input[name='tiers']:checked").val();

				// find the relevent cake sizes with selected id
				$.ajax({
					type: "POST",
					url: "inc/get-sizes.php",
					data: { 
						id: radioValue
					},
					cache: false,
					success: function(result) {
						$(".cakeSizes").html(result).fadeIn(500);
						$('.cakeSizes').show(800);
					},
					error: function(result) {
						alert('error');
					}
				});

				// get tier id
				tier_id = radioValue;
				//alert(tier_id);

			}
		}

		$('#Step_2').fadeOut(100);
		$('.cakeServings').hide();

	});

	// Show multi tier sizes
	$('#order-flavour-form input[name="multiple_tiers"]').change(function (){

		$('.cakeSizes').hide();
		$('.cakeShapes').hide();

		var inputValue = $(this).attr("id");
		var radioValue;

		if($("#"+inputValue).is(':checked')) {
			
			radioValue = $("input[name='multiple_tiers']:checked").val();

			// find the relevent cake sizes with selected id
			$.ajax({
				type: "POST",
				url: "inc/get-sizes.php",
				data: { 
					id: radioValue
				},
				cache: false,
				success: function(result) {
					$(".cakeSizes").html(result).fadeIn(500);
					$('.cakeSizes').show(800);
				},
				error: function(result) {
					alert('error');
				}
			});
			// get tier id
			tier_id = radioValue;
			//alert('tier_id: '+tier_id);
		}

	});

	/* CAKE FLAVOUR ORDER FORM DYNAMICALLY GENERATED CAKE SIZES FIELDS */
	$(document).on('change','#order-flavour-form #size',function (){

		$('.cakeShapes').hide();
		$('.cakeServings').hide();
		$('#Step_2').fadeOut();
		
		var radioValue = this.value;

		// find the relevent cake shapes with selected id
		$.ajax({
			type: "POST",
			url: "inc/get-shapes.php",
			data: { 
				id: radioValue
			},
			cache: false,
			success: function(result) {
				$(".cakeShapes").html(result).fadeIn(500);
				$('.cakeShapes').show(800);
			},
			error: function(result) {
				alert('error');
			}
		});
		
	});

	/* CAKE FLAVOUR ORDER FORM DYNAMICALLY GENERATED CAKE SHAPES FIELDS */
	$(document).on('click','#order-flavour-form input[name="shape"]',function (){

		$('.cakeServings').hide();
		
		// Get the selected value from the size dropdown
		var size_id = $( "#order-flavour-form #size option:checked" ).val();
		var id = this.value;
		// find the relevent cake servings with selected id (also we need size_id and tier_id)
		$.ajax({
			type: "POST",
			url: "inc/get-servings.php",
			data: { 
				id: id,
				size_id: size_id,
				tier_id: tier_id
			},
			cache: false,
			success: function(result) {
				$(".cakeServings").html(result).fadeIn(500);
				$('.cakeServings').show(800);
				$('#Step_2').fadeIn(100);
			},
			error: function(result) {
				alert('error');
			}
		});

	});

	/*-------------- 
		STEP 3  
	----------------*/

	$('#order-flavour-form #design').change(function () {	

		var radioValue = $(this.options[this.selectedIndex]).val();

		$.ajax({
			type: "POST",
			url: "inc/get-child-designs.php",
			data: { 
				id: radioValue
			},
			cache: false,
			success: function(result) {
				if ($(".cakeDesigns").html() != result) {
					$(".cakeDesigns").fadeOut(500, function() {
					  $(".cakeDesigns").html(result); 
					  $(".cakeDesigns").fadeIn(500);
					});
					
				}
			},
			error: function(result) {
				alert('error');
			}
		});	
		
	});

	$(document).on('change','#order-flavour-form input[name="product"]',function (){
		if($('#order-flavour-form input[name="product"]').is(':checked')) {
			$('#Step_3').fadeIn(100);
		}
	});

	$("#order-flavour-form #Step_3").click(function(e) {
		e.preventDefault();
	});

	/*-------------- 
		STEP 4  
	----------------*/

	$('#order-flavour-form input[name="method"]').click(function(){
		if ($(this).attr('id') === 'deliver'){			
			$('#venuAddress').show(800);
			$('#venue_address').attr('required', true);
		}
		else {
			$('#venuAddress').hide(800);
			$('#venue_address').attr('required', false);
		}	
	});

	$('#order-flavour-form input[name="add_details_on_cake"]').click(function(){
		if($(this).is(':checked')) {
			$('#nameAgeBox').show(800);
			$('#cake_name').attr('required', true);
			$('#cake_age').attr('required', true);;
		} else {
			$('#nameAgeBox').hide(800);
			$('#cake_name').attr('required', false);
			$('#cake_age').attr('required', false);
		}
	});


});

/* 
---------------------	
CAKE FILLING ORDER FORM 
----------------------	
*/

$(document).ready(function(){

	$('#order-filling-form #Step_1').hide();
	$('#order-filling-form #Step_2').hide();
	$('#order-filling-form #Step_3').hide();

	// show sub flavours
	$('#order-filling-form input[name="flavour"]').click(function(){
		var inputValue = $(this).attr("id");
		var targetDiv = inputValue + "-flavour";
		$('.hide').hide();
		$("#"+ targetDiv).show('slow');
	});

	// dynamic dependent filling fields
	$('#order-filling-form input[name="flavour"]').change(function (){	

		var inputValue = $(this).attr("id");
		var targetDiv = inputValue + "-flavour";
		var targetRadioID = inputValue + "-sub-flavour";
		
		// alert(inputValue);

		if($("#"+inputValue).is(':checked')) {
			
			if(($("#" + targetDiv).length == 1)) {

				// radio button has child elements make them required.
				$("#"+targetRadioID).attr('required', true);
				$('#Step_1').fadeOut(100);
				
				$('#order-filling-form input[name="sub_flavour"]').change(function () {					
					if($('#order-filling-form input[name="sub_flavour"]').is(':checked')){
						$('#Step_1').fadeIn(100);
					}
				});
			}
			else {				
				$('#Step_1').fadeIn(100);
			}

		}
   	
	});

	/*-------------- 
		STEP 2  
	----------------*/

	var tier_id;

	// show multiple tiers
	$('#order-filling-form input[name="tiers"]').click(function(){
		if ($(this).attr('id') === 'multiple'){			
			$('#multiple-tier').show(800);
			$('.cakeSizes').hide();
			$('.cakeShapes').hide();
			$('input[name="multiple_tiers"]').attr('required', true);
		}
		else if ($(this).attr('id') === 'single'){
			$('#multiple-tier').hide(800);
			$('.cakeSizes').show(800);
			$('.cakeShapes').hide();
			$('input[name="multiple_tiers"]').attr('required', false);
		}	
	});

	// Show single tier sizes
	$('#order-filling-form input[name="tiers"]').change(function (){

		if ($(this).attr('id') === 'single'){

			var inputValue = $(this).attr("id");
			var radioValue;

			if($("#"+inputValue).is(':checked')) {
				
				radioValue = $("input[name='tiers']:checked").val();

				// find the relevent cake sizes with selected id
				$.ajax({
					type: "POST",
					url: "inc/get-sizes.php",
					data: { 
						id: radioValue
					},
					cache: false,
					success: function(result) {
						$(".cakeSizes").html(result).fadeIn(500);
						$('.cakeSizes').show(800);
					},
					error: function(result) {
						alert('error');
					}
				});

				// get tier id
				tier_id = radioValue;
				//alert(tier_id);

			}
		}

		$('#Step_2').fadeOut(100);
		$('.cakeServings').hide();

	});

	// Show multi tier sizes
	$('#order-filling-form input[name="multiple_tiers"]').change(function (){

		$('.cakeSizes').hide();
		$('.cakeShapes').hide();

		var inputValue = $(this).attr("id");
		var radioValue;

		if($("#"+inputValue).is(':checked')) {
			
			radioValue = $("input[name='multiple_tiers']:checked").val();

			// find the relevent cake sizes with selected id
			$.ajax({
				type: "POST",
				url: "inc/get-sizes.php",
				data: { 
					id: radioValue
				},
				cache: false,
				success: function(result) {
					$(".cakeSizes").html(result).fadeIn(500);
					$('.cakeSizes').show(800);
				},
				error: function(result) {
					alert('error');
				}
			});
			// get tier id
			tier_id = radioValue;
			//alert('tier_id: '+tier_id);
		}

	});

	/* CAKE FILLING ORDER FORM DYNAMICALLY GENERATED CAKE SIZES FIELDS */
	$(document).on('change','#order-filling-form #size',function (){

		$('.cakeShapes').hide();
		$('.cakeServings').hide();
		$('#Step_2').fadeOut();
		
		var radioValue = this.value;

		// find the relevent cake shapes with selected id
		$.ajax({
			type: "POST",
			url: "inc/get-shapes.php",
			data: { 
				id: radioValue
			},
			cache: false,
			success: function(result) {
				$(".cakeShapes").html(result).fadeIn(500);
				$('.cakeShapes').show(800);
			},
			error: function(result) {
				alert('error');
			}
		});
		
	});

	/* CAKE FILLING ORDER FORM DYNAMICALLY GENERATED CAKE SHAPES FIELDS */
	$(document).on('click','#order-filling-form input[name="shape"]',function (){

		$('.cakeServings').hide();
		
		// Get the selected value from the size dropdown
		var size_id = $( "#order-filling-form #size option:checked" ).val();
		var id = this.value;
		// find the relevent cake servings with selected id (also we need size_id and tier_id)
		$.ajax({
			type: "POST",
			url: "inc/get-servings.php",
			data: { 
				id: id,
				size_id: size_id,
				tier_id: tier_id
			},
			cache: false,
			success: function(result) {
				$(".cakeServings").html(result).fadeIn(500);
				$('.cakeServings').show(800);
				$('#Step_2').fadeIn(100);
			},
			error: function(result) {
				alert('error');
			}
		});

	});

	/*-------------- 
		STEP 3  
	----------------*/

	$('#order-filling-form #design').change(function () {	

		var radioValue = $(this.options[this.selectedIndex]).val();

		$.ajax({
			type: "POST",
			url: "inc/get-child-designs.php",
			data: { 
				id: radioValue
			},
			cache: false,
			success: function(result) {
				if ($(".cakeDesigns").html() != result) {
					$(".cakeDesigns").fadeOut(500, function() {
					  $(".cakeDesigns").html(result); 
					  $(".cakeDesigns").fadeIn(500);
					});
					
				}
			},
			error: function(result) {
				alert('error');
			}
		});	
		
	});

	$(document).on('change','#order-filling-form input[name="product"]',function (){
		if($('#order-filling-form input[name="product"]').is(':checked')) {
			$('#Step_3').fadeIn(100);
		}
	});

	$("#order-filling-form #Step_3").click(function(e) {
		e.preventDefault();
	});

	/*-------------- 
		STEP 4  
	----------------*/

	$('#order-filling-form input[name="method"]').click(function(){
		if ($(this).attr('id') === 'deliver'){			
			$('#venuAddress').show(800);
			$('#venue_address').attr('required', true);
		}
		else {
			$('#venuAddress').hide(800);
			$('#venue_address').attr('required', false);
		}	
	});

	$('#order-filling-form input[name="add_details_on_cake"]').click(function(){
		if($(this).is(':checked')) {
			$('#nameAgeBox').show(800);
			$('#cake_name').attr('required', true);
			$('#cake_age').attr('required', true);;
		} else {
			$('#nameAgeBox').hide(800);
			$('#cake_name').attr('required', false);
			$('#cake_age').attr('required', false);
		}
	});


});

/* 
---------------------	
CAKE SIZE PAGE
----------------------	
*/

$(document).ready(function(){

	$('#cake_size #Step_2').hide();

	var tier_id;

	// show multiple tiers
	$('#cake_size input[name="tiers"]').click(function(){
		if ($(this).attr('id') === 'multiple'){			
			$('#multiple-tier').show(800);
			$('.cakeSizes').hide();
			$('.cakeShapes').hide();
			$('input[name="multiple_tiers"]').attr('required', true);
		}
		else if ($(this).attr('id') === 'single'){
			$('#multiple-tier').hide(800);
			$('.cakeSizes').show(800);
			$('.cakeShapes').hide();
			$('input[name="multiple_tiers"]').attr('required', false);
		}	
	});

	// Show single tier sizes
	$('#cake_size input[name="tiers"]').change(function (){

		if ($(this).attr('id') === 'single'){

			var inputValue = $(this).attr("id");
			var radioValue;

			if($("#"+inputValue).is(':checked')) {
				
				radioValue = $("input[name='tiers']:checked").val();

				// find the relevent cake sizes with selected id
				$.ajax({
					type: "POST",
					url: "inc/get-sizes.php",
					data: { 
						id: radioValue
					},
					cache: false,
					success: function(result) {
						$(".cakeSizes").html(result).fadeIn(500);
						$('.cakeSizes').show(800);
					},
					error: function(result) {
						alert('error');
					}
				});

				// get tier id
				tier_id = radioValue;
				//alert(tier_id);
			}
		}

		$('#Step_2').fadeOut(100);
		$('.cakeServings').hide();

	});

	// Show multi tier sizes
	$('#cake_size input[name="multiple_tiers"]').change(function (){

		$('.cakeSizes').hide();
		$('.cakeShapes').hide();

		var inputValue = $(this).attr("id");
		var radioValue;

		if($("#"+inputValue).is(':checked')) {
			
			radioValue = $("input[name='multiple_tiers']:checked").val();

			// find the relevent cake sizes with selected id
			$.ajax({
				type: "POST",
				url: "inc/get-sizes.php",
				data: { 
					id: radioValue
				},
				cache: false,
				success: function(result) {
					$(".cakeSizes").html(result).fadeIn(500);
					$('.cakeSizes').show(800);
				},
				error: function(result) {
					alert('error');
				}
			});
			// get tier id
			tier_id = radioValue;
			//alert('tier_id: '+tier_id);
		}

	});

	/* CAKE FLAVOUR ORDER FORM DYNAMICALLY GENERATED CAKE SIZES FIELDS */
	$(document).on('change','#cake_size #size',function (){

		$('.cakeShapes').hide();
		$('.cakeServings').hide();
		$('#Step_2').fadeOut();
		
		var radioValue = this.value;

		// find the relevent cake shapes with selected id
		$.ajax({
			type: "POST",
			url: "inc/get-shapes.php",
			data: { 
				id: radioValue
			},
			cache: false,
			success: function(result) {
				$(".cakeShapes").html(result).fadeIn(500);
				$('.cakeShapes').show(800);
			},
			error: function(result) {
				alert('error');
			}
		});
		
	});

	/* CAKE FLAVOUR ORDER FORM DYNAMICALLY GENERATED CAKE SHAPES FIELDS */
	$(document).on('click','#cake_size input[name="shape"]',function (){

		$('.cakeServings').hide();
		
		// Get the selected value from the size dropdown
		var size_id = $( "#cake_size #size option:checked" ).val();
		var id = this.value;
		// find the relevent cake servings with selected id (also we need size_id and tier_id)
		$.ajax({
			type: "POST",
			url: "inc/get-servings.php",
			data: { 
				id: id,
				size_id: size_id,
				tier_id: tier_id
			},
			cache: false,
			success: function(result) {
				$(".cakeServings").html(result).fadeIn(500);
				$('.cakeServings').show(800);
				$('#Step_2').fadeIn(100);
			},
			error: function(result) {
				alert('error');
			}
		});

	});

});

/* 
---------------------	
CAKE SIZE ORDER FORM 
----------------------	
*/

$(document).ready(function(){

	$('#order-size-form #Step_1').hide();
	$('#order-size-form #Step_2').hide();
	$('#order-size-form #Step_3').hide();

	/*-------------- 
		STEP 1
	----------------*/

	// show sub flavours
	$('#order-size-form input[name="flavour"]').click(function(){
		var inputValue = $(this).attr("id");
		var targetDiv = inputValue + "-flavour";
		$('.hide').hide();
		$("#"+ targetDiv).show('slow');
	});

	// dynamic dependent filling fields
	$('#order-size-form input[name="flavour"]').change(function (){	

		var inputValue = $(this).attr("id");
		var targetDiv = inputValue + "-flavour";
		var targetRadioID = inputValue + "-sub-flavour";
		var radioValue;

		// alert(inputValue);

		if($("#"+inputValue).is(':checked')) {
			
			if(($("#" + targetDiv).length == 1)) {

				// radio button has child elements make them required.
				$("#"+targetRadioID).attr('required', true);
				$('#Step_1').fadeOut(100);
				
				$('#order-size-form input[name="sub_flavour"]').change(function () {
					
					if($('#order-size-form input[name="sub_flavour"]').is(':checked')){

						radioValue = $("input[name='sub_flavour']:checked").val();
						$('#Step_1').fadeIn(100);	

						// find the relevent cake fillings with selected id
						$.ajax({
							type: "POST",
							url: "inc/get-fillings.php",
							data: { 
								id: radioValue
							},
							cache: false,
							success: function(result) {
								$(".cakeFillings").html(result);
								// console.log(result);
							},
							error: function(result) {
								alert('error');
							}
						});

					}

				});

			}
			else {
				
				radioValue = $("input[name='flavour']:checked").val();
				// remove required from child elements.
				$('#Step_1').fadeIn(100);

				// find the relevent cake fillings with selected id
				$.ajax({
					type: "POST",
					url: "inc/get-fillings.php",
					data: { 
						id: radioValue
					},
					cache: false,
					success: function(result) {
						$(".cakeFillings").html(result);
					},
					error: function(result) {
						alert('error');
					}
				});

			}

		}
   	
	});

	/*-------------- 
		STEP 2  
	----------------*/

	/* CAKE SIZE ORDER FORM DYNAMICALLY GENERATED CAKE FILLING FIELDS */
	$(document).on('click','#order-size-form input[name="filling"]',function (){
		if ($(this).is(':checked')) {			
			$('#Step_2').fadeIn(100);
			//alert($(this).val());
		}
	});

	/*-------------- 
		STEP 3  
	----------------*/

	$('#order-size-form #design').change(function () {	

		var radioValue = $(this.options[this.selectedIndex]).val();

		$.ajax({
			type: "POST",
			url: "inc/get-child-designs.php",
			data: { 
				id: radioValue
			},
			cache: false,
			success: function(result) {
				if ($(".cakeDesigns").html() != result) {
					$(".cakeDesigns").fadeOut(500, function() {
					  $(".cakeDesigns").html(result); 
					  $(".cakeDesigns").fadeIn(500);
					});
				}
			},
			error: function(result) {
				alert('error');
			}
		});	
		
	});

	$(document).on('change','#order-size-form input[name="product"]',function (){
		if($('#order-size-form input[name="product"]').is(':checked')) {
			$('#Step_3').fadeIn(100);
		}
	});

	$("#order-size-form #Step_3").click(function(e) {
		e.preventDefault();
	});

	/*-------------- 
		STEP 4  
	----------------*/

	$('#order-size-form input[name="method"]').click(function(){
		if ($(this).attr('id') === 'deliver'){			
			$('#venuAddress').show(800);
			$('#venue_address').attr('required', true);
		}
		else {
			$('#venuAddress').hide(800);
			$('#venue_address').attr('required', false);
		}	
	});

	$('#order-size-form input[name="add_details_on_cake"]').click(function(){
		if($(this).is(':checked')) {
			$('#nameAgeBox').show(800);
			$('#cake_name').attr('required', true);
			$('#cake_age').attr('required', true);;
		} else {
			$('#nameAgeBox').hide(800);
			$('#cake_name').attr('required', false);
			$('#cake_age').attr('required', false);
		}
	});

});


/* 
---------------------	
GET QUOTE ORDER FORM 
----------------------	
*/

$(document).ready(function(){

	$('#get-quote-form #Step_1').hide();
	$('#get-quote-form #Step_2').hide();
	$('#get-quote-form #Step_3').hide();
	$('#get-quote-form #Step_4').hide();

	/*-------------- 
		STEP 1  
	----------------*/

	//Show options according to radio button value
	$('#get-quote-form input[name="design_option"]').click(function(){
		
		var inputValue = $(this).attr("id");
		var targetDiv =  "from_" + inputValue;
		var targetInputID =  "input_" + inputValue;

		$('.hide').hide();
		$("#"+ targetDiv).show('slow');
		$('#Step_1').fadeOut(100);

		/* Make relevent fields required */
		if ($(this).attr('id') === inputValue){	
			$(".req-false").attr('required', false);		
			$("#"+targetInputID).attr('required', true);			
		}

		if ($.trim($("#input_custom").val())) {
			// textarea is not empty
			$('#Step_1').fadeIn(100);
		} else {
			$('#Step_1').fadeOut(100);
		}

	});
	/*---*/

	/* When Gallery Option Selected */
	$('#get-quote-form #input_design').change(function () {	

		$('#Step_1').fadeOut(100);
		var radioValue = $(this.options[this.selectedIndex]).val();

		$.ajax({
			type: "POST",
			url: "inc/get-child-designs.php",
			data: { 
				id: radioValue
			},
			cache: false,
			success: function(result) {
				if ($(".cakeDesigns").html() != result) {
					$(".cakeDesigns").fadeOut(500, function() {
					$(".cakeDesigns").html(result); 
					$(".cakeDesigns").fadeIn(500);
					});
				}
			},
			error: function(result) {
				alert('error');
			}
		});	
		
	});

	$(document).on('change','#get-quote-form input[name="product"]',function (){
		if($('#get-quote-form input[name="product"]').is(':checked')) {
			$('#Step_1').fadeIn(100);
		}
	});

	// Image upload and preview
	$(document).on('change', '.btn-file :file', function() {
		
		var input = $(this),
		label = input.val().replace(/\\/g, '/').replace(/.*\//, '');
		input.trigger('fileselect', [label]);
		
		/* Show button when upload option selected */
		if(label){

			$('#Step_1').fadeIn(100);

			/* Image size validation */
			//this.files[0].size gets the size of your file.
			var imgbytes = this.files[0].size;
			// var imgkbytes = Math.round(parseInt(imgbytes)/1024);
			// alert(imgkbytes+' KB');1000000
			if(imgbytes > 100000) {
				$("#image-error").html("Image larger than 1MB. Please upload an image less than 1MB");
				$('#Step_1').fadeOut(100);
			}else{
				$("#image-error").html("");
				$('#Step_1').fadeIn(100);
			}
			/* Image extension validation */
			var ext = $('#input_upload').val().split('.').pop().toLowerCase();
			//alert(ext);
			if ($.inArray(ext, ['gif','png','jpg','jpeg']) == -1){
				$("#image-error").html("Invalid Image Format! Image Format Must Be jpg, jpeg, png or gif.");
				$('#Step_1').fadeOut(100);
			}else{
				$("#image-error").html("");
				$('#Step_1').fadeIn(100);			
			}

		} else {
			$('#Step_1').fadeOut(100);
		}
		
	});

	$('.btn-file :file').on('fileselect', function(event, label) {
		
		var input = $(this).parents('.input-group').find(':text'),
			log = label;
		
		if( input.length ) {
			input.val(log);
		} else {
			if( log ) alert(log);
		}
	
	});

	function readURL(input) {
		if (input.files && input.files[0]) {
			var reader = new FileReader();
			
			reader.onload = function (e) {
				$('#img-upload').attr('src', e.target.result);
			}
			
			reader.readAsDataURL(input.files[0]);
		}
	}

	// $('#input_upload').bind('change', function() {
		
	// });

	$("#input_upload").change(function(){
		readURL(this);
	});

	/* When Custom Option Selected */
	$("#input_custom").keydown(function(){  
		if ($.trim($("#input_custom").val())) {
			// textarea is not empty
			$('#Step_1').fadeIn(100);
		} else {
			$('#Step_1').fadeOut(100);
		}
	});  
	
	/*-------------- 
		STEP 2
	----------------*/

	var tier_id;

	// show multiple tiers
	$('#get-quote-form input[name="tiers"]').click(function(){
		if ($(this).attr('id') === 'multiple'){			
			$('#multiple-tier').show(800);
			$('.cakeSizes').hide();
			$('.cakeShapes').hide();
			$('input[name="multiple_tiers"]').attr('required', true);
		}
		else if ($(this).attr('id') === 'single'){
			$('#multiple-tier').hide(800);
			$('.cakeSizes').show(800);
			$('.cakeShapes').hide();
			$('input[name="multiple_tiers"]').attr('required', false);
		}	
	});

	// Show single tier sizes
	$('#get-quote-form input[name="tiers"]').change(function (){

		if ($(this).attr('id') === 'single'){

			var inputValue = $(this).attr("id");
			var radioValue;

			if($("#"+inputValue).is(':checked')) {
				
				radioValue = $("input[name='tiers']:checked").val();

				// find the relevent cake sizes with selected id
				$.ajax({
					type: "POST",
					url: "inc/get-sizes.php",
					data: { 
						id: radioValue
					},
					cache: false,
					success: function(result) {
						$(".cakeSizes").html(result).fadeIn(500);
						$('.cakeSizes').show(800);
					},
					error: function(result) {
						alert('error');
					}
				});

				// get tier id
				tier_id = radioValue;
				//alert(tier_id);

			}
		}

	});

	// Show multi tier sizes
	$('#get-quote-form input[name="multiple_tiers"]').change(function (){

		$('.cakeSizes').hide();
		$('.cakeShapes').hide();
		$('.cakeServings').hide();

		var inputValue = $(this).attr("id");
		var radioValue;

		if($("#"+inputValue).is(':checked')) {
			
			radioValue = $("input[name='multiple_tiers']:checked").val();

			// find the relevent cake sizes with selected id
			$.ajax({
				type: "POST",
				url: "inc/get-sizes.php",
				data: { 
					id: radioValue
				},
				cache: false,
				success: function(result) {
					$(".cakeSizes").html(result).fadeIn(500);
					$('.cakeSizes').show(800);
				},
				error: function(result) {
					alert('error');
				}
			});
			// get tier id
			tier_id = radioValue;
			//alert('tier_id: '+tier_id);
		}

	});

	/* CAKE DESIGN ORDER FORM DYNAMICALLY GENERATED CAKE SIZES FIELDS */
	$(document).on('change','#get-quote-form #size',function (){

		$('.cakeShapes').hide();
		$('.cakeServings').hide();
		$('#Step_2').fadeOut();
		
		var radioValue = this.value;

		// find the relevent cake shapes with selected id
		$.ajax({
			type: "POST",
			url: "inc/get-shapes.php",
			data: { 
				id: radioValue
			},
			cache: false,
			success: function(result) {
				$(".cakeShapes").html(result).fadeIn(500);
				$('.cakeShapes').show(800);
			},
			error: function(result) {
				alert('error');
			}
		});
		
	});

	/* CAKE DESIGN ORDER FORM DYNAMICALLY GENERATED CAKE SHAPES FIELDS */
	$(document).on('click','#get-quote-form input[name="shape"]',function (){

		$('.cakeServings').hide();
		
		// Get the selected value from the size dropdown
		var size_id = $( "#get-quote-form #size option:checked" ).val();
		//alert('size id val '+size_id);
		var id = this.value;
		//alert('id val '+id);	
		//alert('t: '+tier_id+'s: '+size_id+'sh: '+id);

		// find the relevent cake servings with selected id (also we need size_id and tier_id)
		$.ajax({
			type: "POST",
			url: "inc/get-servings.php",
			data: { 
				id: id,
				size_id: size_id,
				tier_id: tier_id
			},
			cache: false,
			success: function(result) {
				$(".cakeServings").html(result).fadeIn(500);
				$('.cakeServings').show(800);
				$('#Step_2').fadeIn(100);
			},
			error: function(result) {
				alert('error');
			}
		});

	});

	$("#get-quote-form #Step_2").click(function(e) {
		e.preventDefault();
	});

	/*-------------- 
		STEP 3  
	----------------*/

	// show sub flavours
	$('#get-quote-form input[name="flavour"]').click(function(){
		var inputValue = $(this).attr("id");
		var targetDiv = inputValue + "-flavour";
		$('.hide').hide();
		$("#"+ targetDiv).show('slow');
	});

	// dynamic dependent filling fields
	$('#get-quote-form input[name="flavour"]').change(function (){	

		var inputValue = $(this).attr("id");
		var targetDiv = inputValue + "-flavour";
		var targetRadioID = inputValue + "-sub-flavour";
		var radioValue;

		// alert(inputValue);

		if($("#"+inputValue).is(':checked')) {
			
			if(($("#" + targetDiv).length == 1)) {

				// radio button has child elements make them required.
				$("#"+targetRadioID).attr('required', true);
				$('#Step_3').fadeOut(100);
				
				$('#get-quote-form input[name="sub_flavour"]').change(function () {
					
					if($('#get-quote-form input[name="sub_flavour"]').is(':checked')){

						radioValue = $("input[name='sub_flavour']:checked").val();
						$('#Step_3').fadeIn(100);	

						// find the relevent cake fillings with selected id
						$.ajax({
							type: "POST",
							url: "inc/get-fillings.php",
							data: { 
								id: radioValue
							},
							cache: false,
							success: function(result) {
								$(".cakeFillings").html(result);
								// console.log(result);
							},
							error: function(result) {
								alert('error');
							}
						});

					}

				});

			}
			else {
				
				radioValue = $("input[name='flavour']:checked").val();
				// remove required from child elements.
				$('#Step_3').fadeIn(100);

				// find the relevent cake fillings with selected id
				$.ajax({
					type: "POST",
					url: "inc/get-fillings.php",
					data: { 
						id: radioValue
					},
					cache: false,
					success: function(result) {
						$(".cakeFillings").html(result);
					},
					error: function(result) {
						alert('error');
					}
				});

			}

		}
   	
	});

	/*-------------- 
		STEP 4  
	----------------*/

	/* CAKE SIZE ORDER FORM DYNAMICALLY GENERATED CAKE FILLING FIELDS */
	$(document).on('click','#get-quote-form input[name="filling"]',function (){
		if ($(this).is(':checked')) {			
			$('#Step_4').fadeIn(100);
			//alert($(this).val());
		}
	});

	$("#get-quote-form #Step_4").click(function(e) {
		e.preventDefault();
	});

	/*-------------- 
		STEP 5  
	----------------*/

	$('#get-quote-form input[name="method"]').click(function(){
		if ($(this).attr('id') === 'deliver'){			
			$('#venuAddress').show(800);
			$('#venue_address').attr('required', true);
		}
		else {
			$('#venuAddress').hide(800);
			$('#venue_address').attr('required', false);
		}	
	});

	$('#get-quote-form input[name="add_details_on_cake"]').click(function(){
		if($(this).is(':checked')) {
			$('#nameAgeBox').show(800);
			$('#cake_name').attr('required', true);
			$('#cake_age').attr('required', true);;
		} else {
			$('#nameAgeBox').hide(800);
			$('#cake_name').attr('required', false);
			$('#cake_age').attr('required', false);
		}
	});

});

/* Step by step wizard form */
$(document).ready(function(){

	 //Initialize tooltips
	 $('.nav-tabs > li a[title]').tooltip();

	 //Wizard
	 $('a[data-toggle="tab"]').on('show.bs.tab', function (e) {
	
			 var $target = $(e.target);
	
			 if ($target.hasClass('disabled')) {
					 return false;
			 }
	 });
	
	 $(".next-step").click(function (e) {
			 var $active = $('.wizard .nav-tabs .nav-item .active');
			 var $activeli = $active.parent("li");
	
			 $($activeli).next().find('a[data-toggle="tab"]').removeClass("disabled");
			 $($activeli).next().find('a[data-toggle="tab"]').click();
	 });	
	
	 $(".prev-step").click(function (e) {
	
			 var $active = $('.wizard .nav-tabs .nav-item .active');
			 var $activeli = $active.parent("li");
	
			 $($activeli).prev().find('a[data-toggle="tab"]').removeClass("disabled");
			 $($activeli).prev().find('a[data-toggle="tab"]').click();
	
	 });
	

});


