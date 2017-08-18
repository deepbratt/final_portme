// /*!
//  * @copyright &copy; Kartik Visweswaran, Krajee.com, 2013 - 2015
//  * @version 3.5.4
//  *
//  * A simple yet powerful JQuery star rating plugin that allows rendering
//  * fractional star ratings and supports Right to Left (RTL) input.
//  * 
//  * For more JQuery plugins visit http://plugins.krajee.com
//  * For more Yii related demos visit http://demos.krajee.com
//  */
// (function ($) {
//     "use strict";
//     var DEFAULT_MIN = 0, DEFAULT_MAX = 5, DEFAULT_STEP = 0.5,
//         isEmpty = function (value, trim) {
//             return value === null || value === undefined || value.length === 0 || (trim && $.trim(value) === '');
//         },
//         addCss = function ($el, css) {
//             $el.removeClass(css).addClass(css);
//         },
//         validateAttr = function ($input, vattr, options) {
//             var chk = isEmpty($input.data(vattr)) ? $input.attr(vattr) : $input.data(vattr);
//             return chk ? chk : options[vattr];
//         },
//         getDecimalPlaces = function (num) {
//             var match = ('' + num).match(/(?:\.(\d+))?(?:[eE]([+-]?\d+))?$/);
//             return !match ? 0 : Math.max(0, (match[1] ? match[1].length : 0) - (match[2] ? +match[2] : 0));
//         },
//         applyPrecision = function (val, precision) {
//             return parseFloat(val.toFixed(precision));
//         },
//         Rating = function (element, options) {
//             this.$element = $(element);
//             this.init(options);
//         };

//     Rating.prototype = {
//         constructor: Rating,
//         _parseAttr: function (vattr, options) {
//             var self = this, $el = self.$element;
//             if ($el.attr('type') === 'range' || $el.attr('type') === 'number') {
//                 var val = validateAttr($el, vattr, options), chk, finals;
//                 switch (vattr) {
//                     case 'min':
//                         chk = DEFAULT_MIN;
//                         break;
//                     case 'max':
//                         chk = DEFAULT_MAX;
//                         break;
//                     default:
//                         chk = DEFAULT_STEP;
//                 }
//                 finals = isEmpty(val) ? chk : val;
//                 return parseFloat(finals);
//             }
//             return parseFloat(options[vattr]);
//         },
//         listenClick: function($el, callback) {
//             $el.on('click touchstart', function(e) {
//                 e.stopPropagation();
//                 e.preventDefault();
//                 if (e.handled !== true) {
//                     callback(e);
//                     e.handled = true;
//                 } else {
//                     return false;
//                 }
//             });
//         },
//         setDefault: function (key, val) {
//             var self = this;
//             if (isEmpty(self[key])) {
//                 self[key] = val;
//             }
//         },
//         getPosition: function (e) {
//             var pageX = e.pageX || e.originalEvent.touches[0].pageX;
//             return pageX - this.$rating.offset().left;
//         },
//         listen: function () {
//             var self = this, pos, out;
//             self.initTouch();
//             self.listenClick(self.$rating, function(e) {
//                 if (self.inactive) {
//                     return false;
//                 }
//                 pos = self.getPosition(e);
//                 self.setStars(pos);
//                 self.$element.trigger('change').trigger('rating.change', [self.$element.val(), self.$caption.html()]);
//                 self.starClicked = true;
//             });
//             self.$rating.on("mousemove", function (e) {
//                 if (!self.hoverEnabled || self.inactive) {
//                     return;
//                 }
//                 self.starClicked = false;
//                 pos = self.getPosition(e);
//                 out = self.calculate(pos);
//                 self.toggleHover(out);
//                 self.$element.trigger('rating.hover', [out.val, out.caption, 'stars']);
//             });
//             self.$rating.on("mouseleave", function () {
//                 if (!self.hoverEnabled || self.inactive || self.starClicked) {
//                     return;
//                 }
//                 out = self.cache;
//                 self.toggleHover(out);
//                 self.$element.trigger('rating.hoverleave', ['stars']);
//             });
//             self.$clear.on("mousemove", function () {
//                 if (!self.hoverEnabled || self.inactive || !self.hoverOnClear) {
//                     return;
//                 }
//                 self.clearClicked = false;
//                 var caption = '<span class="' + self.clearCaptionClass + '">' + self.clearCaption + '</span>',
//                     val = self.clearValue, width = self.getWidthFromValue(val);
//                 out = {caption: caption, width: width, val: val};
//                 self.toggleHover(out);
//                 self.$element.trigger('rating.hover', [val, caption, 'clear']);
//             });
//             self.$clear.on("mouseleave", function () {
//                 if (!self.hoverEnabled || self.inactive || self.clearClicked || !self.hoverOnClear) {
//                     return;
//                 }
//                 out = self.cache;
//                 self.toggleHover(out);
//                 self.$element.trigger('rating.hoverleave', ['clear']);
//             });
//             self.listenClick(self.$clear, function () {
//                 if (!self.inactive) {
//                     self.clear();
//                     self.clearClicked = true;
//                 }
//             });
//             $(self.$element[0].form).on("reset", function () {
//                 if (!self.inactive) {
//                     self.reset();
//                 }
//             });
//         },
//         destroy: function () {
//             var self = this, $el = self.$element;
//             if (!isEmpty(self.$container)) {
//                 self.$container.before($el).remove();
//             }
//             $.removeData($el.get(0));
//             $el.off('rating').removeClass('hide');
//         },
//         create: function (options) {
//             var self = this, $el = self.$element;
//             options = options || self.options || {};
//             self.destroy();
//             $el.rating(options);
//         },
//         setTouch: function (e, flag) {
//             var self = this, isTouchCapable = 'ontouchstart' in window ||
//                 (window.DocumentTouch && document instanceof window.DocumentTouch);
//             if (!isTouchCapable || self.inactive) {
//                 return;
//             }
//             var ev = e.originalEvent, touches = ev.touches || ev.changedTouches, pos = self.getPosition(touches[0]);
//             if (flag) {
//                 self.setStars(pos);
//                 self.$element.trigger('change').trigger('rating.change', [self.$element.val(), self.$caption.html()]);
//                 self.starClicked = true;
//             } else {
//                 var out = self.calculate(pos), caption = out.val <= self.clearValue ? self.fetchCaption(self.clearValue) : out.caption,
//                     w = self.getWidthFromValue(self.clearValue),
//                     width = out.val <= self.clearValue ? (self.rtl ? (100 - w) + '%' : w + '%') : out.width;
//                 self.$caption.html(caption);
//                 self.$stars.css('width', width);
//             }
//         },
//         initTouch: function () {
//             var self = this;
//             self.$rating.on("touchstart touchmove touchend", function (e) {
//                 var flag = (e.type === "touchend");
//                 self.setTouch(e, flag);
//             });
//         },
//         initSlider: function (options) {
//             var self = this;
//             if (isEmpty(self.$element.val())) {
//                 self.$element.val(0);
//             }
//             self.initialValue = self.$element.val();
//             self.setDefault('min', self._parseAttr('min', options));
//             self.setDefault('max', self._parseAttr('max', options));
//             self.setDefault('step', self._parseAttr('step', options));
//             if (isNaN(self.min) || isEmpty(self.min)) {
//                 self.min = DEFAULT_MIN;
//             }
//             if (isNaN(self.max) || isEmpty(self.max)) {
//                 self.max = DEFAULT_MAX;
//             }
//             if (isNaN(self.step) || isEmpty(self.step) || self.step === 0) {
//                 self.step = DEFAULT_STEP;
//             }
//             self.diff = self.max - self.min;
//         },
//         init: function (options) {
//             var self = this, $el = self.$element, defaultStar, starVal, starWidth;
//             self.options = options;
//             $.each(options, function (key, value) {
//                 self[key] = value;
//             });
//             self.starClicked = false;
//             self.clearClicked = false;
//             self.initSlider(options);
//             self.checkDisabled();
//             self.setDefault('rtl', $el.attr('dir'));
//             if (self.rtl) {
//                 $el.attr('dir', 'rtl');
//             }
//             defaultStar = (self.glyphicon) ? '\ue006' : '\u2605';
//             self.setDefault('symbol', defaultStar);
//             self.setDefault('clearButtonBaseClass', 'clear-rating');
//             self.setDefault('clearButtonActiveClass', 'clear-rating-active');
//             self.setDefault('clearValue', self.min);
//             addCss($el, 'form-control hide');
//             self.$clearElement = isEmpty(options.clearElement) ? null : $(options.clearElement);
//             self.$captionElement = isEmpty(options.captionElement) ? null : $(options.captionElement);
//             if (self.$rating === undefined && self.$container === undefined) {
//                 self.$rating = $(document.createElement("div")).html('<div class="rating-stars"></div>');
//                 self.$container = $(document.createElement("div"));
//                 self.$container.before(self.$rating).append(self.$rating);
//                 $el.before(self.$container).appendTo(self.$rating);
//             }
//             self.$stars = self.$rating.find('.rating-stars');
//             self.generateRating();
//             self.$clear = !isEmpty(self.$clearElement) ? self.$clearElement : self.$container.find('.' + self.clearButtonBaseClass);
//             self.$caption = !isEmpty(self.$captionElement) ? self.$captionElement : self.$container.find(".caption");
//             self.setStars();
//             self.listen();
//             if (self.showClear) {
//                 self.$clear.attr({"class": self.getClearClass()});
//             }
//             starVal = $el.val();
//             starWidth = self.getWidthFromValue(starVal);
//             self.cache = {
//                 caption: self.$caption.html(),
//                 width: (self.rtl ? (100 - starWidth) : starWidth) + '%',
//                 val: starVal
//             };
//             $el.removeClass('rating-loading');
//         },
//         checkDisabled: function () {
//             var self = this;
//             self.disabled = validateAttr(self.$element, 'disabled', self.options);
//             self.readonly = validateAttr(self.$element, 'readonly', self.options);
//             self.inactive = (self.disabled || self.readonly);
//         },
//         getClearClass: function () {
//             return this.clearButtonBaseClass + ' ' + ((this.inactive) ? '' : this.clearButtonActiveClass);
//         },
//         generateRating: function () {
//             var self = this, clear = self.renderClear(), caption = self.renderCaption(),
//                 css = (self.rtl) ? 'rating-container-rtl' : 'rating-container',
//                 stars = self.getStars();
//             if (self.glyphicon) {
//                 css += (self.symbol === '\ue006' ? ' rating-gly-star' : ' rating-gly') + self.ratingClass;
//             } else {
//                 css += isEmpty(self.ratingClass) ? ' rating-uni' : ' ' + self.ratingClass;
//             }
//             self.$rating.attr('class', css);
//             self.$rating.attr('data-content', stars);
//             self.$stars.attr('data-content', stars);
//             css = self.rtl ? 'star-rating-rtl' : 'star-rating';
//             self.$container.attr('class', css + ' rating-' + self.size);
//             self.$container.removeClass('rating-active rating-disabled');
//             if (self.inactive) {
//                 self.$container.addClass('rating-disabled');
//             }
//             else {
//                 self.$container.addClass('rating-active');
//             }
//             if (isEmpty(self.$caption)) {
//                 if (self.rtl) {
//                     self.$container.prepend(caption);
//                 } else {
//                     self.$container.append(caption);
//                 }
//             }
//             if (isEmpty(self.$clear)) {
//                 if (self.rtl) {
//                     self.$container.append(clear);
//                 }
//                 else {
//                     self.$container.prepend(clear);
//                 }
//             }
//             if (!isEmpty(self.containerClass)) {
//                 addCss(self.$container, self.containerClass);
//             }
//         },
//         getStars: function () {
//             var self = this, numStars = self.stars, stars = '', i;
//             for (i = 1; i <= numStars; i++) {
//                 stars += self.symbol;
//             }
//             return stars;
//         },
//         renderClear: function () {
//             var self = this, css;
//             if (!self.showClear) {
//                 return '';
//             }
//             css = self.getClearClass();
//             if (!isEmpty(self.$clearElement)) {
//                 addCss(self.$clearElement, css);
//                 self.$clearElement.attr({"title": self.clearButtonTitle}).html(self.clearButton);
//                 return '';
//             }
//             return '<div class="' + css + '" title="' + self.clearButtonTitle + '">' + self.clearButton + '</div>';
//         },
//         renderCaption: function () {
//             var self = this, val = self.$element.val(), html;
//             if (!self.showCaption) {
//                 return '';
//             }
//             html = self.fetchCaption(val);
//             if (!isEmpty(self.$captionElement)) {
//                 addCss(self.$captionElement, 'caption');
//                 self.$captionElement.html(html);
//                 return '';
//             }
//             return '<div class="caption">' + html + '</div>';
//         },
//         fetchCaption: function (rating) {
//             var self = this, val = parseFloat(rating), css, cap, capVal, cssVal,
//                 vCap = self.starCaptions, vCss = self.starCaptionClasses, caption;
//             cssVal = typeof vCss === "function" ? vCss(val) : vCss[val];
//             capVal = typeof vCap === "function" ? vCap(val) : vCap[val];
//             cap = isEmpty(capVal) ? self.defaultCaption.replace(/\{rating\}/g, val) : capVal;
//             css = isEmpty(cssVal) ? self.clearCaptionClass : cssVal;
//             caption = (val === self.clearValue) ? self.clearCaption : cap;
//             return '<span class="' + css + '">' + caption + '</span>';
//         },
//         getWidthFromValue: function (val) {
//             var self = this, min = self.min, max = self.max;
//             if (val <= min || min === max) {
//                 return 0;
//             }
//             if (val >= max) {
//                 return 100;
//             }
//             return (val - min) * 100 / (max - min);
//         },
//         getValueFromPosition: function (pos) {
//             var self = this, precision = getDecimalPlaces(self.step),
//                 val, factor, maxWidth = self.$rating.width();
//             factor = (self.diff * pos) / (maxWidth * self.step);
//             factor = self.rtl ? Math.floor(factor) : Math.ceil(factor);
//             val = applyPrecision(parseFloat(self.min + factor * self.step), precision);
//             val = Math.max(Math.min(val, self.max), self.min);
//             return self.rtl ? (self.max - val) : val;
//         },
//         toggleHover: function (out) {
//             var self = this, w, width, caption;
//             if (self.hoverChangeCaption) {
//                 caption = out.val <= self.clearValue ? self.fetchCaption(self.clearValue) : out.caption;
//                 self.$caption.html(caption);
//             }
//             if (self.hoverChangeStars) {
//                 w = self.getWidthFromValue(self.clearValue);
//                 width = out.val <= self.clearValue ? (self.rtl ? (100 - w) + '%' : w + '%') : out.width;
//                 self.$stars.css('width', width);
//             }
//         },
//         calculate: function (pos) {
//             var self = this, defaultVal = isEmpty(self.$element.val()) ? 0 : self.$element.val(),
//                 val = arguments.length ? self.getValueFromPosition(pos) : defaultVal,
//                 caption = self.fetchCaption(val), width = self.getWidthFromValue(val);
//             if (self.rtl) {
//                 width = 100 - width;
//             }
//             width += '%';
//             return {caption: caption, width: width, val: val};
//         },
//         setStars: function (pos) {
//             var self = this, out = arguments.length ? self.calculate(pos) : self.calculate();
//             self.$element.val(out.val);
//             self.$stars.css('width', out.width);
//             self.$caption.html(out.caption);
//             self.cache = out;
//         },
//         clear: function () {
//             var self = this,
//                 title = '<span class="' + self.clearCaptionClass + '">' + self.clearCaption + '</span>';
//             self.$stars.removeClass('rated');
//             if (!self.inactive) {
//                 self.$caption.html(title);
//             }
//             self.$element.val(self.clearValue);
//             self.setStars();
//             self.$element.trigger('rating.clear');
//         },
//         reset: function () {
//             var self = this;
//             self.$element.val(self.initialValue);
//             self.setStars();
//             self.$element.trigger('rating.reset');
//         },
//         update: function (val) {
//             var self = this;
//             if (!arguments.length) {
//                 return;
//             }
//             self.$element.val(val);
//             self.setStars();
//         },
//         refresh: function (options) {
//             var self = this;
//             if (!arguments.length) {
//                 return;
//             }
//             self.$rating.off('rating');
//             if (self.$clear !== undefined) {
//                 self.$clear.off();
//             }
//             self.init($.extend(self.options, options));
//             if (self.showClear) {
//                 self.$clear.show();
//             } else {
//                 self.$clear.hide();
//             }
//             if (self.showCaption) {
//                 self.$caption.show();
//             } else {
//                 self.$caption.hide();
//             }
//             self.$element.trigger('rating.refresh');
//         }
//     };

//     $.fn.rating = function (option) {
//         var args = Array.apply(null, arguments);
//         args.shift();
//         return this.each(function () {
//             var $this = $(this),
//                 data = $this.data('rating'),
//                 options = typeof option === 'object' && option;

//             if (!data) {
//                 $this.data('rating',
//                     (data = new Rating(this, $.extend({}, $.fn.rating.defaults, options, $(this).data()))));
//             }

//             if (typeof option === 'string') {
//                 data[option].apply(data, args);
//             }
//         });
//     };

//     $.fn.rating.defaults = {
//         stars: 5,
//         glyphicon: true,
//         symbol: null,
//         ratingClass: '',
//         disabled: false,
//         readonly: false,
//         rtl: false,
//         size: 'md',
//         showClear: true,
//         showCaption: true,
//         defaultCaption: '{rating} Stars',
//         starCaptions: {
//             0.5: 'Half Star',
//             1: 'One Star',
//             1.5: 'One & Half Star',
//             2: 'Two Stars',
//             2.5: 'Two & Half Stars',
//             3: 'Three Stars',
//             3.5: 'Three & Half Stars',
//             4: 'Four Stars',
//             4.5: 'Four & Half Stars',
//             5: 'Five Stars'
//         },
//         starCaptionClasses: {
//             0.5: 'label label-danger',
//             1: 'label label-danger',
//             1.5: 'label label-warning',
//             2: 'label label-warning',
//             2.5: 'label label-info',
//             3: 'label label-info',
//             3.5: 'label label-primary',
//             4: 'label label-primary',
//             4.5: 'label label-success',
//             5: 'label label-success'
//         },
//         clearButton: '<i class="glyphicon glyphicon-minus-sign"></i>',
//         clearButtonTitle: 'Clear',
//         clearButtonBaseClass: 'clear-rating',
//         clearButtonActiveClass: 'clear-rating-active',
//         clearCaption: 'Not Rated',
//         clearCaptionClass: 'label label-default',
//         clearValue: null,
//         captionElement: null,
//         clearElement: null,
//         containerClass: null,
//         hoverEnabled: true,
//         hoverChangeCaption: true,
//         hoverChangeStars: true,
//         hoverOnClear: true
//     };

//     $.fn.rating.Constructor = Rating;

//     /**
//      * Convert automatically inputs with class 'rating'
//      * into the star rating control.
//      */
//     $('input.rating').addClass('rating-loading');

//     $(document).ready(function () {
//         var $input = $('input.rating'), count = Object.keys($input).length;
//         if (count > 0) {
//             $input.rating();
//         }
//     });
// }(window.jQuery));


/* MINIFIED JS */

/*!
 * @copyright &copy; Kartik Visweswaran, Krajee.com, 2013 - 2015
 * @version 3.5.4
 *
 * A simple yet powerful JQuery star rating plugin that allows rendering
 * fractional star ratings and supports Right to Left (RTL) input.
 * 
 * For more JQuery plugins visit http://plugins.krajee.com
 * For more Yii related demos visit http://demos.krajee.com
 */

(function(e){var c=0,i=5,f=0.5,d=function(l,k){return l===null||l===undefined||l.length===0||(k&&e.trim(l)==="");},g=function(l,k){l.removeClass(k).addClass(k);},b=function(n,m,l){var k=d(n.data(m))?n.attr(m):n.data(m);return k?k:l[m];},a=function(l){var k=(""+l).match(/(?:\.(\d+))?(?:[eE]([+-]?\d+))?$/);return !k?0:Math.max(0,(k[1]?k[1].length:0)-(k[2]?+k[2]:0));},j=function(l,k){return parseFloat(l.toFixed(k));},h=function(l,k){this.$element=e(l);this.init(k);};h.prototype={constructor:h,_parseAttr:function(p,n){var m=this,o=m.$element;if(o.attr("type")==="range"||o.attr("type")==="number"){var q=b(o,p,n),l,k;switch(p){case"min":l=c;break;case"max":l=i;break;default:l=f;}k=d(q)?l:q;return parseFloat(k);}return parseFloat(n[p]);},listenClick:function(k,l){k.on("click touchstart",function(m){m.stopPropagation();m.preventDefault();if(m.handled!==true){l(m);m.handled=true;}else{return false;}});},setDefault:function(l,m){var k=this;if(d(k[l])){k[l]=m;}},getPosition:function(l){var k=l.pageX||l.originalEvent.touches[0].pageX;return k-this.$rating.offset().left;},listen:function(){var k=this,m,l;k.initTouch();k.listenClick(k.$rating,function(n){if(k.inactive){return false;}m=k.getPosition(n);k.setStars(m);k.$element.trigger("change").trigger("rating.change",[k.$element.val(),k.$caption.html()]);k.starClicked=true;});k.$rating.on("mousemove",function(n){if(!k.hoverEnabled||k.inactive){return;}k.starClicked=false;m=k.getPosition(n);l=k.calculate(m);k.toggleHover(l);k.$element.trigger("rating.hover",[l.val,l.caption,"stars"]);});k.$rating.on("mouseleave",function(){if(!k.hoverEnabled||k.inactive||k.starClicked){return;}l=k.cache;k.toggleHover(l);k.$element.trigger("rating.hoverleave",["stars"]);});k.$clear.on("mousemove",function(){if(!k.hoverEnabled||k.inactive||!k.hoverOnClear){return;}k.clearClicked=false;var n='<span class="'+k.clearCaptionClass+'">'+k.clearCaption+"</span>",p=k.clearValue,o=k.getWidthFromValue(p);l={caption:n,width:o,val:p};k.toggleHover(l);k.$element.trigger("rating.hover",[p,n,"clear"]);});k.$clear.on("mouseleave",function(){if(!k.hoverEnabled||k.inactive||k.clearClicked||!k.hoverOnClear){return;}l=k.cache;k.toggleHover(l);k.$element.trigger("rating.hoverleave",["clear"]);});k.listenClick(k.$clear,function(){if(!k.inactive){k.clear();k.clearClicked=true;}});e(k.$element[0].form).on("reset",function(){if(!k.inactive){k.reset();}});},destroy:function(){var k=this,l=k.$element;if(!d(k.$container)){k.$container.before(l).remove();}e.removeData(l.get(0));l.off("rating").removeClass("hide");},create:function(l){var k=this,m=k.$element;l=l||k.options||{};k.destroy();m.rating(l);},setTouch:function(n,p){var u=this,o="ontouchstart" in window||(window.DocumentTouch&&document instanceof window.DocumentTouch);if(!o||u.inactive){return;}var r=n.originalEvent,m=r.touches||r.changedTouches,q=u.getPosition(m[0]);if(p){u.setStars(q);u.$element.trigger("change").trigger("rating.change",[u.$element.val(),u.$caption.html()]);u.starClicked=true;}else{var l=u.calculate(q),t=l.val<=u.clearValue?u.fetchCaption(u.clearValue):l.caption,s=u.getWidthFromValue(u.clearValue),k=l.val<=u.clearValue?(u.rtl?(100-s)+"%":s+"%"):l.width;u.$caption.html(t);u.$stars.css("width",k);}},initTouch:function(){var k=this;k.$rating.on("touchstart touchmove touchend",function(m){var l=(m.type==="touchend");k.setTouch(m,l);});},initSlider:function(l){var k=this;if(d(k.$element.val())){k.$element.val(0);}k.initialValue=k.$element.val();k.setDefault("min",k._parseAttr("min",l));k.setDefault("max",k._parseAttr("max",l));k.setDefault("step",k._parseAttr("step",l));if(isNaN(k.min)||d(k.min)){k.min=c;}if(isNaN(k.max)||d(k.max)){k.max=i;}if(isNaN(k.step)||d(k.step)||k.step===0){k.step=f;}k.diff=k.max-k.min;},init:function(m){var l=this,n=l.$element,k,p,o;l.options=m;e.each(m,function(q,r){l[q]=r;});l.starClicked=false;l.clearClicked=false;l.initSlider(m);l.checkDisabled();l.setDefault("rtl",n.attr("dir"));if(l.rtl){n.attr("dir","rtl");}k=(l.glyphicon)?"\ue006":"\u2605";l.setDefault("symbol",k);l.setDefault("clearButtonBaseClass","clear-rating");l.setDefault("clearButtonActiveClass","clear-rating-active");l.setDefault("clearValue",l.min);g(n,"form-control hide");l.$clearElement=d(m.clearElement)?null:e(m.clearElement);l.$captionElement=d(m.captionElement)?null:e(m.captionElement);if(l.$rating===undefined&&l.$container===undefined){l.$rating=e(document.createElement("div")).html('<div class="rating-stars"></div>');l.$container=e(document.createElement("div"));l.$container.before(l.$rating).append(l.$rating);n.before(l.$container).appendTo(l.$rating);}l.$stars=l.$rating.find(".rating-stars");l.generateRating();l.$clear=!d(l.$clearElement)?l.$clearElement:l.$container.find("."+l.clearButtonBaseClass);l.$caption=!d(l.$captionElement)?l.$captionElement:l.$container.find(".caption");l.setStars();l.listen();if(l.showClear){l.$clear.attr({"class":l.getClearClass()});}p=n.val();o=l.getWidthFromValue(p);l.cache={caption:l.$caption.html(),width:(l.rtl?(100-o):o)+"%",val:p};n.removeClass("rating-loading");},checkDisabled:function(){var k=this;k.disabled=b(k.$element,"disabled",k.options);k.readonly=b(k.$element,"readonly",k.options);k.inactive=(k.disabled||k.readonly);},getClearClass:function(){return this.clearButtonBaseClass+" "+((this.inactive)?"":this.clearButtonActiveClass);},generateRating:function(){var n=this,l=n.renderClear(),m=n.renderCaption(),o=(n.rtl)?"rating-container-rtl":"rating-container",k=n.getStars();if(n.glyphicon){o+=(n.symbol==="\ue006"?" rating-gly-star":" rating-gly")+n.ratingClass;}else{o+=d(n.ratingClass)?" rating-uni":" "+n.ratingClass;}n.$rating.attr("class",o);n.$rating.attr("data-content",k);n.$stars.attr("data-content",k);o=n.rtl?"star-rating-rtl":"star-rating";n.$container.attr("class",o+" rating-"+n.size);n.$container.removeClass("rating-active rating-disabled");if(n.inactive){n.$container.addClass("rating-disabled");}else{n.$container.addClass("rating-active");}if(d(n.$caption)){if(n.rtl){n.$container.prepend(m);}else{n.$container.append(m);}}if(d(n.$clear)){if(n.rtl){n.$container.append(l);}else{n.$container.prepend(l);}}if(!d(n.containerClass)){g(n.$container,n.containerClass);}},getStars:function(){var m=this,l=m.stars,k="",n;for(n=1;n<=l;n++){k+=m.symbol;}return k;},renderClear:function(){var k=this,l;if(!k.showClear){return"";}l=k.getClearClass();if(!d(k.$clearElement)){g(k.$clearElement,l);k.$clearElement.attr({title:k.clearButtonTitle}).html(k.clearButton);return"";}return'<div class="'+l+'" title="'+k.clearButtonTitle+'">'+k.clearButton+"</div>";},renderCaption:function(){var k=this,m=k.$element.val(),l;if(!k.showCaption){return"";}l=k.fetchCaption(m);if(!d(k.$captionElement)){g(k.$captionElement,"caption");k.$captionElement.html(l);return"";}return'<div class="caption">'+l+"</div>";},fetchCaption:function(m){var s=this,l=parseFloat(m),n,q,t,o,k=s.starCaptions,p=s.starCaptionClasses,r;o=typeof p==="function"?p(l):p[l];t=typeof k==="function"?k(l):k[l];q=d(t)?s.defaultCaption.replace(/\{rating\}/g,l):t;n=d(o)?s.clearCaptionClass:o;r=(l===s.clearValue)?s.clearCaption:q;return'<span class="'+n+'">'+r+"</span>";},getWidthFromValue:function(n){var l=this,m=l.min,k=l.max;if(n<=m||m===k){return 0;}if(n>=k){return 100;}return(n-m)*100/(k-m);},getValueFromPosition:function(p){var l=this,k=a(l.step),o,m,n=l.$rating.width();m=(l.diff*p)/(n*l.step);m=l.rtl?Math.floor(m):Math.ceil(m);o=j(parseFloat(l.min+m*l.step),k);o=Math.max(Math.min(o,l.max),l.min);return l.rtl?(l.max-o):o;},toggleHover:function(n){var m=this,k,o,l;if(m.hoverChangeCaption){l=n.val<=m.clearValue?m.fetchCaption(m.clearValue):n.caption;m.$caption.html(l);}if(m.hoverChangeStars){k=m.getWidthFromValue(m.clearValue);o=n.val<=m.clearValue?(m.rtl?(100-k)+"%":k+"%"):n.width;m.$stars.css("width",o);}},calculate:function(p){var l=this,o=d(l.$element.val())?0:l.$element.val(),n=arguments.length?l.getValueFromPosition(p):o,k=l.fetchCaption(n),m=l.getWidthFromValue(n);if(l.rtl){m=100-m;}m+="%";return{caption:k,width:m,val:n};},setStars:function(m){var k=this,l=arguments.length?k.calculate(m):k.calculate();k.$element.val(l.val);k.$stars.css("width",l.width);k.$caption.html(l.caption);k.cache=l;},clear:function(){var k=this,l='<span class="'+k.clearCaptionClass+'">'+k.clearCaption+"</span>";k.$stars.removeClass("rated");if(!k.inactive){k.$caption.html(l);}k.$element.val(k.clearValue);k.setStars();k.$element.trigger("rating.clear");},reset:function(){var k=this;k.$element.val(k.initialValue);k.setStars();k.$element.trigger("rating.reset");},update:function(l){var k=this;if(!arguments.length){return;}k.$element.val(l);k.setStars();},refresh:function(l){var k=this;if(!arguments.length){return;}k.$rating.off("rating");if(k.$clear!==undefined){k.$clear.off();}k.init(e.extend(k.options,l));if(k.showClear){k.$clear.show();}else{k.$clear.hide();}if(k.showCaption){k.$caption.show();}else{k.$caption.hide();}k.$element.trigger("rating.refresh");}};e.fn.rating=function(l){var k=Array.apply(null,arguments);k.shift();return this.each(function(){var o=e(this),n=o.data("rating"),m=typeof l==="object"&&l;if(!n){o.data("rating",(n=new h(this,e.extend({},e.fn.rating.defaults,m,e(this).data()))));}if(typeof l==="string"){n[l].apply(n,k);}});};e.fn.rating.defaults={stars:5,glyphicon:true,symbol:null,ratingClass:"",disabled:false,readonly:false,rtl:false,size:"md",showClear:true,showCaption:true,defaultCaption:"{rating} Stars",starCaptions:{0.5:"Half Star",1:"One Star",1.5:"One & Half Star",2:"Two Stars",2.5:"Two & Half Stars",3:"Three Stars",3.5:"Three & Half Stars",4:"Four Stars",4.5:"Four & Half Stars",5:"Five Stars"},starCaptionClasses:{0.5:"label label-danger",1:"label label-danger",1.5:"label label-warning",2:"label label-warning",2.5:"label label-info",3:"label label-info",3.5:"label label-primary",4:"label label-primary",4.5:"label label-success",5:"label label-success"},clearButton:'<i class="glyphicon glyphicon-minus-sign"></i>',clearButtonTitle:"Clear",clearButtonBaseClass:"clear-rating",clearButtonActiveClass:"clear-rating-active",clearCaption:"Not Rated",clearCaptionClass:"label label-default",clearValue:null,captionElement:null,clearElement:null,containerClass:null,hoverEnabled:true,hoverChangeCaption:true,hoverChangeStars:true,hoverOnClear:true};e.fn.rating.Constructor=h;e("input.rating").addClass("rating-loading");e(document).ready(function(){var l=e("input.rating"),k=Object.keys(l).length;if(k>0){l.rating();}});}(window.jQuery));
