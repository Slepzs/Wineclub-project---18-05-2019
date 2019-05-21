$(document).ready(function() {

  $(".rate").click(function(e) {
    $(this).find(".givestars #focus").focus();
    if( $(this).find(".givestars").attr("clicked") == "false" ) {
      $(this).find(".givestars").css("cssText", "opacity: 1; top: -30px; left: -20px; z-index: 1; border-top: 0px; box-shadow: 0px 0px 0px #c5a8a8;");
      $(this).find(".givestars").attr("clicked", "true");
   } else if($(this).find(".givestars").attr("clicked") == "true") {
      $(this).find(".givestars").css("cssText", "opacity: 0; top: 40px; z-index: -1");
      $(this).find(".givestars").attr("clicked", "false");
 }
});


$(".submitstars").click(function() {
  $(".wine-rating-input input").val('');
})


if( /Android|webOS|iPhone|iPad|iPod|BlackBerry|IEMobile|Opera Mini/i.test(navigator.userAgent) ) {
} else {


$(window).scroll(function () {

 if($(window).scrollTop() > 200) {
    $('.comment-section').css('position','fixed');
    $('.comment-section').css('top','0');
 }

 else if ($(window).scrollTop() <= 200) {
    $('.comment-section').css('position','');
    $('.comment-section').css('top','');
 }
    if ($('.comment-section').offset().top + $(".comment-section").height() > $("#footer").offset().top) {
        $('.comment-section').css('top',-($(".comment-section").offset().top + $(".comment-section").height() - $("#footer").offset().top));
    }
});

}



if(window.location.href.indexOf("/index.php") > 0) {
} else {
   $(".middle-background").css("display", "none");
}



});
