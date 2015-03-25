$(function(){
 var topMargin = $("#main").offset().top;
 $(window).scroll(function(){
 	if($(window).scrollTop() > topMargin){
 		$("#main").addClass("stick");
 	}else{
 		$("#main").removeClass("stick");
 	}
 });


 $('.slideshow').slick({
	  dots: true,
	  infinite: true,
	  autoplay: true,
	  autoplaySpeed: 5000,
	  speed: 500,
	  fade: true,
	  cssEase: 'linear'
  });

$('.slideshow-testimonial').slick({
  dots: true,
  infinite: true,
  autoplay: true,
  autoplaySpeed: 5000,
  speed: 500,
  fade: true,
  cssEase: 'linear'
});

});
