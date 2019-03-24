(function($) {
    "use strict";

    function slickConfig() {
		$('.pi1').slick({
		  slidesToShow: 1,
		  slidesToScroll: 1,
		  arrows: false,
		  dots: false,
		  fade: true,
		  asNavFor: '.pv1'
		});
		$('.pv1').slick({
		  slidesToShow: 3,
		  slidesToScroll: 1,
		  asNavFor: '.pi1',
		  dots: false,
		  arrows: false,
		  centerMode: true,
		  focusOnSelect: true,
		  responsive: [
				{
					breakpoint: 992,
					settings: {
						arrows: false,
						slidesToShow: 4,
						vertical: false
					}
				},
				{
					breakpoint: 480,
					settings: {
						slidesToShow: 3,
						vertical: false
					}
				},
			]
		});
    }

    function productLightbox() {
        $('.ps-product__image').lightGallery({
            selector: '.item a',
            thumbnail: true
        });
        $('.ps-video').lightGallery();
    }

    
    $(function() {
        slickConfig();
        productLightbox();
    });

})(jQuery);