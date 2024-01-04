$('header .gnb>ul>li>a').on('mouseenter', function(){
  $('header .gnb>ul>li').removeClass('on');
  $(this).parent().addClass('on');
});

$('.sub_tit, .lnb, .nav, .contents').on('mouseenter', function(){
  $('header .gnb>ul>li').removeClass('on');
});

$('header .all_link').on('mouseenter', function(){
  $('.all_menu').show();
});

$('.all_menu .close').on('click', function(){
  $('.all_menu').hide();
});

$('.all_menu .depth3').on('click', function(){
  $(this).toggleClass('on');
});

function top_arrow(){
  $('html, body').stop().animate({scrollTop: 0});
}