jQuery(document).ready(function() {
  var d = jQuery('#main_queries');
  d.scrollTop(d.prop("scrollHeight"));


  $(window).resize(function() {

    $('footer').removeAttr("style")
    $("#scrolltop").removeAttr('style');

    footer_align()

  })
  footer_align()

  function footer_align() {
    var docm_height = $(document).height();
    var wind_ht = $(window).height();


    if (docm_height == wind_ht) {

      $('footer').css({
        'position': 'fixed',
        'bottom': 0
      })
      $("#scrolltop").css('display', 'none')
    }

    $(document).on('keypress', '.text-area textarea', function(e) {

      if ((e.which && e.which == 13) || (e.keyCode && e.keyCode == 13)) {
          e.preventDefault();
          $('.button_send').click();
          $(this).blur()
        return;
      } else {
        return;
      }
    });



  }



  $(".paid-option-closed").on('click', function() {
    var parent = $(this);
    var id = $(this).attr('data-value');
    $.ajax({
      url: '/admins/financial_pay',
      type: 'POST',
      data: {
        id: id,
      },
      error: function() {
        alert('error');
      },
      success: function(result) {
        //alert('success');
        location.reload(true);
        // console.log($(this));
        //$(".paid-option-paid").css("display",'block')


      }
    })
  })
  $(".paid-option-pay-study").on('click', function() {
    var parent = $(this);
    var id = $(this).attr('data-value');
    $.ajax({
      url: '/admins/financial_pay_study',
      type: 'POST',
      data: {
        id: id,
      },
      error: function() {
        alert('error');
      },
      success: function(result) {
        //alert('success');
        location.reload(true);
        // console.log($(this));
        //$(".paid-option-paid").css("display",'block')


      }
    })
  })
  $(".paid-option-refund").on('click', function() {
    var parent = $(this);
    var id = $(this).attr('data-value');
    $.ajax({
      url: '/admins/financial_refund',
      type: 'POST',
      data: {
        id: id,
      },
      error: function() {
        alert('error');
      },
      success: function(result) {
        //alert('success');
        location.reload(true);
        // console.log($(this));
        //$(".paid-option-paid").css("display",'block')


      }
    })
  })
  $(".paid-option-refund-study").on('click', function() {
    var parent = $(this);
    var id = $(this).attr('data-value');
    $.ajax({
      url: '/admins/financial_refund_study',
      type: 'POST',
      data: {
        id: id,
      },
      error: function() {
        alert('error');
      },
      success: function(result) {
        //alert('success');
        location.reload(true);
        // console.log($(this));
        //$(".paid-option-paid").css("display",'block')


      }
    })
  })
  $('.block.courseitem h4.block_title').dotdotdot();

  $('.block_content.borderz h4').dotdotdot()


  $(".nano").nanoScroller({
    scroll: 'top',
    alwaysVisible: true
  });
  $(".course-queries.nano").nanoScroller({
    scroll: 'bottom',alwaysVisible: true,flash: true,disableResize: false
  });

  $(".chatboxhead.nano").nanoScroller({ scroll: 'bottom',alwaysVisible:true,flash: true,disableResize: false});

  $(".course_query_send .button_send").click(function(){
    var query_text = $(".course_query_message textarea").val();
    var file_attch = $(".course_query_message textarea").attr('data-file_att')

   if($.trim(query_text) == "" )
    {

      if($.trim(file_attch) == "no")
      {
        return false;
      }

    }
    else if($.trim(file_attch)!= "no" )
    {

      if($.trim(query_text) == "")
      {
        return false;
      }

    }
    else {

      return
    }
  })

  $("#study_material_study_material_type").attr({'data-validation':"required",'data-validation-error-msg':"Please select material type"})

  $('.news-filter').click(function(){
    var window_scroll = $(window).scrollTop();
    $(window).scrollTop(window_scroll)
     if(!$(this).parent().hasClass('open'))
     {
      var scroll_down = window_scroll + 70;
       $(window).scrollTop(scroll_down)
     }
  })

  $('.input').keypress(function (e) {
  if (e.which == 13) {
    $('form').submit();
    return false;    //<---- Add this line
  }


});

  $(".student_email").keypress(function (e) {
  if (e.which == 13) {
    hide_show_register();
    return false;    //<---- Add this line
  }


});




for (var i in CKEDITOR.instances) {
          CKEDITOR.instances[i].on('blur', function() {
            xyz = $(this)[0]
            var content_text = xyz['_']['editable']['$'].innerText;
            $('.ckeditor').removeClass('has-error');
            $('iframe').css('border',0)
            $('.ckeditor .form-error').remove()
            if($.trim(content_text) == '')
            {
              $('.ckeditor').addClass('has-error').append('<span class="help-block form-error">Please enter description</span>');
              $('iframe').css('border','1px solid #B94846')
            }


            
          });
            
    }

})
var _validFileExtensions = [".pdf", ".", ".htm", ".html", ".docx", "zip", "rar"];
var _validMediaExtensions = ["mp3", "mp4"];

function get_extension(val) {
  var filename = val;
  var lastIndex = filename.lastIndexOf("\\");
  if (lastIndex >= 0) {
    filename = filename.substring(lastIndex + 1);
  }
  document.getElementById('file_name').innerHTML = filename;
  var ext = val.replace(/^.*\./, '');
  var material = document.getElementById("study_material_study_material_type").value;
  /*var filename = val;
  var lastIndex = filename.lastIndexOf("\\");
  if (lastIndex >= 0) {
      filename = filename.substring(lastIndex + 1);
  }
  document.getElementById('file_name').innerHTML = filename;
  var ext = val.replace(/^.*\./, '');
  var material = document.getElementById("study_material_study_material_type").value;
  if (material == 'Question Paper' || material == 'Book') {
      // var re = /(\.pdf|\.doc|\.htm|\.html|\.docx|\.zip|\.rar)$/i;
      var regex = new RegExp("(.*?)\(docx|doc|pdf|xml|bmp|ppt|xls)$");
      if (!(regex.test(ext))) {
          alert('Please select correct file format');
          document.getElementById('file_name').innerHTML = '';
          $("#study_material_attachment").val("");

          return false;
      }
  } else if (material == 'Audio') {
      var regex = new RegExp("(.*?)\(mp3)$");
      if (!(regex.test(ext))) {
          alert('Please select mp3  file format');
          document.getElementById('file_name').innerHTML = '';
          $("#study_material_attachment").val("");

          return false;
      }
  } else if (material == 'Video') {
      var regex = new RegExp("(.*?)\(mp4)$");
      if (!(regex.test(ext))) {
          alert('Please select mp4 file format');
          document.getElementById('file_name').innerHTML = '';
          $("#study_material_attachment").val("");

          return false;
      }
  }*/


}

function ind() {
  document.getElementById('ind').style.display = "block";
  document.getElementById('orgs').style.display = "none";
}

function orgs() {

  document.getElementById('orgs').style.display = "block";
  document.getElementById('ind').style.display = "none";
}

function update_subscategories_div(parent_id) {
  var result = {},
    objectlength, select_options = ''
  var coach_id = document.getElementById('programme_coach_id').value;
  if (parent_id == '') {
    jQuery('#categoriesDiv').html('');

  } else {
    jQuery.ajax({
      url: "/coaches/get_subscategories/" + parent_id + ".json",
      type: "GET",
      data: {
        "parent_id": parent_id,
        "coach_id": coach_id
      },
      dataType: "html",
      success: function(data) {
        result = JSON.parse(data)
        objectlength = result.length
        for (var i = 0; i < objectlength; i++) {
          select_options += '<option value=' + result[i].id + '>' + result[i].name + '</option>'
        }
        jQuery('#categoriesDiv').html(select_options);
      }
    });
  }
}


function counter(msg) {
  document.getElementById('counter_div').innerHTML = msg.value.length;
}

function on_click() {
  var coachId = document.getElementById('msg-popup').getAttribute("data-id");
  document.getElementById('course_query_coach_id').value = coachId;
}

function atanu() {
  document.getElementById('mark_div').style.display = 'block';
  document.getElementById('rating_div').style.display = 'none';
  document.getElementById('rating_div1').style.display = 'block';

  jQuery('#rating-input').rating({
    min: 0,
    max: 5,
    step: 1,
    size: 'xs',
    showClear: false
  });


  jQuery('#rating-input').on('rating.change', function() {
    var coach_communication = jQuery('#rating-input').val();
    jQuery('#subscription_coach_communication').val(coach_communication)

  });

  jQuery('#rating-input1').rating({
    min: 0,
    max: 5,
    step: 1,
    size: 'xs',
    showClear: false
  });


  jQuery('#rating-input1').on('rating.change', function() {
    var course_as_described = jQuery('#rating-input1').val();
    jQuery('#subscription_course_as_described').val(course_as_described)
  });

  jQuery('#rating-input2').rating({
    min: 0,
    max: 5,
    step: 1,
    size: 'xs',
    showClear: false
  });


  jQuery('#rating-input2').on('rating.change', function() {
    var would_recommend = jQuery('#rating-input2').val();
    jQuery('#subscription_would_recommend').val(would_recommend)
  });
}

function update_chats_div(coach_id, uname, subscription) {
  var result = {},
    objectlength, chat_contents = '',
    name = ''
    if (uname)
    {
       if (uname.indexOf("hide") > -1)
       {
         jQuery("#reviewDiv").css("display", "none"); 
     }
     else
       {
         jQuery("#reviewDiv").show();
         jQuery("#subscription_id").val(subscription);

         jQuery("#rating_div").show();
         jQuery('#rateCoach1').html(uname + "'s Course");

         jQuery('#rateCoach').html('Rate ' + name);

         jQuery("#chat_coach_id").val(coach_id);
         jQuery("#reviewDiv").show();
     }
 }
    else
    {
     jQuery("#reviewDiv").show();
     jQuery("#subscription_id").val(subscription);

     jQuery("#rating_div").show();
     jQuery('#rateCoach1').html(uname + "'s Course");

     jQuery('#rateCoach').html('Rate ' + name);

     jQuery("#chat_coach_id").val(coach_id);
     jQuery("#reviewDiv").show();
 }
}

function submit_chats_div() {

  var result = {},
    objectlength, chat_contents = ''

  var val = jQuery("#new_chat").serialize();
  jQuery.ajax({
    url: "/students/save_chats",
    type: "POST",
    data: val,
    dataType: "html",
    success: function(data) {
      obj = JSON.parse(data);
      chat_contents = '<div style="float:right"><div class="col-md-12 line_height"><div class="col-md-1 col-xs-1 class_mar_pad"></div><img src="images/col.jpg" height="45" width="45" class="profile_pic_circle"/></div> <div class="col-md-11 col-xs-11 chat_margin"><p><b>Me</b></p> <p>' + obj.chats + '</p></div><div class="clearz"></div></div></div>'
      jQuery('#chatDiv').append(chat_contents);

      jQuery("#chatDiv").animate({
        scrollbottom: jQuery("#chatDiv")[0].scrollHeight
      }, 1000);

      jQuery("#chat_chats").val('');


    }
  });
  return false; // prevents normal behaviour

}

function approve_or_reject_coach() {
  var coachId = document.getElementById('msg-popup').getAttribute("data-id");
  var result = {},
    objectlength, coach_contents = ''
  jQuery.ajax({
    url: "/admins/coaches/" + coachId + ".json",
    type: "GET",
    data: {
      "id": coachId
    },
    dataType: "html",
    success: function(data) {
      result = JSON.parse(data)
        //alert(data);
      coach_contents += '<table><tr><td>Name :</td><td>' + result.name + '</td></tr></table>';
      jQuery('#coach_details').html(coach_contents);


    }
  });

}

function check_password() {
  if (document.getElementById('student_current_password').value == '') {
    alert("Please Enter Old Password");
    return false;
  }
  if (document.getElementById('student_password').value == '') {
    alert("Please Enter New Password");
    return false;
  }

  return true;
}

function check_payment() {
  if (document.getElementById('subscription_payment_type_paypal').value == '' || document.getElementById('subscription_payment_type_ccavenue').value == '') {
    alert("Please Select Payment Type");
    return false;
  }
  return true;
}

function view_details(val, info_id) {
  //var info_id=document.getElementById('msg-popup').getAttribute("data-id");
  var result = {},
    objectlength, info_contents = '';

  jQuery.ajax({
    url: "/students/update_news/" + info_id + ".json",
    type: "GET",
    data: {
      "id": info_id
    },
    dataType: "html",
    success: function(data) {
      result = JSON.parse(data);

      console.log('values are');
      console.log(result);
      info_contents = '<div id="title" style="margin-top: 0px !important;text-align: center;font-weight: bold;font-size: 20px; padding-bottom: 0px !important;padding: 0px!important;">' + result.title + '</div></b><div id="description">' + result.description + '</div>';
      jQuery('#info_id').html(info_contents);
      jQuery("#student_information_id").val(info_id);
      if (val == 2) {
        jQuery("#sdfsdvds").hide();
      } else {
        jQuery("#sdfsdvds").show();
      }
    }
  });

}
jQuery(document).ready(function() {
  jQuery('#coach_role_individual').click(function() {
    setTimeout(function() {
      jQuery(".category-scroll").getNiceScroll().resize();
    }, 100);
    jQuery('#coach_heading').html('Individual');
    jQuery('#linkd').show();
    jQuery('#univ').show();

    jQuery('#employee').hide();
    jQuery('#website').hide();
  });
  jQuery('#coach_role_organisation').click(function() {
    setTimeout(function() {
      jQuery(".category-scroll").getNiceScroll().resize();
    }, 100);
    jQuery('#coach_heading').html('Organisation');
    jQuery('#employee').show();
    jQuery('#website').show();
    jQuery('#linkd').hide();
    jQuery('#univ').hide();

  });

  jQuery.validate({
    
    modules: 'security',
    modules: 'file'
  });

  jQuery('#new_coach').submit(function() {

    var checkedLength = jQuery("input.category_checking:checked").length;
    //var emailblockReg = /^([\w-\.]+@(?!gmail.com)(?!rediff.com)(?!yahoo.com)(?!hotmail.com)(?!aol.com)([\w-]+\.)+[\w-]{2,4})?$/;
    var emailblockReg = ""

    var emailaddressVal = jQuery("#coach_email").val();
    if (!emailblockReg.test(emailaddressVal)) {
      jQuery("#validate_email_error").html('<span class="category_error">No public emails like Gmail,Yahoo,Rediff,hotmail.</span>');
      return false;

    } else {
      jQuery('#category-error').html('');

    }
    if (checkedLength == 0) {
      jQuery('#category-error').html('<span class="category_error">Please select atleast one category</span>');
      return false;
    } else {
      jQuery('#category-error').html('');
    }
  });

  jQuery(document).on('change', '.category_checking', function() {
    var checkedLength = jQuery("input.category_checking:checked").length;
    if (checkedLength > 0) {
      jQuery('#category-error').html('');
    } else {
      jQuery('#category-error').html('<span class="category_error">Please select atleast one category</span>');
    }
  })
  jQuery('#search_head').click(function() {
    if (document.getElementById('q').value == '') {
      alert("Please Enter keyword");
      return false;
    }
    //$(".menu form").submit();
    //$(".menu form").reset();
    //return true;

  });



  jQuery('#home_serach_index').click(function() {

    if (jQuery('#subid').css('display') == 'none') {
      jQuery("#subid").css("display", "block");
    } else if (jQuery('#subid').css('display') == 'block') {
      jQuery("#subid").css("display", "none");
    }
  });


});
jQuery(window).load(function() {

  jQuery.validate({
    modules: 'date,security'
  });

  $('#student_email').change(function() {

    var studentEmailId = jQuery('#student_email').val().trim();
    var isvalidEmailId = isValidEmailAddress(studentEmailId);
    $('.student_email .help-block.form-error').remove()
    $(this).css('border-color', '#ccc')
      //alert(isvalidEmailId);
    if ($(this).value == '' || isvalidEmailId == false) {
      $(this).css('border', '1px solid #B94A48')
      $(this).after('<span class="help-block form-error">Given email-id not correct </span>')
      $(this).focus()
      return false;
    }
  })

});

function hide_show_register() {

  var studentEmailId = jQuery('#student_email').val().trim();
  var isvalidEmailId = isValidEmailAddress(studentEmailId);
  $('.student_email .help-block.form-error').remove()
  $('#student_email').css('border-color', '#ccc')
    //alert(isvalidEmailId);
  if (document.getElementById('student_email').value == '' || isvalidEmailId == false) {
    document.getElementById('student_email').style.border = '1px solid #B94A48'
    $('#student_email').after('<span class="help-block form-error">Given email-id not correct </span>')
    $('#student_email').focus()
    return false;
  } else {
    jQuery("#first_div").hide();
    jQuery("#next_div").show();
  }


}

function isValidEmailAddress(emailAddress) {
  var pattern = /^([a-z\d!#$%&'*+\-\/=?^_`{|}~\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF]+(\.[a-z\d!#$%&'*+\-\/=?^_`{|}~\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF]+)*|"((([ \t]*\r\n)?[ \t]+)?([\x01-\x08\x0b\x0c\x0e-\x1f\x7f\x21\x23-\x5b\x5d-\x7e\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF]|\\[\x01-\x09\x0b\x0c\x0d-\x7f\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF]))*(([ \t]*\r\n)?[ \t]+)?")@(([a-z\d\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF]|[a-z\d\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF][a-z\d\-._~\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF]*[a-z\d\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])\.)+([a-z\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF]|[a-z\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF][a-z\d\-._~\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF]*[a-z\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])\.?$/i;
  return pattern.test(emailAddress);
};

function display_money() {
  // alert("hi");
}

function validate_query() {
  if (document.getElementById('course_query_message').value == '' && document.getElementById('course_query_attachment').value == '') {
    alert("Please Enter Queries");
    return false;
  }
  return true;
}

function search_details() {
  jQuery('#new_course_query').submit();


}

function news_sort(val) {
  //alert(val);
  document.getElementById('student_sort').value = val;
  jQuery('#sort_news').submit();


}

function price_sort(id, min, max) {
  var min_paisas = min;

  document.getElementById('programme_min').value = min_paisas;

  var max_paisas = max;
  document.getElementById('programme_max').value = max_paisas;
  jQuery("#" + id).prop("checked", true)

  jQuery('#sort_price').submit();


}

function price_material_sort(id, min, max) {
  var min_paisas = min;

  document.getElementById('study_material_min').value = min_paisas;

  var max_paisas = max;
  document.getElementById('study_material_max').value = max_paisas;
  jQuery("#" + id).prop("checked", true)

  jQuery('#sort_price').submit();


}

function count_notifications() {
  //var info_id=document.getElementById('msg-popup').getAttribute("data-id");
  var result = {},
    objectlength, info_contents = ''
  jQuery.ajax({
    url: "/admins/notification/" + info_id + ".json",
    type: "GET",
    data: {
      "id": info_id
    },
    dataType: "html",
    success: function(data) {
      result = JSON.parse(data)
      info_contents = '<div id="title" style="margin-top: 0px !important;text-align: center;font-weight: bold;font-size: 20px; padding-bottom: 0px !important;padding: 0px!important;">' + result.title + '</div></b><div id="description">' + result.description + '</div>';
      jQuery('#info_id').html(info_contents);
      jQuery("#student_information_id").val(info_id);
      if (val == 2) {
        jQuery("#sdfsdvds").hide();
      } else {
        jQuery("#sdfsdvds").show();
      }
    }
  });

}

function change_coach_notification_status(userId) {
  jQuery.ajax({
    url: "/coaches/update_notification/" + userId + ".json",
    type: "GET",
    data: {
      "id": userId
    },
    dataType: "html",
    success: function(data) {
      jQuery('#noti_count').hide();

    }
  });
}

function change_coach_message_status(userId) {
  jQuery.ajax({
    url: "/coaches/update_messages/" + userId + ".json",
    type: "GET",
    data: {
      "id": userId
    },
    dataType: "html",
    success: function(data) {
      jQuery('#noti_msg_count').hide();

    }
  });
}

function change_admin_notification_status(userId) {
  jQuery.ajax({
    url: "/admins/update_notification/" + userId + ".json",
    type: "GET",
    dataType: "html",
    success: function(data) {
      jQuery('#noti_count').hide();

    }
  });
}

function change_student_notification_status(userId) {
  jQuery.ajax({
    url: "/students/update_notification/" + userId + ".json",
    type: "GET",
    dataType: "html",
    success: function(data) {
      jQuery('#noti_count').hide();

    }
  });
}

function change_student_message_status(userId) {
  jQuery.ajax({
    url: "/students/update_message/" + userId + ".json",
    type: "GET",
    dataType: "html",
    success: function(data) {
      jQuery('#noti_msg_count').hide();

    }
  });
}

function download_notifications(d_id, s_id) {
  // alert(d_id);
  alert('download');
  //var info_id=document.getElementById('msg-popup').getAttribute("data-id");
  var result = {},
    objectlength, info_contents = ''
  jQuery.ajax({
    url: "/students/file_download/" + d_id + ".json",
    type: "GET",
    data: {
      "download_id": d_id,
      "study_id": s_id
    },
    dataType: "html",
    success: function(data) {

      result = JSON.parse(data)
      alert(data.study_material.attachment.url);
     $.fileDownload('/public/'+result.study_material.attachment.url);
      info_contents = 'Thank you for downloading';
      jQuery('#before_download').html(info_contents);

    }
  });

}

function rate_studymaterial(val, info_id) {
  jQuery('#download_id').val(info_id);
  jQuery('#rating-input').rating({
    min: 0,
    max: 5,
    step: 1,
    size: 'xs',
    showClear: false
  });


  jQuery('#rating-input').on('rating.change', function() {
    var coach_communication = jQuery('#rating-input').val();
    jQuery('#download_coach_communication').val(coach_communication)

  });

  jQuery('#rating-input1').rating({
    min: 0,
    max: 5,
    step: 1,
    size: 'xs',
    showClear: false
  });


  jQuery('#rating-input1').on('rating.change', function() {
    var course_as_described = jQuery('#rating-input1').val();
    jQuery('#download_course_as_described').val(course_as_described)
  });

  jQuery('#rating-input2').rating({
    min: 0,
    max: 5,
    step: 1,
    size: 'xs',
    showClear: false
  });


  jQuery('#rating-input2').on('rating.change', function() {
    var would_recommend = jQuery('#rating-input2').val();
    jQuery('#download_would_recommend').val(would_recommend)
  });

}

function validate_studymaterial() {
  if (document.getElementById('download_coach_communication').value == '') {
    alert("Please give rating to coach communication");
    return false;
  }
  if (document.getElementById('download_course_as_described').value == '') {
    alert("Please give rating to coach as described");
    return false;
  }
  if (document.getElementById('download_would_recommend').value == '') {
    alert("Please give rating to coach would recommend");
    return false;
  }
  if (document.getElementById('download_comments').value == '') {
    alert("Please enter some comments");
    return false;
  }
  return true;
}
var clicked = 0;

function update_download(d_id) {
  jQuery.ajax({
    url: "/students/file_download/" + d_id + ".json",
    type: "GET",
    data: {
      "download_id": d_id
    },
    dataType: "html",
    success: function(data) {
      //result = JSON.parse(data)
      //info_contents = 'Thank you for downloading';
      //jQuery('#before_download').html(info_contents);
      setTimeout(
          function(){

              location.reload()

          }, 1000
      )

    }
  });

}

function getStudentList(d_id, f_id) {
  var html_contents = ''
  jQuery.ajax({
    url: "/coaches/get_students/" + f_id + ".json",
    type: "GET",
    data: {
      "id": f_id
    },
    dataType: "html",
    success: function(data) {
      result = JSON.parse(data)
      objectlength = result.length
      html_contents = '';
      for (var i = 0; i < objectlength; i++) {
        html_contents += '<p style="border-bottom: solid #ccc 1px;">' + (i + 1) + "." + result[i].name + '</p>'
      }
      jQuery('#userDiv').html(html_contents);
    }
  });
}

jQuery(document).ready(function() {
  var html_contents = '',
    result, objectlength
  jQuery("#name").keyup(function() {
    var name = jQuery('#name').val();
    if (name == "") {
      jQuery("#display").html("");
    } else {
      jQuery.ajax({
        type: "get",
        url: "/admins/programmes/programme_list/" + name + ".json",
        success: function(data) {
          //alert(data)
          result = data
          objectlength = result.length
            //alert(objectlength)
          html_contents = '<ul class="list">';
          for (var i = 0; i < objectlength; i++) {
            html_contents += '<li><a href="programmes/' + result[i].slug + '">' + result[i].title + '</a></li>';
          }
          jQuery("#display").html(html_contents).show();
        }
      });
    }
  });


});

jQuery(document).ready(function() {
  var html_contents = '',
    result, objectlength
  jQuery("#sname").keyup(function() {
    var name = jQuery('#sname').val();
    var programme_id = jQuery('#programme_id').val();

    //alert(name)
    if (name == "") {
      jQuery("#sdisplay").html("");
    } else {
      jQuery.ajax({
        type: "get",
        url: "/admins/programmes/student_list/" + programme_id + "/" + name + ".json",
        success: function(data) {
          result = data
          objectlength = result.length
            //alert(objectlength)
          html_contents = '<ul class="list">';
          for (var i = 0; i < objectlength; i++) {
            html_contents += '<li><a href="get-history/' + result[i].subscription_id + '">' + result[i].name + '</a></li>';
          }
          jQuery("#sdisplay").html(html_contents).show();
        }
      });
    }
  });
});

function rate_subscription_by_admin(val, info_id) {
  jQuery('#subscription_id').val(info_id);
  jQuery('#rating-input').rating({
    min: 0,
    max: 5,
    step: 1,
    size: 'xs',
    showClear: false
  });


  jQuery('#rating-input').on('rating.change', function() {
    var coach_communication = jQuery('#rating-input').val();
    jQuery('#subscription_coach_communication').val(coach_communication)

  });

  jQuery('#rating-input1').rating({
    min: 0,
    max: 5,
    step: 1,
    size: 'xs',
    showClear: false
  });


  jQuery('#rating-input1').on('rating.change', function() {
    var course_as_described = jQuery('#rating-input1').val();
    jQuery('#subscription_course_as_described').val(course_as_described)
  });

  jQuery('#rating-input2').rating({
    min: 0,
    max: 5,
    step: 1,
    size: 'xs',
    showClear: false
  });


  jQuery('#rating-input2').on('rating.change', function() {
    var would_recommend = jQuery('#rating-input2').val();
    jQuery('#subscription_would_recommend').val(would_recommend)
  });

}


function goToLocation(val) {
  window.location = val;
}

function check_password(old, pass) {
  if (document.getElementById(old).value == '') {
    alert("Please enter current Password");
    return false;
  }
  if (document.getElementById(pass).value == '') {
    alert("New Password is not valid");
    return false;
  } else if (document.getElementById(pass).value.length < 8) {
    alert("Length size should be more than 8");
    return false;
  }
  return true;
}

function rate_subscription() {
  if (document.getElementById('subscription_coach_communication').value == '') {
    alert("Please give rating to coach communication");
    return false;
  }
  if (document.getElementById('subscription_course_as_described').value == '') {
    alert("Please give rating to coach as described");
    return false;
  }
  if (document.getElementById('subscription_would_recommend').value == '') {
    alert("Please give rating to coach would recommend");
    return false;
  }
  if (document.getElementById('subscription_comments').value == '') {
    alert("Please enter some comments");
    return false;
  }
  return true;
}

function update_material_subscategories_div(parent_id) {
  var result = {},
    objectlength, select_options = ''
  var coach_id = document.getElementById('study_material_coach_id').value;
  if (parent_id == '') {
    jQuery('#categoriesDiv').html('');

  } else {
    jQuery.ajax({
      url: "/coaches/get_subscategories/" + parent_id + ".json",
      type: "GET",
      data: {
        "parent_id": parent_id,
        "coach_id": coach_id
      },
      dataType: "html",
      success: function(data) {
        result = JSON.parse(data)
        objectlength = result.length
        for (var i = 0; i < objectlength; i++) {
          select_options += '<option value=' + result[i].id + '>' + result[i].name + '</option>'
        }
        jQuery('#categoriesDiv').html(select_options);
      }
    });
  }
}

function createCookie(name, value, days) {
  if (days) {
    var date = new Date();
    date.setTime(date.getTime() + (days * 24 * 60 * 60 * 1000));
    var expires = "; expires=" + date.toGMTString();
  } else var expires = "";
  document.cookie = name + "=" + value + expires + "; path=/";
}

function set_cookie_user() {
  createCookie('popup', 'true', 1);
  createCookie('coach_id', 'true', 1);

}

function readCookie(name) {
  var nameEQ = name + "=";
  var ca = document.cookie.split(';');
  for (var i = 0; i < ca.length; i++) {
    var c = ca[i];
    while (c.charAt(0) == ' ') c = c.substring(1, c.length);
    if (c.indexOf(nameEQ) == 0) return c.substring(nameEQ.length, c.length);
  }
  return null;
}

function eraseCookie(name) {
  createCookie(name, "", -1);
}
var x = readCookie('popup')

if (x) {
  jQuery(window).load(function() {
    jQuery('#myModal').modal('show');

  });
  eraseCookie('popup')
 
}


function course_query_file(val) {

  var filename = val;
  var lastIndex = filename.lastIndexOf("\\");
  if (lastIndex >= 0) {
    filename = filename.substring(lastIndex + 1);
  }
  jQuery('#file_name').show();
  document.getElementById('file_name').innerHTML = "<i class='fa fa-picture-o'></i><span class='file-name'>" + filename + "</span>&nbsp;&nbsp;<span id='fileLoader' style='display:none;'><img src='/images/loading.gif' style='height:15px; width:15px;'></span><span id='close_id' onclick='clear_fields();'></span>";
  $('.course_query_message textarea').focus();
  $('.course_query_message textarea').attr("data-file_att",'yes')

  // alert('heyy virtual');
}

function clear_fields() {
  jQuery('#file_name').hide();

  $("#course_query_attachment").val("");
  document.getElementById('file_name').innerHTML = '';
  $('.course_query_message textarea').attr("data-file_att",'no')
}

jQuery(document).ready(function() {
  var html_contents = '',
    result, objectlength
  jQuery("#query_text").keyup(function() {
    var name = jQuery('#query_text').val();
    if (name == "") {
      jQuery("#display").html("");
    } else {
      jQuery.ajax({
        type: "get",
        url: "/coaches/query_list/" + name + ".json",
        success: function(data) {
          //alert(data)
          result = data
          objectlength = result.length
            //alert(objectlength)
          html_contents = '<ul class="list">';
          for (var i = 0; i < objectlength; i++) {
            html_contents += '<li><a href="/coaches/course_queries/' + result[i].student_id + '">' + result[i].message.substring(0, 10) + '...</a></li>';
          }
          jQuery("#display").html(html_contents).show();
        }
      });
    }
  });


});

jQuery(document).ready(function() {
  var html_contents = '',
    result, objectlength
  jQuery("#squery_text").keyup(function() {
    var name = jQuery('#squery_text').val();
    if (name == "") {
      jQuery("#display").html("");
    } else {
      jQuery.ajax({
        type: "get",
        url: "/students/query_list_s/" + name + ".json",
        success: function(data) {
          //alert(data)
          result = data
          objectlength = result.length
            //alert(objectlength)
          html_contents = '<ul class="list">';
          for (var i = 0; i < objectlength; i++) {
            html_contents += '<li><a href="/students/course_queries/' + result[i].coach_id + '">' + result[i].message.substring(0, 10) + '...</a></li>';
          }
          jQuery("#display").html(html_contents).show();
        }
      });
    }
  });



jQuery(".noti_Container_class").click(function(){
setTimeout(function () {
           $('.nano').nanoScroller();
           $('.nano').nanoScroller({scroll: 'top',alwaysVisible: true});
           console.log("5678".toHHMMSS());
      }, 100);
})
});

