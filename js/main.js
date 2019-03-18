/*$('body').on('mouseenter mouseleave','.dropdown-hover',function(e){
	let dropdown=$(e.target).closest('.dropdown-hover');
	dropdown.addClass('show');
	  
	setTimeout(function(){
		  dropdown[dropdown.is(':hover')?'addClass':'removeClass']('show');
	},300);
});*/

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

// CAKE ORDER FORM RADIO BUTTONS
 
$("input[name='flavour']").on("click", function(){
    $(".sponge-flavours").toggle(this.value === "sponge-cake" && this.checked);
});

$("input[name='flavour']").on("click", function(){
    $(".sl-flavours").toggle(this.value === "sl-cake" && this.checked);
});

$("input[name='flavour']").on("click", function(){
	//$(".dr-cats").toggle(this.value === "dr-cake" && this.checked);
	$(".dr-flavours").toggle(this.value === "dr-cake" && this.checked);

	//$("input[name='dr-cat']").on("click", function(){
		// $(".dr-flavours").toggle(this.value === "dr-cake" && this.checked);
	//});
});

// SPONGE CAKE DEPENDENT RADIO BUTTON
$('input[name="flavour"]').change(function () {
	if($("#sponge-cake").is(':checked')) {
		$('input[name="sponge-flavour"]').attr('required', true);
		$('input[name="sl-flavour"]').removeAttr('required');
		$('input[name="dr-flavour"]').removeAttr('required');
	} else if($("#sl-cake").is(':checked')) {
		$('input[name="sl-flavour"]').attr('required', true);
		$('input[name="sponge-flavour"]').removeAttr('required');
		$('input[name="dr-flavour"]').removeAttr('required');
	}
	else if($("#dr-cake").is(':checked')) {
		$('input[name="dr-flavour"]').attr('required', true);
		$('input[name="sponge-flavour"]').removeAttr('required');
		$('input[name="sl-flavour"]').removeAttr('required');
	}
});

$("input[name='tiers']").on("click", function(){
    $("#cake_shape").slideDown( "slow", function() {
		// Animation complete.
	});
});

$("input[name='shape']").on("click", function(){
    $("#cake_size").show();
});

 /* Fixed Header on Scroll */
 
/*$("#header-scroll").hide();*/
$(window).scroll(function() {
  if ($(this).scrollTop() > 150) {
		$('#mainHeader').addClass("sticky");
    //$('#header-scroll').slideDown("fast");
    /*$('#header-full').slideUp("fast");
		$('.homepage').addClass("header-margin");*/
  } else {
		$('#mainHeader').removeClass("sticky");
    //$('#header-scroll').slideUp("fast");
    /*$('#header-full').slideDown("fast");
		$('.homepage').removeClass("header-margin");*/	
  }
});