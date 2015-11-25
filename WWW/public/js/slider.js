$(document).ready(function(){
  $('.slider').slick({
    slidesToShow: 1,
    slidesToScroll: 1,
    autoplay: true,
    autoplaySpeed: 5000,
    dots:true,
  });
  $('.fade').slick({
    infinite: true,
    speed: 500,
    fade: true,
    cssEase: 'linear'
  });
  $('.gallerySlider').slick({
    slidesToShow: 4,
    slidesToScroll: 4,
    autoplay: false,
    infinite: true,
    dots: true,
    focusOnSelect: true,
    cssEase: 'linear'
  });

  $(function() {
    $( "#datepicker" ).datepicker();
  });  
});