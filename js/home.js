
// $(window).load(function(){
//     var ht = $(window).height();
//     ht =ht-102;

//     $('#bkg_height').css("height", ht);
//     $('.circle-div').click(function() {
//         $('.circle-div').removeClass('fullarticle_active');
//         $(this).addClass("fullarticle_active");
//         var shown = $(this).attr('dataimg');
//         $('img').removeClass('icon_container_active');
//         $('.show1').show();
//         $('.show2').hide();
//         $(this).find('.show1').hide();
//         $(this).find('.show1').removeClass('icon_container_active');
//         $(this).find('.show2').show();
//         $(this).find('.show2').addClass('icon_container_active');


//     });

//     $('.view-profile .send_messg_button ').click(function(){
//       $('.modal-content').css('display','block');
//     });
     
//     $(window).bind("pageshow", function() {
//       var form = $('.menu form');
//       form[0].reset();
//     });

//      $(".dropdown").on('click',function(){

//         var width_drop = $(this).find('.dropdown-menu').width()/2;
//         var width_minus = width_drop-12;
//         $(this).find('.dropdown-menu').css('left',-width_minus);
//      });

//   });

// function form_submit(){
//     $('#conversation_form_3').submit();
// }

// MINIFIED JS

$(window).load(function(){var a=$(window).height();a=a-102;$("#bkg_height").css("height",a);$(".circle-div").click(function(){$(".circle-div").removeClass("fullarticle_active");$(this).addClass("fullarticle_active");var b=$(this).attr("dataimg");$("img").removeClass("icon_container_active");$(".show1").show();$(".show2").hide();$(this).find(".show1").hide();$(this).find(".show1").removeClass("icon_container_active");$(this).find(".show2").show();$(this).find(".show2").addClass("icon_container_active");});$(".view-profile .send_messg_button ").click(function(){$(".modal-content").css("display","block");});$(window).bind("pageshow",function(){var b=$(".menu form");});$(".dropdown").on("click",function(){var c=$(this).find(".dropdown-menu").width()/2;var b=c-12;$(this).find(".dropdown-menu").css("left",-b);});});function form_submit(){$("#conversation_form_3").submit();}
;
