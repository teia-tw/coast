jQuery(function($){
  $(document).ready(function(){
      
    //superFish
    $(function() { 
      $("#main-menu > ul.menu").superfish({
		
			autoArrows:  false  
      });
    });
  
  }); // end doc ready
}); // end function
/*
 * Superfish v1.4.8 - jQuery menu widget
 * Copyright (c) 2008 Joel Birch
 *
 * Dual licensed under the MIT and GPL licenses:
 *   http://www.opensource.org/licenses/mit-license.php
 *   http://www.gnu.org/licenses/gpl.html
 *
 * CHANGELOG: http://users.tpg.com.au/j_birch/plugins/superfish/changelog.txt
 */

;(function($){
  $.fn.superfish = function(op){

    var sf = $.fn.superfish,
      c = sf.c,
      $arrow = $(['<i style="paddin-left:6px;float:right; opacity:0.4;" class="icon-right-open ic"></i>'].join('')),
      over = function(){
        var $$ = $(this), menu = getMenu($$);
        clearTimeout(menu.sfTimer);
        $$.showSuperfishUl().siblings().hideSuperfishUl();
      },
      out = function(){
        var $$ = $(this), menu = getMenu($$), o = sf.op;
        clearTimeout(menu.sfTimer);
        menu.sfTimer=setTimeout(function(){
          o.retainPath=($.inArray($$[0],o.$path)>-1);
          $$.hideSuperfishUl();
          if (o.$path.length && $$.parents(['li.',o.hoverClass].join('')).length<1){over.call(o.$path);}
        },o.delay);  
      },
      getMenu = function($menu){
        var menu = $menu.parents(['ul.',c.menuClass,':first'].join(''))[0];
        sf.op = sf.o[menu.serial];
        return menu;
      },
      addArrow = function($a){ $a.addClass(c.anchorClass).append($arrow.clone()); };
      
    return this.each(function() {
      var s = this.serial = sf.o.length;
      var o = $.extend({},sf.defaults,op);
      o.$path = $('li.'+o.pathClass,this).slice(0,o.pathLevels).each(function(){
        $(this).addClass([o.hoverClass,c.bcClass].join(' '))
          .filter('li:has(ul)').removeClass(o.pathClass);
      });
      sf.o[s] = sf.op = o;
      
      $('li:has(ul)',this)[($.fn.hoverIntent && !o.disableHI) ? 'hoverIntent' : 'hover'](over,out).each(function() {
        if (o.autoArrows) addArrow( $('>a:first-child',this) );

      })
      .not('.'+c.bcClass)
        .hideSuperfishUl();
      
      var $a = $('a',this);
      $a.each(function(i){
        var $li = $a.eq(i).parents('li');
        $a.eq(i).focus(function(){over.call($li);}).blur(function(){out.call($li);});
      });
      o.onInit.call(this);
      
    }).each(function() {
      var menuClasses = [c.menuClass];
      if (sf.op.dropShadows  && !($.browser.msie && $.browser.version < 7)) menuClasses.push(c.shadowClass);
      $(this).addClass(menuClasses.join(' '));
    });
  };

  var sf = $.fn.superfish;
  sf.o = [];
  sf.op = {};
  sf.IE7fix = function(){
    var o = sf.op;
    if ($.browser.msie && $.browser.version > 6 && o.dropShadows && o.animation.opacity!=undefined)
      this.toggleClass(sf.c.shadowClass+'-off');
    };
  sf.c = {
    bcClass     : 'sf-breadcrumb',
    menuClass   : 'sf-js-enabled',
    anchorClass : 'sf-with-ul',
    arrowClass  : 'sf-sub-indicator',
    shadowClass : 'sf-shadow'
  };
  sf.defaults = {
    hoverClass  : 'sfHover',
    pathClass  : 'overideThisToUse',
    pathLevels  : 1,
    delay    : 10000,
    animation  : {opacity:'show'},
    speed    : 'normal',
    autoArrows  : true,
    dropShadows : true,
    disableHI  : false,    // true disables hoverIntent detection
    onInit    : function(){}, // callback functions
    onBeforeShow: function(){},
    onShow    : function(){},
    onHide    : function(){}
  };
  $.fn.extend({
    hideSuperfishUl : function(){
      var o = sf.op,
        not = (o.retainPath===true) ? o.$path : '';
      o.retainPath = false;
      var $ul = $(['li.',o.hoverClass].join(''),this).add(this).not(not).removeClass(o.hoverClass)
          .find('>ul').hide().css('visibility','hidden');
      o.onHide.call($ul);
      return this;
    },
    showSuperfishUl : function(){
      var o = sf.op,
        sh = sf.c.shadowClass+'-off',
        $ul = this.addClass(o.hoverClass)
          .find('>ul:hidden').css('visibility','visible');
      sf.IE7fix.call($ul);
      o.onBeforeShow.call($ul);
      $ul.animate(o.animation,o.speed,function(){ sf.IE7fix.call($ul); o.onShow.call($ul); });
      return this;
    }
  });
  
 


$(document).ready(function(){

$('#carousel').flexslider({
        animation: "slide",
        controlNav: false,
        slideshow: false,
		itemWidth: 142,
		itemHeight: 50,
		itemMargin: 7,
		touch:true,
		move:1,
      });
	  
	  $('#testimonials').flexslider({
        controlNav: false,
        slideshow: true,
		touch:true,
		move:1,
		animation: "fade",              //String: Select your animation type, "fade" or "slide"
		easing: "swing",               //{NEW} String: Determines the easing method used in jQuery transitions. jQuery easing plugin is supported!
		animationLoop: true,             //Boolean: Should the animation loop? If false, directionNav will received "disable" classes at either end
		slideshow: true,                //Boolean: Animate slider automatically
		slideshowSpeed: 7000,           //Integer: Set the speed of the slideshow cycling, in milliseconds
		animationSpeed: 600,            //Integer: Set the speed of animations, in milliseconds
 	});
	  
	  $('#our-work').flexslider({
        controlNav: false,
        slideshow: true,
		touch:true,
		move:2,
		animation: "slide",              //String: Select your animation type, "fade" or "slide"
		easing: "swing",                  //{NEW} Boolean: Reverse the animation direction
		animationLoop: true,             //Boolean: Should the animation loop? If false, directionNav will received "disable" classes at either end
		slideshow: false,                //Boolean: Animate slider automatically
		
		 itemWidth: 240,
		itemMargin: 0,
      });
	  $('.flexslider').flexslider({
		animation: "slide",
		animationLoop: true,
		itemMargin: 40,
		touch:true,
		controlNav: false,
	  });


  $("googlemap").each(function(){                        
    var embed ="<iframe width='100%' height='360px' frameborder='0' scrolling='no'  marginheight='0' marginwidth='0'   src='https://maps.google.com/maps?&amp;q="+ encodeURIComponent( $(this).text() ) +"&output=embed&iwloc='></iframe>";
                                $(this).html(embed);
                            
   });
});
})(jQuery);



 

