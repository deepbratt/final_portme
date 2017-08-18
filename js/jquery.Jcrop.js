// /**
//  * jquery.Jcrop.js v0.9.12
//  * jQuery Image Cropping Plugin - released under MIT License 
//  * Author: Kelly Hallman <khallman@gmail.com>
//  * http://github.com/tapmodo/Jcrop
//  * Copyright (c) 2008-2013 Tapmodo Interactive LLC {{{
//  *
//  * Permission is hereby granted, free of charge, to any person
//  * obtaining a copy of this software and associated documentation
//  * files (the "Software"), to deal in the Software without
//  * restriction, including without limitation the rights to use,
//  * copy, modify, merge, publish, distribute, sublicense, and/or sell
//  * copies of the Software, and to permit persons to whom the
//  * Software is furnished to do so, subject to the following
//  * conditions:
//  *
//  * The above copyright notice and this permission notice shall be
//  * included in all copies or substantial portions of the Software.
//  *
//  * THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND,
//  * EXPRESS OR IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES
//  * OF MERCHANTABILITY, FITNESS FOR A PARTICULAR PURPOSE AND
//  * NONINFRINGEMENT. IN NO EVENT SHALL THE AUTHORS OR COPYRIGHT
//  * HOLDERS BE LIABLE FOR ANY CLAIM, DAMAGES OR OTHER LIABILITY,
//  * WHETHER IN AN ACTION OF CONTRACT, TORT OR OTHERWISE, ARISING
//  * FROM, OUT OF OR IN CONNECTION WITH THE SOFTWARE OR THE USE OR
//  * OTHER DEALINGS IN THE SOFTWARE.
//  *
//  * }}}
//  */

// (function ($) {

//   $.Jcrop = function (obj, opt) {
//     var options = $.extend({}, $.Jcrop.defaults),
//         docOffset,
//         _ua = navigator.userAgent.toLowerCase(),
//         is_msie = /msie/.test(_ua),
//         ie6mode = /msie [1-6]\./.test(_ua);

//     // Internal Methods {{{
//     function px(n) {
//       return Math.round(n) + 'px';
//     }
//     function cssClass(cl) {
//       return options.baseClass + '-' + cl;
//     }
//     function supportsColorFade() {
//       return $.fx.step.hasOwnProperty('backgroundColor');
//     }
//     function getPos(obj) //{{{
//     {
//       var pos = $(obj).offset();
//       return [pos.left, pos.top];
//     }
//     //}}}
//     function mouseAbs(e) //{{{
//     {
//       return [(e.pageX - docOffset[0]), (e.pageY - docOffset[1])];
//     }
//     //}}}
//     function setOptions(opt) //{{{
//     {
//       if (typeof(opt) !== 'object') opt = {};
//       options = $.extend(options, opt);

//       $.each(['onChange','onSelect','onRelease','onDblClick'],function(i,e) {
//         if (typeof(options[e]) !== 'function') options[e] = function () {};
//       });
//     }
//     //}}}
//     function startDragMode(mode, pos, touch) //{{{
//     {
//       docOffset = getPos($img);
//       Tracker.setCursor(mode === 'move' ? mode : mode + '-resize');

//       if (mode === 'move') {
//         return Tracker.activateHandlers(createMover(pos), doneSelect, touch);
//       }

//       var fc = Coords.getFixed();
//       var opp = oppLockCorner(mode);
//       var opc = Coords.getCorner(oppLockCorner(opp));

//       Coords.setPressed(Coords.getCorner(opp));
//       Coords.setCurrent(opc);

//       Tracker.activateHandlers(dragmodeHandler(mode, fc), doneSelect, touch);
//     }
//     //}}}
//     function dragmodeHandler(mode, f) //{{{
//     {
//       return function (pos) {
//         if (!options.aspectRatio) {
//           switch (mode) {
//           case 'e':
//             pos[1] = f.y2;
//             break;
//           case 'w':
//             pos[1] = f.y2;
//             break;
//           case 'n':
//             pos[0] = f.x2;
//             break;
//           case 's':
//             pos[0] = f.x2;
//             break;
//           }
//         } else {
//           switch (mode) {
//           case 'e':
//             pos[1] = f.y + 1;
//             break;
//           case 'w':
//             pos[1] = f.y + 1;
//             break;
//           case 'n':
//             pos[0] = f.x + 1;
//             break;
//           case 's':
//             pos[0] = f.x + 1;
//             break;
//           }
//         }
//         Coords.setCurrent(pos);
//         Selection.update();
//       };
//     }
//     //}}}
//     function createMover(pos) //{{{
//     {
//       var lloc = pos;
//       KeyManager.watchKeys();

//       return function (pos) {
//         Coords.moveOffset([pos[0] - lloc[0], pos[1] - lloc[1]]);
//         lloc = pos;

//         Selection.update();
//       };
//     }
//     //}}}
//     function oppLockCorner(ord) //{{{
//     {
//       switch (ord) {
//       case 'n':
//         return 'sw';
//       case 's':
//         return 'nw';
//       case 'e':
//         return 'nw';
//       case 'w':
//         return 'ne';
//       case 'ne':
//         return 'sw';
//       case 'nw':
//         return 'se';
//       case 'se':
//         return 'nw';
//       case 'sw':
//         return 'ne';
//       }
//     }
//     //}}}
//     function createDragger(ord) //{{{
//     {
//       return function (e) {
//         if (options.disabled) {
//           return false;
//         }
//         if ((ord === 'move') && !options.allowMove) {
//           return false;
//         }
        
//         // Fix position of crop area when dragged the very first time.
//         // Necessary when crop image is in a hidden element when page is loaded.
//         docOffset = getPos($img);

//         btndown = true;
//         startDragMode(ord, mouseAbs(e));
//         e.stopPropagation();
//         e.preventDefault();
//         return false;
//       };
//     }
//     //}}}
//     function presize($obj, w, h) //{{{
//     {
//       var nw = $obj.width(),
//           nh = $obj.height();
//       if ((nw > w) && w > 0) {
//         nw = w;
//         nh = (w / $obj.width()) * $obj.height();
//       }
//       if ((nh > h) && h > 0) {
//         nh = h;
//         nw = (h / $obj.height()) * $obj.width();
//       }
//       xscale = $obj.width() / nw;
//       yscale = $obj.height() / nh;
//       $obj.width(nw).height(nh);
//     }
//     //}}}
//     function unscale(c) //{{{
//     {
//       return {
//         x: c.x * xscale,
//         y: c.y * yscale,
//         x2: c.x2 * xscale,
//         y2: c.y2 * yscale,
//         w: c.w * xscale,
//         h: c.h * yscale
//       };
//     }
//     //}}}
//     function doneSelect(pos) //{{{
//     {
//       var c = Coords.getFixed();
//       if ((c.w > options.minSelect[0]) && (c.h > options.minSelect[1])) {
//         Selection.enableHandles();
//         Selection.done();
//       } else {
//         Selection.release();
//       }
//       Tracker.setCursor(options.allowSelect ? 'crosshair' : 'default');
//     }
//     //}}}
//     function newSelection(e) //{{{
//     {
//       if (options.disabled) {
//         return false;
//       }
//       if (!options.allowSelect) {
//         return false;
//       }
//       btndown = true;
//       docOffset = getPos($img);
//       Selection.disableHandles();
//       Tracker.setCursor('crosshair');
//       var pos = mouseAbs(e);
//       Coords.setPressed(pos);
//       Selection.update();
//       Tracker.activateHandlers(selectDrag, doneSelect, e.type.substring(0,5)==='touch');
//       KeyManager.watchKeys();

//       e.stopPropagation();
//       e.preventDefault();
//       return false;
//     }
//     //}}}
//     function selectDrag(pos) //{{{
//     {
//       Coords.setCurrent(pos);
//       Selection.update();
//     }
//     //}}}
//     function newTracker() //{{{
//     {
//       var trk = $('<div></div>').addClass(cssClass('tracker'));
//       if (is_msie) {
//         trk.css({
//           opacity: 0,
//           backgroundColor: 'white'
//         });
//       }
//       return trk;
//     }
//     //}}}

//     // }}}
//     // Initialization {{{
//     // Sanitize some options {{{
//     if (typeof(obj) !== 'object') {
//       obj = $(obj)[0];
//     }
//     if (typeof(opt) !== 'object') {
//       opt = {};
//     }
//     // }}}
//     setOptions(opt);
//     // Initialize some jQuery objects {{{
//     // The values are SET on the image(s) for the interface
//     // If the original image has any of these set, they will be reset
//     // However, if you destroy() the Jcrop instance the original image's
//     // character in the DOM will be as you left it.
//     var img_css = {
//       border: 'none',
//       visibility: 'visible',
//       margin: 0,
//       padding: 0,
//       position: 'absolute',
//       top: 0,
//       left: 0
//     };

//     var $origimg = $(obj),
//       img_mode = true;

//     if (obj.tagName == 'IMG') {
//       // Fix size of crop image.
//       // Necessary when crop image is within a hidden element when page is loaded.
//       if ($origimg[0].width != 0 && $origimg[0].height != 0) {
//         // Obtain dimensions from contained img element.
//         $origimg.width($origimg[0].width);
//         $origimg.height($origimg[0].height);
//       } else {
//         // Obtain dimensions from temporary image in case the original is not loaded yet (e.g. IE 7.0). 
//         var tempImage = new Image();
//         tempImage.src = $origimg[0].src;
//         $origimg.width(tempImage.width);
//         $origimg.height(tempImage.height);
//       } 

//       var $img = $origimg.clone().removeAttr('id').css(img_css).show();

//       $img.width($origimg.width());
//       $img.height($origimg.height());
//       $origimg.after($img).hide();

//     } else {
//       $img = $origimg.css(img_css).show();
//       img_mode = false;
//       if (options.shade === null) { options.shade = true; }
//     }

//     presize($img, options.boxWidth, options.boxHeight);

//     var boundx = $img.width(),
//         boundy = $img.height(),
        
        
//         $div = $('<div />').width(boundx).height(boundy).addClass(cssClass('holder')).css({
//         position: 'relative',
//         backgroundColor: options.bgColor
//       }).insertAfter($origimg).append($img);

//     if (options.addClass) {
//       $div.addClass(options.addClass);
//     }

//     var $img2 = $('<div />'),

//         $img_holder = $('<div />') 
//         .width('100%').height('100%').css({
//           zIndex: 310,
//           position: 'absolute',
//           overflow: 'hidden'
//         }),

//         $hdl_holder = $('<div />') 
//         .width('100%').height('100%').css('zIndex', 320), 

//         $sel = $('<div />') 
//         .css({
//           position: 'absolute',
//           zIndex: 600
//         }).dblclick(function(){
//           var c = Coords.getFixed();
//           options.onDblClick.call(api,c);
//         }).insertBefore($img).append($img_holder, $hdl_holder); 

//     if (img_mode) {

//       $img2 = $('<img />')
//           .attr('src', $img.attr('src')).css(img_css).width(boundx).height(boundy),

//       $img_holder.append($img2);

//     }

//     if (ie6mode) {
//       $sel.css({
//         overflowY: 'hidden'
//       });
//     }

//     var bound = options.boundary;
//     var $trk = newTracker().width(boundx + (bound * 2)).height(boundy + (bound * 2)).css({
//       position: 'absolute',
//       top: px(-bound),
//       left: px(-bound),
//       zIndex: 290
//     }).mousedown(newSelection);

//     /* }}} */
//     // Set more variables {{{
//     var bgcolor = options.bgColor,
//         bgopacity = options.bgOpacity,
//         xlimit, ylimit, xmin, ymin, xscale, yscale, enabled = true,
//         btndown, animating, shift_down;

//     docOffset = getPos($img);
//     // }}}
//     // }}}
//     // Internal Modules {{{
//     // Touch Module {{{ 
//     var Touch = (function () {
//       // Touch support detection function adapted (under MIT License)
//       // from code by Jeffrey Sambells - http://github.com/iamamused/
//       function hasTouchSupport() {
//         var support = {}, events = ['touchstart', 'touchmove', 'touchend'],
//             el = document.createElement('div'), i;

//         try {
//           for(i=0; i<events.length; i++) {
//             var eventName = events[i];
//             eventName = 'on' + eventName;
//             var isSupported = (eventName in el);
//             if (!isSupported) {
//               el.setAttribute(eventName, 'return;');
//               isSupported = typeof el[eventName] == 'function';
//             }
//             support[events[i]] = isSupported;
//           }
//           return support.touchstart && support.touchend && support.touchmove;
//         }
//         catch(err) {
//           return false;
//         }
//       }

//       function detectSupport() {
//         if ((options.touchSupport === true) || (options.touchSupport === false)) return options.touchSupport;
//           else return hasTouchSupport();
//       }
//       return {
//         createDragger: function (ord) {
//           return function (e) {
//             if (options.disabled) {
//               return false;
//             }
//             if ((ord === 'move') && !options.allowMove) {
//               return false;
//             }
//             docOffset = getPos($img);
//             btndown = true;
//             startDragMode(ord, mouseAbs(Touch.cfilter(e)), true);
//             e.stopPropagation();
//             e.preventDefault();
//             return false;
//           };
//         },
//         newSelection: function (e) {
//           return newSelection(Touch.cfilter(e));
//         },
//         cfilter: function (e){
//           e.pageX = e.originalEvent.changedTouches[0].pageX;
//           e.pageY = e.originalEvent.changedTouches[0].pageY;
//           return e;
//         },
//         isSupported: hasTouchSupport,
//         support: detectSupport()
//       };
//     }());
//     // }}}
//     // Coords Module {{{
//     var Coords = (function () {
//       var x1 = 0,
//           y1 = 0,
//           x2 = 0,
//           y2 = 0,
//           ox, oy;

//       function setPressed(pos) //{{{
//       {
//         pos = rebound(pos);
//         x2 = x1 = pos[0];
//         y2 = y1 = pos[1];
//       }
//       //}}}
//       function setCurrent(pos) //{{{
//       {
//         pos = rebound(pos);
//         ox = pos[0] - x2;
//         oy = pos[1] - y2;
//         x2 = pos[0];
//         y2 = pos[1];
//       }
//       //}}}
//       function getOffset() //{{{
//       {
//         return [ox, oy];
//       }
//       //}}}
//       function moveOffset(offset) //{{{
//       {
//         var ox = offset[0],
//             oy = offset[1];

//         if (0 > x1 + ox) {
//           ox -= ox + x1;
//         }
//         if (0 > y1 + oy) {
//           oy -= oy + y1;
//         }

//         if (boundy < y2 + oy) {
//           oy += boundy - (y2 + oy);
//         }
//         if (boundx < x2 + ox) {
//           ox += boundx - (x2 + ox);
//         }

//         x1 += ox;
//         x2 += ox;
//         y1 += oy;
//         y2 += oy;
//       }
//       //}}}
//       function getCorner(ord) //{{{
//       {
//         var c = getFixed();
//         switch (ord) {
//         case 'ne':
//           return [c.x2, c.y];
//         case 'nw':
//           return [c.x, c.y];
//         case 'se':
//           return [c.x2, c.y2];
//         case 'sw':
//           return [c.x, c.y2];
//         }
//       }
//       //}}}
//       function getFixed() //{{{
//       {
//         if (!options.aspectRatio) {
//           return getRect();
//         }
//         // This function could use some optimization I think...
//         var aspect = options.aspectRatio,
//             min_x = options.minSize[0] / xscale,
            
            
//             //min_y = options.minSize[1]/yscale,
//             max_x = options.maxSize[0] / xscale,
//             max_y = options.maxSize[1] / yscale,
//             rw = x2 - x1,
//             rh = y2 - y1,
//             rwa = Math.abs(rw),
//             rha = Math.abs(rh),
//             real_ratio = rwa / rha,
//             xx, yy, w, h;

//         if (max_x === 0) {
//           max_x = boundx * 10;
//         }
//         if (max_y === 0) {
//           max_y = boundy * 10;
//         }
//         if (real_ratio < aspect) {
//           yy = y2;
//           w = rha * aspect;
//           xx = rw < 0 ? x1 - w : w + x1;

//           if (xx < 0) {
//             xx = 0;
//             h = Math.abs((xx - x1) / aspect);
//             yy = rh < 0 ? y1 - h : h + y1;
//           } else if (xx > boundx) {
//             xx = boundx;
//             h = Math.abs((xx - x1) / aspect);
//             yy = rh < 0 ? y1 - h : h + y1;
//           }
//         } else {
//           xx = x2;
//           h = rwa / aspect;
//           yy = rh < 0 ? y1 - h : y1 + h;
//           if (yy < 0) {
//             yy = 0;
//             w = Math.abs((yy - y1) * aspect);
//             xx = rw < 0 ? x1 - w : w + x1;
//           } else if (yy > boundy) {
//             yy = boundy;
//             w = Math.abs(yy - y1) * aspect;
//             xx = rw < 0 ? x1 - w : w + x1;
//           }
//         }

//         // Magic %-)
//         if (xx > x1) { // right side
//           if (xx - x1 < min_x) {
//             xx = x1 + min_x;
//           } else if (xx - x1 > max_x) {
//             xx = x1 + max_x;
//           }
//           if (yy > y1) {
//             yy = y1 + (xx - x1) / aspect;
//           } else {
//             yy = y1 - (xx - x1) / aspect;
//           }
//         } else if (xx < x1) { // left side
//           if (x1 - xx < min_x) {
//             xx = x1 - min_x;
//           } else if (x1 - xx > max_x) {
//             xx = x1 - max_x;
//           }
//           if (yy > y1) {
//             yy = y1 + (x1 - xx) / aspect;
//           } else {
//             yy = y1 - (x1 - xx) / aspect;
//           }
//         }

//         if (xx < 0) {
//           x1 -= xx;
//           xx = 0;
//         } else if (xx > boundx) {
//           x1 -= xx - boundx;
//           xx = boundx;
//         }

//         if (yy < 0) {
//           y1 -= yy;
//           yy = 0;
//         } else if (yy > boundy) {
//           y1 -= yy - boundy;
//           yy = boundy;
//         }

//         return makeObj(flipCoords(x1, y1, xx, yy));
//       }
//       //}}}
//       function rebound(p) //{{{
//       {
//         if (p[0] < 0) p[0] = 0;
//         if (p[1] < 0) p[1] = 0;

//         if (p[0] > boundx) p[0] = boundx;
//         if (p[1] > boundy) p[1] = boundy;

//         return [Math.round(p[0]), Math.round(p[1])];
//       }
//       //}}}
//       function flipCoords(x1, y1, x2, y2) //{{{
//       {
//         var xa = x1,
//             xb = x2,
//             ya = y1,
//             yb = y2;
//         if (x2 < x1) {
//           xa = x2;
//           xb = x1;
//         }
//         if (y2 < y1) {
//           ya = y2;
//           yb = y1;
//         }
//         return [xa, ya, xb, yb];
//       }
//       //}}}
//       function getRect() //{{{
//       {
//         var xsize = x2 - x1,
//             ysize = y2 - y1,
//             delta;

//         if (xlimit && (Math.abs(xsize) > xlimit)) {
//           x2 = (xsize > 0) ? (x1 + xlimit) : (x1 - xlimit);
//         }
//         if (ylimit && (Math.abs(ysize) > ylimit)) {
//           y2 = (ysize > 0) ? (y1 + ylimit) : (y1 - ylimit);
//         }

//         if (ymin / yscale && (Math.abs(ysize) < ymin / yscale)) {
//           y2 = (ysize > 0) ? (y1 + ymin / yscale) : (y1 - ymin / yscale);
//         }
//         if (xmin / xscale && (Math.abs(xsize) < xmin / xscale)) {
//           x2 = (xsize > 0) ? (x1 + xmin / xscale) : (x1 - xmin / xscale);
//         }

//         if (x1 < 0) {
//           x2 -= x1;
//           x1 -= x1;
//         }
//         if (y1 < 0) {
//           y2 -= y1;
//           y1 -= y1;
//         }
//         if (x2 < 0) {
//           x1 -= x2;
//           x2 -= x2;
//         }
//         if (y2 < 0) {
//           y1 -= y2;
//           y2 -= y2;
//         }
//         if (x2 > boundx) {
//           delta = x2 - boundx;
//           x1 -= delta;
//           x2 -= delta;
//         }
//         if (y2 > boundy) {
//           delta = y2 - boundy;
//           y1 -= delta;
//           y2 -= delta;
//         }
//         if (x1 > boundx) {
//           delta = x1 - boundy;
//           y2 -= delta;
//           y1 -= delta;
//         }
//         if (y1 > boundy) {
//           delta = y1 - boundy;
//           y2 -= delta;
//           y1 -= delta;
//         }

//         return makeObj(flipCoords(x1, y1, x2, y2));
//       }
//       //}}}
//       function makeObj(a) //{{{
//       {
//         return {
//           x: a[0],
//           y: a[1],
//           x2: a[2],
//           y2: a[3],
//           w: a[2] - a[0],
//           h: a[3] - a[1]
//         };
//       }
//       //}}}

//       return {
//         flipCoords: flipCoords,
//         setPressed: setPressed,
//         setCurrent: setCurrent,
//         getOffset: getOffset,
//         moveOffset: moveOffset,
//         getCorner: getCorner,
//         getFixed: getFixed
//       };
//     }());

//     //}}}
//     // Shade Module {{{
//     var Shade = (function() {
//       var enabled = false,
//           holder = $('<div />').css({
//             position: 'absolute',
//             zIndex: 240,
//             opacity: 0
//           }),
//           shades = {
//             top: createShade(),
//             left: createShade().height(boundy),
//             right: createShade().height(boundy),
//             bottom: createShade()
//           };

//       function resizeShades(w,h) {
//         shades.left.css({ height: px(h) });
//         shades.right.css({ height: px(h) });
//       }
//       function updateAuto()
//       {
//         return updateShade(Coords.getFixed());
//       }
//       function updateShade(c)
//       {
//         shades.top.css({
//           left: px(c.x),
//           width: px(c.w),
//           height: px(c.y)
//         });
//         shades.bottom.css({
//           top: px(c.y2),
//           left: px(c.x),
//           width: px(c.w),
//           height: px(boundy-c.y2)
//         });
//         shades.right.css({
//           left: px(c.x2),
//           width: px(boundx-c.x2)
//         });
//         shades.left.css({
//           width: px(c.x)
//         });
//       }
//       function createShade() {
//         return $('<div />').css({
//           position: 'absolute',
//           backgroundColor: options.shadeColor||options.bgColor
//         }).appendTo(holder);
//       }
//       function enableShade() {
//         if (!enabled) {
//           enabled = true;
//           holder.insertBefore($img);
//           updateAuto();
//           Selection.setBgOpacity(1,0,1);
//           $img2.hide();

//           setBgColor(options.shadeColor||options.bgColor,1);
//           if (Selection.isAwake())
//           {
//             setOpacity(options.bgOpacity,1);
//           }
//             else setOpacity(1,1);
//         }
//       }
//       function setBgColor(color,now) {
//         colorChangeMacro(getShades(),color,now);
//       }
//       function disableShade() {
//         if (enabled) {
//           holder.remove();
//           $img2.show();
//           enabled = false;
//           if (Selection.isAwake()) {
//             Selection.setBgOpacity(options.bgOpacity,1,1);
//           } else {
//             Selection.setBgOpacity(1,1,1);
//             Selection.disableHandles();
//           }
//           colorChangeMacro($div,0,1);
//         }
//       }
//       function setOpacity(opacity,now) {
//         if (enabled) {
//           if (options.bgFade && !now) {
//             holder.animate({
//               opacity: 1-opacity
//             },{
//               queue: false,
//               duration: options.fadeTime
//             });
//           }
//           else holder.css({opacity:1-opacity});
//         }
//       }
//       function refreshAll() {
//         options.shade ? enableShade() : disableShade();
//         if (Selection.isAwake()) setOpacity(options.bgOpacity);
//       }
//       function getShades() {
//         return holder.children();
//       }

//       return {
//         update: updateAuto,
//         updateRaw: updateShade,
//         getShades: getShades,
//         setBgColor: setBgColor,
//         enable: enableShade,
//         disable: disableShade,
//         resize: resizeShades,
//         refresh: refreshAll,
//         opacity: setOpacity
//       };
//     }());
//     // }}}
//     // Selection Module {{{
//     var Selection = (function () {
//       var awake,
//           hdep = 370,
//           borders = {},
//           handle = {},
//           dragbar = {},
//           seehandles = false;

//       // Private Methods
//       function insertBorder(type) //{{{
//       {
//         var jq = $('<div />').css({
//           position: 'absolute',
//           opacity: options.borderOpacity
//         }).addClass(cssClass(type));
//         $img_holder.append(jq);
//         return jq;
//       }
//       //}}}
//       function dragDiv(ord, zi) //{{{
//       {
//         var jq = $('<div />').mousedown(createDragger(ord)).css({
//           cursor: ord + '-resize',
//           position: 'absolute',
//           zIndex: zi
//         }).addClass('ord-'+ord);

//         if (Touch.support) {
//           jq.bind('touchstart.jcrop', Touch.createDragger(ord));
//         }

//         $hdl_holder.append(jq);
//         return jq;
//       }
//       //}}}
//       function insertHandle(ord) //{{{
//       {
//         var hs = options.handleSize,

//           div = dragDiv(ord, hdep++).css({
//             opacity: options.handleOpacity
//           }).addClass(cssClass('handle'));

//         if (hs) { div.width(hs).height(hs); }

//         return div;
//       }
//       //}}}
//       function insertDragbar(ord) //{{{
//       {
//         return dragDiv(ord, hdep++).addClass('jcrop-dragbar');
//       }
//       //}}}
//       function createDragbars(li) //{{{
//       {
//         var i;
//         for (i = 0; i < li.length; i++) {
//           dragbar[li[i]] = insertDragbar(li[i]);
//         }
//       }
//       //}}}
//       function createBorders(li) //{{{
//       {
//         var cl,i;
//         for (i = 0; i < li.length; i++) {
//           switch(li[i]){
//             case'n': cl='hline'; break;
//             case's': cl='hline bottom'; break;
//             case'e': cl='vline right'; break;
//             case'w': cl='vline'; break;
//           }
//           borders[li[i]] = insertBorder(cl);
//         }
//       }
//       //}}}
//       function createHandles(li) //{{{
//       {
//         var i;
//         for (i = 0; i < li.length; i++) {
//           handle[li[i]] = insertHandle(li[i]);
//         }
//       }
//       //}}}
//       function moveto(x, y) //{{{
//       {
//         if (!options.shade) {
//           $img2.css({
//             top: px(-y),
//             left: px(-x)
//           });
//         }
//         $sel.css({
//           top: px(y),
//           left: px(x)
//         });
//       }
//       //}}}
//       function resize(w, h) //{{{
//       {
//         $sel.width(Math.round(w)).height(Math.round(h));
//       }
//       //}}}
//       function refresh() //{{{
//       {
//         var c = Coords.getFixed();

//         Coords.setPressed([c.x, c.y]);
//         Coords.setCurrent([c.x2, c.y2]);

//         updateVisible();
//       }
//       //}}}

//       // Internal Methods
//       function updateVisible(select) //{{{
//       {
//         if (awake) {
//           return update(select);
//         }
//       }
//       //}}}
//       function update(select) //{{{
//       {
//         var c = Coords.getFixed();

//         resize(c.w, c.h);
//         moveto(c.x, c.y);
//         if (options.shade) Shade.updateRaw(c);

//         awake || show();

//         if (select) {
//           options.onSelect.call(api, unscale(c));
//         } else {
//           options.onChange.call(api, unscale(c));
//         }
//       }
//       //}}}
//       function setBgOpacity(opacity,force,now) //{{{
//       {
//         if (!awake && !force) return;
//         if (options.bgFade && !now) {
//           $img.animate({
//             opacity: opacity
//           },{
//             queue: false,
//             duration: options.fadeTime
//           });
//         } else {
//           $img.css('opacity', opacity);
//         }
//       }
//       //}}}
//       function show() //{{{
//       {
//         $sel.show();

//         if (options.shade) Shade.opacity(bgopacity);
//           else setBgOpacity(bgopacity,true);

//         awake = true;
//       }
//       //}}}
//       function release() //{{{
//       {
//         disableHandles();
//         $sel.hide();

//         if (options.shade) Shade.opacity(1);
//           else setBgOpacity(1);

//         awake = false;
//         options.onRelease.call(api);
//       }
//       //}}}
//       function showHandles() //{{{
//       {
//         if (seehandles) {
//           $hdl_holder.show();
//         }
//       }
//       //}}}
//       function enableHandles() //{{{
//       {
//         seehandles = true;
//         if (options.allowResize) {
//           $hdl_holder.show();
//           return true;
//         }
//       }
//       //}}}
//       function disableHandles() //{{{
//       {
//         seehandles = false;
//         $hdl_holder.hide();
//       } 
//       //}}}
//       function animMode(v) //{{{
//       {
//         if (v) {
//           animating = true;
//           disableHandles();
//         } else {
//           animating = false;
//           enableHandles();
//         }
//       } 
//       //}}}
//       function done() //{{{
//       {
//         animMode(false);
//         refresh();
//       } 
//       //}}}
//       // Insert draggable elements {{{
//       // Insert border divs for outline

//       if (options.dragEdges && $.isArray(options.createDragbars))
//         createDragbars(options.createDragbars);

//       if ($.isArray(options.createHandles))
//         createHandles(options.createHandles);

//       if (options.drawBorders && $.isArray(options.createBorders))
//         createBorders(options.createBorders);

//       //}}}

//       // This is a hack for iOS5 to support drag/move touch functionality
//       $(document).bind('touchstart.jcrop-ios',function(e) {
//         if ($(e.currentTarget).hasClass('jcrop-tracker')) e.stopPropagation();
//       });

//       var $track = newTracker().mousedown(createDragger('move')).css({
//         cursor: 'move',
//         position: 'absolute',
//         zIndex: 360
//       });

//       if (Touch.support) {
//         $track.bind('touchstart.jcrop', Touch.createDragger('move'));
//       }

//       $img_holder.append($track);
//       disableHandles();

//       return {
//         updateVisible: updateVisible,
//         update: update,
//         release: release,
//         refresh: refresh,
//         isAwake: function () {
//           return awake;
//         },
//         setCursor: function (cursor) {
//           $track.css('cursor', cursor);
//         },
//         enableHandles: enableHandles,
//         enableOnly: function () {
//           seehandles = true;
//         },
//         showHandles: showHandles,
//         disableHandles: disableHandles,
//         animMode: animMode,
//         setBgOpacity: setBgOpacity,
//         done: done
//       };
//     }());
    
//     //}}}
//     // Tracker Module {{{
//     var Tracker = (function () {
//       var onMove = function () {},
//           onDone = function () {},
//           trackDoc = options.trackDocument;

//       function toFront(touch) //{{{
//       {
//         $trk.css({
//           zIndex: 450
//         });

//         if (touch)
//           $(document)
//             .bind('touchmove.jcrop', trackTouchMove)
//             .bind('touchend.jcrop', trackTouchEnd);

//         else if (trackDoc)
//           $(document)
//             .bind('mousemove.jcrop',trackMove)
//             .bind('mouseup.jcrop',trackUp);
//       } 
//       //}}}
//       function toBack() //{{{
//       {
//         $trk.css({
//           zIndex: 290
//         });
//         $(document).unbind('.jcrop');
//       } 
//       //}}}
//       function trackMove(e) //{{{
//       {
//         onMove(mouseAbs(e));
//         return false;
//       } 
//       //}}}
//       function trackUp(e) //{{{
//       {
//         e.preventDefault();
//         e.stopPropagation();

//         if (btndown) {
//           btndown = false;

//           onDone(mouseAbs(e));

//           if (Selection.isAwake()) {
//             options.onSelect.call(api, unscale(Coords.getFixed()));
//           }

//           toBack();
//           onMove = function () {};
//           onDone = function () {};
//         }

//         return false;
//       }
//       //}}}
//       function activateHandlers(move, done, touch) //{{{
//       {
//         btndown = true;
//         onMove = move;
//         onDone = done;
//         toFront(touch);
//         return false;
//       }
//       //}}}
//       function trackTouchMove(e) //{{{
//       {
//         onMove(mouseAbs(Touch.cfilter(e)));
//         return false;
//       }
//       //}}}
//       function trackTouchEnd(e) //{{{
//       {
//         return trackUp(Touch.cfilter(e));
//       }
//       //}}}
//       function setCursor(t) //{{{
//       {
//         $trk.css('cursor', t);
//       }
//       //}}}

//       if (!trackDoc) {
//         $trk.mousemove(trackMove).mouseup(trackUp).mouseout(trackUp);
//       }

//       $img.before($trk);
//       return {
//         activateHandlers: activateHandlers,
//         setCursor: setCursor
//       };
//     }());
//     //}}}
//     // KeyManager Module {{{
//     var KeyManager = (function () {
//       var $keymgr = $('<input type="radio" />').css({
//         position: 'fixed',
//         left: '-120px',
//         width: '12px'
//       }).addClass('jcrop-keymgr'),

//         $keywrap = $('<div />').css({
//           position: 'absolute',
//           overflow: 'hidden'
//         }).append($keymgr);

//       function watchKeys() //{{{
//       {
//         if (options.keySupport) {
//           $keymgr.show();
//           $keymgr.focus();
//         }
//       }
//       //}}}
//       function onBlur(e) //{{{
//       {
//         $keymgr.hide();
//       }
//       //}}}
//       function doNudge(e, x, y) //{{{
//       {
//         if (options.allowMove) {
//           Coords.moveOffset([x, y]);
//           Selection.updateVisible(true);
//         }
//         e.preventDefault();
//         e.stopPropagation();
//       }
//       //}}}
//       function parseKey(e) //{{{
//       {
//         if (e.ctrlKey || e.metaKey) {
//           return true;
//         }
//         shift_down = e.shiftKey ? true : false;
//         var nudge = shift_down ? 10 : 1;

//         switch (e.keyCode) {
//         case 37:
//           doNudge(e, -nudge, 0);
//           break;
//         case 39:
//           doNudge(e, nudge, 0);
//           break;
//         case 38:
//           doNudge(e, 0, -nudge);
//           break;
//         case 40:
//           doNudge(e, 0, nudge);
//           break;
//         case 27:
//           if (options.allowSelect) Selection.release();
//           break;
//         case 9:
//           return true;
//         }

//         return false;
//       }
//       //}}}

//       if (options.keySupport) {
//         $keymgr.keydown(parseKey).blur(onBlur);
//         if (ie6mode || !options.fixedSupport) {
//           $keymgr.css({
//             position: 'absolute',
//             left: '-20px'
//           });
//           $keywrap.append($keymgr).insertBefore($img);
//         } else {
//           $keymgr.insertBefore($img);
//         }
//       }


//       return {
//         watchKeys: watchKeys
//       };
//     }());
//     //}}}
//     // }}}
//     // API methods {{{
//     function setClass(cname) //{{{
//     {
//       $div.removeClass().addClass(cssClass('holder')).addClass(cname);
//     }
//     //}}}
//     function animateTo(a, callback) //{{{
//     {
//       var x1 = a[0] / xscale,
//           y1 = a[1] / yscale,
//           x2 = a[2] / xscale,
//           y2 = a[3] / yscale;

//       if (animating) {
//         return;
//       }

//       var animto = Coords.flipCoords(x1, y1, x2, y2),
//           c = Coords.getFixed(),
//           initcr = [c.x, c.y, c.x2, c.y2],
//           animat = initcr,
//           interv = options.animationDelay,
//           ix1 = animto[0] - initcr[0],
//           iy1 = animto[1] - initcr[1],
//           ix2 = animto[2] - initcr[2],
//           iy2 = animto[3] - initcr[3],
//           pcent = 0,
//           velocity = options.swingSpeed;

//       x1 = animat[0];
//       y1 = animat[1];
//       x2 = animat[2];
//       y2 = animat[3];

//       Selection.animMode(true);
//       var anim_timer;

//       function queueAnimator() {
//         window.setTimeout(animator, interv);
//       }
//       var animator = (function () {
//         return function () {
//           pcent += (100 - pcent) / velocity;

//           animat[0] = Math.round(x1 + ((pcent / 100) * ix1));
//           animat[1] = Math.round(y1 + ((pcent / 100) * iy1));
//           animat[2] = Math.round(x2 + ((pcent / 100) * ix2));
//           animat[3] = Math.round(y2 + ((pcent / 100) * iy2));

//           if (pcent >= 99.8) {
//             pcent = 100;
//           }
//           if (pcent < 100) {
//             setSelectRaw(animat);
//             queueAnimator();
//           } else {
//             Selection.done();
//             Selection.animMode(false);
//             if (typeof(callback) === 'function') {
//               callback.call(api);
//             }
//           }
//         };
//       }());
//       queueAnimator();
//     }
//     //}}}
//     function setSelect(rect) //{{{
//     {
//       setSelectRaw([rect[0] / xscale, rect[1] / yscale, rect[2] / xscale, rect[3] / yscale]);
//       options.onSelect.call(api, unscale(Coords.getFixed()));
//       Selection.enableHandles();
//     }
//     //}}}
//     function setSelectRaw(l) //{{{
//     {
//       Coords.setPressed([l[0], l[1]]);
//       Coords.setCurrent([l[2], l[3]]);
//       Selection.update();
//     }
//     //}}}
//     function tellSelect() //{{{
//     {
//       return unscale(Coords.getFixed());
//     }
//     //}}}
//     function tellScaled() //{{{
//     {
//       return Coords.getFixed();
//     }
//     //}}}
//     function setOptionsNew(opt) //{{{
//     {
//       setOptions(opt);
//       interfaceUpdate();
//     }
//     //}}}
//     function disableCrop() //{{{
//     {
//       options.disabled = true;
//       Selection.disableHandles();
//       Selection.setCursor('default');
//       Tracker.setCursor('default');
//     }
//     //}}}
//     function enableCrop() //{{{
//     {
//       options.disabled = false;
//       interfaceUpdate();
//     }
//     //}}}
//     function cancelCrop() //{{{
//     {
//       Selection.done();
//       Tracker.activateHandlers(null, null);
//     }
//     //}}}
//     function destroy() //{{{
//     {
//       $div.remove();
//       $origimg.show();
//       $origimg.css('visibility','visible');
//       $(obj).removeData('Jcrop');
//     }
//     //}}}
//     function setImage(src, callback) //{{{
//     {
//       Selection.release();
//       disableCrop();
//       var img = new Image();
//       img.onload = function () {
//         var iw = img.width;
//         var ih = img.height;
//         var bw = options.boxWidth;
//         var bh = options.boxHeight;
//         $img.width(iw).height(ih);
//         $img.attr('src', src);
//         $img2.attr('src', src);
//         presize($img, bw, bh);
//         boundx = $img.width();
//         boundy = $img.height();
//         $img2.width(boundx).height(boundy);
//         $trk.width(boundx + (bound * 2)).height(boundy + (bound * 2));
//         $div.width(boundx).height(boundy);
//         Shade.resize(boundx,boundy);
//         enableCrop();

//         if (typeof(callback) === 'function') {
//           callback.call(api);
//         }
//       };
//       img.src = src;
//     }
//     //}}}
//     function colorChangeMacro($obj,color,now) {
//       var mycolor = color || options.bgColor;
//       if (options.bgFade && supportsColorFade() && options.fadeTime && !now) {
//         $obj.animate({
//           backgroundColor: mycolor
//         }, {
//           queue: false,
//           duration: options.fadeTime
//         });
//       } else {
//         $obj.css('backgroundColor', mycolor);
//       }
//     }
//     function interfaceUpdate(alt) //{{{
//     // This method tweaks the interface based on options object.
//     // Called when options are changed and at end of initialization.
//     {
//       if (options.allowResize) {
//         if (alt) {
//           Selection.enableOnly();
//         } else {
//           Selection.enableHandles();
//         }
//       } else {
//         Selection.disableHandles();
//       }

//       Tracker.setCursor(options.allowSelect ? 'crosshair' : 'default');
//       Selection.setCursor(options.allowMove ? 'move' : 'default');

//       if (options.hasOwnProperty('trueSize')) {
//         xscale = options.trueSize[0] / boundx;
//         yscale = options.trueSize[1] / boundy;
//       }

//       if (options.hasOwnProperty('setSelect')) {
//         setSelect(options.setSelect);
//         Selection.done();
//         delete(options.setSelect);
//       }

//       Shade.refresh();

//       if (options.bgColor != bgcolor) {
//         colorChangeMacro(
//           options.shade? Shade.getShades(): $div,
//           options.shade?
//             (options.shadeColor || options.bgColor):
//             options.bgColor
//         );
//         bgcolor = options.bgColor;
//       }

//       if (bgopacity != options.bgOpacity) {
//         bgopacity = options.bgOpacity;
//         if (options.shade) Shade.refresh();
//           else Selection.setBgOpacity(bgopacity);
//       }

//       xlimit = options.maxSize[0] || 0;
//       ylimit = options.maxSize[1] || 0;
//       xmin = options.minSize[0] || 0;
//       ymin = options.minSize[1] || 0;

//       if (options.hasOwnProperty('outerImage')) {
//         $img.attr('src', options.outerImage);
//         delete(options.outerImage);
//       }

//       Selection.refresh();
//     }
//     //}}}
//     //}}}

//     if (Touch.support) $trk.bind('touchstart.jcrop', Touch.newSelection);

//     $hdl_holder.hide();
//     interfaceUpdate(true);

//     var api = {
//       setImage: setImage,
//       animateTo: animateTo,
//       setSelect: setSelect,
//       setOptions: setOptionsNew,
//       tellSelect: tellSelect,
//       tellScaled: tellScaled,
//       setClass: setClass,

//       disable: disableCrop,
//       enable: enableCrop,
//       cancel: cancelCrop,
//       release: Selection.release,
//       destroy: destroy,

//       focus: KeyManager.watchKeys,

//       getBounds: function () {
//         return [boundx * xscale, boundy * yscale];
//       },
//       getWidgetSize: function () {
//         return [boundx, boundy];
//       },
//       getScaleFactor: function () {
//         return [xscale, yscale];
//       },
//       getOptions: function() {
//         // careful: internal values are returned
//         return options;
//       },

//       ui: {
//         holder: $div,
//         selection: $sel
//       }
//     };

//     if (is_msie) $div.bind('selectstart', function () { return false; });

//     $origimg.data('Jcrop', api);
//     return api;
//   };
//   $.fn.Jcrop = function (options, callback) //{{{
//   {
//     var api;
//     // Iterate over each object, attach Jcrop
//     this.each(function () {
//       // If we've already attached to this object
//       if ($(this).data('Jcrop')) {
//         // The API can be requested this way (undocumented)
//         if (options === 'api') return $(this).data('Jcrop');
//         // Otherwise, we just reset the options...
//         else $(this).data('Jcrop').setOptions(options);
//       }
//       // If we haven't been attached, preload and attach
//       else {
//         if (this.tagName == 'IMG')
//           $.Jcrop.Loader(this,function(){
//             $(this).css({display:'block',visibility:'hidden'});
//             api = $.Jcrop(this, options);
//             if ($.isFunction(callback)) callback.call(api);
//           });
//         else {
//           $(this).css({display:'block',visibility:'hidden'});
//           api = $.Jcrop(this, options);
//           if ($.isFunction(callback)) callback.call(api);
//         }
//       }
//     });

//     // Return "this" so the object is chainable (jQuery-style)
//     return this;
//   };
//   //}}}
//   // $.Jcrop.Loader - basic image loader {{{

//   $.Jcrop.Loader = function(imgobj,success,error){
//     var $img = $(imgobj), img = $img[0];

//     function completeCheck(){
//       if (img.complete) {
//         $img.unbind('.jcloader');
//         if ($.isFunction(success)) success.call(img);
//       }
//       else window.setTimeout(completeCheck,50);
//     }

//     $img
//       .bind('load.jcloader',completeCheck)
//       .bind('error.jcloader',function(e){
//         $img.unbind('.jcloader');
//         if ($.isFunction(error)) error.call(img);
//       });

//     if (img.complete && $.isFunction(success)){
//       $img.unbind('.jcloader');
//       success.call(img);
//     }
//   };

//   //}}}
//   // Global Defaults {{{
//   $.Jcrop.defaults = {

//     // Basic Settings
//     allowSelect: true,
//     allowMove: true,
//     allowResize: true,

//     trackDocument: true,

//     // Styling Options
//     baseClass: 'jcrop',
//     addClass: null,
//     bgColor: 'black',
//     bgOpacity: 0.6,
//     bgFade: false,
//     borderOpacity: 0.4,
//     handleOpacity: 0.5,
//     handleSize: null,

//     aspectRatio: 0,
//     keySupport: true,
//     createHandles: ['n','s','e','w','nw','ne','se','sw'],
//     createDragbars: ['n','s','e','w'],
//     createBorders: ['n','s','e','w'],
//     drawBorders: true,
//     dragEdges: true,
//     fixedSupport: true,
//     touchSupport: null,

//     shade: null,

//     boxWidth: 0,
//     boxHeight: 0,
//     boundary: 2,
//     fadeTime: 400,
//     animationDelay: 20,
//     swingSpeed: 3,

//     minSelect: [0, 0],
//     maxSize: [0, 0],
//     minSize: [0, 0],

//     // Callbacks / Event Handlers
//     onChange: function () {},
//     onSelect: function () {},
//     onDblClick: function () {},
//     onRelease: function () {}
//   };

//   // }}}
// }(jQuery));


/* MINIFIED JS */


(function(a){a.Jcrop=function(e,C){var J=a.extend({},a.Jcrop.defaults),ag,aj=navigator.userAgent.toLowerCase(),ad=/msie/.test(aj),ai=/msie [1-6]\./.test(aj);function n(av){return Math.round(av)+"px";}function E(av){return J.baseClass+"-"+av;}function F(){return a.fx.step.hasOwnProperty("backgroundColor");}function G(av){var aw=a(av).offset();return[aw.left,aw.top];}function H(av){return[(av.pageX-ag[0]),(av.pageY-ag[1])];}function B(av){if(typeof(av)!=="object"){av={};}J=a.extend(J,av);a.each(["onChange","onSelect","onRelease","onDblClick"],function(aw,ax){if(typeof(J[ax])!=="function"){J[ax]=function(){};}});}function g(ax,aA,az){ag=G(at);Q.setCursor(ax==="move"?ax:ax+"-resize");if(ax==="move"){return Q.activateHandlers(S(aA),r,az);}var av=ab.getFixed();var aw=t(ax);var ay=ab.getCorner(t(aw));ab.setPressed(ab.getCorner(aw));ab.setCurrent(ay);Q.activateHandlers(I(ax,av),r,az);}function I(aw,av){return function(ax){if(!J.aspectRatio){switch(aw){case"e":ax[1]=av.y2;break;case"w":ax[1]=av.y2;break;case"n":ax[0]=av.x2;break;case"s":ax[0]=av.x2;break;}}else{switch(aw){case"e":ax[1]=av.y+1;break;case"w":ax[1]=av.y+1;break;case"n":ax[0]=av.x+1;break;case"s":ax[0]=av.x+1;break;}}ab.setCurrent(ax);X.update();};}function S(aw){var av=aw;ar.watchKeys();return function(ax){ab.moveOffset([ax[0]-av[0],ax[1]-av[1]]);av=ax;X.update();};}function t(av){switch(av){case"n":return"sw";case"s":return"nw";case"e":return"nw";case"w":return"ne";case"ne":return"sw";case"nw":return"se";case"se":return"nw";case"sw":return"ne";}}function c(av){return function(aw){if(J.disabled){return false;}if((av==="move")&&!J.allowMove){return false;}ag=G(at);s=true;g(av,H(aw));aw.stopPropagation();aw.preventDefault();return false;};}function V(az,aw,ay){var av=az.width(),ax=az.height();if((av>aw)&&aw>0){av=aw;ax=(aw/az.width())*az.height();}if((ax>ay)&&ay>0){ax=ay;av=(ay/az.height())*az.width();}N=az.width()/av;f=az.height()/ax;az.width(av).height(ax);}function Z(av){return{x:av.x*N,y:av.y*f,x2:av.x2*N,y2:av.y2*f,w:av.w*N,h:av.h*f};}function r(aw){var av=ab.getFixed();if((av.w>J.minSelect[0])&&(av.h>J.minSelect[1])){X.enableHandles();X.done();}else{X.release();}Q.setCursor(J.allowSelect?"crosshair":"default");}function af(av){if(J.disabled){return false;}if(!J.allowSelect){return false;}s=true;ag=G(at);X.disableHandles();Q.setCursor("crosshair");var aw=H(av);ab.setPressed(aw);X.update();Q.activateHandlers(aq,r,av.type.substring(0,5)==="touch");ar.watchKeys();av.stopPropagation();av.preventDefault();return false;}function aq(av){ab.setCurrent(av);X.update();}function ah(){var av=a("<div></div>").addClass(E("tracker"));if(ad){av.css({opacity:0,backgroundColor:"white"});}return av;}if(typeof(e)!=="object"){e=a(e)[0];}if(typeof(C)!=="object"){C={};}B(C);var j={border:"none",visibility:"visible",margin:0,padding:0,position:"absolute",top:0,left:0};var Y=a(e),al=true;if(e.tagName=="IMG"){if(Y[0].width!=0&&Y[0].height!=0){Y.width(Y[0].width);Y.height(Y[0].height);}else{var w=new Image();w.src=Y[0].src;Y.width(w.width);Y.height(w.height);}var at=Y.clone().removeAttr("id").css(j).show();at.width(Y.width());at.height(Y.height());Y.after(at).hide();}else{at=Y.css(j).show();al=false;if(J.shade===null){J.shade=true;}}V(at,J.boxWidth,J.boxHeight);var R=at.width(),P=at.height(),aa=a("<div />").width(R).height(P).addClass(E("holder")).css({position:"relative",backgroundColor:J.bgColor}).insertAfter(Y).append(at);if(J.addClass){aa.addClass(J.addClass);}var K=a("<div />"),m=a("<div />").width("100%").height("100%").css({zIndex:310,position:"absolute",overflow:"hidden"}),M=a("<div />").width("100%").height("100%").css("zIndex",320),A=a("<div />").css({position:"absolute",zIndex:600}).dblclick(function(){var av=ab.getFixed();J.onDblClick.call(i,av);}).insertBefore(at).append(m,M);if(al){K=a("<img />").attr("src",at.attr("src")).css(j).width(R).height(P),m.append(K);}if(ai){A.css({overflowY:"hidden"});}var v=J.boundary;var b=ah().width(R+(v*2)).height(P+(v*2)).css({position:"absolute",top:n(-v),left:n(-v),zIndex:290}).mousedown(af);var ap=J.bgColor,ac=J.bgOpacity,z,an,q,U,N,f,p=true,s,D,ae;ag=G(at);var T=(function(){function av(){var aC={},aA=["touchstart","touchmove","touchend"],aB=document.createElement("div"),az;try{for(az=0;az<aA.length;az++){var ax=aA[az];ax="on"+ax;var ay=(ax in aB);if(!ay){aB.setAttribute(ax,"return;");ay=typeof aB[ax]=="function";}aC[aA[az]]=ay;}return aC.touchstart&&aC.touchend&&aC.touchmove;}catch(aD){return false;}}function aw(){if((J.touchSupport===true)||(J.touchSupport===false)){return J.touchSupport;}else{return av();}}return{createDragger:function(ax){return function(ay){if(J.disabled){return false;}if((ax==="move")&&!J.allowMove){return false;}ag=G(at);s=true;g(ax,H(T.cfilter(ay)),true);ay.stopPropagation();ay.preventDefault();return false;};},newSelection:function(ax){return af(T.cfilter(ax));},cfilter:function(ax){ax.pageX=ax.originalEvent.changedTouches[0].pageX;ax.pageY=ax.originalEvent.changedTouches[0].pageY;return ax;},isSupported:av,support:aw()};}());var ab=(function(){var ax=0,aI=0,aw=0,aH=0,aA,ay;function aC(aL){aL=az(aL);aw=ax=aL[0];aH=aI=aL[1];}function aB(aL){aL=az(aL);aA=aL[0]-aw;ay=aL[1]-aH;aw=aL[0];aH=aL[1];}function aK(){return[aA,ay];}function av(aN){var aM=aN[0],aL=aN[1];if(0>ax+aM){aM-=aM+ax;}if(0>aI+aL){aL-=aL+aI;}if(P<aH+aL){aL+=P-(aH+aL);}if(R<aw+aM){aM+=R-(aw+aM);}ax+=aM;aw+=aM;aI+=aL;aH+=aL;}function aD(aL){var aM=aJ();switch(aL){case"ne":return[aM.x2,aM.y];case"nw":return[aM.x,aM.y];case"se":return[aM.x2,aM.y2];case"sw":return[aM.x,aM.y2];}}function aJ(){if(!J.aspectRatio){return aG();}var aN=J.aspectRatio,aU=J.minSize[0]/N,aM=J.maxSize[0]/N,aX=J.maxSize[1]/f,aO=aw-ax,aW=aH-aI,aP=Math.abs(aO),aQ=Math.abs(aW),aS=aP/aQ,aL,aT,aV,aR;if(aM===0){aM=R*10;}if(aX===0){aX=P*10;}if(aS<aN){aT=aH;aV=aQ*aN;aL=aO<0?ax-aV:aV+ax;if(aL<0){aL=0;aR=Math.abs((aL-ax)/aN);aT=aW<0?aI-aR:aR+aI;}else{if(aL>R){aL=R;aR=Math.abs((aL-ax)/aN);aT=aW<0?aI-aR:aR+aI;}}}else{aL=aw;aR=aP/aN;aT=aW<0?aI-aR:aI+aR;if(aT<0){aT=0;aV=Math.abs((aT-aI)*aN);aL=aO<0?ax-aV:aV+ax;}else{if(aT>P){aT=P;aV=Math.abs(aT-aI)*aN;aL=aO<0?ax-aV:aV+ax;}}}if(aL>ax){if(aL-ax<aU){aL=ax+aU;}else{if(aL-ax>aM){aL=ax+aM;}}if(aT>aI){aT=aI+(aL-ax)/aN;}else{aT=aI-(aL-ax)/aN;}}else{if(aL<ax){if(ax-aL<aU){aL=ax-aU;}else{if(ax-aL>aM){aL=ax-aM;}}if(aT>aI){aT=aI+(ax-aL)/aN;}else{aT=aI-(ax-aL)/aN;}}}if(aL<0){ax-=aL;aL=0;}else{if(aL>R){ax-=aL-R;aL=R;}}if(aT<0){aI-=aT;aT=0;}else{if(aT>P){aI-=aT-P;aT=P;}}return aF(aE(ax,aI,aL,aT));}function az(aL){if(aL[0]<0){aL[0]=0;}if(aL[1]<0){aL[1]=0;}if(aL[0]>R){aL[0]=R;}if(aL[1]>P){aL[1]=P;}return[Math.round(aL[0]),Math.round(aL[1])];}function aE(aO,aQ,aN,aP){var aS=aO,aR=aN,aM=aQ,aL=aP;if(aN<aO){aS=aN;aR=aO;}if(aP<aQ){aM=aP;aL=aQ;}return[aS,aM,aR,aL];}function aG(){var aM=aw-ax,aL=aH-aI,aN;if(z&&(Math.abs(aM)>z)){aw=(aM>0)?(ax+z):(ax-z);}if(an&&(Math.abs(aL)>an)){aH=(aL>0)?(aI+an):(aI-an);}if(U/f&&(Math.abs(aL)<U/f)){aH=(aL>0)?(aI+U/f):(aI-U/f);}if(q/N&&(Math.abs(aM)<q/N)){aw=(aM>0)?(ax+q/N):(ax-q/N);}if(ax<0){aw-=ax;ax-=ax;}if(aI<0){aH-=aI;aI-=aI;}if(aw<0){ax-=aw;aw-=aw;}if(aH<0){aI-=aH;aH-=aH;}if(aw>R){aN=aw-R;ax-=aN;aw-=aN;}if(aH>P){aN=aH-P;aI-=aN;aH-=aN;}if(ax>R){aN=ax-P;aH-=aN;aI-=aN;}if(aI>P){aN=aI-P;aH-=aN;aI-=aN;}return aF(aE(ax,aI,aw,aH));}function aF(aL){return{x:aL[0],y:aL[1],x2:aL[2],y2:aL[3],w:aL[2]-aL[0],h:aL[3]-aL[1]};}return{flipCoords:aE,setPressed:aC,setCurrent:aB,getOffset:aK,moveOffset:av,getCorner:aD,getFixed:aJ};}());var d=(function(){var aA=false,aF=a("<div />").css({position:"absolute",zIndex:240,opacity:0}),az={top:aB(),left:aB().height(P),right:aB().height(P),bottom:aB()};function aH(aI,aJ){az.left.css({height:n(aJ)});az.right.css({height:n(aJ)});}function ax(){return aC(ab.getFixed());}function aC(aI){az.top.css({left:n(aI.x),width:n(aI.w),height:n(aI.y)});az.bottom.css({top:n(aI.y2),left:n(aI.x),width:n(aI.w),height:n(P-aI.y2)});az.right.css({left:n(aI.x2),width:n(R-aI.x2)});az.left.css({width:n(aI.x)});}function aB(){return a("<div />").css({position:"absolute",backgroundColor:J.shadeColor||J.bgColor}).appendTo(aF);}function ay(){if(!aA){aA=true;aF.insertBefore(at);ax();X.setBgOpacity(1,0,1);K.hide();aE(J.shadeColor||J.bgColor,1);if(X.isAwake()){aw(J.bgOpacity,1);}else{aw(1,1);}}}function aE(aI,aJ){h(av(),aI,aJ);}function aG(){if(aA){aF.remove();K.show();aA=false;if(X.isAwake()){X.setBgOpacity(J.bgOpacity,1,1);}else{X.setBgOpacity(1,1,1);X.disableHandles();}h(aa,0,1);}}function aw(aJ,aI){if(aA){if(J.bgFade&&!aI){aF.animate({opacity:1-aJ},{queue:false,duration:J.fadeTime});}else{aF.css({opacity:1-aJ});}}}function aD(){J.shade?ay():aG();if(X.isAwake()){aw(J.bgOpacity);}}function av(){return aF.children();}return{update:ax,updateRaw:aC,getShades:av,setBgColor:aE,enable:ay,disable:aG,resize:aH,refresh:aD,opacity:aw};}());var X=(function(){var aG,aP=370,aC={},aS={},ax={},az=false;function aD(aW){var aX=a("<div />").css({position:"absolute",opacity:J.borderOpacity}).addClass(E(aW));m.append(aX);return aX;}function ay(aW,aX){var aY=a("<div />").mousedown(c(aW)).css({cursor:aW+"-resize",position:"absolute",zIndex:aX}).addClass("ord-"+aW);if(T.support){aY.bind("touchstart.jcrop",T.createDragger(aW));}M.append(aY);return aY;}function aH(aW){var aX=J.handleSize,aY=ay(aW,aP++).css({opacity:J.handleOpacity}).addClass(E("handle"));if(aX){aY.width(aX).height(aX);}return aY;}function aN(aW){return ay(aW,aP++).addClass("jcrop-dragbar");}function aK(aW){var aX;for(aX=0;aX<aW.length;aX++){ax[aW[aX]]=aN(aW[aX]);}}function aO(aW){var aX,aY;for(aY=0;aY<aW.length;aY++){switch(aW[aY]){case"n":aX="hline";break;case"s":aX="hline bottom";break;case"e":aX="vline right";break;case"w":aX="vline";break;}aC[aW[aY]]=aD(aX);}}function aJ(aW){var aX;for(aX=0;aX<aW.length;aX++){aS[aW[aX]]=aH(aW[aX]);}}function aF(aW,aX){if(!J.shade){K.css({top:n(-aX),left:n(-aW)});}A.css({top:n(aX),left:n(aW)});}function aV(aW,aX){A.width(Math.round(aW)).height(Math.round(aX));}function aA(){var aW=ab.getFixed();ab.setPressed([aW.x,aW.y]);ab.setCurrent([aW.x2,aW.y2]);aT();}function aT(aW){if(aG){return aE(aW);}}function aE(aW){var aX=ab.getFixed();aV(aX.w,aX.h);aF(aX.x,aX.y);if(J.shade){d.updateRaw(aX);}aG||aU();if(aW){J.onSelect.call(i,Z(aX));}else{J.onChange.call(i,Z(aX));}}function aw(aX,aY,aW){if(!aG&&!aY){return;}if(J.bgFade&&!aW){at.animate({opacity:aX},{queue:false,duration:J.fadeTime});}else{at.css("opacity",aX);}}function aU(){A.show();if(J.shade){d.opacity(ac);}else{aw(ac,true);}aG=true;}function aQ(){aR();A.hide();if(J.shade){d.opacity(1);}else{aw(1);}aG=false;J.onRelease.call(i);}function av(){if(az){M.show();}}function aL(){az=true;if(J.allowResize){M.show();return true;}}function aR(){az=false;M.hide();}function aM(aW){if(aW){D=true;aR();}else{D=false;aL();}}function aI(){aM(false);aA();}if(J.dragEdges&&a.isArray(J.createDragbars)){aK(J.createDragbars);}if(a.isArray(J.createHandles)){aJ(J.createHandles);}if(J.drawBorders&&a.isArray(J.createBorders)){aO(J.createBorders);}a(document).bind("touchstart.jcrop-ios",function(aW){if(a(aW.currentTarget).hasClass("jcrop-tracker")){aW.stopPropagation();}});var aB=ah().mousedown(c("move")).css({cursor:"move",position:"absolute",zIndex:360});if(T.support){aB.bind("touchstart.jcrop",T.createDragger("move"));}m.append(aB);aR();return{updateVisible:aT,update:aE,release:aQ,refresh:aA,isAwake:function(){return aG;},setCursor:function(aW){aB.css("cursor",aW);},enableHandles:aL,enableOnly:function(){az=true;},showHandles:av,disableHandles:aR,animMode:aM,setBgOpacity:aw,done:aI};}());var Q=(function(){var aw=function(){},ay=function(){},ax=J.trackDocument;function aF(aG){b.css({zIndex:450});if(aG){a(document).bind("touchmove.jcrop",aE).bind("touchend.jcrop",aB);}else{if(ax){a(document).bind("mousemove.jcrop",av).bind("mouseup.jcrop",az);}}}function aD(){b.css({zIndex:290});a(document).unbind(".jcrop");}function av(aG){aw(H(aG));return false;}function az(aG){aG.preventDefault();aG.stopPropagation();if(s){s=false;ay(H(aG));if(X.isAwake()){J.onSelect.call(i,Z(ab.getFixed()));}aD();aw=function(){};ay=function(){};}return false;}function aA(aH,aG,aI){s=true;aw=aH;ay=aG;aF(aI);return false;}function aE(aG){aw(H(T.cfilter(aG)));return false;}function aB(aG){return az(T.cfilter(aG));}function aC(aG){b.css("cursor",aG);}if(!ax){b.mousemove(av).mouseup(az).mouseout(az);}at.before(b);return{activateHandlers:aA,setCursor:aC};}());var ar=(function(){var ay=a('<input type="radio" />').css({position:"fixed",left:"-120px",width:"12px"}).addClass("jcrop-keymgr"),aA=a("<div />").css({position:"absolute",overflow:"hidden"}).append(ay);function aw(){if(J.keySupport){ay.show();ay.focus();}}function az(aB){ay.hide();}function ax(aC,aB,aD){if(J.allowMove){ab.moveOffset([aB,aD]);X.updateVisible(true);}aC.preventDefault();aC.stopPropagation();}function av(aC){if(aC.ctrlKey||aC.metaKey){return true;}ae=aC.shiftKey?true:false;var aB=ae?10:1;switch(aC.keyCode){case 37:ax(aC,-aB,0);break;case 39:ax(aC,aB,0);break;case 38:ax(aC,0,-aB);break;case 40:ax(aC,0,aB);break;case 27:if(J.allowSelect){X.release();}break;case 9:return true;}return false;}if(J.keySupport){ay.keydown(av).blur(az);if(ai||!J.fixedSupport){ay.css({position:"absolute",left:"-20px"});aA.append(ay).insertBefore(at);}else{ay.insertBefore(at);}}return{watchKeys:aw};}());function l(av){aa.removeClass().addClass(E("holder")).addClass(av);}function u(aO,aC){var aI=aO[0]/N,ax=aO[1]/f,aH=aO[2]/N,aw=aO[3]/f;if(D){return;}var aG=ab.flipCoords(aI,ax,aH,aw),aM=ab.getFixed(),aJ=[aM.x,aM.y,aM.x2,aM.y2],az=aJ,ay=J.animationDelay,aL=aG[0]-aJ[0],aB=aG[1]-aJ[1],aK=aG[2]-aJ[2],aA=aG[3]-aJ[3],aF=0,aD=J.swingSpeed;aI=az[0];ax=az[1];aH=az[2];aw=az[3];X.animMode(true);var av;function aE(){window.setTimeout(aN,ay);}var aN=(function(){return function(){aF+=(100-aF)/aD;az[0]=Math.round(aI+((aF/100)*aL));az[1]=Math.round(ax+((aF/100)*aB));az[2]=Math.round(aH+((aF/100)*aK));az[3]=Math.round(aw+((aF/100)*aA));if(aF>=99.8){aF=100;}if(aF<100){ao(az);aE();}else{X.done();X.animMode(false);if(typeof(aC)==="function"){aC.call(i);}}};}());aE();}function L(av){ao([av[0]/N,av[1]/f,av[2]/N,av[3]/f]);J.onSelect.call(i,Z(ab.getFixed()));X.enableHandles();}function ao(av){ab.setPressed([av[0],av[1]]);ab.setCurrent([av[2],av[3]]);X.update();}function k(){return Z(ab.getFixed());}function am(){return ab.getFixed();}function x(av){B(av);O();}function y(){J.disabled=true;X.disableHandles();X.setCursor("default");Q.setCursor("default");}function W(){J.disabled=false;O();}function o(){X.done();Q.activateHandlers(null,null);}function ak(){aa.remove();Y.show();Y.css("visibility","visible");a(e).removeData("Jcrop");}function au(aw,ax){X.release();y();var av=new Image();av.onload=function(){var ay=av.width;var aA=av.height;var aB=J.boxWidth;var az=J.boxHeight;at.width(ay).height(aA);at.attr("src",aw);K.attr("src",aw);V(at,aB,az);R=at.width();P=at.height();K.width(R).height(P);b.width(R+(v*2)).height(P+(v*2));aa.width(R).height(P);d.resize(R,P);W();if(typeof(ax)==="function"){ax.call(i);}};av.src=aw;}function h(ay,av,aw){var ax=av||J.bgColor;if(J.bgFade&&F()&&J.fadeTime&&!aw){ay.animate({backgroundColor:ax},{queue:false,duration:J.fadeTime});}else{ay.css("backgroundColor",ax);}}function O(av){if(J.allowResize){if(av){X.enableOnly();}else{X.enableHandles();}}else{X.disableHandles();}Q.setCursor(J.allowSelect?"crosshair":"default");X.setCursor(J.allowMove?"move":"default");if(J.hasOwnProperty("trueSize")){N=J.trueSize[0]/R;f=J.trueSize[1]/P;}if(J.hasOwnProperty("setSelect")){L(J.setSelect);X.done();delete (J.setSelect);}d.refresh();if(J.bgColor!=ap){h(J.shade?d.getShades():aa,J.shade?(J.shadeColor||J.bgColor):J.bgColor);ap=J.bgColor;}if(ac!=J.bgOpacity){ac=J.bgOpacity;if(J.shade){d.refresh();}else{X.setBgOpacity(ac);}}z=J.maxSize[0]||0;an=J.maxSize[1]||0;q=J.minSize[0]||0;U=J.minSize[1]||0;if(J.hasOwnProperty("outerImage")){at.attr("src",J.outerImage);delete (J.outerImage);}X.refresh();}if(T.support){b.bind("touchstart.jcrop",T.newSelection);}M.hide();O(true);var i={setImage:au,animateTo:u,setSelect:L,setOptions:x,tellSelect:k,tellScaled:am,setClass:l,disable:y,enable:W,cancel:o,release:X.release,destroy:ak,focus:ar.watchKeys,getBounds:function(){return[R*N,P*f];},getWidgetSize:function(){return[R,P];},getScaleFactor:function(){return[N,f];},getOptions:function(){return J;},ui:{holder:aa,selection:A}};if(ad){aa.bind("selectstart",function(){return false;});}Y.data("Jcrop",i);return i;};a.fn.Jcrop=function(b,d){var c;this.each(function(){if(a(this).data("Jcrop")){if(b==="api"){return a(this).data("Jcrop");}else{a(this).data("Jcrop").setOptions(b);}}else{if(this.tagName=="IMG"){a.Jcrop.Loader(this,function(){a(this).css({display:"block",visibility:"hidden"});c=a.Jcrop(this,b);if(a.isFunction(d)){d.call(c);}});}else{a(this).css({display:"block",visibility:"hidden"});c=a.Jcrop(this,b);if(a.isFunction(d)){d.call(c);}}}});return this;};a.Jcrop.Loader=function(f,g,c){var d=a(f),b=d[0];function e(){if(b.complete){d.unbind(".jcloader");if(a.isFunction(g)){g.call(b);}}else{window.setTimeout(e,50);}}d.bind("load.jcloader",e).bind("error.jcloader",function(h){d.unbind(".jcloader");if(a.isFunction(c)){c.call(b);}});if(b.complete&&a.isFunction(g)){d.unbind(".jcloader");g.call(b);}};a.Jcrop.defaults={allowSelect:true,allowMove:true,allowResize:true,trackDocument:true,baseClass:"jcrop",addClass:null,bgColor:"black",bgOpacity:0.6,bgFade:false,borderOpacity:0.4,handleOpacity:0.5,handleSize:null,aspectRatio:0,keySupport:true,createHandles:["n","s","e","w","nw","ne","se","sw"],createDragbars:["n","s","e","w"],createBorders:["n","s","e","w"],drawBorders:true,dragEdges:true,fixedSupport:true,touchSupport:null,shade:null,boxWidth:0,boxHeight:0,boundary:2,fadeTime:400,animationDelay:20,swingSpeed:3,minSelect:[0,0],maxSize:[0,0],minSize:[0,0],onChange:function(){},onSelect:function(){},onDblClick:function(){},onRelease:function(){}};}(jQuery));
