 <script type="text/javascript">
    $(document).ready(function() {
      $('.owl-carousel-blog').owlCarousel({
          rtl:false,
          loop:false,
          margin:10,
          nav:true,
          navigationText : ["", ""],
          responsive:{
              0:{
                  items:1
              },
              500:{
                  items:2
              },
              992:{
                  items:3
              },
              1200:{
                  items:4
              }
          }
      })
    
      // blog arrow
      $(".owl-prev").html("<i class='fa fa-chevron-left' aria-hidden='true'></i>");
      $(".owl-next").html("<i class='fa fa-chevron-right' aria-hidden='true'></i>");
    });
  </script>
  <!-- featured in -->
  <!-- <div class="full_width fetured_sm_hd">
    <h1 class="text-center">FEATURED IN</h1>
    </div> -->
  <!-- blog update section end -->
  <span id="totopa"><i class="fa fa-arrow-up"></i></span>
  <!--Footer start-->


  <footer class="main-footer">
    <div class="ft-btm-sec">
      <div class="row">
        <div class="col-lg-12" style="text-align:center;">
          <ul class="hmeftr">
            <li><a href="javascript:void(0)">Privacy Policy</a></li>
            <li><a href="javascript:void(0)">Terms</a></li>
            <li><a href="javascript:void(0)">Blog</a></li>
            <li><a href="javascript:void(0)">FAQ</a></li>
          </ul>
          <p>Copyright &copy; 2017 - portme.co All rights reserved.</p>
        </div>
      </div>
    </div>
    </div>
  </footer>
  <!--Footer End-->
  <script src="js/TweenMax.min.js"></script>
  <script src="js/ScrollToPlugin.min.js"></script>
  <script type="text/javascript" src="js/slick.min.js"></script>
  <script type="text/javascript">
    /*Testimonial Slider*/
    
    $('.testi-slider-con').slick({
    slidesToShow: 1,
    slidesToScroll: 1,
    arrows: false,
    fade: true,
    dots: true,
    });
  </script>
  <script type="text/javascript">
    $(document).ready(function() {
    
  var universities = new Bloodhound({
  datumTokenizer: Bloodhound.tokenizers.whitespace,
  queryTokenizer: Bloodhound.tokenizers.whitespace,
  // url points to a json file that contains an array of country names, see
  // https://github.com/twitter/typeahead.js/blob/gh-pages/data/countries.json
  prefetch: '#u_name.json'
});


	// options being used
	$('#prefetch .typeahead').typeahead(null, {
	  name: 'universities',
	  source: universities
	}).on('typeahead:selected', function(event, selection) {
	  
	  // the second argument has the info you want
	  u_url = convertToSlug(selection);
	  window.location.href = '#university/'+u_url;
	  //alert(selection);
	});

function convertToSlug(text){
		return text.toString().toLowerCase()
			.replace(/\s+/g, '-')           // Replace spaces with -
			.replace(/[^\u0100-\uFFFF\w\-]/g,'-') // Remove all non-word chars ( fix for UTF-8 chars )
			.replace(/\-\-+/g, '-')         // Replace multiple - with single -
			.replace(/^-+/, '')             // Trim - from start of text
			.replace(/-+$/, '');            // Trim - from end of text
		}
    
    
      if ($(window).width() > 767) {
        var winH = $(window).height(); $('.section_top').css('height',winH);
      }else {
        $('.section_top').css('height','auto');
      }
      $(window).resize(function() {
        if ($(window).width() > 767) {
        var winH = $(window).height(); $('.section_top').css('height',winH);
        }else {
          $('.section_top').css('height','auto');
        }
      });
    
      // Header top scrolled down
      $('.bounce').on('click',function() {
        $('html,body').animate({
          scrollTop: $("#whtscoch").offset().top},
          1200);
      });
    
      // on scroll number drop one by one
      $(window).scroll(function() {
        var winScroll = $(window).scrollTop();
        var one = $('.one'),
            two = $('.two'),
            three = $('.three'),
            four = $('.four');
    
        if (winScroll > $("#how").offset().top - 250) {
          setTimeout(function() {
            // $(one).removeClass('hidden').addClass('slideInDown');
          },500);
          setTimeout(function() {
            $(two).removeClass('hidden').addClass('slideInDown');
          },500);
          setTimeout(function() {
            $(three).removeClass('hidden').addClass('slideInDown');
          },1500);
          setTimeout(function() {
            $(four).removeClass('hidden').addClass('slideInDown');
          },2200);
        }else {
          $('.two,.three,.four').addClass('hidden').removeClass('slideInDown');
        }
      });
    
      //
      $('#browse_prog').click(function(){
          $('html, body').animate({scrollTop:0}, 2000);
          return false;
      });
      
    });
    
     
    
    
  </script>
  <script type="text/javascript">
    function switchClass(i) {
	   var lis = $('#home-news > div');
	   lis.eq(i).removeClass('home_header_on');
	   lis.eq(i).removeClass('home_header_out');
		lis.eq(i = ++i % lis.length).addClass('home_header_on');
		lis.eq(i = ++i % lis.length).addClass('home_header_out');
		setTimeout(function() {
			switchClass(i);
		}, 3500);
	}

	$(window).load(function() {
	   switchClass(-1);
	});
    
    
  </script>
  <script type="text/javascript" src="js/owl.carousel.min.js"></script>
<script src="js/jquery-2.1.1.js"></script>
<script src="js/main2.js"></script> <!-- Resource jQuery -->
