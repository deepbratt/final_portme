// var chatBoxes = new Array();
// var chatboxFocus = new Array();
// var loggedInUserId = ''
// // browser detecting
// var nVer = navigator.appVersion;
// var nAgt = navigator.userAgent;
// var browserName  = navigator.appName;
// var fullVersion  = ''+parseFloat(navigator.appVersion);
// var majorVersion = parseInt(navigator.appVersion,10);
// var nameOffset,verOffset,ix;
// // In Opera 15+, the true version is after "OPR/"
// if ((verOffset=nAgt.indexOf("OPR/"))!=-1) {
//  browserName = "Opera";
//  fullVersion = nAgt.substring(verOffset+4);
// }
// // In older Opera, the true version is after "Opera" or after "Version"
// else if ((verOffset=nAgt.indexOf("Opera"))!=-1) {
//  browserName = "Opera";
//  fullVersion = nAgt.substring(verOffset+6);
//  if ((verOffset=nAgt.indexOf("Version"))!=-1)
//    fullVersion = nAgt.substring(verOffset+8);
// }
// // In MSIE, the true version is after "MSIE" in userAgent
// else if ((verOffset=nAgt.indexOf("MSIE"))!=-1) {
//  browserName = "Microsoft Internet Explorer";
//  fullVersion = nAgt.substring(verOffset+5);
// }
// // In Chrome, the true version is after "Chrome"
// else if ((verOffset=nAgt.indexOf("Chrome"))!=-1) {
//  browserName = "Chrome";
//  fullVersion = nAgt.substring(verOffset+7);
// }
// // In Safari, the true version is after "Safari" or after "Version"
// else if ((verOffset=nAgt.indexOf("Safari"))!=-1) {
//  browserName = "Safari";
//  fullVersion = nAgt.substring(verOffset+7);
//  if ((verOffset=nAgt.indexOf("Version"))!=-1)
//    fullVersion = nAgt.substring(verOffset+8);
// }
// // In Firefox, the true version is after "Firefox"
// else if ((verOffset=nAgt.indexOf("Firefox"))!=-1) {
//  browserName = "Firefox";
//  fullVersion = nAgt.substring(verOffset+8);
// }
// // In most other browsers, "name/version" is at the end of userAgent
// else if ( (nameOffset=nAgt.lastIndexOf(' ')+1) <
//           (verOffset=nAgt.lastIndexOf('/')) )
// {
//  browserName = nAgt.substring(nameOffset,verOffset);
//  fullVersion = nAgt.substring(verOffset+1);
//  if (browserName.toLowerCase()==browserName.toUpperCase()) {
//   browserName = navigator.appName;
//  }
// }
// // trim the fullVersion string at semicolon/space if present
// if ((ix=fullVersion.indexOf(";"))!=-1)
//    fullVersion=fullVersion.substring(0,ix);
// if ((ix=fullVersion.indexOf(" "))!=-1)
//    fullVersion=fullVersion.substring(0,ix);
// majorVersion = parseInt(''+fullVersion,10);
// if (isNaN(majorVersion)) {
//  fullVersion  = ''+parseFloat(navigator.appVersion);
//  majorVersion = parseInt(navigator.appVersion,10);
// }
// $(document).ready(function () {
// check_browser()
// $('window').resize(function(){
//    check_browser() 
// })
// function check_browser(){
//      if(browserName == "Chrome" && majorVersion >= 40)
//   {}
//   // else if(browserName == "Firefox" && majorVersion >= 40)
//   // {}
//   // else if(browserName == "Safari" && majorVersion >= 8)
//   // {}
//   // else if(browserName == "Opera" && majorVersion >= 8)
//   // {}
//   else {
//     // var append_text = '<p class="not-suport">Eazycoach works best on Chrome. Please open Eazycoach on Chrome Browser for the perfect experience. <a href="https://www.google.co.in/chrome/browser/desktop/" target="_blank">Download latest version from here</a></p>';
//     // $(".fixed_head ").before(append_text)
//     // var height_not = $(".not-suport").height();
//     // $(".fixed_head").css('top',height_not)
//     // $(".topcontainer_m").css('top',height_not+10)
// }
 
//   }
//     // Start conversation
//     $(document).on('click','.start-conversation', function (e) {
//         e.preventDefault();
//         //alert('hi')
//         chat_height()
//         $(".available-coaches li").removeClass('active')
//         $(this).closest('li').addClass('active')
//         $("#default_chat").hide();
//         $("#chatbox_" + subscription).hide();
//         var sender = $(this).data('sender');
//         var sender_id = $(this).data('sid');
//         var recipient_id = $(this).data('rip');
//         var coach_username = $(this).data('uname');
//         var subscription = $(this).data('subscription');
//         var sender_id = $(this).data('sid');
//         var recipient_id = $(this).data('rip');
//         var coach_username = $(this).data('uname');
//         console.log(subscription);
//         update_chats_div(recipient_id, coach_username, subscription);
//         if ($("#chatbox_" + subscription).length > 0) {
//             if ($("#chatbox_" + subscription).css('display') == 'none') {
//                 $("#chatbox_" + subscription).css('display', 'block');
//                 //chatBox.restructure();
//             }
//             $("#chatbox_" + subscription + " .chatboxtextarea").focus();
//             return;
//         }
//         $(".chat-box-content").html('<div id="chatbox_' + subscription + '" class="chatbox"></div>')
//         $.get("conversations/" + subscription, function (data) {
//             $('#chatbox_' + subscription).html(data);
//         }, "html");
//         $("#chatbox_" + subscription).css('bottom', '0px');
//         chatBoxeslength = 0;
//         for (x in chatBoxes) {
//             if ($("#chatbox_" + chatBoxes[x]).css('display') != 'none') {
//                 chatBoxeslength++;
//             }
//         }
//         if (chatBoxeslength == 0) {
//             $("#chatbox_" + subscription).css('right', '20px');
//         } else {
//             width = (chatBoxeslength) * (280 + 7) + 20;
//             $("#chatbox_" + subscription).css('right', width + 'px');
//         }
//         chatBoxes.push(subscription);
//         chatboxFocus[subscription] = false;
//         $("#chatbox_" + subscription + " .chatboxtextarea").blur(function () {
//             chatboxFocus[subscription] = false;
//             $("#chatbox_" + subscription + " .chatboxtextarea").removeClass('chatboxtextareaselected');
//         }).focus(function () {
//             chatboxFocus[subscription] = true;
//             $('#chatbox_' + subscription + ' .chatboxhead').removeClass('chatboxblink');
//             $("#chatbox_" + subscription + " .chatboxtextarea").addClass('chatboxtextareaselected');
//         });
//         $("#chatbox_" + subscription).click(function () {
//             if ($('#chatbox_' + subscription + ' .chatboxcontent').css('display') != 'none') {
//                 $("#chatbox_" + subscription + " .chatboxtextarea").focus();
//             }
//         });
//         $("#chatbox_" + subscription).show();
//         var checkingHeight=setInterval(function(){
//           if ($('.new_chatbox').length > 0) {
//               clearInterval(checkingHeight);
//               $(".new_chatbox.nano").nanoScroller({ scroll: 'bottom',alwaysVisible:true,flash: true,disableResize: false });
//           }
//         },50);
//     });
//     // Send message
//     $('.button_send').on('click', function () {
//         $('.chatboxtextarea').val('');
//         $('.upload-file-name').html('');
//         $('.upload-file-name').css('display','none');
//     });
//     $("form#new_course_query").submit(function() {
//         $(this).submit(function() {
//             return false;
//         });
//         return true;
// });
//     // Start classroom
//     $('.chat-container').on('click', '#class_start', function () {
//        var uid= $(this).attr('data-waitingid');
//         $('#virtual-class-waiting').attr('data-uid',uid);
//         var subscriptionId = $(this).data('subscription');
//         $('#request-cancel').attr('data-sid', subscriptionId);
//         $.post('/virtual_class/ask', {subscription_id: subscriptionId}).success(function () {
//             $('#virtual-class-waiting').modal();
//         }).error(function () {
//         });
//     });
//     if(loggedInUserId) {
//         var virtualClassRequestSubscriptionId;
//         PrivatePub.subscribe('/virtual_class/actions/' + loggedInUserId, function (data, channel) {
//             console.log(data);
//             if (loggedInUserId != data.sender) {
//                 if (data.action == 'Ask') {
//                     virtualClassRequestSubscriptionId = data.subscription_id;
//                     $('#vc-requester-name').text(data.name);
//                     $('#virtual-class-actions').modal()
//                 } else if (data.action == 'Accept') {
//                     // Accepted
//                     window.location.href = data.link;
//                 } else if (data.action == 'Decline') {
//                     // Rejected
//                     $('#virtual-class-waiting, #virtual-class-actions').modal('hide');
//                 } else if (data.action == 'End') {
//                     createCookie('session_closed', 'true', 1);
//                     window.location.href = data.link;
//                 }
//                 else if (data.action == 'Cancel') {
//                     $('#virtual-class-actions').modal('hide');
//                 }
//                 else {
//                     $('#virtual-class-end').modal();
//                 }
//             }
//         });
//         $('#virtual-class-actions').on('hidden.bs.modal', function () {
//             //alert('#virtual-class-actions');
//             $.ajax({
//                 type: "POST",
//                 url: '/virtual_class/decline/',
//                 data: {_method: 'DELETE', subscription_id: virtualClassRequestSubscriptionId}
//             });
//         });
//         $('#accept-vc-request').on('click', function () {
//             //alert('#accept-vc-request');
//             $.ajax({
//                 type: "POST",
//                 url: '/virtual_class/accept',
//                 data: {_method: 'PUT', subscription_id: virtualClassRequestSubscriptionId},
//                 success: function (data) {
//                    window.location.href = data.link;
//                 }
//               //  beforeSend: function(data){
               
//               //  $('.loader').removeClass('hidden');
//               //  },
//               // complete: function(data){
//               //      $('.loader').addClass('hidden');
//               //       window.location.href = data.link;
//               //   }
//             });
//         });
//         //js added from here
//         $(document).on('click','#request-cancel', function () {
//             var subscriptionId = $(this).attr('data-sid');
//             $.ajax({
//                 type: "POST",
//                 url: '/virtual_class/decline/',
//                 data: {_method: 'DELETE', subscription_id: subscriptionId}
//             });
//         });
//         //js added from here
//         $('#end_session').on('click', function () {
//             //alert('#end_session');
//             $.ajax({
//                 type: "POST",
//                 url: '/virtual_class/end_session/',
//                 data: {_method: 'DELETE', virtual_class_id: virtualClassId},
//                 success: function (data) {
//                     window.location.href = data.link;
//                 }
//             });
//         })
//     }
//     $(document).on('click','.start-conversation1',function(e){
//      e.preventDefault();
//     var subscription = $(this).data('subscription');
//     window.location.href = "/conversations?sid="+subscription;
//         // $.ajax({
//         //   url:'/conversations',
//         //   type:'GET',
//         //   data:{"sid": subscription},
//         //   dataType: "html",
//         //   success:function(data){
//         //     window.location.href = "/conversations?sid="+subscription;  // replace
//         //
//         //   }
//         // })
//      })
// $("#end_session_wrapt .close,.close_popup").on('click',function(){
//     $('#end_session_wrap.fade').css({'opacity':0,'display':'none'})
// })
// });

var chatBoxes = [];
var chatboxFocus = [];
var loggedInUserId;

   $(document).ready(function () { 
    // Start conversation
    $(document).on('click','.start-conversation', function (e) {
        e.preventDefault();
        //alert('hi')
        chat_height();
        $(".available-coaches li").removeClass('active');
        $(this).closest('li').addClass('active');
        $("#default_chat").hide();
        $("#chatbox_" + subscription).hide();
        var sender = $(this).data('sender');
        var sender_id = $(this).data('sid');
        var recipient_id = $(this).data('rip');
        var coach_username = $(this).data('uname');
        var subscription = $(this).data('subscription');
        console.log(subscription);
        update_chats_div(recipient_id, coach_username, subscription);

        if ($("#chatbox_" + subscription).length > 0) {
            if ($("#chatbox_" + subscription).css('display') == 'none') {
                $("#chatbox_" + subscription).css('display', 'block');
                //chatBox.restructure();
            }
            $("#chatbox_" + subscription + " .chatboxtextarea").focus();
            return;
        }
 
 $(".chat-box-content").html('<div id="chatbox_' + subscription + '" class="chatbox"><img src="/images/loading1.gif" id="chatboxLoader" style=" position: absolute; margin: auto; top: 0; left: 0; right: 0; bottom: 0; height:50px;"></div>');

        $.get("conversations/" + subscription, function (data) {
            $('#chatbox_' + subscription).html(data);
        }, "html");

        $("#chatbox_" + subscription).css('bottom', '0px');

        chatBoxeslength = 0;

        for (var x in chatBoxes) {
            if ($("#chatbox_" + chatBoxes[x]).css('display') != 'none') {
                chatBoxeslength++;
            }
        }

        if (chatBoxeslength === 0) {
            $("#chatbox_" + subscription).css('right', '20px');
        } else {
            width = (chatBoxeslength) * (280 + 7) + 20;
            $("#chatbox_" + subscription).css('right', width + 'px');
        }

        chatBoxes.push(subscription);

        chatboxFocus[subscription] = false;

        $("#chatbox_" + subscription + " .chatboxtextarea").blur(function () {
            chatboxFocus[subscription] = false;
            $("#chatbox_" + subscription + " .chatboxtextarea").removeClass('chatboxtextareaselected');
        }).focus(function () {
            chatboxFocus[subscription] = true;
            $('#chatbox_' + subscription + ' .chatboxhead').removeClass('chatboxblink');
            $("#chatbox_" + subscription + " .chatboxtextarea").addClass('chatboxtextareaselected');
        });

        $("#chatbox_" + subscription).click(function () {
            if ($('#chatbox_' + subscription + ' .chatboxcontent').css('display') != 'none') {
                $("#chatbox_" + subscription + " .chatboxtextarea").focus();
            }
        });

        $("#chatbox_" + subscription).show();
        var checkingHeight=setInterval(function(){
          if ($('.new_chatbox').length > 0) {
              clearInterval(checkingHeight);
              $(".new_chatbox.nano").nanoScroller({ scroll: 'bottom', alwaysVisible:true, flash: true, disableResize: false });

          }
        },50);

        $('.chatboxtextarea').val('');

    });

   
    $("form#new_course_query").submit(function() {
        $(this).submit(function() {
            return false;
        });
        return true;
    });

    // Start classroom
    $('.chat-container').on('click', '#class_start', function () {
       var uid= $(this).attr('data-waitingid');
        $('#virtual-class-waiting').attr('data-uid',uid);
        var subscriptionId = $(this).data('subscription');
        $('#request-cancel').attr('data-sid', subscriptionId);
        $.post('/virtual_class/ask', {subscription_id: subscriptionId}).success(function () {
            $('#virtual-class-waiting').modal();
        }).error(function () {

        });
    });

    if(loggedInUserId) {

        var virtualClassRequestSubscriptionId;
        PrivatePub.subscribe('/virtual_class/actions/' + loggedInUserId, function (data, channel) {
            console.log(data);
            if (loggedInUserId != data.sender) {
                if (data.action == 'Ask') {
                    virtualClassRequestSubscriptionId = data.subscription_id;
                    $('#vc-requester-name').text(data.name);
                    $('#virtual-class-actions').modal();
                } else if (data.action == 'Accept') {
                    // Accepted
                    window.location.href = data.link;
                } else if (data.action == 'Decline') {
                    // Rejected
                    $('#virtual-class-waiting, #virtual-class-actions').modal('hide');
                } else if (data.action == 'End') {
                    createCookie('session_closed', 'true', 1);
                    window.location.href = data.link;
                }
                else if (data.action == 'Cancel') {
                    $('#virtual-class-actions').modal('hide');

                }
                else {
                    $('#virtual-class-end').modal();
                }
            }
        });

        $('#virtual-class-actions').on('hidden.bs.modal', function () {
            //alert('#virtual-class-actions');
            $.ajax({
                type: "POST",
                url: '/virtual_class/decline/',
                data: {_method: 'DELETE', subscription_id: virtualClassRequestSubscriptionId}
            });
        });

        $(document).on('click','#accept-vc-request', function () {
            //alert('#accept-vc-request');
            // $('.loader-ht').removeClass('hidden');
            $.ajax({
                type: "POST",
                url: '/virtual_class/accept',
                data: {_method: 'PUT', subscription_id: virtualClassRequestSubscriptionId},
                success: function (data) {
                    $('.acc-btn').addClass('zoomOutUp');
                    window.location.href = data.link;
                    $('.ld-load').addClass('zoomOutIn').removeClass('hidden');
                    if ($('.ld-load').hasClass('zoomOutIn')) {
                        setTimeout(function() {
                            $('.acc-btn').addClass('hidden');
                        },1000);                        
                    }
                    // $('.loader-ht').addClass('hidden');
                }
                 //  beforeSend: function(data){
               
//               //  $('.loader').removeClass('hidden');
//               //  },
//               // complete: function(data){
//               //      $('.loader').addClass('hidden');
//               //       window.location.href = data.link;
//               //   }
            });
        });
        //js added from here

        $(document).on('click','#request-cancel', function () {
            var subscriptionId = $(this).attr('data-sid');
            $.ajax({
                type: "POST",
                url: '/virtual_class/decline/',
                data: {_method: 'DELETE', subscription_id: subscriptionId}
            });
        });

        //js added from here

        $('#end_session').on('click', function () {

            //alert('#end_session');
            $.ajax({
                type: "POST",
                url: '/virtual_class/end_session/',
                data: {_method: 'DELETE', virtual_class_id: virtualClassId},
                success: function (data) {
                    window.location.href = data.link;
                }
            });
        });

    }



    $(document).on('click','.start-conversation1', function(e){
        e.preventDefault();

        var subscription = $(this).data('subscription');
        window.location.href = "/conversations?sid="+subscription;
       

     });


$("#end_session_wrapt .close,.close_popup").on('click',function(){
    $('#end_session_wrap.fade').css({'opacity':0, 'display':'none'});
});



});
