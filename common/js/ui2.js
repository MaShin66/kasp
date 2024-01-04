$('header .gnb>ul>li>a').on('mouseenter', function(){
  $('header .gnb>ul>li').removeClass('on');
  $(this).parent().addClass('on');
});

$('.sub_tit, .lnb, .nav, .contents').on('mouseenter', function(){
  $('header .gnb>ul>li').removeClass('on');
});

$('header .all_link').on('mouseenter', function(){
  $('.all_menu').addClass('show');
  $('body').addClass('ofh');
});

$('header .m_link').on('click', function(){
  $('.all_menu').addClass('show');
  $('body').addClass('ofh');
});

$('.all_menu .close, .all_menu .m_bg').on('click', function(){
  $('.all_menu').removeClass('show');
  $('body').removeClass('ofh');
});

$(window).on("load", function() {
  const winW = $(window).width();
  if (winW <= 1140) {
    $('.all_menu .m_gnb h3').on('click', function(){
      $(this).next('ul').stop().slideToggle();
      $(this).parent('li').siblings().find('>ul').stop().slideUp();
    });
  }
})

$('.all_menu .depth3').on('click', function(){
  $(this).toggleClass('on');
});

function top_arrow(){
  $('html, body').stop().animate({scrollTop: 0});
}