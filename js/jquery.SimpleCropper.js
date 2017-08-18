// /* 
//     Author     : Tomaz Dragar
//     Mail       : <tomaz@dragar.net>
//     Homepage   : http://www.dragar.net
// */

// (function ($) {
// var client_window_width;
// var crop_wrap_width;
// var per = 45;




// $.fn.simpleCropper = function (onComplete) {
// client_window_width = $(window).width();
// console.log(client_window_width)
// if(client_window_width < 768)
// {
//     per = 80;
// }

// crop_wrap_width = (client_window_width * per)/100;
// $("#preview").css('width',client_window_width+8)
//         var image_dimension_x = crop_wrap_width;
//         var image_dimension_y = 600;
//         var scaled_width = 0;
//         var scaled_height = 0;
//         var x1 = 0;
//         var y1 = 0;
//         var x2 = 0;
//         var y2 = 0;
//         var current_image = null;
//         var image_filename = null;
//         var aspX = 1;
//         var aspY = 1;
//         var file_display_area = null;
//         var ias = null;
//         var original_data = null;
//         var jcrop_api;
//         var parent;
//         var checkingProgileImg;
//         var bottom_html = "<input type='file' id='fileInput' name='files[]'  style='display:none;'/><canvas id='myCanvas' style='display:none;'></canvas><div id='modal'></div><div id='preview'><div class='buttons'><div class='cancel'></div><div class='ok'></div></div></div>";
//         $('body').append(bottom_html);

//         //add click to element
//         this.click(function () {
//             parent= $(this).closest('.crop-image-box');
//             /*aspX = $('.cropme-wrap').width();
//             aspY = $('.cropme-wrap').height();*/
            
//             aspX = $(this).attr('data-imgwidth');
//             aspY = $(this).attr('data-imgheight');
//             checkingProgileImg=$(this).attr('data-isProfilePic');
//             console.log('aspXaspY');
//             console.log($(this));
//             /*aspX = 50;
//             aspY = 50;*/
//             file_display_area = $(this);
//             $('#fileInput').click();
//         });

//         $(document).ready(function () {
//             //capture selected filename
//             $('#fileInput').change(function (click) {
//                 imageUpload($('#preview').get(0));
//                 // Reset input value
//                 $(this).val("");
//             });

//             //o listener
//             $('.ok').click(function () {
//                  dataUrl = preview();
//                $('.hidden-base64 input').val(dataUrl)
                     
//                  console.log(dataUrl);
//                 $('#preview').delay(100).hide();
//                 $('#modal').hide();
//                 jcrop_api.destroy();
//                 reset();
//             });

//             //cancel listener
//             $('.cancel').click(function (event) {
//                 $('#preview').delay(100).hide();
//                 $('#modal').hide();
//                 jcrop_api.destroy();
//                 reset();
//             });
//         });

//         function reset() {
//             scaled_width = 0;
//             scaled_height = 0;
//             x1 = 0;
//             y1 = 0;
//             x2 = 0;
//             y2 = 0;
//             current_image = null;
//             image_filename = null;
//             original_data = null;
//             /*aspX = 150;
//             aspY = 150;*/
//             file_display_area = null;
//         }

//         function imageUpload(dropbox) {
//             var file = $("#fileInput").get(0).files[0];

//             var imageType = /image.*/;

//             if (file.type.match(imageType)) {
//                 var reader = new FileReader();
//                 image_filename = file.name;

//                 reader.onload = function (e) {
//                     // Clear the current image.
//                     $('#photo').remove();

//                     original_data = reader.result;
                    

//                     // Create a new image with image crop functionality
//                     current_image = new Image();
//                     current_image.src = reader.result;
//                     current_image.id = "photo";
//                     current_image.style['maxWidth'] = image_dimension_x + 'px';
//                     current_image.style['maxHeight'] = image_dimension_y + 'px';

                    
//                     current_image.onload = function () {

//                         // Calculate scaled image dimensions
                        
//                         var uploadedImgWidth=current_image.width;
//                         var uploadedImgHeight=current_image.height;
//                         console.log(uploadedImgWidth,uploadedImgHeight);
//                         if( (checkingProgileImg=='false') && (uploadedImgWidth<600 || uploadedImgHeight<400) ){
//                             alert('Image size is invalid, please upload 600 * 400 image');
//                             return;
//                         }
                        

//                         console.log(current_image.width,current_image.height);
//                         if (current_image.width > image_dimension_x || current_image.height > image_dimension_y) {
//                             if (current_image.width > current_image.height) {
//                                 scaled_width = image_dimension_x;
//                                 scaled_height = image_dimension_x * current_image.height / current_image.width;
//                             }
//                             if (current_image.width < current_image.height) {
//                                 scaled_height = image_dimension_y;
//                                 scaled_width = image_dimension_y * current_image.width / current_image.height;
//                             }
//                             if (current_image.width == current_image.height) {
//                                 scaled_width = image_dimension_x;
//                                 scaled_height = image_dimension_y;
//                             }
//                         }
//                         else {
//                             scaled_width = current_image.width;
//                             scaled_height = current_image.height;
//                         }


//                         // Position the modal div to the center of the screen
//                         $('#modal').css('display', 'block');
//                         var window_width = $(window).width() / 2 - scaled_width / 2 + "px";
//                         var window_height = $(window).height() / 2 - scaled_height / 2 + "px";

//                         // Show image in modal view
//                         $("#preview").css("top", window_height);
//                         $("#preview").css("left", window_width);
//                         $('#preview').show(500);


//                         // Calculate selection rect
//                         var selection_width = aspX;
//                         var selection_height = aspY;

//                         var max_x = Math.floor(scaled_height * aspX / aspY);
//                         var max_y = Math.floor(scaled_width * aspY / aspX);


//                         if (max_x > scaled_width) {
//                             selection_width = scaled_width;
//                             selection_height = max_y;
//                         }
//                         else {
//                             selection_width = max_x;
//                             selection_height = scaled_height;
//                         }

//                         ias = $(this).Jcrop({
//                             onSelect: showCoords,
//                             onChange: showCoords,
//                             bgColor: '#747474',
//                             bgOpacity: .4,
//                             aspectRatio: aspX / aspY,
//                             setSelect: [0, 0, selection_width, selection_height]
//                         }, function () {
//                             jcrop_api = this;
//                         });
//                     }

//                     // Add image to dropbox element
//                     dropbox.appendChild(current_image);
//                 }

//                 reader.readAsDataURL(file);
//             } else {
//                 dropbox.innerHTML = "File not supported!";
//             }
//         }

//         function showCoords(c) {
//             x1 = c.x;
//             y1 = c.y;
//             x2 = c.x2;
//             y2 = c.y2;
//         }

//         function preview() {
//             // Set canvas
//             var canvas = document.getElementById('myCanvas');
//             var context = canvas.getContext('2d');

//             // Delete previous image on canvas
//             context.clearRect(0, 0, canvas.width, canvas.height);

//             // Set selection width and height
//             var sw = x2 - x1;
//             var sh = y2 - y1;


//             // Set image original width and height
//             var imgWidth = current_image.naturalWidth;
//             var imgHeight = current_image.naturalHeight;

//             // Set selection koeficient
//             var kw = imgWidth / $("#preview").width();
//             var kh = imgHeight / $("#preview").height();

//             // Set canvas width and height and draw selection on it
//             canvas.width = aspX;
//             canvas.height = aspY;


//             context.drawImage(current_image, (x1 * kw), (y1 * kh), (sw * kw), (sh * kh), 0, 0, aspX, aspY);

//             // Convert canvas image to normal img
//             var dataUrl = canvas.toDataURL();
//             //var imageFoo = document.createElement('img');

//             if($(parent).find('.crop-align').hasClass('hidden')){
               
//                $(parent).find('.crop-align').removeClass('hidden')
//                 $(parent).find('.name-letter').addClass('hidden')
//             }
//             $('.crop-align').attr('src',dataUrl)


//             // Append it to the body element
//             $('#preview').delay(100).hide();
//             $('#modal').hide();
//             //file_display_area.html('');
//             //file_display_area.append(imageFoo);

//             if (onComplete) onComplete(
//                 {                    
//                     "original": { "filename": image_filename, "base64": original_data, "width": current_image.width, "height": current_image.height },
//                     "crop": { "x": (x1 * kw), "y": (y1 * kh), "width": (sw * kw), "height": (sh * kh) }
//                 }
//                );

//                 return dataUrl;
//         }

//         $(window).resize(function () {
//             // Position the modal div to the center of the screen
//             var window_width = $(window).width() / 2 - scaled_width / 2 + "px";
//             var window_height = $(window).height() / 2 - scaled_height / 2 + "px";

//             // Show image in modal view
//             $("#preview").css("top", window_height);
//             $("#preview").css("left", window_width);
//         });
//     }
// }(jQuery));


/* MINFIED JS */


(function(d){var b;var c;var a=45;d.fn.simpleCropper=function(z){b=d(window).width();console.log(b);if(b<768){a=80;}c=(b*a)/100;d("#preview").css("width",b+8);var o=c;var l=600;var w=0;var k=0;var y=0;var f=0;var x=0;var e=0;var g=null;var i=null;var j=1;var h=1;var t=null;var v=null;var r=null;var B;var p;var n;var m="<input type='file' id='fileInput' name='files[]'  style='display:none;'/><canvas id='myCanvas' style='display:none;'></canvas><div id='modal'></div><div id='preview'><div class='buttons'><div class='cancel'></div><div class='ok'></div></div></div>";d("body").append(m);this.click(function(){p=d(this).closest(".crop-image-box");j=d(this).attr("data-imgwidth");h=d(this).attr("data-imgheight");n=d(this).attr("data-isProfilePic");console.log("aspXaspY");console.log(d(this));t=d(this);d("#fileInput").click();});d(document).ready(function(){d("#fileInput").change(function(C){u(d("#preview").get(0));d(this).val("");});d(".ok").click(function(){dataUrl=s();d(".hidden-base64 input").val(dataUrl);console.log(dataUrl);d("#preview").delay(100).hide();d("#modal").hide();B.destroy();A();});d(".cancel").click(function(C){d("#preview").delay(100).hide();d("#modal").hide();B.destroy();A();});});function A(){w=0;k=0;y=0;f=0;x=0;e=0;g=null;i=null;r=null;t=null;}function u(D){var E=d("#fileInput").get(0).files[0];var F=/image.*/;if(E.type.match(F)){var C=new FileReader();i=E.name;C.onload=function(G){d("#photo").remove();r=C.result;g=new Image();g.src=C.result;g.id="photo";g.style.maxWidth=o+"px";g.style.maxHeight=l+"px";g.onload=function(){var I=g.width;var K=g.height;console.log(I,K);if((n=="false")&&(I<600||K<400)){alert("Image size is invalid, please upload 600 * 400 image");return;}console.log(g.width,g.height);if(g.width>o||g.height>l){if(g.width>g.height){w=o;k=o*g.height/g.width;}if(g.width<g.height){k=l;w=l*g.width/g.height;}if(g.width==g.height){w=o;k=l;}}else{w=g.width;k=g.height;}d("#modal").css("display","block");var H=d(window).width()/2-w/2+"px";var J=d(window).height()/2-k/2+"px";d("#preview").css("top",J);d("#preview").css("left",H);d("#preview").show(500);var M=j;var L=h;var O=Math.floor(k*j/h);var N=Math.floor(w*h/j);if(O>w){M=w;L=N;}else{M=O;L=k;}v=d(this).Jcrop({onSelect:q,onChange:q,bgColor:"#747474",bgOpacity:0.4,aspectRatio:j/h,setSelect:[0,0,M,L]},function(){B=this;});};D.appendChild(g);};C.readAsDataURL(E);}else{D.innerHTML="File not supported!";}}function q(C){y=C.x;f=C.y;x=C.x2;e=C.y2;}function s(){var D=document.getElementById("myCanvas");var C=D.getContext("2d");C.clearRect(0,0,D.width,D.height);var K=x-y;var F=e-f;var I=g.naturalWidth;var J=g.naturalHeight;var G=I/d("#preview").width();var E=J/d("#preview").height();D.width=j;D.height=h;C.drawImage(g,(y*G),(f*E),(K*G),(F*E),0,0,j,h);var H=D.toDataURL();if(d(p).find(".crop-align").hasClass("hidden")){d(p).find(".crop-align").removeClass("hidden");d(p).find(".name-letter").addClass("hidden");}d(".crop-align").attr("src",H);d("#preview").delay(100).hide();d("#modal").hide();if(z){z({original:{filename:i,base64:r,width:g.width,height:g.height},crop:{x:(y*G),y:(f*E),width:(K*G),height:(F*E)}});}return H;}d(window).resize(function(){var C=d(window).width()/2-w/2+"px";var D=d(window).height()/2-k/2+"px";d("#preview").css("top",D);d("#preview").css("left",C);});};}(jQuery));
