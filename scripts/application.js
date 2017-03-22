
$('input, textarea').change(function(){
  if( $(this).val().length > 0 ){
    $(this).addClass('has-content');
  } else {
    $(this).removeClass('has-content');
  }
});

function mobileHeader(on) {
  var globalHeader = $('header.global'),
      logo_link = globalHeader.find('.logo_link').clone(),
      navItems = globalHeader.find('> a').clone(),
      logoImg = $('.logo_link img').attr('src');

    $('<div class="mobile-nav"><a href="#" class="mobile-nav_trigger"><span class="top"></span><span class="middle first"></span><span class="middle last"></span><span class="bottom"></span></a><div class="mobile-nav_container"></div></div>').appendTo(globalHeader);
    $('<div class="logo_link"><a href="' + logo_link.attr('href') + '"><img src="' + logoImg + '"/></a></div>').prependTo('.mobile-nav');
    navItems.appendTo('.mobile-nav_container');

    $('.mobile-nav_trigger').click(function(e){
      e.preventDefault();
      $(this).parent().toggleClass('open');
    });

    $('main').click(function(){
      $('.mobile-nav.open').removeClass('open');
    });

}

$('.hero_scroll_button').click(function(e){
  e.preventDefault();
  $('html, body').animate({scrollTop:$('.hero').outerHeight()},350);
});

function lightboxActions(){

  $('.lightbox-trigger').click(function(e){
    e.preventDefault();

    var content = $(this);

    $('header.global').addClass('lightbox-open');

    $('.lightbox .lightbox_content').children().remove();

    content.children('.lightbox_content').children().clone().appendTo('.lightbox .lightbox_content');

    $('.lightbox').addClass('open');

    if(content.hasClass('video-lightbox')){
      $('.lightbox .lightbox_content video').attr("autoplay", "true");
      $('.lightbox .lightbox_content').addClass("video-lightbox");
    }

    setTimeout( function(){
      positionFauxed(true);
    }, 250);

  });

  $('.lightbox_underlay, .lightbox .close').click(function(){

    $('.lightbox').removeClass('open');
    $('header.global').removeClass('lightbox-open');
    setTimeout( function(){
      $('.lightbox .lightbox_content').children().remove();
      $('.lightbox .lightbox_content.video-lightbox').removeClass("video-lightbox");
    }, 250);

    setTimeout( function(){
        positionFauxed(false);
    }, 250);

  });

}

function lineAnimation(){
  $('.line.hidden').each(function(i){
    var self = $(this),
        height = $(window).height() / 3;

    if( $(window).scrollTop() >= ( self.offset().top - (height * 2)) ) {
      self.removeClass('hidden');
    }

  });
}

function sliderSetup() {

  $('.slider_quotes').slick({
    prevArrow: '.slider_quotes + .arrows .prev',
    nextArrow: '.slider_quotes + .arrows .next',
    dots: true,
    slidesToShow: 1,
    infinite: true,
    swipe: true
  });

  $('.slider_social').slick({
    prevArrow: '.slider_social + .arrows .prev',
    nextArrow: '.slider_social + .arrows .next',
    dots: true,
    slidesToShow: 1,
    infinite: true,
    swipe: true
  });

  $('.slider_tweets').slick({
    prevArrow: '.slider_tweets + .arrows .prev',
    nextArrow: '.slider_tweets + .arrows .next',
    slidesToShow: 4,
    infinite: true,
    swipe: true
  });

}

sliderSetup();

$(window).load(function() {

  mobileHeader(true);
  lineAnimation();
  lightboxActions();
  AOS.init();
  
});

$(window).resize(function() {

});

$(window).scroll( $.throttle( 100, function() {

  lineAnimation();

  var top = $(window).scrollTop(),
      height = $(window).height();

  if($(window).scrollTop() > 100){
    $('header.global').addClass('scrolled');
  } else {
    $('header.global').removeClass('scrolled');
  }

  $('.number-wrapper').each(function(){
    var self = $(this).children('.number');
    self.css('top', ( ( ( $(this).offset().top - top ) * -1) + "px") );
  });

}));

function minWidth(width) {
  var screenWidth =  $(window).width();
  if ( screenWidth >= width ) {
    return true;
  } else {
    return false;
  }
}

function maxWidth(width) {
  var screenWidth =  $(window).width();
  if ( screenWidth <= width ) {
    return true;
  } else {
    return false;
  }
}

// This function takes care of all the weir issues you might run into when trying to do a fixed position overlay on mobile.

function positionFauxed(on){
  var headerOffset = 0;
  var fakeScroll = $(window).scrollTop() - headerOffset;
  var scrollAmount = parseInt($("main.noscroll").css("top"), 10) - headerOffset;
  scrollAmount = parseInt(scrollAmount, 10);
  scrollAmount = scrollAmount * -1;

  if(on === true){
    $("main").addClass("noscroll");
    $("main").css("top", + (fakeScroll  * -1));

  } else {

    setTimeout( function(){
      $("main").removeClass("noscroll");
      $("main").css("top", "0");
      $(window).scrollTop(scrollAmount);
    }, 1);

  }
}

var BrowserDetect = {
        init: function () {
            this.browser = this.searchString(this.dataBrowser) || "Other";
            this.version = this.searchVersion(navigator.userAgent) || this.searchVersion(navigator.appVersion) || "Unknown";
        },
        searchString: function (data) {
            for (var i = 0; i < data.length; i++) {
                var dataString = data[i].string;
                this.versionSearchString = data[i].subString;

                if (dataString.indexOf(data[i].subString) !== -1) {
                    return data[i].identity;
                }
            }
        },
        searchVersion: function (dataString) {
            var index = dataString.indexOf(this.versionSearchString);
            if (index === -1) {
                return;
            }

            var rv = dataString.indexOf("rv:");
            if (this.versionSearchString === "Trident" && rv !== -1) {
                return parseFloat(dataString.substring(rv + 3));
            } else {
                return parseFloat(dataString.substring(index + this.versionSearchString.length + 1));
            }
        },

        dataBrowser: [
            {string: navigator.userAgent, subString: "Edge", identity: "MS Edge"},
            {string: navigator.userAgent, subString: "MSIE", identity: "Explorer"},
            {string: navigator.userAgent, subString: "Trident", identity: "Explorer"},
            {string: navigator.userAgent, subString: "Firefox", identity: "Firefox"},
            {string: navigator.userAgent, subString: "Opera", identity: "Opera"},
            {string: navigator.userAgent, subString: "OPR", identity: "Opera"},

            {string: navigator.userAgent, subString: "Chrome", identity: "Chrome"},
            {string: navigator.userAgent, subString: "Safari", identity: "Safari"}
        ]
    };

BrowserDetect.init();
$("html").addClass((BrowserDetect.browser).toLowerCase()).addClass((BrowserDetect.browser).toLowerCase() + "-" + BrowserDetect.version);
