$('input[type="submit"]').mousedown(function(){
  $(this).css('background', '#2ecc71');
});
$('input[type="submit"]').mouseup(function(){
  $(this).css('background', '#1abc9c');
});

$('#loginform').click(function(){
  $('.login').fadeToggle('slow');
  $(this).toggleClass('green');
});



$(document).mouseup(function (e)
{
  var container = $(".login");

    if (!container.is(e.target) // if the target of the click isn't the container...
        && container.has(e.target).length === 0) // ... nor a descendant of the container
    {
      container.hide();
      $('#loginform').removeClass('green');
    }
  });

jQuery(".reg").click(function () {
  jQuery(".logo").addClass("fadeOutLeft animated");
  setTimeout( function(){ 
    jQuery(".logo").remove();
    jQuery(".regist").removeClass("notshow");
    jQuery(".regist").addClass("fadeInRight animated show");
  }  , 200 );
});

jQuery(".log").click(function () {
  jQuery(".regist").addClass("fadeOutRight animated");
  setTimeout( function(){ 
    jQuery(".regist").remove();
    jQuery(".logo").removeClass("notshow");
    jQuery(".logo").addClass("fadeInLeft animated show");
  }  , 200 );
});