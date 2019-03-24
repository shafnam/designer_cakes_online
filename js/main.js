
/* MULTIPLE LEVEL NAVIGATION */

(function($){

	$('.dropdown-menu a.dropdown-toggle').on('click', function(e) {
	  if (!$(this).next().hasClass('show')) {
		$(this).parents('.dropdown-menu').first().find('.show').removeClass("show");
	  }
	  var $subMenu = $(this).next(".dropdown-menu");
	  $subMenu.toggleClass('show');

	  $(this).parents('li.nav-item.dropdown.show').on('hidden.bs.dropdown', function(e) {
		$('.dropdown-submenu .show').removeClass("show");
	  });

	  return false;
	});

})(jQuery)


/* Fixed Header on Scroll */
 
$(window).scroll(function() {
  if ($(this).scrollTop() > 150) {
		$('#mainHeader').addClass("sticky");
  } else {
		$('#mainHeader').removeClass("sticky");
  }
});


$(document).ready(function(){	

	/* CAKE DESIGN ORDER FORM */

	$('#Step_1').prop("disabled", true);
	$('#Step_2').prop("disabled", true);
	$('#Step_3').prop("disabled", true);

	// show sub flavours
	$('#order-design-form input[name="flavour"]').click(function(){
		var inputValue = $(this).attr("id");
		var targetDiv = inputValue + "-flavour";
		$('.hide').hide();
		$("#"+ targetDiv).show('slow');
		//alert(inputValue);
	});

	$('#order-design-form input[name="flavour"]').change(function () {		

		var inputValue = $(this).attr("id");
		var targetDiv = inputValue + "-flavour";
		var radioValue;

		if($("#"+inputValue).is(':checked')) {

			if(($("#" + targetDiv).length == 1)) {

				// radio button has child elements
				$('input[name="'+targetDiv+'"]').attr('required', true);
				$('#Step_1').prop("disabled", true);
				
				$('#order-design-form input[name="'+targetDiv+'"]').change(function () {		
						if($('input[name="'+targetDiv+'"]').is(':checked')){

							radioValue = $("input[name='"+targetDiv+"']:checked").val();
							$('#Step_1').prop("disabled", false);	

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
				});

			}
			else {

				radioValue = $("input[name='flavour']:checked").val();
				$('#Step_1').prop("disabled", false);

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

	$("#Step_1").click(function(e) {
		e.preventDefault();
		$('#flavour-error').show("fast");
	});

});


$(document).on('click','#order-design-form input[name="filling"]',function () {
	if ($(this).is(':checked')) {
			//alert($(this).val());
		$('#Step_2').prop("disabled", false);

	}
});
	
	// $("#Step_1").click(function(e) {
	// 	e.preventDefault();
	// 	var radioValue = $("input[name='flavour']:checked").val();
		
	// 	//alert(radioValue);
  //   $.ajax({
  //       type: "POST",
  //       url: "inc/get-fillings.php",
  //       data: { 
  //           id: radioValue
  //           //access_token: $("#access_token").val() 
	// 			},
	// 			cache: false,
  //       success: function(result) {
	// 				console.log(result);
	// 				$(".cakeFillings").html(result);
  //       },
  //       error: function(result) {
  //           alert('error');
  //       }
	// 	});
		
	// });

	

	/*$(".nextBtn").click(function(){
		//alert('inputValue');
		//'#flavour-error'
		
		var nav = $('#flavour-error');
		alert(nav.length);

		if (nav.length) {
			alert(nav.length);
			$('html, body').animate({
					scrollTop: $("#flavour-error").offset().top
			}, 1000);
		}
	});*/

	/*$('input[name="flavour"]').change(function () {
		if($("#sponge-cake").is(':checked')) {
			$('input[name="sponge-cake-flavour"]').attr('required', true);
			$('input[name="sri-lankan-cake-flavour"]').removeAttr('required');
			$('input[name="dr-flavour"]').removeAttr('required');
		} 
		else if($("#sl-cake").is(':checked')) {
			$('input[name="sri-lankan-cake-flavour"]').attr('required', true);
			$('input[name="sponge-cake-flavour"]').removeAttr('required');
			$('input[name="dr-flavour"]').removeAttr('required');
		}
		else if($("#dr-cake").is(':checked')) {
			$('input[name="dr-flavour"]').attr('required', true);
			$('input[name="sponge-cake-flavour"]').removeAttr('required');
			$('input[name="sri-lankan-cake-flavour"]').removeAttr('required');
		}
	});*/

$(document).ready(function(){		

	$("input[name='tiers']").on("click", function(){
			$("#cake_shape").slideDown("slow");
	});

	$("input[name='shape']").on("click", function(){
			$("#cake_size").show();
	});
	
	/* Cake Flavours Page */
	
	$(".showFlavours").click(function(){
			var $toggle = $(this); 

			var id = "#flavourOptions-" + $toggle.data('id'); 

			$( id ).toggle(500);
	});

	$("#dLabel").change(function () {
		var $aval = $(this).find(':selected').data('id');
		console.log($aval);		
    $("#OrderLinkOne").attr('href', 'order-flavour.php?flavour_id='+$aval);
    //$("#PriceOne").html('1000'); // you can turn this interger in what you want
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


