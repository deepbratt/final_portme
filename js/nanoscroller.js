// /*! nanoScrollerJS - v0.8.7 - 2015
// * http://jamesflorentino.github.com/nanoScrollerJS/
// * Copyright (c) 2015 James Florentino; Licensed MIT */

// (function(factory) {
//   if (typeof define === 'function' && define.amd) {
//     return define(['jquery'], function($) {
//       return factory($, window, document);
//     });
//   } else if (typeof exports === 'object') {
//     return module.exports = factory(require('jquery'), window, document);
//   } else {
//     return factory(jQuery, window, document);
//   }
// })(function($, window, document) {
//   "use strict";
//   var BROWSER_IS_IE7, BROWSER_SCROLLBAR_WIDTH, DOMSCROLL, DOWN, DRAG, ENTER, KEYDOWN, KEYUP, MOUSEDOWN, MOUSEENTER, MOUSEMOVE, MOUSEUP, MOUSEWHEEL, NanoScroll, PANEDOWN, RESIZE, SCROLL, SCROLLBAR, TOUCHMOVE, UP, WHEEL, cAF, defaults, getBrowserScrollbarWidth, hasTransform, isFFWithBuggyScrollbar, rAF, transform, _elementStyle, _prefixStyle, _vendor;
//   defaults = {

//     /**
//       a classname for the pane element.
//       @property paneClass
//       @type String
//       @default 'nano-pane'
//      */
//     paneClass: 'nano-pane',

//     /**
//       a classname for the slider element.
//       @property sliderClass
//       @type String
//       @default 'nano-slider'
//      */
//     sliderClass: 'nano-slider',

//     /**
//       a classname for the content element.
//       @property contentClass
//       @type String
//       @default 'nano-content'
//      */
//     contentClass: 'nano-content',

//     /**
//       a classname for enabled mode
//       @property enabledClass
//       @type String
//       @default 'has-scrollbar'
//      */
//     enabledClass: 'has-scrollbar',

//     /**
//       a classname for flashed mode
//       @property flashedClass
//       @type String
//       @default 'flashed'
//      */
//     flashedClass: 'flashed',

//     /**
//       a classname for active mode
//       @property activeClass
//       @type String
//       @default 'active'
//      */
//     activeClass: 'active',

//     /**
//       a setting to enable native scrolling in iOS devices.
//       @property iOSNativeScrolling
//       @type Boolean
//       @default false
//      */
//     iOSNativeScrolling: false,

//     /**
//       a setting to prevent the rest of the page being
//       scrolled when user scrolls the `.content` element.
//       @property preventPageScrolling
//       @type Boolean
//       @default false
//      */
//     preventPageScrolling: false,

//     /**
//       a setting to disable binding to the resize event.
//       @property disableResize
//       @type Boolean
//       @default false
//      */
//     disableResize: false,

//     /**
//       a setting to make the scrollbar always visible.
//       @property alwaysVisible
//       @type Boolean
//       @default false
//      */
//     alwaysVisible: false,

//     /**
//       a default timeout for the `flash()` method.
//       @property flashDelay
//       @type Number
//       @default 1500
//      */
//     flashDelay: 1500,

//     /**
//       a minimum height for the `.slider` element.
//       @property sliderMinHeight
//       @type Number
//       @default 20
//      */
//     sliderMinHeight: 20,

//     /**
//       a maximum height for the `.slider` element.
//       @property sliderMaxHeight
//       @type Number
//       @default null
//      */
//     sliderMaxHeight: null,

//     /**
//       an alternate document context.
//       @property documentContext
//       @type Document
//       @default null
//      */
//     documentContext: null,

//     /**
//       an alternate window context.
//       @property windowContext
//       @type Window
//       @default null
//      */
//     windowContext: null
//   };

//   /**
//     @property SCROLLBAR
//     @type String
//     @static
//     @final
//     @private
//    */
//   SCROLLBAR = 'scrollbar';

//   /**
//     @property SCROLL
//     @type String
//     @static
//     @final
//     @private
//    */
//   SCROLL = 'scroll';

//   /**
//     @property MOUSEDOWN
//     @type String
//     @final
//     @private
//    */
//   MOUSEDOWN = 'mousedown';

//   /**
//     @property MOUSEENTER
//     @type String
//     @final
//     @private
//    */
//   MOUSEENTER = 'mouseenter';

//   /**
//     @property MOUSEMOVE
//     @type String
//     @static
//     @final
//     @private
//    */
//   MOUSEMOVE = 'mousemove';

//   /**
//     @property MOUSEWHEEL
//     @type String
//     @final
//     @private
//    */
//   MOUSEWHEEL = 'mousewheel';

//   /**
//     @property MOUSEUP
//     @type String
//     @static
//     @final
//     @private
//    */
//   MOUSEUP = 'mouseup';

//   /**
//     @property RESIZE
//     @type String
//     @final
//     @private
//    */
//   RESIZE = 'resize';

//   /**
//     @property DRAG
//     @type String
//     @static
//     @final
//     @private
//    */
//   DRAG = 'drag';

//   /**
//     @property ENTER
//     @type String
//     @static
//     @final
//     @private
//    */
//   ENTER = 'enter';

//   /**
//     @property UP
//     @type String
//     @static
//     @final
//     @private
//    */
//   UP = 'up';

//   /**
//     @property PANEDOWN
//     @type String
//     @static
//     @final
//     @private
//    */
//   PANEDOWN = 'panedown';

//   /**
//     @property DOMSCROLL
//     @type String
//     @static
//     @final
//     @private
//    */
//   DOMSCROLL = 'DOMMouseScroll';

//   /**
//     @property DOWN
//     @type String
//     @static
//     @final
//     @private
//    */
//   DOWN = 'down';

//   /**
//     @property WHEEL
//     @type String
//     @static
//     @final
//     @private
//    */
//   WHEEL = 'wheel';

//   /**
//     @property KEYDOWN
//     @type String
//     @static
//     @final
//     @private
//    */
//   KEYDOWN = 'keydown';

//   /**
//     @property KEYUP
//     @type String
//     @static
//     @final
//     @private
//    */
//   KEYUP = 'keyup';

//   /**
//     @property TOUCHMOVE
//     @type String
//     @static
//     @final
//     @private
//    */
//   TOUCHMOVE = 'touchmove';

//   /**
//     @property BROWSER_IS_IE7
//     @type Boolean
//     @static
//     @final
//     @private
//    */
//   BROWSER_IS_IE7 = window.navigator.appName === 'Microsoft Internet Explorer' && /msie 7./i.test(window.navigator.appVersion) && window.ActiveXObject;

//   /**
//     @property BROWSER_SCROLLBAR_WIDTH
//     @type Number
//     @static
//     @default null
//     @private
//    */
//   BROWSER_SCROLLBAR_WIDTH = null;
//   rAF = window.requestAnimationFrame;
//   cAF = window.cancelAnimationFrame;
//   _elementStyle = document.createElement('div').style;
//   _vendor = (function() {
//     var i, transform, vendor, vendors, _i, _len;
//     vendors = ['t', 'webkitT', 'MozT', 'msT', 'OT'];
//     for (i = _i = 0, _len = vendors.length; _i < _len; i = ++_i) {
//       vendor = vendors[i];
//       transform = vendors[i] + 'ransform';
//       if (transform in _elementStyle) {
//         return vendors[i].substr(0, vendors[i].length - 1);
//       }
//     }
//     return false;
//   })();
//   _prefixStyle = function(style) {
//     if (_vendor === false) {
//       return false;
//     }
//     if (_vendor === '') {
//       return style;
//     }
//     return _vendor + style.charAt(0).toUpperCase() + style.substr(1);
//   };
//   transform = _prefixStyle('transform');
//   hasTransform = transform !== false;

//   /**
//     Returns browser's native scrollbar width
//     @method getBrowserScrollbarWidth
//     @return {Number} the scrollbar width in pixels
//     @static
//     @private
//    */
//   getBrowserScrollbarWidth = function() {
//     var outer, outerStyle, scrollbarWidth;
//     outer = document.createElement('div');
//     outerStyle = outer.style;
//     outerStyle.position = 'absolute';
//     outerStyle.width = '100px';
//     outerStyle.height = '100px';
//     outerStyle.overflow = SCROLL;
//     outerStyle.top = '-9999px';
//     document.body.appendChild(outer);
//     scrollbarWidth = outer.offsetWidth - outer.clientWidth;
//     document.body.removeChild(outer);
//     return scrollbarWidth;
//   };
//   isFFWithBuggyScrollbar = function() {
//     var isOSXFF, ua, version;
//     ua = window.navigator.userAgent;
//     isOSXFF = /(?=.+Mac OS X)(?=.+Firefox)/.test(ua);
//     if (!isOSXFF) {
//       return false;
//     }
//     version = /Firefox\/\d{2}\./.exec(ua);
//     if (version) {
//       version = version[0].replace(/\D+/g, '');
//     }
//     return isOSXFF && +version > 23;
//   };

//   /**
//     @class NanoScroll
//     @param element {HTMLElement|Node} the main element
//     @param options {Object} nanoScroller's options
//     @constructor
//    */
//   NanoScroll = (function() {
//     function NanoScroll(el, options) {
//       this.el = el;
//       this.options = options;
//       BROWSER_SCROLLBAR_WIDTH || (BROWSER_SCROLLBAR_WIDTH = getBrowserScrollbarWidth());
//       this.$el = $(this.el);
//       this.doc = $(this.options.documentContext || document);
//       this.win = $(this.options.windowContext || window);
//       this.body = this.doc.find('body');
//       this.$content = this.$el.children("." + this.options.contentClass);
//       this.$content.attr('tabindex', this.options.tabIndex || 0);
//       this.content = this.$content[0];
//       this.previousPosition = 0;
//       if (this.options.iOSNativeScrolling && (this.el.style.WebkitOverflowScrolling != null)) {
//         this.nativeScrolling();
//       } else {
//         this.generate();
//       }
//       this.createEvents();
//       this.addEvents();
//       this.reset();
//     }


//     /**
//       Prevents the rest of the page being scrolled
//       when user scrolls the `.nano-content` element.
//       @method preventScrolling
//       @param event {Event}
//       @param direction {String} Scroll direction (up or down)
//       @private
//      */

//     NanoScroll.prototype.preventScrolling = function(e, direction) {
//       if (!this.isActive) {
//         return;
//       }
//       if (e.type === DOMSCROLL) {
//         if (direction === DOWN && e.originalEvent.detail > 0 || direction === UP && e.originalEvent.detail < 0) {
//           e.preventDefault();
//         }
//       } else if (e.type === MOUSEWHEEL) {
//         if (!e.originalEvent || !e.originalEvent.wheelDelta) {
//           return;
//         }
//         if (direction === DOWN && e.originalEvent.wheelDelta < 0 || direction === UP && e.originalEvent.wheelDelta > 0) {
//           e.preventDefault();
//         }
//       }
//     };


//     /**
//       Enable iOS native scrolling
//       @method nativeScrolling
//       @private
//      */

//     NanoScroll.prototype.nativeScrolling = function() {
//       this.$content.css({
//         WebkitOverflowScrolling: 'touch'
//       });
//       this.iOSNativeScrolling = true;
//       this.isActive = true;
//     };


//     /**
//       Updates those nanoScroller properties that
//       are related to current scrollbar position.
//       @method updateScrollValues
//       @private
//      */

//     NanoScroll.prototype.updateScrollValues = function() {
//       var content, direction;
//       content = this.content;
//       this.maxScrollTop = content.scrollHeight - content.clientHeight;
//       this.prevScrollTop = this.contentScrollTop || 0;
//       this.contentScrollTop = content.scrollTop;
//       direction = this.contentScrollTop > this.previousPosition ? "down" : this.contentScrollTop < this.previousPosition ? "up" : "same";
//       this.previousPosition = this.contentScrollTop;
//       if (direction !== "same") {
//         this.$el.trigger('update', {
//           position: this.contentScrollTop,
//           maximum: this.maxScrollTop,
//           direction: direction
//         });
//       }
//       if (!this.iOSNativeScrolling) {
//         this.maxSliderTop = this.paneHeight - this.sliderHeight;
//         this.sliderTop = this.maxScrollTop === 0 ? 0 : this.contentScrollTop * this.maxSliderTop / this.maxScrollTop;
//       }
//     };


//     /**
//       Updates CSS styles for current scroll position.
//       Uses CSS 2d transfroms and `window.requestAnimationFrame` if available.
//       @method setOnScrollStyles
//       @private
//      */

//     NanoScroll.prototype.setOnScrollStyles = function() {
//       var cssValue;
//       if (hasTransform) {
//         cssValue = {};
//         cssValue[transform] = "translate(0, " + this.sliderTop + "px)";
//       } else {
//         cssValue = {
//           top: this.sliderTop
//         };
//       }
//       if (rAF) {
//         if (cAF && this.scrollRAF) {
//           cAF(this.scrollRAF);
//         }
//         this.scrollRAF = rAF((function(_this) {
//           return function() {
//             _this.scrollRAF = null;
//             return _this.slider.css(cssValue);
//           };
//         })(this));
//       } else {
//         this.slider.css(cssValue);
//       }
//     };


//     /**
//       Creates event related methods
//       @method createEvents
//       @private
//      */

//     NanoScroll.prototype.createEvents = function() {
//       this.events = {
//         down: (function(_this) {
//           return function(e) {
//             _this.isBeingDragged = true;
//             _this.offsetY = e.pageY - _this.slider.offset().top;
//             if (!_this.slider.is(e.target)) {
//               _this.offsetY = 0;
//             }
//             _this.pane.addClass(_this.options.activeClass);
//             _this.doc.bind(MOUSEMOVE, _this.events[DRAG]).bind(MOUSEUP, _this.events[UP]);
//             _this.body.bind(MOUSEENTER, _this.events[ENTER]);
//             return false;
//           };
//         })(this),
//         drag: (function(_this) {
//           return function(e) {
//             _this.sliderY = e.pageY - _this.$el.offset().top - _this.paneTop - (_this.offsetY || _this.sliderHeight * 0.5);
//             _this.scroll();
//             if (_this.contentScrollTop >= _this.maxScrollTop && _this.prevScrollTop !== _this.maxScrollTop) {
//               _this.$el.trigger('scrollend');
//             } else if (_this.contentScrollTop === 0 && _this.prevScrollTop !== 0) {
//               _this.$el.trigger('scrolltop');
//             }
//             return false;
//           };
//         })(this),
//         up: (function(_this) {
//           return function(e) {
//             _this.isBeingDragged = false;
//             _this.pane.removeClass(_this.options.activeClass);
//             _this.doc.unbind(MOUSEMOVE, _this.events[DRAG]).unbind(MOUSEUP, _this.events[UP]);
//             _this.body.unbind(MOUSEENTER, _this.events[ENTER]);
//             return false;
//           };
//         })(this),
//         resize: (function(_this) {
//           return function(e) {
//             _this.reset();
//           };
//         })(this),
//         panedown: (function(_this) {
//           return function(e) {
//             _this.sliderY = (e.offsetY || e.originalEvent.layerY) - (_this.sliderHeight * 0.5);
//             _this.scroll();
//             _this.events.down(e);
//             return false;
//           };
//         })(this),
//         scroll: (function(_this) {
//           return function(e) {
//             _this.updateScrollValues();
//             if (_this.isBeingDragged) {
//               return;
//             }
//             if (!_this.iOSNativeScrolling) {
//               _this.sliderY = _this.sliderTop;
//               _this.setOnScrollStyles();
//             }
//             if (e == null) {
//               return;
//             }
//             if (_this.contentScrollTop >= _this.maxScrollTop) {
//               if (_this.options.preventPageScrolling) {
//                 _this.preventScrolling(e, DOWN);
//               }
//               if (_this.prevScrollTop !== _this.maxScrollTop) {
//                 _this.$el.trigger('scrollend');
//               }
//             } else if (_this.contentScrollTop === 0) {
//               if (_this.options.preventPageScrolling) {
//                 _this.preventScrolling(e, UP);
//               }
//               if (_this.prevScrollTop !== 0) {
//                 _this.$el.trigger('scrolltop');
//               }
//             }
//           };
//         })(this),
//         wheel: (function(_this) {
//           return function(e) {
//             var delta;
//             if (e == null) {
//               return;
//             }
//             delta = e.delta || e.wheelDelta || (e.originalEvent && e.originalEvent.wheelDelta) || -e.detail || (e.originalEvent && -e.originalEvent.detail);
//             if (delta) {
//               _this.sliderY += -delta / 3;
//             }
//             _this.scroll();
//             return false;
//           };
//         })(this),
//         enter: (function(_this) {
//           return function(e) {
//             var _ref;
//             if (!_this.isBeingDragged) {
//               return;
//             }
//             if ((e.buttons || e.which) !== 1) {
//               return (_ref = _this.events)[UP].apply(_ref, arguments);
//             }
//           };
//         })(this)
//       };
//     };


//     /**
//       Adds event listeners with jQuery.
//       @method addEvents
//       @private
//      */

//     NanoScroll.prototype.addEvents = function() {
//       var events;
//       this.removeEvents();
//       events = this.events;
//       if (!this.options.disableResize) {
//         this.win.bind(RESIZE, events[RESIZE]);
//       }
//       if (!this.iOSNativeScrolling) {
//         this.slider.bind(MOUSEDOWN, events[DOWN]);
//         this.pane.bind(MOUSEDOWN, events[PANEDOWN]).bind("" + MOUSEWHEEL + " " + DOMSCROLL, events[WHEEL]);
//       }
//       this.$content.bind("" + SCROLL + " " + MOUSEWHEEL + " " + DOMSCROLL + " " + TOUCHMOVE, events[SCROLL]);
//     };


//     /**
//       Removes event listeners with jQuery.
//       @method removeEvents
//       @private
//      */

//     NanoScroll.prototype.removeEvents = function() {
//       var events;
//       events = this.events;
//       this.win.unbind(RESIZE, events[RESIZE]);
//       if (!this.iOSNativeScrolling) {
//         this.slider.unbind();
//         this.pane.unbind();
//       }
//       this.$content.unbind("" + SCROLL + " " + MOUSEWHEEL + " " + DOMSCROLL + " " + TOUCHMOVE, events[SCROLL]);
//     };


//     /**
//       Generates nanoScroller's scrollbar and elements for it.
//       @method generate
//       @chainable
//       @private
//      */

//     NanoScroll.prototype.generate = function() {
//       var contentClass, cssRule, currentPadding, options, pane, paneClass, sliderClass;
//       options = this.options;
//       paneClass = options.paneClass, sliderClass = options.sliderClass, contentClass = options.contentClass;
//       if (!(pane = this.$el.children("." + paneClass)).length && !pane.children("." + sliderClass).length) {
//         this.$el.append("<div class=\"" + paneClass + "\"><div class=\"" + sliderClass + "\" /></div>");
//       }
//       this.pane = this.$el.children("." + paneClass);
//       this.slider = this.pane.find("." + sliderClass);
//       if (BROWSER_SCROLLBAR_WIDTH === 0 && isFFWithBuggyScrollbar()) {
//         currentPadding = window.getComputedStyle(this.content, null).getPropertyValue('padding-right').replace(/[^0-9.]+/g, '');
//         cssRule = {
//           right: -14,
//           paddingRight: +currentPadding + 14
//         };
//       } else if (BROWSER_SCROLLBAR_WIDTH) {
//         cssRule = {
//           right: -BROWSER_SCROLLBAR_WIDTH
//         };
//         this.$el.addClass(options.enabledClass);
//       }
//       if (cssRule != null) {
//         this.$content.css(cssRule);
//       }
//       return this;
//     };


//     /**
//       @method restore
//       @private
//      */

//     NanoScroll.prototype.restore = function() {
//       this.stopped = false;
//       if (!this.iOSNativeScrolling) {
//         this.pane.show();
//       }
//       this.addEvents();
//     };


//     /**
//       Resets nanoScroller's scrollbar.
//       @method reset
//       @chainable
//       @example
//           $(".nano").nanoScroller();
//      */

//     NanoScroll.prototype.reset = function() {
//       var content, contentHeight, contentPosition, contentStyle, contentStyleOverflowY, paneBottom, paneHeight, paneOuterHeight, paneTop, parentMaxHeight, right, sliderHeight;
//       if (this.iOSNativeScrolling) {
//         this.contentHeight = this.content.scrollHeight;
//         return;
//       }
//       if (!this.$el.find("." + this.options.paneClass).length) {
//         this.generate().stop();
//       }
//       if (this.stopped) {
//         this.restore();
//       }
//       content = this.content;
//       contentStyle = content.style;
//       contentStyleOverflowY = contentStyle.overflowY;
//       if (BROWSER_IS_IE7) {
//         this.$content.css({
//           height: this.$content.height()
//         });
//       }
//       contentHeight = content.scrollHeight + BROWSER_SCROLLBAR_WIDTH;
//       parentMaxHeight = parseInt(this.$el.css("max-height"), 10);
//       if (parentMaxHeight > 0) {
//         this.$el.height("");
//         this.$el.height(content.scrollHeight > parentMaxHeight ? parentMaxHeight : content.scrollHeight);
//       }
//       paneHeight = this.pane.outerHeight(false);
//       paneTop = parseInt(this.pane.css('top'), 10);
//       paneBottom = parseInt(this.pane.css('bottom'), 10);
//       paneOuterHeight = paneHeight + paneTop + paneBottom;
//       sliderHeight = Math.round(paneOuterHeight / contentHeight * paneHeight);
//       if (sliderHeight < this.options.sliderMinHeight) {
//         sliderHeight = this.options.sliderMinHeight;
//       } else if ((this.options.sliderMaxHeight != null) && sliderHeight > this.options.sliderMaxHeight) {
//         sliderHeight = this.options.sliderMaxHeight;
//       }
//       if (contentStyleOverflowY === SCROLL && contentStyle.overflowX !== SCROLL) {
//         sliderHeight += BROWSER_SCROLLBAR_WIDTH;
//       }
//       this.maxSliderTop = paneOuterHeight - sliderHeight;
//       this.contentHeight = contentHeight;
//       this.paneHeight = paneHeight;
//       this.paneOuterHeight = paneOuterHeight;
//       this.sliderHeight = sliderHeight;
//       this.paneTop = paneTop;
//       this.slider.height(sliderHeight);
//       this.events.scroll();
//       this.pane.show();
//       this.isActive = true;
//       if ((content.scrollHeight === content.clientHeight) || (this.pane.outerHeight(true) >= content.scrollHeight && contentStyleOverflowY !== SCROLL)) {
//         this.pane.hide();
//         this.isActive = false;
//       } else if (this.el.clientHeight === content.scrollHeight && contentStyleOverflowY === SCROLL) {
//         this.slider.hide();
//       } else {
//         this.slider.show();
//       }
//       this.pane.css({
//         opacity: (this.options.alwaysVisible ? 1 : ''),
//         visibility: (this.options.alwaysVisible ? 'visible' : '')
//       });
//       contentPosition = this.$content.css('position');
//       if (contentPosition === 'static' || contentPosition === 'relative') {
//         right = parseInt(this.$content.css('right'), 10);
//         if (right) {
//           this.$content.css({
//             right: '',
//             marginRight: right
//           });
//         }
//       }
//       return this;
//     };


//     /**
//       @method scroll
//       @private
//       @example
//           $(".nano").nanoScroller({ scroll: 'top' });
//      */

//     NanoScroll.prototype.scroll = function() {
//       if (!this.isActive) {
//         return;
//       }
//       this.sliderY = Math.max(0, this.sliderY);
//       this.sliderY = Math.min(this.maxSliderTop, this.sliderY);
//       this.$content.scrollTop(this.maxScrollTop * this.sliderY / this.maxSliderTop);
//       if (!this.iOSNativeScrolling) {
//         this.updateScrollValues();
//         this.setOnScrollStyles();
//       }
//       return this;
//     };


//     /**
//       Scroll at the bottom with an offset value
//       @method scrollBottom
//       @param offsetY {Number}
//       @chainable
//       @example
//           $(".nano").nanoScroller({ scrollBottom: value });
//      */

//     NanoScroll.prototype.scrollBottom = function(offsetY) {
//       if (!this.isActive) {
//         return;
//       }
//       this.$content.scrollTop(this.contentHeight - this.$content.height() - offsetY).trigger(MOUSEWHEEL);
//       this.stop().restore();
//       return this;
//     };


//     /**
//       Scroll at the top with an offset value
//       @method scrollTop
//       @param offsetY {Number}
//       @chainable
//       @example
//           $(".nano").nanoScroller({ scrollTop: value });
//      */

//     NanoScroll.prototype.scrollTop = function(offsetY) {
//       if (!this.isActive) {
//         return;
//       }
//       this.$content.scrollTop(+offsetY).trigger(MOUSEWHEEL);
//       this.stop().restore();
//       return this;
//     };


//     /**
//       Scroll to an element
//       @method scrollTo
//       @param node {Node} A node to scroll to.
//       @chainable
//       @example
//           $(".nano").nanoScroller({ scrollTo: $('#a_node') });
//      */

//     NanoScroll.prototype.scrollTo = function(node) {
//       if (!this.isActive) {
//         return;
//       }
//       this.scrollTop(this.$el.find(node).get(0).offsetTop);
//       return this;
//     };


//     /**
//       To stop the operation.
//       This option will tell the plugin to disable all event bindings and hide the gadget scrollbar from the UI.
//       @method stop
//       @chainable
//       @example
//           $(".nano").nanoScroller({ stop: true });
//      */

//     NanoScroll.prototype.stop = function() {
//       if (cAF && this.scrollRAF) {
//         cAF(this.scrollRAF);
//         this.scrollRAF = null;
//       }
//       this.stopped = true;
//       this.removeEvents();
//       if (!this.iOSNativeScrolling) {
//         this.pane.hide();
//       }
//       return this;
//     };


//     /**
//       Destroys nanoScroller and restores browser's native scrollbar.
//       @method destroy
//       @chainable
//       @example
//           $(".nano").nanoScroller({ destroy: true });
//      */

//     NanoScroll.prototype.destroy = function() {
//       if (!this.stopped) {
//         this.stop();
//       }
//       if (!this.iOSNativeScrolling && this.pane.length) {
//         this.pane.remove();
//       }
//       if (BROWSER_IS_IE7) {
//         this.$content.height('');
//       }
//       this.$content.removeAttr('tabindex');
//       if (this.$el.hasClass(this.options.enabledClass)) {
//         this.$el.removeClass(this.options.enabledClass);
//         this.$content.css({
//           right: ''
//         });
//       }
//       return this;
//     };


//     /**
//       To flash the scrollbar gadget for an amount of time defined in plugin settings (defaults to 1,5s).
//       Useful if you want to show the user (e.g. on pageload) that there is more content waiting for him.
//       @method flash
//       @chainable
//       @example
//           $(".nano").nanoScroller({ flash: true });
//      */

//     NanoScroll.prototype.flash = function() {
//       if (this.iOSNativeScrolling) {
//         return;
//       }
//       if (!this.isActive) {
//         return;
//       }
//       this.reset();
//       this.pane.addClass(this.options.flashedClass);
//       setTimeout((function(_this) {
//         return function() {
//           _this.pane.removeClass(_this.options.flashedClass);
//         };
//       })(this), this.options.flashDelay);
//       return this;
//     };

//     return NanoScroll;

//   })();
//   $.fn.nanoScroller = function(settings) {
//     return this.each(function() {
//       var options, scrollbar;
//       if (!(scrollbar = this.nanoscroller)) {
//         options = $.extend({}, defaults, settings);
//         this.nanoscroller = scrollbar = new NanoScroll(this, options);
//       }
//       if (settings && typeof settings === "object") {
//         $.extend(scrollbar.options, settings);
//         if (settings.scrollBottom != null) {
//           return scrollbar.scrollBottom(settings.scrollBottom);
//         }
//         if (settings.scrollTop != null) {
//           return scrollbar.scrollTop(settings.scrollTop);
//         }
//         if (settings.scrollTo) {
//           return scrollbar.scrollTo(settings.scrollTo);
//         }
//         if (settings.scroll === 'bottom') {
//           return scrollbar.scrollBottom(0);
//         }
//         if (settings.scroll === 'top') {
//           return scrollbar.scrollTop(0);
//         }
//         if (settings.scroll && settings.scroll instanceof $) {
//           return scrollbar.scrollTo(settings.scroll);
//         }
//         if (settings.stop) {
//           return scrollbar.stop();
//         }
//         if (settings.destroy) {
//           return scrollbar.destroy();
//         }
//         if (settings.flash) {
//           return scrollbar.flash();
//         }
//       }
//       return scrollbar.reset();
//     });
//   };
//   $.fn.nanoScroller.Constructor = NanoScroll;
// });


/*MINIFIED JS */

/*! nanoScrollerJS - v0.8.7 - 2015
* http://jamesflorentino.github.com/nanoScrollerJS/
* Copyright (c) 2015 James Florentino; Licensed MIT */
(function(a){if(typeof define==="function"&&define.amd){return define(["jquery"],function(b){return a(b,window,document);});}else{if(typeof exports==="object"){return module.exports=a(require("jquery"),window,document);}else{return a(jQuery,window,document);}}})(function(g,o,B){var c,r,j,F,d,s,e,a,t,E,A,m,G,H,b,q,z,D,k,f,v,p,u,x,i,l,C,w,n,y,h;u={paneClass:"nano-pane",sliderClass:"nano-slider",contentClass:"nano-content",enabledClass:"has-scrollbar",flashedClass:"flashed",activeClass:"active",iOSNativeScrolling:false,preventPageScrolling:false,disableResize:false,alwaysVisible:false,flashDelay:1500,sliderMinHeight:20,sliderMaxHeight:null,documentContext:null,windowContext:null};D="scrollbar";z="scroll";t="mousedown";E="mouseenter";A="mousemove";G="mousewheel";m="mouseup";q="resize";d="drag";s="enter";f="up";b="panedown";j="DOMMouseScroll";F="down";v="wheel";e="keydown";a="keyup";k="touchmove";c=o.navigator.appName==="Microsoft Internet Explorer"&&/msie 7./i.test(o.navigator.appVersion)&&o.ActiveXObject;r=null;C=o.requestAnimationFrame;p=o.cancelAnimationFrame;n=B.createElement("div").style;h=(function(){var K,J,N,M,L,I;M=["t","webkitT","MozT","msT","OT"];for(K=L=0,I=M.length;L<I;K=++L){N=M[K];J=M[K]+"ransform";if(J in n){return M[K].substr(0,M[K].length-1);}}return false;})();y=function(I){if(h===false){return false;}if(h===""){return I;}return h+I.charAt(0).toUpperCase()+I.substr(1);};w=y("transform");i=w!==false;x=function(){var I,K,J;I=B.createElement("div");K=I.style;K.position="absolute";K.width="100px";K.height="100px";K.overflow=z;K.top="-9999px";B.body.appendChild(I);J=I.offsetWidth-I.clientWidth;B.body.removeChild(I);return J;};l=function(){var K,J,I;J=o.navigator.userAgent;K=/(?=.+Mac OS X)(?=.+Firefox)/.test(J);if(!K){return false;}I=/Firefox\/\d{2}\./.exec(J);if(I){I=I[0].replace(/\D+/g,"");}return K&&+I>23;};H=(function(){function I(K,J){this.el=K;this.options=J;r||(r=x());this.$el=g(this.el);this.doc=g(this.options.documentContext||B);this.win=g(this.options.windowContext||o);this.body=this.doc.find("body");this.$content=this.$el.children("."+this.options.contentClass);this.$content.attr("tabindex",this.options.tabIndex||0);this.content=this.$content[0];this.previousPosition=0;if(this.options.iOSNativeScrolling&&(this.el.style.WebkitOverflowScrolling!=null)){this.nativeScrolling();}else{this.generate();}this.createEvents();this.addEvents();this.reset();}I.prototype.preventScrolling=function(K,J){if(!this.isActive){return;}if(K.type===j){if(J===F&&K.originalEvent.detail>0||J===f&&K.originalEvent.detail<0){K.preventDefault();}}else{if(K.type===G){if(!K.originalEvent||!K.originalEvent.wheelDelta){return;}if(J===F&&K.originalEvent.wheelDelta<0||J===f&&K.originalEvent.wheelDelta>0){K.preventDefault();}}}};I.prototype.nativeScrolling=function(){this.$content.css({WebkitOverflowScrolling:"touch"});this.iOSNativeScrolling=true;this.isActive=true;};I.prototype.updateScrollValues=function(){var J,K;J=this.content;this.maxScrollTop=J.scrollHeight-J.clientHeight;this.prevScrollTop=this.contentScrollTop||0;this.contentScrollTop=J.scrollTop;K=this.contentScrollTop>this.previousPosition?"down":this.contentScrollTop<this.previousPosition?"up":"same";this.previousPosition=this.contentScrollTop;if(K!=="same"){this.$el.trigger("update",{position:this.contentScrollTop,maximum:this.maxScrollTop,direction:K});}if(!this.iOSNativeScrolling){this.maxSliderTop=this.paneHeight-this.sliderHeight;this.sliderTop=this.maxScrollTop===0?0:this.contentScrollTop*this.maxSliderTop/this.maxScrollTop;}};I.prototype.setOnScrollStyles=function(){var J;if(i){J={};J[w]="translate(0, "+this.sliderTop+"px)";}else{J={top:this.sliderTop};}if(C){if(p&&this.scrollRAF){p(this.scrollRAF);}this.scrollRAF=C((function(K){return function(){K.scrollRAF=null;return K.slider.css(J);};})(this));}else{this.slider.css(J);}};I.prototype.createEvents=function(){this.events={down:(function(J){return function(K){J.isBeingDragged=true;J.offsetY=K.pageY-J.slider.offset().top;if(!J.slider.is(K.target)){J.offsetY=0;}J.pane.addClass(J.options.activeClass);J.doc.bind(A,J.events[d]).bind(m,J.events[f]);J.body.bind(E,J.events[s]);return false;};})(this),drag:(function(J){return function(K){J.sliderY=K.pageY-J.$el.offset().top-J.paneTop-(J.offsetY||J.sliderHeight*0.5);J.scroll();if(J.contentScrollTop>=J.maxScrollTop&&J.prevScrollTop!==J.maxScrollTop){J.$el.trigger("scrollend");}else{if(J.contentScrollTop===0&&J.prevScrollTop!==0){J.$el.trigger("scrolltop");}}return false;};})(this),up:(function(J){return function(K){J.isBeingDragged=false;J.pane.removeClass(J.options.activeClass);J.doc.unbind(A,J.events[d]).unbind(m,J.events[f]);J.body.unbind(E,J.events[s]);return false;};})(this),resize:(function(J){return function(K){J.reset();};})(this),panedown:(function(J){return function(K){J.sliderY=(K.offsetY||K.originalEvent.layerY)-(J.sliderHeight*0.5);J.scroll();J.events.down(K);return false;};})(this),scroll:(function(J){return function(K){J.updateScrollValues();if(J.isBeingDragged){return;}if(!J.iOSNativeScrolling){J.sliderY=J.sliderTop;J.setOnScrollStyles();}if(K==null){return;}if(J.contentScrollTop>=J.maxScrollTop){if(J.options.preventPageScrolling){J.preventScrolling(K,F);}if(J.prevScrollTop!==J.maxScrollTop){J.$el.trigger("scrollend");}}else{if(J.contentScrollTop===0){if(J.options.preventPageScrolling){J.preventScrolling(K,f);}if(J.prevScrollTop!==0){J.$el.trigger("scrolltop");}}}};})(this),wheel:(function(J){return function(K){var L;if(K==null){return;}L=K.delta||K.wheelDelta||(K.originalEvent&&K.originalEvent.wheelDelta)||-K.detail||(K.originalEvent&&-K.originalEvent.detail);if(L){J.sliderY+=-L/3;}J.scroll();return false;};})(this),enter:(function(J){return function(L){var K;if(!J.isBeingDragged){return;}if((L.buttons||L.which)!==1){return(K=J.events)[f].apply(K,arguments);}};})(this)};};I.prototype.addEvents=function(){var J;this.removeEvents();J=this.events;if(!this.options.disableResize){this.win.bind(q,J[q]);}if(!this.iOSNativeScrolling){this.slider.bind(t,J[F]);this.pane.bind(t,J[b]).bind(""+G+" "+j,J[v]);}this.$content.bind(""+z+" "+G+" "+j+" "+k,J[z]);};I.prototype.removeEvents=function(){var J;J=this.events;this.win.unbind(q,J[q]);if(!this.iOSNativeScrolling){this.slider.unbind();this.pane.unbind();}this.$content.unbind(""+z+" "+G+" "+j+" "+k,J[z]);};I.prototype.generate=function(){var L,M,N,K,P,J,O;K=this.options;J=K.paneClass,O=K.sliderClass,L=K.contentClass;if(!(P=this.$el.children("."+J)).length&&!P.children("."+O).length){this.$el.append('<div class="'+J+'"><div class="'+O+'" /></div>');}this.pane=this.$el.children("."+J);this.slider=this.pane.find("."+O);if(r===0&&l()){N=o.getComputedStyle(this.content,null).getPropertyValue("padding-right").replace(/[^0-9.]+/g,"");M={right:-14,paddingRight:+N+14};}else{if(r){M={right:-r};this.$el.addClass(K.enabledClass);}}if(M!=null){this.$content.css(M);}return this;};I.prototype.restore=function(){this.stopped=false;if(!this.iOSNativeScrolling){this.pane.show();}this.addEvents();};I.prototype.reset=function(){var P,R,T,U,K,L,J,N,M,Q,S,O;if(this.iOSNativeScrolling){this.contentHeight=this.content.scrollHeight;return;}if(!this.$el.find("."+this.options.paneClass).length){this.generate().stop();}if(this.stopped){this.restore();}P=this.content;U=P.style;K=U.overflowY;if(c){this.$content.css({height:this.$content.height()});}R=P.scrollHeight+r;Q=parseInt(this.$el.css("max-height"),10);if(Q>0){this.$el.height("");this.$el.height(P.scrollHeight>Q?Q:P.scrollHeight);}J=this.pane.outerHeight(false);M=parseInt(this.pane.css("top"),10);L=parseInt(this.pane.css("bottom"),10);N=J+M+L;O=Math.round(N/R*J);if(O<this.options.sliderMinHeight){O=this.options.sliderMinHeight;}else{if((this.options.sliderMaxHeight!=null)&&O>this.options.sliderMaxHeight){O=this.options.sliderMaxHeight;}}if(K===z&&U.overflowX!==z){O+=r;}this.maxSliderTop=N-O;this.contentHeight=R;this.paneHeight=J;this.paneOuterHeight=N;this.sliderHeight=O;this.paneTop=M;this.slider.height(O);this.events.scroll();this.pane.show();this.isActive=true;if((P.scrollHeight===P.clientHeight)||(this.pane.outerHeight(true)>=P.scrollHeight&&K!==z)){this.pane.hide();this.isActive=false;}else{if(this.el.clientHeight===P.scrollHeight&&K===z){this.slider.hide();}else{this.slider.show();}}this.pane.css({opacity:(this.options.alwaysVisible?1:""),visibility:(this.options.alwaysVisible?"visible":"")});T=this.$content.css("position");if(T==="static"||T==="relative"){S=parseInt(this.$content.css("right"),10);if(S){this.$content.css({right:"",marginRight:S});}}return this;};I.prototype.scroll=function(){if(!this.isActive){return;}this.sliderY=Math.max(0,this.sliderY);this.sliderY=Math.min(this.maxSliderTop,this.sliderY);this.$content.scrollTop(this.maxScrollTop*this.sliderY/this.maxSliderTop);if(!this.iOSNativeScrolling){this.updateScrollValues();this.setOnScrollStyles();}return this;};I.prototype.scrollBottom=function(J){if(!this.isActive){return;}this.$content.scrollTop(this.contentHeight-this.$content.height()-J).trigger(G);this.stop().restore();return this;};I.prototype.scrollTop=function(J){if(!this.isActive){return;}this.$content.scrollTop(+J).trigger(G);this.stop().restore();return this;};I.prototype.scrollTo=function(J){if(!this.isActive){return;}this.scrollTop(this.$el.find(J).get(0).offsetTop);return this;};I.prototype.stop=function(){if(p&&this.scrollRAF){p(this.scrollRAF);this.scrollRAF=null;}this.stopped=true;this.removeEvents();if(!this.iOSNativeScrolling){this.pane.hide();}return this;};I.prototype.destroy=function(){if(!this.stopped){this.stop();}if(!this.iOSNativeScrolling&&this.pane.length){this.pane.remove();}if(c){this.$content.height("");}this.$content.removeAttr("tabindex");if(this.$el.hasClass(this.options.enabledClass)){this.$el.removeClass(this.options.enabledClass);this.$content.css({right:""});}return this;};I.prototype.flash=function(){if(this.iOSNativeScrolling){return;}if(!this.isActive){return;}this.reset();this.pane.addClass(this.options.flashedClass);setTimeout((function(J){return function(){J.pane.removeClass(J.options.flashedClass);};})(this),this.options.flashDelay);return this;};return I;})();g.fn.nanoScroller=function(I){return this.each(function(){var J,K;if(!(K=this.nanoscroller)){J=g.extend({},u,I);this.nanoscroller=K=new H(this,J);}if(I&&typeof I==="object"){g.extend(K.options,I);if(I.scrollBottom!=null){return K.scrollBottom(I.scrollBottom);}if(I.scrollTop!=null){return K.scrollTop(I.scrollTop);}if(I.scrollTo){return K.scrollTo(I.scrollTo);}if(I.scroll==="bottom"){return K.scrollBottom(0);}if(I.scroll==="top"){return K.scrollTop(0);}if(I.scroll&&I.scroll instanceof g){return K.scrollTo(I.scroll);}if(I.stop){return K.stop();}if(I.destroy){return K.destroy();}if(I.flash){return K.flash();}}return K.reset();});};g.fn.nanoScroller.Constructor=H;});