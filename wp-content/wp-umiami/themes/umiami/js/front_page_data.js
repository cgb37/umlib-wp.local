jQuery(document).ready(function($){

  // focus for form
  $("input[type='text']:first").focus();

  // remove quick links go button
  $("#quick_links_submit").hide();

  // @todo make quick links jump to proper place if go button removed

  $("#quick_links_jumpzzzzzzz").change(function() {
    var url = $(this).val();
    // and this is to add a bit of GA event tracking
    var stext = $("#quick_links option:selected").text()
    _gaq.push(['_trackEvent', 'QuickLink', 'Click', stext]);
    // off to desired location
    window.location.href = url;
  })

  $("#gifto_promo a").click(function() {
    _gaq.push(['_trackEvent', 'FeatureLink', 'Click', stext]);
  })

  $("#quick_links_jump").change(function() {
    var url = $(this).val();
    var stext = $("#quick_links option:selected").text()
    var pathname = window.location.pathname;
    // figure out where this GA data belongs
    /*switch (pathname) {
      case "/musiclib/":
      _gaq.push(['_trackEvent', 'QuickLink-Music', 'Click', stext]);
      break;
      case "/universityarchives/":
      _gaq.push(['_trackEvent', 'QuickLink-Archives', 'Click', stext]);
      break;
      default:
      _gaq.push(['_trackEvent', 'QuickLink', 'Click', stext]);

    }*/

    // off to desired location
    window.location.href = url;
  });

  // Add/remove search box when someone hovers over the image info area

  function addSearch(){
    $("#searchbox").fadeIn("medium");
  }

  function removeSearch(){
    $("#searchbox").fadeOut("medium");

  }

  var searchboxConfig = {
    interval: 50,
    sensitivity: 4,
    over: removeSearch,
    timeout: 100,
    out: addSearch
  };

  $("#bg_info_overlay").hoverIntent(searchboxConfig);


  // expand footer on home page
  //$("#wide_footer").height("12em");

  // set starting tab
  /*$("div[class*=search-]").hide();
    var holder = 'div[class*=search-2]';
    $(holder).show();*/

  // tabs on home page
  $("a[rel*=tc-]").click(function() {
    var tab_id = $(this).attr("rel").split("-");
    // fade out current tab

    $("div[class*=search-]").hide();
    // show desired tab
    var holder = 'div[class*=search-' + tab_id[1] + ']';
    $(holder).show();
    /*
          alert(tab_id);
        var holder = 'div[id=tc-' + tab_id[1] + ']';
        $(holder).delay();
        $(holder).load("includes/home_page_data.php", {tab_type_id: tab_id[1], tab_id: tab_id[2], tab_height: tab_id[3]}).fadeIn(800);
         */
    var unactivate = "#searchtabs li";
    $(unactivate).removeClass("active");
    $(this).parent().addClass("active");
    var this_box = 'input[class=searchinput-' + tab_id[1] + ']';
    $(this_box).focus();
    return false;

  });


  // Depends on directory (main site or branch sites) how many news and events items will show
  if( window.location.pathname != "/business/" && window.location.pathname != "/specialcollections/")
    // && window.location.pathname != "/specialcollections/"
  { //settings for three carosel*/
    var carousel_width = 954;
    var carosel_number = 3;
 }else
  {
    var carousel_width = 650;
    var carosel_number = 2;
  }
  
  if( window.location.pathname === "/business/") {
	   var carousel_width = 650;
    var carosel_number = 2;
  
  }

  // Depends on directory (main site or branch sites) how many news and events items will show
  $(".mini_feature").fadeIn("slow");

  var lboolAuto = true;

  $("#mini_features").carouFredSel({
    circular: true,
    infinite: false,
    height: 120,
    width: carousel_width,
    padding: [0, 4, 2, 4],
    items: {
      visible: carosel_number,
      minimum: carosel_number,
      width: 316,
      height: 118
    },
    scroll:
      {
      duration: 1000,
      onAfter: function() {
        var curPos = $(this).triggerHandler( "currentPosition" );
          if ( curPos <carosel_number ) {

          if(lboolAuto)
      	  {
      	    $(this).trigger("slideTo", [0, "prev"]);
      	  }

          $(this).trigger( "pause" ); // or "stop"

        }
      },
      pauseOnHover: [true, "resume"]
    },
    auto: {
      delay: 100
    },
    prev : {
      button	: "#spotlight_controls_prev",
      key		: "left",
      onAfter   : function()
      {
      	var lboolAuto = false;

      	$(this).trigger("pause");
      }
    },
    next : {
      button	: "#spotlight_controls_next",
      key		: "right",
      onAfter   : function()
      {
      	var lboolAuto = false;

       	$(this).trigger("pause");
      }
    }
  });

  $('.caroufredsel_wrapper').css('float', 'left');


$.ajax({
        url: '/dev-www/wp-content/themes/umiami/inc/comment_check.php',
        async: true,
        type:'GET',
        success: function(msg) {
          //alert(msg);
          if (msg != "false") {
            // display new message
            $('.tour_3').attr('title', 'New comment: ' + msg);
            $('#new_comment').html('&nbsp;new&nbsp;').fadeIn("slow");
            $('new_comment').css('padding','1px');
          }


            $('#error').show();
            //do whatyou need to do after you have succesfully vompleted the ajax request
        }
    });

  /*
  // this was moving the Meet Your Librarian sprite back and forth
	$("#gifto_promo a").hover(function(){
		$("img", this).stop().animate({left:"-298px"},{queue:false,duration:600});
	}, function() {
		//$("img", this).stop().animate({right:"0px"},{queue:false,duration:200});
	});
    */
});