// /**
//  * jQuery Form Validator
//  * ------------------------------------------
//  * Created by Victor Jonsson <http://www.victorjonsson.se>
//  *
//  * @website http://formvalidator.net/
//  * @license MIT
//  * @version 2.2.83
//  */
// (function ($) {

//   'use strict';

//   var $window = $(window),
//     _getInputParentContainer = function ($elem) {
//       if ($elem.valAttr('error-msg-container')) {
//         return $($elem.valAttr('error-msg-container'));
//       } else {
//         var $parent = $elem.parent();
//         if ( !$parent.hasClass('form-group') && !$parent.closest('form').hasClass('form-horizontal') ) {
//           var $formGroup = $parent.closest('.form-group');
//           if ($formGroup.length) {
//             return $formGroup.eq(0);
//           }
//         }
//         return $parent;
//       }
//     },
//     _applyErrorStyle = function ($elem, conf) {
//       $elem
//         .addClass(conf.errorElementClass)
//         .removeClass('valid');

//       _getInputParentContainer($elem)
//         .addClass(conf.inputParentClassOnError)
//         .removeClass(conf.inputParentClassOnSuccess);

//       if (conf.borderColorOnError !== '') {
//         $elem.css('border-color', conf.borderColorOnError);
//       }
//     },
//     _removeErrorStyle = function ($elem, conf) {
//       $elem.each(function () {
//         var $this = $(this);

//         _setInlineErrorMessage($this, '', conf, conf.errorMessagePosition);

//         $this
//           .removeClass('valid')
//           .removeClass(conf.errorElementClass)
//           .css('border-color', '');

//         _getInputParentContainer($this)
//           .removeClass(conf.inputParentClassOnError)
//           .removeClass(conf.inputParentClassOnSuccess)
//           .find('.' + conf.errorMessageClass) // remove inline span holding error message
//             .remove();
//       });
//     },
//     _setInlineErrorMessage = function ($input, mess, conf, $messageContainer) {
//       var custom = document.getElementById($input.attr('name') + '_err_msg'),
//           setErrorMessage = function($elem) {
//             $window.trigger('validationErrorDisplay', [$input, $elem]);
//             $elem.html(mess);
//           },
//           $mess = {};

//       if (custom) {
//         setErrorMessage($(custom));
//       }
//       else if (typeof $messageContainer === 'object') {
//         var $found = false;
//         $messageContainer.find('.' + conf.errorMessageClass).each(function () {
//           if (this.inputReferer === $input[0]) {
//             $found = $(this);
//             return false;
//           }
//         });
//         if ($found) {
//           if (!mess) {
//             $found.remove();
//           } else {
//             setErrorMessage($found);
//           }
//         } else {
//           $mess = $('<div class="' + conf.errorMessageClass + '"></div>');
//           setErrorMessage($mess);
//           $mess[0].inputReferer = $input[0];
//           $messageContainer.prepend($mess);
//         }
//       }
//       else {
//         var $parent = _getInputParentContainer($input);
//         $mess = $parent.find('.' + conf.errorMessageClass + '.help-block');

//         if ($mess.length === 0) {
//           $mess = $('<span></span>').addClass('help-block').addClass(conf.errorMessageClass);
//           $mess.appendTo($parent);
//         }

//         setErrorMessage($mess);
//       }
//     },
//     _templateMessage = function ($form, title, errorMessages, conf) {
//       var messages = conf.errorMessageTemplate.messages.replace(/\{errorTitle\}/g, title),
//           fields = [],
//           container;

//       $.each(errorMessages, function (i, msg) {
//         fields.push(conf.errorMessageTemplate.field.replace(/\{msg\}/g, msg));
//       });

//       messages = messages.replace(/\{fields\}/g, fields.join(''));
//       container = conf.errorMessageTemplate.container.replace(/\{errorMessageClass\}/g, conf.errorMessageClass);
//       container = container.replace(/\{messages\}/g, messages);
//       $form.children().eq(0).before(container);
//     };


//   /**
//    * Assigns validateInputOnBlur function to elements blur event
//    *
//    * @param {Object} language Optional, will override $.formUtils.LANG
//    * @param {Object} conf Optional, will override the default settings
//    * @return {jQuery}
//    */
//   $.fn.validateOnBlur = function (language, conf) {
//     this.find('*[data-validation]')
//       .bind('blur.validation', function () {

//         $(this).validateInputOnBlur(language, conf, true, 'blur');

//       });
//     if (conf.validateCheckboxRadioOnClick) {
//       // bind click event to validate on click for radio & checkboxes for nice UX
//       this.find('input[type=checkbox][data-validation],input[type=radio][data-validation]')
//         .bind('click.validation', function () {
//           $(this).validateInputOnBlur(language, conf, true, 'click');
//         });
//     }

//     return this;
//   };

//   /*
//    * Assigns validateInputOnBlur function to elements custom event
//    * @param {Object} language Optional, will override $.formUtils.LANG
//    * @param {Object} settings Optional, will override the default settings
//    * * @return {jQuery}
//    */
//   $.fn.validateOnEvent = function (language, settings) {
//     this.find('*[data-validation-event]')
//       .each(function () {
//         var $el = $(this),
//             etype = $el.valAttr('event');
//         if (etype) {
//           $el
//             .unbind(etype + '.validation')
//             .bind(etype + '.validation', function () {
//               $(this).validateInputOnBlur(language, settings, true, etype);
//             });
//         }
//       });
//     return this;
//   };

//   /**
//    * fade in help message when input gains focus
//    * fade out when input loses focus
//    * <input data-help="The info that I want to display for the user when input is focused" ... />
//    *
//    * @param {String} attrName - Optional, default is data-help
//    * @return {jQuery}
//    */
//   $.fn.showHelpOnFocus = function (attrName) {
//     if (!attrName) {
//       attrName = 'data-validation-help';
//     }

//     // Remove previously added event listeners
//     this.find('.has-help-txt')
//       .valAttr('has-keyup-event', false)
//       .removeClass('has-help-txt');

//     // Add help text listeners
//     this.find('textarea,input').each(function () {
//       var $elem = $(this),
//           className = 'jquery_form_help_' + ($elem.attr('name') || '').replace(/(:|\.|\[|\])/g, ''),
//           help = $elem.attr(attrName);

//       if (help) {
//         $elem
//           .addClass('has-help-txt')
//           .unbind('focus.help')
//           .bind('focus.help', function () {
//             var $help = $elem.parent().find('.' + className);
//             if ($help.length === 0) {
//               $help = $('<span />')
//                         .addClass(className)
//                         .addClass('help')
//                         .addClass('help-block') // twitter bs
//                         .text(help)
//                         .hide();

//               $elem.after($help);
//             }
//             $help.fadeIn();
//           })
//           .unbind('blur.help')
//           .bind('blur.help', function () {
//             $(this)
//               .parent()
//               .find('.' + className)
//               .fadeOut('slow');
//           });
//       }
//     });

//     return this;
//   };

//   /**
//    * @param {Function} cb
//    * @param {Object} [conf]
//    * @param {Object} [lang]
//    */
//   $.fn.validate = function(cb, conf, lang) {
//     var language = $.extend({}, $.formUtils.LANG, lang || {});
//     this.each(function() {
        
//       var $elem = $(this),
//           formDefaultConfig = $elem.closest('form').get(0).validationConfig || {};

//       $elem.one('validation', function(evt, isValid) {
//         if ( typeof cb === 'function' ) {
//           cb(isValid, this, evt);
//         }
//       });

//       $elem.validateInputOnBlur(
//           language,
//           $.extend({}, formDefaultConfig, conf || {}),
//           true
//         );
//     });
//   };

//   /**
//    * Tells whether or not validation of this input will have to postpone the form submit ()
//    * @returns {Boolean}
//    */
//   $.fn.willPostponeValidation = function() {
//     return (this.valAttr('suggestion-nr') ||
//             this.valAttr('postpone') ||
//             this.hasClass('hasDatepicker')) &&
//             !window.postponedValidation;
//   };

//   /**
//    * Validate single input when it loses focus
//    * shows error message in a span element
//    * that is appended to the parent element
//    *
//    * @param {Object} [language] Optional, will override $.formUtils.LANG
//    * @param {Object} [conf] Optional, will override the default settings
//    * @param {Boolean} attachKeyupEvent Optional
//    * @param {String} eventType
//    * @return {jQuery}
//    */
//   $.fn.validateInputOnBlur = function (language, conf, attachKeyupEvent, eventType) {

//     $.formUtils.eventType = eventType;

//     if ( this.willPostponeValidation() ) {
//       // This validation has to be postponed
//       var _self = this,
//           postponeTime = this.valAttr('postpone') || 200;

//       window.postponedValidation = function () {
//         _self.validateInputOnBlur(language, conf, attachKeyupEvent, eventType);
//         window.postponedValidation = false;
//       };

//       setTimeout(function () {
//         if (window.postponedValidation) {
//           window.postponedValidation();
//         }
//       }, postponeTime);

//       return this;
//     }

//     language = $.extend({}, $.formUtils.LANG, language || {});
//     _removeErrorStyle(this, conf);
//     var $elem = this,
//         $form = $elem.closest('form'),
//         result = $.formUtils.validateInput(
//                     $elem,
//                     language,
//                     conf,
//                     $form,
//                     eventType
//                   );

//     if ( result.isValid ) {
//       if( result.shouldChangeDisplay ) {
//           $elem.addClass('valid');
//           _getInputParentContainer($elem)
//             .addClass(conf.inputParentClassOnSuccess);
//       }
//     }
//     else if (!result.isValid) {

//       _applyErrorStyle($elem, conf);
//       _setInlineErrorMessage($elem, result.errorMsg, conf, conf.errorMessagePosition);

//       if (attachKeyupEvent) {
//         $elem
//           .unbind('keyup.validation')
//           .bind('keyup.validation', function () {
//             $(this).validateInputOnBlur(language, conf, false, 'keyup');
//           });
//       }
//     }

//     return this;
//   };

//   /**
//    * Short hand for fetching/adding/removing element attributes
//    * prefixed with 'data-validation-'
//    *
//    * @param {String} name
//    * @param {String|Boolean} [val]
//    * @return string|undefined
//    * @protected
//    */
//   $.fn.valAttr = function (name, val) {
//     if (val === undefined) {
//       return this.attr('data-validation-' + name);
//     } else if (val === false || val === null) {
//       return this.removeAttr('data-validation-' + name);
//     } else {
//       name = ((name.length > 0) ? '-' + name : '');
//       return this.attr('data-validation' + name, val);
//     }
//   };

//   /**
//    * Function that validates all inputs in active form
//    *
//    * @param {Object} [language]
//    * @param {Object} [conf]
//    * @param {Boolean} [displayError] Defaults to true
//    */
//   $.fn.isValid = function (language, conf, displayError) {

//     if ($.formUtils.isLoadingModules) {
//       var $self = this;
//       setTimeout(function () {
//         $self.isValid(language, conf, displayError);
//       }, 200);
//       return null;
//     }

//     conf = $.extend({}, $.formUtils.defaultConfig(), conf || {});
//     language = $.extend({}, $.formUtils.LANG, language || {});
//     displayError = displayError !== false;

//     if ($.formUtils.errorDisplayPreventedWhenHalted) {
//       // isValid() was called programmatically with argument displayError set
//       // to false when the validation was halted by any of the validators
//       delete $.formUtils.errorDisplayPreventedWhenHalted;
//       displayError = false;
//     }

//     $.formUtils.isValidatingEntireForm = true;
//     $.formUtils.haltValidation = false;

//     /**
//      * Adds message to error message stack if not already in the message stack
//      *
//      * @param {String} mess
//      * @para {jQuery} $elem
//      */
//     var addErrorMessage = function (mess, $elem) {
//           if ($.inArray(mess, errorMessages) < 0) {
//             errorMessages.push(mess);
//           }
//           errorInputs.push($elem);
//           $elem.attr('current-error', mess);
//           if (displayError) {
//             _applyErrorStyle($elem, conf);
//           }
//         },

//         /** Holds inputs (of type checkox or radio) already validated, to prevent recheck of mulitple checkboxes & radios */
//         checkedInputs = [],

//         /** Error messages for this validation */
//         errorMessages = [],

//         /** Input elements which value was not valid */
//         errorInputs = [],

//         /** Form instance */
//         $form = this,

//       /**
//        * Tells whether or not to validate element with this name and of this type
//        *
//        * @param {String} name
//        * @param {String} type
//        * @return {Boolean}
//        */
//         ignoreInput = function (name, type) {
//         if (type === 'submit' || type === 'button' || type === 'reset') {
//           return true;
//         }
//         return $.inArray(name, conf.ignore || []) > -1;
//       };

//     // Reset style and remove error class
//     if (displayError) {
//       $form.find('.' + conf.errorMessageClass + '.alert').remove();
//       _removeErrorStyle($form.find('.' + conf.errorElementClass + ',.valid'), conf);
//     }
        
  
     
//     // Validate element values
//     $form.find('input,textarea,select,iframe').filter(':not([type="submit"],[type="button"])').each(function () {
//       var $elem = $(this),
//         elementType = $elem.attr('type'),
//         isCheckboxOrRadioBtn = elementType === 'radio' || elementType === 'checkbox',
//         elementName = $elem.attr('name');
//         //console.log($elem)

//       if (!ignoreInput(elementName, elementType) && (!isCheckboxOrRadioBtn || $.inArray(elementName, checkedInputs) < 0)) {

//         if (isCheckboxOrRadioBtn) {
//           checkedInputs.push(elementName);
//         }

//         var result = $.formUtils.validateInput(
//                               $elem,
//                               language,
//                               conf,
//                               $form,
//                               'submit'
//                             );

//         if( result.shouldChangeDisplay ) {
//           if ( !result.isValid ) {
//             addErrorMessage(result.errorMsg, $elem);
//           } else if( result.isValid ) {
//             $elem
//               .valAttr('current-error', false)
//               .addClass('valid');

//             _getInputParentContainer($elem)
//               .addClass(conf.inputParentClassOnSuccess);
//           }
//         }
//       }
//     });

//     // Run validation callback
//     if (typeof conf.onValidate === 'function') {
//       var errors = conf.onValidate($form);
//       if ($.isArray(errors)) {
//         $.each(errors, function (i, err) {
//           addErrorMessage(err.message, err.element);
//         });
//       }
//       else if (errors && errors.element && errors.message) {
//         addErrorMessage(errors.message, errors.element);
//       }
//     }

//     // Reset form validation flag
//     $.formUtils.isValidatingEntireForm = false;

//     // Validation failed
//     if (!$.formUtils.haltValidation && errorInputs.length > 0) {

//       if (displayError) {
//         // display all error messages in top of form
//         if (conf.errorMessagePosition === 'top') {
//           _templateMessage($form, language.errorTitle, errorMessages, conf);
//         }
//         // Customize display message
//         else if (conf.errorMessagePosition === 'custom') {
//           if (typeof conf.errorMessageCustom === 'function') {
//             conf.errorMessageCustom($form, language.errorTitle, errorMessages, conf);
//           }
//         }
//         // Display error message below input field or in defined container
//         else {
//           $.each(errorInputs, function (i, $input) {
//             _setInlineErrorMessage($input, $input.attr('current-error'), conf, conf.errorMessagePosition);
//           });
//         }

//         if (conf.scrollToTopOnError) {
//           $window.scrollTop($form.offset().top - 20);
//         }
//       }

//       return false;
//     }

//     if (!displayError && $.formUtils.haltValidation) {
//       $.formUtils.errorDisplayPreventedWhenHalted = true;
//     }

//     return !$.formUtils.haltValidation;
//   };

//   /**
//    * @deprecated
//    * @param language
//    * @param conf
//    */
//   $.fn.validateForm = function (language, conf) {
//     if (window.console && typeof window.console.warn === 'function') {
//       window.console.warn('Use of deprecated function $.validateForm, use $.isValid instead');
//     }
//     return this.isValid(language, conf, true);
//   };

//   /**
//    * Plugin for displaying input length restriction
//    */
//   $.fn.restrictLength = function (maxLengthElement) {
//     new $.formUtils.lengthRestriction(this, maxLengthElement);
//     return this;
//   };

//   /**
//    * Add suggestion dropdown to inputs having data-suggestions with a comma
//    * separated string with suggestions
//    * @param {Array} [settings]
//    * @returns {jQuery}
//    */
//   $.fn.addSuggestions = function (settings) {
//     var sugs = false;
//     this.find('input').each(function () {
//       var $field = $(this);

//       sugs = $.split($field.attr('data-suggestions'));

//       if (sugs.length > 0 && !$field.hasClass('has-suggestions')) {
//         $.formUtils.suggest($field, sugs, settings);
//         $field.addClass('has-suggestions');
//       }
//     });
//     return this;
//   };

//   /**
//    * A bit smarter split function
//    * delimiter can be space, comma, dash or pipe
//    * @param {String} val
//    * @param {Function|String} [callback]
//    * @returns {Array|void}
//    */
//   $.split = function (val, callback) {
//     if (typeof callback !== 'function') {
//       // return array
//       if (!val) {
//         return [];
//       }
//       var values = [];
//       $.each(val.split(callback ? callback : /[,|\-\s]\s*/g),
//         function (i, str) {
//           str = $.trim(str);
//           if (str.length) {
//             values.push(str);
//           }
//         }
//       );
//       return values;
//     } else if (val) {
//       // exec callback func on each
//       $.each(val.split(/[,|\-\s]\s*/g),
//         function (i, str) {
//           str = $.trim(str);
//           if (str.length) {
//             return callback(str, i);
//           }
//         }
//       );
//     }
//   };

//   /**
//    * Short hand function that makes the validation setup require less code
//    * @param conf
//    */
//   $.validate = function (conf) {

//     var defaultConf = $.extend($.formUtils.defaultConfig(), {
//       form: 'form',
//       /*
//        * Enable custom event for validation
//        */
//       validateOnEvent: false,
//       validateOnBlur: true,
//       validateCheckboxRadioOnClick: true,
//       showHelpOnFocus: true,
//       addSuggestions: true,
//       modules: '',
//       onModulesLoaded: null,
//       language: false,
//       onSuccess: false,
//       onError: false,
//       onElementValidate: false,
//     });

//     conf = $.extend(defaultConf, conf || {});

//     if( conf.lang && conf.lang !== 'en' ) {
//       var langModule = 'lang/'+conf.lang+'.js';
//       conf.modules += conf.modules.length ? ','+langModule : langModule;
//     }

//     // Add validation to forms
//     $(conf.form).each(function (i, form) {

//       // Make a reference to the config for this form
//       form.validationConfig = conf;

//       // Trigger jQuery event that we're about to setup va
//       var $form = $(form);
//       $window.trigger('formValidationSetup', [$form, conf]);

//       // Remove classes and event handlers that might have been
//       // added by a previous call to $.validate
//       $form.find('.has-help-txt')
//           .unbind('focus.validation')
//           .unbind('blur.validation');

//       $form
//         .removeClass('has-validation-callback')
//         .unbind('submit.validation')
//         .unbind('reset.validation')
//         .find('input[data-validation],textarea[data-validation]')
//           .unbind('blur.validation');

//       // Validate when submitted
//       $form.bind('submit.validation', function () {

//         var $form = $(this);

        

//         if ($.formUtils.haltValidation) {
//           // pressing several times on submit button while validation is halted
//           return false;
//         }

//         if ($.formUtils.isLoadingModules) {
//           setTimeout(function () {
//             $form.trigger('submit.validation');
//           }, 200);
//           return false;
//         }

//         var valid = $form.isValid(conf.language, conf);
//         var img_validation = $form.find('img.crop-align').attr('src');
//         var border_red = $(this).find('.crop-image-box .myLabel')
//         border_red.css('border-color','#000');
//         $(this).find('.crop-image-box .help-block.form-error').remove()
//         if(img_validation == '')
//         {
//           border_red.css('border-color','#a94442');
//           border_red.after('<span class="help-block form-error">Please upload your cover page</span>');
//           return false;
//         }
          
//         if ($.formUtils.haltValidation) {
//           // Validation got halted by one of the validators
//           return false;

//         } else {
          
//           if (valid && typeof conf.onSuccess === 'function') {
//             var callbackResponse = conf.onSuccess($form);
//             if (callbackResponse === false) {
//               return false;
//             }
//           } else if (!valid && typeof conf.onError === 'function') {
//             conf.onError($form);
//             return false;
//           } else {
//             return valid;
//           }
//         }


//       })
//       .bind('reset.validation', function () {
//         // remove messages
//         $(this).find('.' + conf.errorMessageClass + '.alert').remove();
//         _removeErrorStyle($(this).find('.' + conf.errorElementClass + ',.valid'), conf);
//       })
//       .addClass('has-validation-callback');

//       if (conf.showHelpOnFocus) {
//         $form.showHelpOnFocus();
//       }
//       if (conf.addSuggestions) {
//         $form.addSuggestions();
//       }
//       if (conf.validateOnBlur) {
//         $form.validateOnBlur(conf.language, conf);
//         $form.bind('html5ValidationAttrsFound', function () {
//           $form.validateOnBlur(conf.language, conf);
//         });
//       }
//       if (conf.validateOnEvent) {
//         $form.validateOnEvent(conf.language, conf);
//       }
//     });

//     if (conf.modules !== '') {
//       $.formUtils.loadModules(conf.modules, false, function() {
//         if (typeof conf.onModulesLoaded === 'function') {
//           conf.onModulesLoaded();
//         }
//         $window.trigger('validatorsLoaded', [typeof conf.form === 'string' ? $(conf.form) : conf.form, conf]);
//       });
//     }
//   };

//   /**
//    * Object containing utility methods for this plugin
//    */
//   $.formUtils = {

//     /**
//      * Default config for $(...).isValid();
//      */
//     defaultConfig: function () {
//       return {
//         ignore: [], // Names of inputs not to be validated even though node attribute containing the validation rules tells us to
//         errorElementClass: 'error', // Class that will be put on elements which value is invalid
//         borderColorOnError: '#b94a48', // Border color of elements which value is invalid, empty string to not change border color
//         errorMessageClass: 'form-error', // class name of div containing error messages when validation fails
//         validationRuleAttribute: 'data-validation', // name of the attribute holding the validation rules
//         validationErrorMsgAttribute: 'data-validation-error-msg', // define custom err msg inline with element
//         errorMessagePosition: 'element', // Can be either "top" or "element" or "custom"
//         errorMessageTemplate: {
//           container: '<div class="{errorMessageClass} alert alert-danger">{messages}</div>',
//           messages: '<strong>{errorTitle}</strong><ul>{fields}</ul>',
//           field: '<li>{msg}</li>'
//         },
//         errorMessageCustom: _templateMessage,
//         scrollToTopOnError: true,
//         dateFormat: 'yyyy-mm-dd',
//         addValidClassOnAll: false, // whether or not to apply class="valid" even if the input wasn't validated
//         decimalSeparator: '.',
//         inputParentClassOnError: 'has-error', // twitter-bootstrap default class name
//         inputParentClassOnSuccess: 'has-success', // twitter-bootstrap default class name
//         validateHiddenInputs: false, // whether or not hidden inputs should be validated
//       };
//     },

//     /**
//      * Available validators
//      */
//     validators: {},

//     /**
//      * Events triggered by form validator
//      */
//     _events: {load: [], valid: [], invalid: []},

//     /**
//      * Setting this property to true during validation will
//      * stop further validation from taking place and form will
//      * not be sent
//      */
//     haltValidation: false,

//     /**
//      * This variable will be true $.fn.isValid() is called
//      * and false when $.fn.validateOnBlur is called
//      */
//     isValidatingEntireForm: false,

//     /**
//      * Function for adding a validator
//      * @param {Object} validator
//      */
//     addValidator: function (validator) {
//       // prefix with "validate_" for backward compatibility reasons
//       var name = validator.name.indexOf('validate_') === 0 ? validator.name : 'validate_' + validator.name;
//       if (validator.validateOnKeyUp === undefined) {
//         validator.validateOnKeyUp = true;
//       }
//       this.validators[name] = validator;
//     },

//     /**
//      * @var {Boolean}
//      */
//     isLoadingModules: false,

//     /**
//      * @var {Object}
//      */
//     loadedModules: {},

//     /**
//      * @example
//      *  $.formUtils.loadModules('date, security.dev');
//      *
//      * Will load the scripts date.js and security.dev.js from the
//      * directory where this script resides. If you want to load
//      * the modules from another directory you can use the
//      * path argument.
//      *
//      * The script will be cached by the browser unless the module
//      * name ends with .dev
//      *
//      * @param {String} modules - Comma separated string with module file names (no directory nor file extension)
//      * @param {String} [path] - Optional, path where the module files is located if their not in the same directory as the core modules
//      * @param {Boolean|function} [fireEvent] - Optional, whether or not to fire event 'load' when modules finished loading
//      */
//     loadModules: function (modules, path, fireEvent) {

//       if (fireEvent === undefined) {
//         fireEvent = true;
//       }

//       if ($.formUtils.isLoadingModules) {
//         setTimeout(function () {
//           $.formUtils.loadModules(modules, path, fireEvent);
//         });
//         return;
//       }

//       var hasLoadedAnyModule = false,
//         loadModuleScripts = function (modules, path) {

//           var moduleList = $.split(modules),
//             numModules = moduleList.length,
//             moduleLoadedCallback = function () {
//               numModules--;
//               if (numModules === 0) {
//                 $.formUtils.isLoadingModules = false;
//                 if (fireEvent && hasLoadedAnyModule) {
//                   if( typeof fireEvent === 'function' ) {
//                     fireEvent();
//                   } else {
//                     $window.trigger('validatorsLoaded');
//                   }
//                 }
//               }
//             };


//           if (numModules > 0) {
//             $.formUtils.isLoadingModules = true;
//           }

//           var cacheSuffix = '?_=' + ( new Date().getTime() ),
//             appendToElement = document.getElementsByTagName('head')[0] || document.getElementsByTagName('body')[0];

//           $.each(moduleList, function (i, modName) {
//             modName = $.trim(modName);
//             if (modName.length === 0) {
//               moduleLoadedCallback();
//             }
//             else {
//               var scriptUrl = path + modName + (modName.slice(-3) === '.js' ? '' : '.js'),
//                 script = document.createElement('SCRIPT');

//               if (scriptUrl in $.formUtils.loadedModules) {
//                 // already loaded
//                 moduleLoadedCallback();
//               }
//               else {

//                 // Remember that this script is loaded
//                 $.formUtils.loadedModules[scriptUrl] = 1;
//                 hasLoadedAnyModule = true;

//                 // Load the script
//                 script.type = 'text/javascript';
//                 script.onload = moduleLoadedCallback;
//                 script.src = scriptUrl + ( scriptUrl.slice(-7) === '.dev.js' ? cacheSuffix : '' );
//                 script.onerror = function() {
//                   if( 'console' in window && window.console.log ) {
//                     window.console.log('Unable to load form validation module '+scriptUrl);
//                   }
//                 };
//                 script.onreadystatechange = function () {
//                   // IE 7 fix
//                   if (this.readyState === 'complete' || this.readyState === 'loaded') {
//                     moduleLoadedCallback();
//                     // Handle memory leak in IE
//                     this.onload = null;
//                     this.onreadystatechange = null;
//                   }
//                 };
//                 appendToElement.appendChild(script);
//               }
//             }
//           });
//         };

//       if (path) {
//         loadModuleScripts(modules, path);
//       } else {
//         var findScriptPathAndLoadModules = function () {
//           var foundPath = false;
//           $('script[src*="form-validator"]').each(function () {
//             foundPath = this.src.substr(0, this.src.lastIndexOf('/')) + '/';
//             if (foundPath === '/') {
//               foundPath = '';
//             }
//             return false;
//           });

//           if (foundPath !== false) {
//             loadModuleScripts(modules, foundPath);
//             return true;
//           }
//           return false;
//         };

//         if (!findScriptPathAndLoadModules()) {
//           $(findScriptPathAndLoadModules);
//         }
//       }
//     },

//     /**
//      * Validate the value of given element according to the validation rules
//      * found in the attribute data-validation. Will return an object representing
//      * a validation result, having the props shouldChangeDisplay, isValid and errorMsg
//      * @param {jQuery} $elem
//      * @param {Object} language ($.formUtils.LANG)
//      * @param {Object} conf
//      * @param {jQuery} $form
//      * @param {String} [eventContext]
//      * @return {Object}
//      */
//     validateInput: function ($elem, language, conf, $form, eventContext) {

//       $elem.trigger('beforeValidation');
//       conf = conf || $.formUtils.defaultConfig();
//       language = language || $.formUtils.LANG;

//       var value = $elem.val() || '',
//           result = {isValid: true, shouldChangeDisplay:true, errorMsg:''},
//           optional = $elem.valAttr('optional'),

//           // test if a checkbox forces this element to be validated
//           validationDependsOnCheckedInput = false,
//           validationDependentInputIsChecked = false,
//           validateIfCheckedElement = false,

//           // get value of this element's attribute "... if-checked"
//           validateIfCheckedElementName = $elem.valAttr('if-checked'),
//           // get expected radio button value for "if-checked" optional validation
//           validateIfCheckedElementValue = $elem.valAttr('if-checked-value');


//       if ($elem.attr('disabled') || (!$elem.is(':visible') && !conf.validateHiddenInputs)) {
//         result.shouldChangeDisplay = false;
//         return result;
//       }

//       // make sure we can proceed
//       if (validateIfCheckedElementName != null) {

//         // Set the boolean telling us that the validation depends
//         // on another input being checked
//         validationDependsOnCheckedInput = true;

//         // select the checkbox type element in this form
//         validateIfCheckedElement = $form.find('input[name="' + validateIfCheckedElementName + '"]');

//         // test if check input value
//         if (validateIfCheckedElementValue != null) {
//           validateIfCheckedElement.each(function(index, el) {
//             // test if it's property "checked" is checked and value equals expected value
//             if ($(el).prop('checked') && $(el).val() === validateIfCheckedElementValue) {
//               validationDependentInputIsChecked = true;
//             }
//           });
//         }
//         else {
//           // test if it's property "checked" is checked
//           if (validateIfCheckedElement.prop('checked')) {
//             // set value for validation checkpoint
//             validationDependentInputIsChecked = true;
//           }
//         }
//       }

//       // validation checkpoint
//       // if empty AND optional attribute is present
//       // OR depending on a checkbox being checked AND checkbox is checked, return true
//       var isInvalidNumberInput = !value && $elem[0].type === 'number';
//       if ((!value && optional === 'true' && !isInvalidNumberInput) || (validationDependsOnCheckedInput && !validationDependentInputIsChecked)) {
//         result.shouldChangeDisplay = conf.addValidClassOnAll;
//         return result;
//       }

//       var validationRules = $elem.attr(conf.validationRuleAttribute),

//         // see if form element has inline err msg attribute
//         validationErrorMsg = true;

//       if (!validationRules) {
//         result.shouldChangeDisplay = conf.addValidClassOnAll;
//         return result;
//       }

//       $.split(validationRules, function (rule) {
//         if (rule.indexOf('validate_') !== 0) {
//           rule = 'validate_' + rule;
//         }

//         var validator = $.formUtils.validators[rule];

//         if (validator && typeof validator.validatorFunction === 'function') {

//           // special change of element for checkbox_group rule
//           if (rule === 'validate_checkbox_group') {
//             // set element to first in group, so error msg attr doesn't need to be set on all elements in group
//             $elem = $form.find('[name="' + $elem.attr('name') + '"]:eq(0)');
//           }

//           var isValid = null;
//           if (eventContext !== 'keyup' || validator.validateOnKeyUp) {
//             isValid = validator.validatorFunction(value, $elem, conf, language, $form);
//           }

//           if (!isValid) {
//             validationErrorMsg = null;
//             if (isValid !== null) {
//               validationErrorMsg = $elem.attr(conf.validationErrorMsgAttribute + '-' + rule.replace('validate_', ''));
//               if (!validationErrorMsg) {
//                 validationErrorMsg = $elem.attr(conf.validationErrorMsgAttribute);
//                 if (!validationErrorMsg) {
//                   if (typeof validator.errorMessageKey !== 'function') {
//                     validationErrorMsg = language[validator.errorMessageKey];
//                   }
//                   else {
//                     validationErrorMsg = language[validator.errorMessageKey(conf)];
//                   }
//                   if (!validationErrorMsg) {
//                     validationErrorMsg = validator.errorMessage;
//                   }
//                 }
//               }
//             }
//             return false; // break iteration
//           }

//         } else {
//           throw new Error('Using undefined validator "' + rule + '"');
//         }

//       }, ' ');

//       if (typeof validationErrorMsg === 'string') {
//         $elem.trigger('validation', false);
//         result.errorMsg = validationErrorMsg;
//         result.isValid = false;
//         result.shouldChangeDisplay = true;
//       } else if (validationErrorMsg === null) {
//         result.shouldChangeDisplay = conf.addValidClassOnAll;
//       } else {
//         $elem.trigger('validation', true);
//         result.shouldChangeDisplay = true;
//       }

//       // Run element validation callback
//       if (typeof conf.onElementValidate === 'function' && validationErrorMsg !== null) {
//         conf.onElementValidate(result.isValid, $elem, $form, validationErrorMsg);
//       }

//       return result;
//     },

//     /**
//      * Is it a correct date according to given dateFormat. Will return false if not, otherwise
//      * an array 0=>year 1=>month 2=>day
//      *
//      * @param {String} val
//      * @param {String} dateFormat
//      * @return {Array}|{Boolean}
//      */
//     parseDate: function (val, dateFormat) {
//       var divider = dateFormat.replace(/[a-zA-Z]/gi, '').substring(0, 1),
//         regexp = '^',
//         formatParts = dateFormat.split(divider || null),
//         matches, day, month, year;

//       $.each(formatParts, function (i, part) {
//         regexp += (i > 0 ? '\\' + divider : '') + '(\\d{' + part.length + '})';
//       });

//       regexp += '$';

//       matches = val.match(new RegExp(regexp));
//       if (matches === null) {
//         return false;
//       }

//       var findDateUnit = function (unit, formatParts, matches) {
//         for (var i = 0; i < formatParts.length; i++) {
//           if (formatParts[i].substring(0, 1) === unit) {
//             return $.formUtils.parseDateInt(matches[i + 1]);
//           }
//         }
//         return -1;
//       };

//       month = findDateUnit('m', formatParts, matches);
//       day = findDateUnit('d', formatParts, matches);
//       year = findDateUnit('y', formatParts, matches);

//       if ((month === 2 && day > 28 && (year % 4 !== 0 || year % 100 === 0 && year % 400 !== 0)) ||
//       (month === 2 && day > 29 && (year % 4 === 0 || year % 100 !== 0 && year % 400 === 0)) ||
//       month > 12 || month === 0) {
//         return false;
//       }
//       if ((this.isShortMonth(month) && day > 30) || (!this.isShortMonth(month) && day > 31) || day === 0) {
//         return false;
//       }

//       return [year, month, day];
//     },

//     /**
//      * skum fix. är talet 05 eller lägre ger parseInt rätt int annars får man 0 när man kör parseInt?
//      *
//      * @param {String} val
//      * @param {Number}
//      */
//     parseDateInt: function (val) {
//       if (val.indexOf('0') === 0) {
//         val = val.replace('0', '');
//       }
//       return parseInt(val, 10);
//     },

//     /**
//      * Has month only 30 days?
//      *
//      * @param {Number} m
//      * @return {Boolean}
//      */
//     isShortMonth: function (m) {
//       return (m % 2 === 0 && m < 7) || (m % 2 !== 0 && m > 7);
//     },

//     /**
//      * Restrict input length
//      *
//      * @param {jQuery} $inputElement Jquery Html object
//      * @param {jQuery} $maxLengthElement jQuery Html Object
//      * @return void
//      */
//     lengthRestriction: function ($inputElement, $maxLengthElement) {
//       // read maxChars from counter display initial text value
//       var maxChars = parseInt($maxLengthElement.text(), 10),
//         charsLeft = 0,

//       // internal function does the counting and sets display value
//         countCharacters = function () {
//           var numChars = $inputElement.val().length;
//           if (numChars > maxChars) {
//             // get current scroll bar position
//             var currScrollTopPos = $inputElement.scrollTop();
//             // trim value to max length
//             $inputElement.val($inputElement.val().substring(0, maxChars));
//             $inputElement.scrollTop(currScrollTopPos);
//           }
//           charsLeft = maxChars - numChars;
//           if (charsLeft < 0) {
//             charsLeft = 0;
//           }

//           // set counter text
//           $maxLengthElement.text(charsLeft);
//         };

//       // bind events to this element
//       // setTimeout is needed, cut or paste fires before val is available
//       $($inputElement).bind('keydown keyup keypress focus blur', countCharacters)
//         .bind('cut paste', function () {
//           setTimeout(countCharacters, 100);
//         });

//       // count chars on pageload, if there are prefilled input-values
//       $(document).bind('ready', countCharacters);
//     },

//     /**
//      * Test numeric against allowed range
//      *
//      * @param $value int
//      * @param $rangeAllowed str; (1-2, min1, max2, 10)
//      * @return array
//      */
//     numericRangeCheck: function (value, rangeAllowed) {
//       // split by dash
//       var range = $.split(rangeAllowed),
//           // min or max
//           minmax = parseInt(rangeAllowed.substr(3), 10);

//       if( range.length === 1 && rangeAllowed.indexOf('min') === -1 && rangeAllowed.indexOf('max') === -1 ) {
//         range = [rangeAllowed, rangeAllowed]; // only a number, checking agains an exact number of characters
//       }

//       // range ?
//       if (range.length === 2 && (value < parseInt(range[0], 10) || value > parseInt(range[1], 10) )) {
//         return [ 'out', range[0], range[1] ];
//       } // value is out of range
//       else if (rangeAllowed.indexOf('min') === 0 && (value < minmax )) // min
//       {
//         return ['min', minmax];
//       } // value is below min
//       else if (rangeAllowed.indexOf('max') === 0 && (value > minmax )) // max
//       {
//         return ['max', minmax];
//       } // value is above max
//       // since no other returns executed, value is in allowed range
//       return [ 'ok' ];
//     },


//     _numSuggestionElements: 0,
//     _selectedSuggestion: null,
//     _previousTypedVal: null,

//     /**
//      * Utility function that can be used to create plugins that gives
//      * suggestions when inputs is typed into
//      * @param {jQuery} $elem
//      * @param {Array} suggestions
//      * @param {Object} settings - Optional
//      * @return {jQuery}
//      */
//     suggest: function ($elem, suggestions, settings) {
//       var conf = {
//           css: {
//             maxHeight: '150px',
//             background: '#FFF',
//             lineHeight: '150%',
//             textDecoration: 'underline',
//             overflowX: 'hidden',
//             overflowY: 'auto',
//             border: '#CCC solid 1px',
//             borderTop: 'none',
//             cursor: 'pointer'
//           },
//           activeSuggestionCSS: {
//             background: '#E9E9E9'
//           }
//         },
//         setSuggsetionPosition = function ($suggestionContainer, $input) {
//           var offset = $input.offset();
//           $suggestionContainer.css({
//             width: $input.outerWidth(),
//             left: offset.left + 'px',
//             top: (offset.top + $input.outerHeight()) + 'px'
//           });
//         };

//       if (settings) {
//         $.extend(conf, settings);
//       }

//       conf.css.position = 'absolute';
//       conf.css['z-index'] = 9999;
//       $elem.attr('autocomplete', 'off');

//       if (this._numSuggestionElements === 0) {
//         // Re-position suggestion container if window size changes
//         $window.bind('resize', function () {
//           $('.jquery-form-suggestions').each(function () {
//             var $container = $(this),
//               suggestID = $container.attr('data-suggest-container');
//             setSuggsetionPosition($container, $('.suggestions-' + suggestID).eq(0));
//           });
//         });
//       }

//       this._numSuggestionElements++;

//       var onSelectSuggestion = function ($el) {
//         var suggestionId = $el.valAttr('suggestion-nr');
//         $.formUtils._selectedSuggestion = null;
//         $.formUtils._previousTypedVal = null;
//         $('.jquery-form-suggestion-' + suggestionId).fadeOut('fast');
//       };

//       $elem
//         .data('suggestions', suggestions)
//         .valAttr('suggestion-nr', this._numSuggestionElements)
//         .unbind('focus.suggest')
//         .bind('focus.suggest', function () {
//           $(this).trigger('keyup');
//           $.formUtils._selectedSuggestion = null;
//         })
//         .unbind('keyup.suggest')
//         .bind('keyup.suggest', function () {
//           var $input = $(this),
//             foundSuggestions = [],
//             val = $.trim($input.val()).toLocaleLowerCase();

//           if (val === $.formUtils._previousTypedVal) {
//             return;
//           }
//           else {
//             $.formUtils._previousTypedVal = val;
//           }

//           var hasTypedSuggestion = false,
//             suggestionId = $input.valAttr('suggestion-nr'),
//             $suggestionContainer = $('.jquery-form-suggestion-' + suggestionId);

//           $suggestionContainer.scrollTop(0);

//           // Find the right suggestions
//           if (val !== '') {
//             var findPartial = val.length > 2;
//             $.each($input.data('suggestions'), function (i, suggestion) {
//               var lowerCaseVal = suggestion.toLocaleLowerCase();
//               if (lowerCaseVal === val) {
//                 foundSuggestions.push('<strong>' + suggestion + '</strong>');
//                 hasTypedSuggestion = true;
//                 return false;
//               } else if (lowerCaseVal.indexOf(val) === 0 || (findPartial && lowerCaseVal.indexOf(val) > -1)) {
//                 foundSuggestions.push(suggestion.replace(new RegExp(val, 'gi'), '<strong>$&</strong>'));
//               }
//             });
//           }

//           // Hide suggestion container
//           if (hasTypedSuggestion || (foundSuggestions.length === 0 && $suggestionContainer.length > 0)) {
//             $suggestionContainer.hide();
//           }

//           // Create suggestion container if not already exists
//           else if (foundSuggestions.length > 0 && $suggestionContainer.length === 0) {
//             $suggestionContainer = $('<div></div>').css(conf.css).appendTo('body');
//             $elem.addClass('suggestions-' + suggestionId);
//             $suggestionContainer
//               .attr('data-suggest-container', suggestionId)
//               .addClass('jquery-form-suggestions')
//               .addClass('jquery-form-suggestion-' + suggestionId);
//           }

//           // Show hidden container
//           else if (foundSuggestions.length > 0 && !$suggestionContainer.is(':visible')) {
//             $suggestionContainer.show();
//           }

//           // add suggestions
//           if (foundSuggestions.length > 0 && val.length !== foundSuggestions[0].length) {

//             // put container in place every time, just in case
//             setSuggsetionPosition($suggestionContainer, $input);

//             // Add suggestions HTML to container
//             $suggestionContainer.html('');
//             $.each(foundSuggestions, function (i, text) {
//               $('<div></div>')
//                 .append(text)
//                 .css({
//                   overflow: 'hidden',
//                   textOverflow: 'ellipsis',
//                   whiteSpace: 'nowrap',
//                   padding: '5px'
//                 })
//                 .addClass('form-suggest-element')
//                 .appendTo($suggestionContainer)
//                 .click(function () {
//                   $input.focus();
//                   $input.val($(this).text());
//                   onSelectSuggestion($input);
//                 });
//             });
//           }
//         })
//         .unbind('keydown.validation')
//         .bind('keydown.validation', function (e) {
//           var code = (e.keyCode ? e.keyCode : e.which),
//             suggestionId,
//             $suggestionContainer,
//             $input = $(this);

//           if (code === 13 && $.formUtils._selectedSuggestion !== null) {
//             suggestionId = $input.valAttr('suggestion-nr');
//             $suggestionContainer = $('.jquery-form-suggestion-' + suggestionId);
//             if ($suggestionContainer.length > 0) {
//               var newText = $suggestionContainer.find('div').eq($.formUtils._selectedSuggestion).text();
//               $input.val(newText);
//               onSelectSuggestion($input);
//               e.preventDefault();
//             }
//           }
//           else {
//             suggestionId = $input.valAttr('suggestion-nr');
//             $suggestionContainer = $('.jquery-form-suggestion-' + suggestionId);
//             var $suggestions = $suggestionContainer.children();
//             if ($suggestions.length > 0 && $.inArray(code, [38, 40]) > -1) {
//               if (code === 38) { // key up
//                 if ($.formUtils._selectedSuggestion === null) {
//                   $.formUtils._selectedSuggestion = $suggestions.length - 1;
//                 }
//                 else{
//                   $.formUtils._selectedSuggestion--;
//                 }
//                 if ($.formUtils._selectedSuggestion < 0) {
//                   $.formUtils._selectedSuggestion = $suggestions.length - 1;
//                 }
//               }
//               else if (code === 40) { // key down
//                 if ($.formUtils._selectedSuggestion === null) {
//                   $.formUtils._selectedSuggestion = 0;
//                 }
//                 else {
//                   $.formUtils._selectedSuggestion++;
//                 }
//                 if ($.formUtils._selectedSuggestion > ($suggestions.length - 1)) {
//                   $.formUtils._selectedSuggestion = 0;
//                 }
//               }

//               // Scroll in suggestion window
//               var containerInnerHeight = $suggestionContainer.innerHeight(),
//                 containerScrollTop = $suggestionContainer.scrollTop(),
//                 suggestionHeight = $suggestionContainer.children().eq(0).outerHeight(),
//                 activeSuggestionPosY = suggestionHeight * ($.formUtils._selectedSuggestion);

//               if (activeSuggestionPosY < containerScrollTop || activeSuggestionPosY > (containerScrollTop + containerInnerHeight)) {
//                 $suggestionContainer.scrollTop(activeSuggestionPosY);
//               }

//               $suggestions
//                 .removeClass('active-suggestion')
//                 .css('background', 'none')
//                 .eq($.formUtils._selectedSuggestion)
//                 .addClass('active-suggestion')
//                 .css(conf.activeSuggestionCSS);

//               e.preventDefault();
//               return false;
//             }
//           }
//         })
//         .unbind('blur.suggest')
//         .bind('blur.suggest', function () {
//           onSelectSuggestion($(this));
//         });

//       return $elem;
//     },

//     /**
//      * Error dialogs
//      *
//      * @var {Object}
//      */
//     LANG: {
//       errorTitle: 'Form submission failed!',
//       requiredField: 'This is a required field',
//       requiredFields: 'You have not answered all required fields',
//       badTime: 'You have not given a correct time',
//       badEmail: 'You have not given a correct e-mail address',
//       badTelephone: 'You have not given a correct phone number',
//       badSecurityAnswer: 'You have not given a correct answer to the security question',
//       badDate: 'You have not given a correct date',
//       lengthBadStart: 'The input value must be between ',
//       lengthBadEnd: ' characters',
//       lengthTooLongStart: 'The input value is longer than ',
//       lengthTooShortStart: 'The input value is shorter than ',
//       notConfirmed: 'Input values could not be confirmed',
//       badDomain: 'Incorrect domain value',
//       badUrl: 'The input value is not a correct URL',
//       badCustomVal: 'The input value is incorrect',
//       andSpaces: ' and spaces ',
//       badInt: 'The input value was not a correct number',
//       badSecurityNumber: 'Your social security number was incorrect',
//       badUKVatAnswer: 'Incorrect UK VAT Number',
//       badStrength: 'The password isn\'t strong enough',
//       badNumberOfSelectedOptionsStart: 'You have to choose at least ',
//       badNumberOfSelectedOptionsEnd: ' answers',
//       badAlphaNumeric: 'The input value can only contain alphanumeric characters ',
//       badAlphaNumericExtra: ' and ',
//       wrongFileSize: 'The file you are trying to upload is too large (max %s)',
//       wrongFileType: 'Only files of type %s is allowed',
//       groupCheckedRangeStart: 'Please choose between ',
//       groupCheckedTooFewStart: 'Please choose at least ',
//       groupCheckedTooManyStart: 'Please choose a maximum of ',
//       groupCheckedEnd: ' item(s)',
//       badCreditCard: 'The credit card number is not correct',
//       badCVV: 'The CVV number was not correct',
//       wrongFileDim : 'Incorrect image dimensions,',
//       imageTooTall : 'the image can not be taller than',
//       imageTooWide : 'the image can not be wider than',
//       imageTooSmall : 'the image was too small',
//       min : 'min',
//       max : 'max',
//       imageRatioNotAccepted : 'Image ratio is not be accepted',
//       badBrazilTelephoneAnswer: 'The phone number entered is invalid',
//       badBrazilCEPAnswer: 'The CEP entered is invalid',
//       badBrazilCPFAnswer: 'The CPF entered is invalid'
//     }
//   };


//   /* * * * * * * * * * * * * * * * * * * * * *
//    CORE VALIDATORS
//    * * * * * * * * * * * * * * * * * * * * */


//   /*
//    * Validate email
//    */
//   $.formUtils.addValidator({
//     name: 'email',
//     validatorFunction: function (email) {

//       var emailParts = email.toLowerCase().split('@'),
//           localPart = emailParts[0],
//           domain = emailParts[1];

//       if (localPart && domain) {

//         if( localPart.indexOf('"') === 0 ) {
//           var len = localPart.length;
//           localPart = localPart.replace(/\"/g, '');
//           if( localPart.length !== (len-2) ) {
//             return false; // It was not allowed to have more than two apostrophes
//           }
//         }

//         return $.formUtils.validators.validate_domain.validatorFunction(emailParts[1]) &&
//               localPart.indexOf('.') !== 0 &&
//               localPart.substring(localPart.length-1, localPart.length) !== '.' &&
//               localPart.indexOf('..') === -1 &&
//               !(/[^\w\+\.\-\#\-\_\~\!\$\&\'\(\)\*\+\,\;\=\:]/.test(localPart));
//       }

//       return false;
//     },
//     errorMessage: '',
//     errorMessageKey: 'badEmail'
//   });

//   /*
//    * Validate domain name
//    */
//   $.formUtils.addValidator({
//     name: 'domain',
//     validatorFunction: function (val) {
//       return val.length > 0 &&
//         val.length <= 253 && // Including sub domains
//         !(/[^a-zA-Z0-9]/.test(val.slice(-2))) && !(/[^a-zA-Z0-9]/.test(val.substr(0, 1))) && !(/[^a-zA-Z0-9\.\-]/.test(val)) &&
//         val.split('..').length === 1 &&
//         val.split('.').length > 1;
//     },
//     errorMessage: '',
//     errorMessageKey: 'badDomain'
//   });

//   /*
//    * Validate required
//    */
//   $.formUtils.addValidator({
//     name: 'required',
//     validatorFunction: function (val, $el, config, language, $form) {

//       switch ($el.attr('type')) {
//         case 'checkbox':
//           return $el.is(':checked');
//         case 'radio':
//           return $form.find('input[name="' + $el.attr('name') + '"]').filter(':checked').length > 0;
//         default:
//           return $.trim(val) !== '';
//       }
//     },
//     errorMessage: '',
//     errorMessageKey: function(config) {
//       if (config.errorMessagePosition === 'top' || config.errorMessagePosition === 'custom') {
//         return 'requiredFields';
//       }
//       else {
//         return 'requiredField';
//       }
//     }
//   });

//   /*
//    * Validate length range
//    */
//   $.formUtils.addValidator({
//     name: 'length',
//     validatorFunction: function (val, $el, conf, lang) {
//       var lengthAllowed = $el.valAttr('length'),
//         type = $el.attr('type');

//       if (lengthAllowed === undefined) {
//         alert('Please add attribute "data-validation-length" to ' + $el[0].nodeName + ' named ' + $el.attr('name'));
//         return true;
//       }

//       // check if length is above min, below max or within range.
//       var len = type === 'file' && $el.get(0).files !== undefined ? $el.get(0).files.length : val.length,
//         lengthCheckResults = $.formUtils.numericRangeCheck(len, lengthAllowed),
//         checkResult;

//       switch (lengthCheckResults[0]) {   // outside of allowed range
//         case 'out':
//           this.errorMessage = lang.lengthBadStart + lengthAllowed + lang.lengthBadEnd;
//           checkResult = false;
//           break;
//         // too short
//         case 'min':
//           this.errorMessage = lang.lengthTooShortStart + lengthCheckResults[1] + lang.lengthBadEnd;
//           checkResult = false;
//           break;
//         // too long
//         case 'max':
//           this.errorMessage = lang.lengthTooLongStart + lengthCheckResults[1] + lang.lengthBadEnd;
//           checkResult = false;
//           break;
//         // ok
//         default:
//           checkResult = true;
//       }

//       return checkResult;
//     },
//     errorMessage: '',
//     errorMessageKey: ''
//   });

//   /*
//    * Validate url
//    */
//   $.formUtils.addValidator({
//     name: 'url',
//     validatorFunction: function (url) {
//       // written by Scott Gonzalez: http://projects.scottsplayground.com/iri/
//       // - Victor Jonsson added support for arrays in the url ?arg[]=sdfsdf
//       // - General improvements made by Stéphane Moureau <https://github.com/TraderStf>

//       var urlFilter = /^(https?|ftp):\/\/((((\w|-|\.|~|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])|(%[\da-f]{2})|[!\$&'\(\)\*\+,;=]|:)*@)?(((\d|[1-9]\d|1\d\d|2[0-4]\d|25[0-5])\.(\d|[1-9]\d|1\d\d|2[0-4]\d|25[0-5])\.(\d|[1-9]\d|1\d\d|2[0-4]\d|25[0-5])\.(\d|[1-9]\d|1\d\d|2[0-4]\d|25[0-5]))|((([a-z]|\d|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])|(([a-z]|\d|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])(\w|-|\.|~|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])*([a-z]|\d|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])))\.)+(([a-z]|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])|(([a-z]|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])(\w|-|\.|~|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])*([a-z]|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])))\.?)(:\d*)?)(\/(((\w|-|\.|~|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])|(%[\da-f]{2})|[!\$&'\(\)\*\+,;=]|:|@)+(\/((\w|-|\.|~|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])|(%[\da-f]{2})|[!\$&'\(\)\*\+,;=]|:|@)*)*)?)?(\?((([a-z]|\d|\[|\]|-|\.|_|~|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])|(%[\da-f]{2})|[!\$&'\(\)\*\+,;=]|:|@)|[\uE000-\uF8FF]|\/|\?)*)?(\#(((\w|-|\.|~|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])|(%[\da-f]{2})|[!\$&'\(\)\*\+,;=]|:|@)|\/|\?)*)?$/i;
//       if (urlFilter.test(url)) {
//         var domain = url.split('://')[1],
//           domainSlashPos = domain.indexOf('/');

//         if (domainSlashPos > -1) {
//           domain = domain.substr(0, domainSlashPos);
//         }

//         return $.formUtils.validators.validate_domain.validatorFunction(domain); // todo: add support for IP-addresses
//       }
//       return false;
//     },
//     errorMessage: '',
//     errorMessageKey: 'badUrl'
//   });

//   /*
//    * Validate number (floating or integer)
//    */
//   $.formUtils.addValidator({
//     name: 'number',
//     validatorFunction: function (val, $el, conf) {
//       if (val !== '') {
//         var allowing = $el.valAttr('allowing') || '',
//           decimalSeparator = $el.valAttr('decimal-separator') || conf.decimalSeparator,
//           allowsRange = false,
//           begin, end,
//           steps = $el.valAttr('step') || '',
//           allowsSteps = false;

//         if (allowing.indexOf('number') === -1) {
//           allowing += ',number';
//         }

//         if (allowing.indexOf('negative') === -1 && val.indexOf('-') === 0) {
//           return false;
//         }

//         if (allowing.indexOf('range') > -1) {
//           begin = parseFloat(allowing.substring(allowing.indexOf('[') + 1, allowing.indexOf(';')));
//           end = parseFloat(allowing.substring(allowing.indexOf(';') + 1, allowing.indexOf(']')));
//           allowsRange = true;
//         }

//         if (steps !== '') {
//           allowsSteps = true;
//         }

//         if (decimalSeparator === ',') {
//           if (val.indexOf('.') > -1) {
//             return false;
//           }
//           // Fix for checking range with floats using ,
//           val = val.replace(',', '.');
//         }

//         if (allowing.indexOf('number') > -1 && val.replace(/[0-9-]/g, '') === '' && (!allowsRange || (val >= begin && val <= end)) && (!allowsSteps || (val % steps === 0))) {
//           return true;
//         }
//         if (allowing.indexOf('float') > -1 && val.match(new RegExp('^([0-9-]+)\\.([0-9]+)$')) !== null && (!allowsRange || (val >= begin && val <= end)) && (!allowsSteps || (val % steps === 0))) {
//           return true;
//         }
//       }
//       return false;
//     },
//     errorMessage: '',
//     errorMessageKey: 'badInt'
//   });

//   /*
//    * Validate alpha numeric
//    */
//   $.formUtils.addValidator({
//     name: 'alphanumeric',
//     validatorFunction: function (val, $el, conf, language) {
//       var patternStart = '^([a-zA-Z0-9',
//         patternEnd = ']+)$',
//         additionalChars = $el.valAttr('allowing'),
//         pattern = '';

//       if (additionalChars) {
//         pattern = patternStart + additionalChars + patternEnd;
//         var extra = additionalChars.replace(/\\/g, '');
//         if (extra.indexOf(' ') > -1) {
//           extra = extra.replace(' ', '');
//           extra += language.andSpaces || $.formUtils.LANG.andSpaces;
//         }
//         this.errorMessage = language.badAlphaNumeric + language.badAlphaNumericExtra + extra;
//       } else {
//         pattern = patternStart + patternEnd;
//         this.errorMessage = language.badAlphaNumeric;
//       }

//       return new RegExp(pattern).test(val);
//     },
//     errorMessage: '',
//     errorMessageKey: ''
//   });

//   /*
//    * Validate against regexp
//    */
//   $.formUtils.addValidator({
//     name: 'custom',
//     validatorFunction: function (val, $el) {
//       var regexp = new RegExp($el.valAttr('regexp'));
//       return regexp.test(val);
//     },
//     errorMessage: '',
//     errorMessageKey: 'badCustomVal'
//   });

//   /*
//    * Validate date
//    */
//   $.formUtils.addValidator({
//     name: 'date',
//     validatorFunction: function (date, $el, conf) {
//       var dateFormat = $el.valAttr('format') || conf.dateFormat || 'yyyy-mm-dd';
//       return $.formUtils.parseDate(date, dateFormat) !== false;
//     },
//     errorMessage: '',
//     errorMessageKey: 'badDate'
//   });

// /*
// * year
// */
// $.formUtils.addValidator({
//   name : 'year',
//   validatorFunction : function(value, $el, config, language, $form) {
//     return ((new Date()).getFullYear() >= parseInt(value) && value.length == 4);
//   },
//   errorMessage : '',
//   errorMessageKey: 'badYear'
// });

// /***/
// $.formUtils.addValidator({
//   name : 'ckeditor',
//   validatorFunction : function(value, $el, config, language, $form) {
//      var content_text = $el.contents().find('.cke_editable').text()
//      return $.trim(content_text) != ''
//   },
  
//    errorMessage: '',
//     errorMessageKey: function(config) {
//       if (config.errorMessagePosition === 'top' || config.errorMessagePosition === 'custom') {
//         return 'requiredFields';
//       }
//       else {
//         return 'requiredField';
//       }
//     }
// });


//   /*
//    * Validate group of checkboxes, validate qty required is checked
//    * written by Steve Wasiura : http://stevewasiura.waztech.com
//    * element attrs
//    *    data-validation="checkbox_group"
//    *    data-validation-qty="1-2"  // min 1 max 2
//    *    data-validation-error-msg="chose min 1, max of 2 checkboxes"
//    */
//   $.formUtils.addValidator({
//     name: 'checkbox_group',
//     validatorFunction: function (val, $el, conf, lang, $form) {
//       // preset return var
//       var isValid = true,
//         // get name of element. since it is a checkbox group, all checkboxes will have same name
//         elname = $el.attr('name'),
//         // get checkboxes and count the checked ones
//         $checkBoxes = $('input[type=checkbox][name^="' + elname + '"]', $form),
//         checkedCount = $checkBoxes.filter(':checked').length,
//         // get el attr that specs qty required / allowed
//         qtyAllowed = $el.valAttr('qty');

//       if (qtyAllowed === undefined) {
//         var elementType = $el.get(0).nodeName;
//         alert('Attribute "data-validation-qty" is missing from ' + elementType + ' named ' + $el.attr('name'));
//       }

//       // call Utility function to check if count is above min, below max, within range etc.
//       var qtyCheckResults = $.formUtils.numericRangeCheck(checkedCount, qtyAllowed);

//       // results will be array, [0]=result str, [1]=qty int
//       switch (qtyCheckResults[0]) {
//         // outside allowed range
//         case 'out':
//           this.errorMessage = lang.groupCheckedRangeStart + qtyAllowed + lang.groupCheckedEnd;
//           isValid = false;
//           break;
//         // below min qty
//         case 'min':
//           this.errorMessage = lang.groupCheckedTooFewStart + qtyCheckResults[1] + lang.groupCheckedEnd;
//           isValid = false;
//           break;
//         // above max qty
//         case 'max':
//           this.errorMessage = lang.groupCheckedTooManyStart + qtyCheckResults[1] + lang.groupCheckedEnd;
//           isValid = false;
//           break;
//         // ok
//         default:
//           isValid = true;
//       }

//       if( !isValid ) {
//         var _triggerOnBlur = function() {
//           $checkBoxes.unbind('click', _triggerOnBlur);
//           $checkBoxes.filter('*[data-validation]').validateInputOnBlur(lang, conf, false, 'blur');
//         };
//         $checkBoxes.bind('click', _triggerOnBlur);
//       }

//       return isValid;
//     }
//     //   errorMessage : '', // set above in switch statement
//     //   errorMessageKey: '' // not used
//   });

// })(jQuery);


/* MINIFIED JS */

(function(e){var g=e(window),d=function(h){if(h.valAttr("error-msg-container")){return e(h.valAttr("error-msg-container"));}else{var j=h.parent();if(!j.hasClass("form-group")&&!j.closest("form").hasClass("form-horizontal")){var i=j.closest(".form-group");if(i.length){return i.eq(0);}}return j;}},f=function(h,i){h.addClass(i.errorElementClass).removeClass("valid");d(h).addClass(i.inputParentClassOnError).removeClass(i.inputParentClassOnSuccess);if(i.borderColorOnError!==""){h.css("border-color",i.borderColorOnError);}},b=function(h,i){h.each(function(){var j=e(this);c(j,"",i,i.errorMessagePosition);j.removeClass("valid").removeClass(i.errorElementClass).css("border-color","");d(j).removeClass(i.inputParentClassOnError).removeClass(i.inputParentClassOnSuccess).find("."+i.errorMessageClass).remove();});},c=function(o,l,n,m){var h=document.getElementById(o.attr("name")+"_err_msg"),k=function(q){g.trigger("validationErrorDisplay",[o,q]);q.html(l);},j={};if(h){k(e(h));}else{if(typeof m==="object"){var p=false;m.find("."+n.errorMessageClass).each(function(){if(this.inputReferer===o[0]){p=e(this);return false;}});if(p){if(!l){p.remove();}else{k(p);}}else{j=e('<div class="'+n.errorMessageClass+'"></div>');k(j);j[0].inputReferer=o[0];m.prepend(j);}}else{var i=d(o);j=i.find("."+n.errorMessageClass+".help-block");if(j.length===0){j=e("<span></span>").addClass("help-block").addClass(n.errorMessageClass);j.appendTo(i);}k(j);}}},a=function(j,n,m,k){var l=k.errorMessageTemplate.messages.replace(/\{errorTitle\}/g,n),h=[],i;e.each(m,function(o,p){h.push(k.errorMessageTemplate.field.replace(/\{msg\}/g,p));});l=l.replace(/\{fields\}/g,h.join(""));i=k.errorMessageTemplate.container.replace(/\{errorMessageClass\}/g,k.errorMessageClass);i=i.replace(/\{messages\}/g,l);j.children().eq(0).before(i);};e.fn.validateOnBlur=function(i,h){this.find("*[data-validation]").bind("blur.validation",function(){e(this).validateInputOnBlur(i,h,true,"blur");});if(h.validateCheckboxRadioOnClick){this.find("input[type=checkbox][data-validation],input[type=radio][data-validation]").bind("click.validation",function(){e(this).validateInputOnBlur(i,h,true,"click");});}return this;};e.fn.validateOnEvent=function(i,h){this.find("*[data-validation-event]").each(function(){var j=e(this),k=j.valAttr("event");if(k){j.unbind(k+".validation").bind(k+".validation",function(){e(this).validateInputOnBlur(i,h,true,k);});}});return this;};e.fn.showHelpOnFocus=function(h){if(!h){h="data-validation-help";}this.find(".has-help-txt").valAttr("has-keyup-event",false).removeClass("has-help-txt");this.find("textarea,input").each(function(){var i=e(this),k="jquery_form_help_"+(i.attr("name")||"").replace(/(:|\.|\[|\])/g,""),j=i.attr(h);if(j){i.addClass("has-help-txt").unbind("focus.help").bind("focus.help",function(){var l=i.parent().find("."+k);if(l.length===0){l=e("<span />").addClass(k).addClass("help").addClass("help-block").text(j).hide();i.after(l);}l.fadeIn();}).unbind("blur.help").bind("blur.help",function(){e(this).parent().find("."+k).fadeOut("slow");});}});return this;};e.fn.validate=function(h,i,j){var k=e.extend({},e.formUtils.LANG,j||{});this.each(function(){var l=e(this),m=l.closest("form").get(0).validationConfig||{};l.one("validation",function(n,o){if(typeof h==="function"){h(o,this,n);}});l.validateInputOnBlur(k,e.extend({},m,i||{}),true);});};e.fn.willPostponeValidation=function(){return(this.valAttr("suggestion-nr")||this.valAttr("postpone")||this.hasClass("hasDatepicker"))&&!window.postponedValidation;};e.fn.validateInputOnBlur=function(k,m,l,i){e.formUtils.eventType=i;if(this.willPostponeValidation()){var n=this,h=this.valAttr("postpone")||200;window.postponedValidation=function(){n.validateInputOnBlur(k,m,l,i);window.postponedValidation=false;};setTimeout(function(){if(window.postponedValidation){window.postponedValidation();}},h);return this;}k=e.extend({},e.formUtils.LANG,k||{});b(this,m);var j=this,p=j.closest("form"),o=e.formUtils.validateInput(j,k,m,p,i);if(o.isValid){if(o.shouldChangeDisplay){j.addClass("valid");d(j).addClass(m.inputParentClassOnSuccess);}}else{if(!o.isValid){f(j,m);c(j,o.errorMsg,m,m.errorMessagePosition);if(l){j.unbind("keyup.validation").bind("keyup.validation",function(){e(this).validateInputOnBlur(k,m,false,"keyup");});}}}return this;};e.fn.valAttr=function(h,i){if(i===undefined){return this.attr("data-validation-"+h);}else{if(i===false||i===null){return this.removeAttr("data-validation-"+h);}else{h=((h.length>0)?"-"+h:"");return this.attr("data-validation"+h,i);}}};e.fn.isValid=function(k,m,l){if(e.formUtils.isLoadingModules){var p=this;setTimeout(function(){p.isValid(k,m,l);},200);return null;}m=e.extend({},e.formUtils.defaultConfig(),m||{});k=e.extend({},e.formUtils.LANG,k||{});l=l!==false;if(e.formUtils.errorDisplayPreventedWhenHalted){delete e.formUtils.errorDisplayPreventedWhenHalted;l=false;}e.formUtils.isValidatingEntireForm=true;e.formUtils.haltValidation=false;var i=function(t,s){if(e.inArray(t,q)<0){q.push(t);}j.push(s);s.attr("current-error",t);if(l){f(s,m);}},h=[],q=[],j=[],r=this,o=function(s,t){if(t==="submit"||t==="button"||t==="reset"){return true;}return e.inArray(s,m.ignore||[])>-1;};if(l){r.find("."+m.errorMessageClass+".alert").remove();b(r.find("."+m.errorElementClass+",.valid"),m);}r.find("input,textarea,select,iframe").filter(':not([type="submit"],[type="button"])').each(function(){var v=e(this),u=v.attr("type"),w=u==="radio"||u==="checkbox",t=v.attr("name");if(!o(t,u)&&(!w||e.inArray(t,h)<0)){if(w){h.push(t);}var s=e.formUtils.validateInput(v,k,m,r,"submit");if(s.shouldChangeDisplay){if(!s.isValid){i(s.errorMsg,v);}else{if(s.isValid){v.valAttr("current-error",false).addClass("valid");d(v).addClass(m.inputParentClassOnSuccess);}}}}});if(typeof m.onValidate==="function"){var n=m.onValidate(r);if(e.isArray(n)){e.each(n,function(s,t){i(t.message,t.element);});}else{if(n&&n.element&&n.message){i(n.message,n.element);}}}e.formUtils.isValidatingEntireForm=false;if(!e.formUtils.haltValidation&&j.length>0){if(l){if(m.errorMessagePosition==="top"){a(r,k.errorTitle,q,m);}else{if(m.errorMessagePosition==="custom"){if(typeof m.errorMessageCustom==="function"){m.errorMessageCustom(r,k.errorTitle,q,m);}}else{e.each(j,function(s,t){c(t,t.attr("current-error"),m,m.errorMessagePosition);});}}if(m.scrollToTopOnError){g.scrollTop(r.offset().top-20);}}return false;}if(!l&&e.formUtils.haltValidation){e.formUtils.errorDisplayPreventedWhenHalted=true;}return !e.formUtils.haltValidation;};e.fn.validateForm=function(i,h){if(window.console&&typeof window.console.warn==="function"){window.console.warn("Use of deprecated function $.validateForm, use $.isValid instead");}return this.isValid(i,h,true);};e.fn.restrictLength=function(h){new e.formUtils.lengthRestriction(this,h);return this;};e.fn.addSuggestions=function(i){var h=false;this.find("input").each(function(){var j=e(this);h=e.split(j.attr("data-suggestions"));if(h.length>0&&!j.hasClass("has-suggestions")){e.formUtils.suggest(j,h,i);j.addClass("has-suggestions");}});return this;};e.split=function(i,j){if(typeof j!=="function"){if(!i){return[];}var h=[];e.each(i.split(j?j:/[,|\-\s]\s*/g),function(k,l){l=e.trim(l);if(l.length){h.push(l);}});return h;}else{if(i){e.each(i.split(/[,|\-\s]\s*/g),function(k,l){l=e.trim(l);if(l.length){return j(l,k);}});}}};e.validate=function(h){var i=e.extend(e.formUtils.defaultConfig(),{form:"form",validateOnEvent:false,validateOnBlur:true,validateCheckboxRadioOnClick:true,showHelpOnFocus:true,addSuggestions:true,modules:"",onModulesLoaded:null,language:false,onSuccess:false,onError:false,onElementValidate:false});h=e.extend(i,h||{});if(h.lang&&h.lang!=="en"){var j="lang/"+h.lang+".js";h.modules+=h.modules.length?","+j:j;}e(h.form).each(function(l,m){m.validationConfig=h;var k=e(m);g.trigger("formValidationSetup",[k,h]);k.find(".has-help-txt").unbind("focus.validation").unbind("blur.validation");k.removeClass("has-validation-callback").unbind("submit.validation").unbind("reset.validation").find("input[data-validation],textarea[data-validation]").unbind("blur.validation");k.bind("submit.validation",function(){var o=e(this);if(e.formUtils.haltValidation){return false;}if(e.formUtils.isLoadingModules){setTimeout(function(){o.trigger("submit.validation");},200);return false;}var q=o.isValid(h.language,h);var r=o.find("img.crop-align").attr("src");var n=e(this).find(".crop-image-box .myLabel");n.css("border-color","#000");e(this).find(".crop-image-box .help-block.form-error").remove();if(r==""){n.css("border-color","#a94442");n.after('<span class="help-block form-error">Please upload your cover page</span>');return false;}if(e.formUtils.haltValidation){return false;}else{if(q&&typeof h.onSuccess==="function"){var p=h.onSuccess(o);if(p===false){return false;}}else{if(!q&&typeof h.onError==="function"){h.onError(o);return false;}else{return q;}}}}).bind("reset.validation",function(){e(this).find("."+h.errorMessageClass+".alert").remove();b(e(this).find("."+h.errorElementClass+",.valid"),h);}).addClass("has-validation-callback");if(h.showHelpOnFocus){k.showHelpOnFocus();}if(h.addSuggestions){k.addSuggestions();}if(h.validateOnBlur){k.validateOnBlur(h.language,h);k.bind("html5ValidationAttrsFound",function(){k.validateOnBlur(h.language,h);});}if(h.validateOnEvent){k.validateOnEvent(h.language,h);}});if(h.modules!==""){e.formUtils.loadModules(h.modules,false,function(){if(typeof h.onModulesLoaded==="function"){h.onModulesLoaded();}g.trigger("validatorsLoaded",[typeof h.form==="string"?e(h.form):h.form,h]);});}};e.formUtils={defaultConfig:function(){return{ignore:[],errorElementClass:"error",borderColorOnError:"#b94a48",errorMessageClass:"form-error",validationRuleAttribute:"data-validation",validationErrorMsgAttribute:"data-validation-error-msg",errorMessagePosition:"element",errorMessageTemplate:{container:'<div class="{errorMessageClass} alert alert-danger">{messages}</div>',messages:"<strong>{errorTitle}</strong><ul>{fields}</ul>",field:"<li>{msg}</li>"},errorMessageCustom:a,scrollToTopOnError:true,dateFormat:"yyyy-mm-dd",addValidClassOnAll:false,decimalSeparator:".",inputParentClassOnError:"has-error",inputParentClassOnSuccess:"has-success",validateHiddenInputs:false};},validators:{},_events:{load:[],valid:[],invalid:[]},haltValidation:false,isValidatingEntireForm:false,addValidator:function(i){var h=i.name.indexOf("validate_")===0?i.name:"validate_"+i.name;if(i.validateOnKeyUp===undefined){i.validateOnKeyUp=true;}this.validators[h]=i;},isLoadingModules:false,loadedModules:{},loadModules:function(j,m,k){if(k===undefined){k=true;}if(e.formUtils.isLoadingModules){setTimeout(function(){e.formUtils.loadModules(j,m,k);});return;}var h=false,i=function(q,t){var s=e.split(q),p=s.length,o=function(){p--;if(p===0){e.formUtils.isLoadingModules=false;if(k&&h){if(typeof k==="function"){k();}else{g.trigger("validatorsLoaded");}}}};if(p>0){e.formUtils.isLoadingModules=true;}var n="?_="+(new Date().getTime()),r=document.getElementsByTagName("head")[0]||document.getElementsByTagName("body")[0];e.each(s,function(v,w){w=e.trim(w);if(w.length===0){o();}else{var x=t+w+(w.slice(-3)===".js"?"":".js"),u=document.createElement("SCRIPT");if(x in e.formUtils.loadedModules){o();}else{e.formUtils.loadedModules[x]=1;h=true;u.type="text/javascript";u.onload=o;u.src=x+(x.slice(-7)===".dev.js"?n:"");u.onerror=function(){if("console" in window&&window.console.log){window.console.log("Unable to load form validation module "+x);}};u.onreadystatechange=function(){if(this.readyState==="complete"||this.readyState==="loaded"){o();this.onload=null;this.onreadystatechange=null;}};r.appendChild(u);}}});};if(m){i(j,m);}else{var l=function(){var n=false;e('script[src*="form-validator"]').each(function(){n=this.src.substr(0,this.src.lastIndexOf("/"))+"/";if(n==="/"){n="";}return false;});if(n!==false){i(j,n);return true;}return false;};if(!l()){e(l);}}},validateInput:function(i,k,o,v,l){i.trigger("beforeValidation");o=o||e.formUtils.defaultConfig();k=k||e.formUtils.LANG;var r=i.val()||"",w={isValid:true,shouldChangeDisplay:true,errorMsg:""},q=i.valAttr("optional"),n=false,t=false,h=false,s=i.valAttr("if-checked"),m=i.valAttr("if-checked-value");if(i.attr("disabled")||(!i.is(":visible")&&!o.validateHiddenInputs)){w.shouldChangeDisplay=false;return w;}if(s!=null){n=true;h=v.find('input[name="'+s+'"]');if(m!=null){h.each(function(x,y){if(e(y).prop("checked")&&e(y).val()===m){t=true;}});}else{if(h.prop("checked")){t=true;}}}var u=!r&&i[0].type==="number";if((!r&&q==="true"&&!u)||(n&&!t)){w.shouldChangeDisplay=o.addValidClassOnAll;return w;}var j=i.attr(o.validationRuleAttribute),p=true;if(!j){w.shouldChangeDisplay=o.addValidClassOnAll;return w;}e.split(j,function(z){if(z.indexOf("validate_")!==0){z="validate_"+z;}var x=e.formUtils.validators[z];if(x&&typeof x.validatorFunction==="function"){if(z==="validate_checkbox_group"){i=v.find('[name="'+i.attr("name")+'"]:eq(0)');}var y=null;if(l!=="keyup"||x.validateOnKeyUp){y=x.validatorFunction(r,i,o,k,v);}if(!y){p=null;if(y!==null){p=i.attr(o.validationErrorMsgAttribute+"-"+z.replace("validate_",""));if(!p){p=i.attr(o.validationErrorMsgAttribute);if(!p){if(typeof x.errorMessageKey!=="function"){p=k[x.errorMessageKey];}else{p=k[x.errorMessageKey(o)];}if(!p){p=x.errorMessage;}}}}return false;}}else{throw new Error('Using undefined validator "'+z+'"');}}," ");if(typeof p==="string"){i.trigger("validation",false);w.errorMsg=p;w.isValid=false;w.shouldChangeDisplay=true;}else{if(p===null){w.shouldChangeDisplay=o.addValidClassOnAll;}else{i.trigger("validation",true);w.shouldChangeDisplay=true;}}if(typeof o.onElementValidate==="function"&&p!==null){o.onElementValidate(w.isValid,i,v,p);}return w;},parseDate:function(i,h){var j=h.replace(/[a-zA-Z]/gi,"").substring(0,1),n="^",q=h.split(j||null),k,p,m,o;e.each(q,function(s,r){n+=(s>0?"\\"+j:"")+"(\\d{"+r.length+"})";});n+="$";k=i.match(new RegExp(n));if(k===null){return false;}var l=function(t,r,u){for(var s=0;s<r.length;s++){if(r[s].substring(0,1)===t){return e.formUtils.parseDateInt(u[s+1]);}}return -1;};m=l("m",q,k);p=l("d",q,k);o=l("y",q,k);if((m===2&&p>28&&(o%4!==0||o%100===0&&o%400!==0))||(m===2&&p>29&&(o%4===0||o%100!==0&&o%400===0))||m>12||m===0){return false;}if((this.isShortMonth(m)&&p>30)||(!this.isShortMonth(m)&&p>31)||p===0){return false;}return[o,m,p];},parseDateInt:function(h){if(h.indexOf("0")===0){h=h.replace("0","");}return parseInt(h,10);},isShortMonth:function(h){return(h%2===0&&h<7)||(h%2!==0&&h>7);},lengthRestriction:function(l,j){var k=parseInt(j.text(),10),h=0,i=function(){var m=l.val().length;if(m>k){var n=l.scrollTop();l.val(l.val().substring(0,k));l.scrollTop(n);}h=k-m;if(h<0){h=0;}j.text(h);};e(l).bind("keydown keyup keypress focus blur",i).bind("cut paste",function(){setTimeout(i,100);});e(document).bind("ready",i);},numericRangeCheck:function(k,h){var i=e.split(h),j=parseInt(h.substr(3),10);if(i.length===1&&h.indexOf("min")===-1&&h.indexOf("max")===-1){i=[h,h];}if(i.length===2&&(k<parseInt(i[0],10)||k>parseInt(i[1],10))){return["out",i[0],i[1]];}else{if(h.indexOf("min")===0&&(k<j)){return["min",j];}else{if(h.indexOf("max")===0&&(k>j)){return["max",j];}}}return["ok"];},_numSuggestionElements:0,_selectedSuggestion:null,_previousTypedVal:null,suggest:function(i,h,l){var j={css:{maxHeight:"150px",background:"#FFF",lineHeight:"150%",textDecoration:"underline",overflowX:"hidden",overflowY:"auto",border:"#CCC solid 1px",borderTop:"none",cursor:"pointer"},activeSuggestionCSS:{background:"#E9E9E9"}},m=function(n,p){var o=p.offset();n.css({width:p.outerWidth(),left:o.left+"px",top:(o.top+p.outerHeight())+"px"});};if(l){e.extend(j,l);}j.css.position="absolute";j.css["z-index"]=9999;i.attr("autocomplete","off");if(this._numSuggestionElements===0){g.bind("resize",function(){e(".jquery-form-suggestions").each(function(){var o=e(this),n=o.attr("data-suggest-container");m(o,e(".suggestions-"+n).eq(0));});});}this._numSuggestionElements++;var k=function(n){var o=n.valAttr("suggestion-nr");e.formUtils._selectedSuggestion=null;e.formUtils._previousTypedVal=null;e(".jquery-form-suggestion-"+o).fadeOut("fast");};i.data("suggestions",h).valAttr("suggestion-nr",this._numSuggestionElements).unbind("focus.suggest").bind("focus.suggest",function(){e(this).trigger("keyup");e.formUtils._selectedSuggestion=null;}).unbind("keyup.suggest").bind("keyup.suggest",function(){var t=e(this),o=[],s=e.trim(t.val()).toLocaleLowerCase();if(s===e.formUtils._previousTypedVal){return;}else{e.formUtils._previousTypedVal=s;}var n=false,r=t.valAttr("suggestion-nr"),q=e(".jquery-form-suggestion-"+r);q.scrollTop(0);if(s!==""){var p=s.length>2;e.each(t.data("suggestions"),function(v,u){var w=u.toLocaleLowerCase();if(w===s){o.push("<strong>"+u+"</strong>");n=true;return false;}else{if(w.indexOf(s)===0||(p&&w.indexOf(s)>-1)){o.push(u.replace(new RegExp(s,"gi"),"<strong>$&</strong>"));}}});}if(n||(o.length===0&&q.length>0)){q.hide();}else{if(o.length>0&&q.length===0){q=e("<div></div>").css(j.css).appendTo("body");i.addClass("suggestions-"+r);q.attr("data-suggest-container",r).addClass("jquery-form-suggestions").addClass("jquery-form-suggestion-"+r);}else{if(o.length>0&&!q.is(":visible")){q.show();}}}if(o.length>0&&s.length!==o[0].length){m(q,t);q.html("");e.each(o,function(u,v){e("<div></div>").append(v).css({overflow:"hidden",textOverflow:"ellipsis",whiteSpace:"nowrap",padding:"5px"}).addClass("form-suggest-element").appendTo(q).click(function(){t.focus();t.val(e(this).text());k(t);});});}}).unbind("keydown.validation").bind("keydown.validation",function(u){var n=(u.keyCode?u.keyCode:u.which),x,o,v=e(this);if(n===13&&e.formUtils._selectedSuggestion!==null){x=v.valAttr("suggestion-nr");o=e(".jquery-form-suggestion-"+x);if(o.length>0){var r=o.find("div").eq(e.formUtils._selectedSuggestion).text();v.val(r);k(v);u.preventDefault();}}else{x=v.valAttr("suggestion-nr");o=e(".jquery-form-suggestion-"+x);var p=o.children();if(p.length>0&&e.inArray(n,[38,40])>-1){if(n===38){if(e.formUtils._selectedSuggestion===null){e.formUtils._selectedSuggestion=p.length-1;}else{e.formUtils._selectedSuggestion--;}if(e.formUtils._selectedSuggestion<0){e.formUtils._selectedSuggestion=p.length-1;}}else{if(n===40){if(e.formUtils._selectedSuggestion===null){e.formUtils._selectedSuggestion=0;}else{e.formUtils._selectedSuggestion++;}if(e.formUtils._selectedSuggestion>(p.length-1)){e.formUtils._selectedSuggestion=0;}}}var q=o.innerHeight(),w=o.scrollTop(),t=o.children().eq(0).outerHeight(),s=t*(e.formUtils._selectedSuggestion);if(s<w||s>(w+q)){o.scrollTop(s);}p.removeClass("active-suggestion").css("background","none").eq(e.formUtils._selectedSuggestion).addClass("active-suggestion").css(j.activeSuggestionCSS);u.preventDefault();return false;}}}).unbind("blur.suggest").bind("blur.suggest",function(){k(e(this));});return i;},LANG:{errorTitle:"Form submission failed!",requiredField:"This is a required field",requiredFields:"You have not answered all required fields",badTime:"You have not given a correct time",badEmail:"You have not given a correct e-mail address",badTelephone:"You have not given a correct phone number",badSecurityAnswer:"You have not given a correct answer to the security question",badDate:"You have not given a correct date",lengthBadStart:"The input value must be between ",lengthBadEnd:" characters",lengthTooLongStart:"The input value is longer than ",lengthTooShortStart:"The input value is shorter than ",notConfirmed:"Input values could not be confirmed",badDomain:"Incorrect domain value",badUrl:"The input value is not a correct URL",badCustomVal:"The input value is incorrect",andSpaces:" and spaces ",badInt:"The input value was not a correct number",badSecurityNumber:"Your social security number was incorrect",badUKVatAnswer:"Incorrect UK VAT Number",badStrength:"The password isn't strong enough",badNumberOfSelectedOptionsStart:"You have to choose at least ",badNumberOfSelectedOptionsEnd:" answers",badAlphaNumeric:"The input value can only contain alphanumeric characters ",badAlphaNumericExtra:" and ",wrongFileSize:"The file you are trying to upload is too large (max %s)",wrongFileType:"Only files of type %s is allowed",groupCheckedRangeStart:"Please choose between ",groupCheckedTooFewStart:"Please choose at least ",groupCheckedTooManyStart:"Please choose a maximum of ",groupCheckedEnd:" item(s)",badCreditCard:"The credit card number is not correct",badCVV:"The CVV number was not correct",wrongFileDim:"Incorrect image dimensions,",imageTooTall:"the image can not be taller than",imageTooWide:"the image can not be wider than",imageTooSmall:"the image was too small",min:"min",max:"max",imageRatioNotAccepted:"Image ratio is not be accepted",badBrazilTelephoneAnswer:"The phone number entered is invalid",badBrazilCEPAnswer:"The CEP entered is invalid",badBrazilCPFAnswer:"The CPF entered is invalid"}};e.formUtils.addValidator({name:"email",validatorFunction:function(k){var i=k.toLowerCase().split("@"),j=i[0],l=i[1];if(j&&l){if(j.indexOf('"')===0){var h=j.length;j=j.replace(/\"/g,"");if(j.length!==(h-2)){return false;}}return e.formUtils.validators.validate_domain.validatorFunction(i[1])&&j.indexOf(".")!==0&&j.substring(j.length-1,j.length)!=="."&&j.indexOf("..")===-1&&!(/[^\w\+\.\-\#\-\_\~\!\$\&\'\(\)\*\+\,\;\=\:]/.test(j));}return false;},errorMessage:"",errorMessageKey:"badEmail"});e.formUtils.addValidator({name:"domain",validatorFunction:function(h){return h.length>0&&h.length<=253&&!(/[^a-zA-Z0-9]/.test(h.slice(-2)))&&!(/[^a-zA-Z0-9]/.test(h.substr(0,1)))&&!(/[^a-zA-Z0-9\.\-]/.test(h))&&h.split("..").length===1&&h.split(".").length>1;},errorMessage:"",errorMessageKey:"badDomain"});e.formUtils.addValidator({name:"required",validatorFunction:function(k,j,i,l,h){switch(j.attr("type")){case"checkbox":return j.is(":checked");case"radio":return h.find('input[name="'+j.attr("name")+'"]').filter(":checked").length>0;default:return e.trim(k)!=="";}},errorMessage:"",errorMessageKey:function(h){if(h.errorMessagePosition==="top"||h.errorMessagePosition==="custom"){return"requiredFields";}else{return"requiredField";}}});e.formUtils.addValidator({name:"length",validatorFunction:function(i,p,m,h){var k=p.valAttr("length"),n=p.attr("type");if(k===undefined){alert('Please add attribute "data-validation-length" to '+p[0].nodeName+" named "+p.attr("name"));return true;}var l=n==="file"&&p.get(0).files!==undefined?p.get(0).files.length:i.length,j=e.formUtils.numericRangeCheck(l,k),o;switch(j[0]){case"out":this.errorMessage=h.lengthBadStart+k+h.lengthBadEnd;o=false;break;case"min":this.errorMessage=h.lengthTooShortStart+j[1]+h.lengthBadEnd;o=false;break;case"max":this.errorMessage=h.lengthTooLongStart+j[1]+h.lengthBadEnd;o=false;break;default:o=true;}return o;},errorMessage:"",errorMessageKey:""});e.formUtils.addValidator({name:"url",validatorFunction:function(h){var k=/^(https?|ftp):\/\/((((\w|-|\.|~|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])|(%[\da-f]{2})|[!\$&'\(\)\*\+,;=]|:)*@)?(((\d|[1-9]\d|1\d\d|2[0-4]\d|25[0-5])\.(\d|[1-9]\d|1\d\d|2[0-4]\d|25[0-5])\.(\d|[1-9]\d|1\d\d|2[0-4]\d|25[0-5])\.(\d|[1-9]\d|1\d\d|2[0-4]\d|25[0-5]))|((([a-z]|\d|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])|(([a-z]|\d|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])(\w|-|\.|~|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])*([a-z]|\d|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])))\.)+(([a-z]|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])|(([a-z]|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])(\w|-|\.|~|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])*([a-z]|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])))\.?)(:\d*)?)(\/(((\w|-|\.|~|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])|(%[\da-f]{2})|[!\$&'\(\)\*\+,;=]|:|@)+(\/((\w|-|\.|~|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])|(%[\da-f]{2})|[!\$&'\(\)\*\+,;=]|:|@)*)*)?)?(\?((([a-z]|\d|\[|\]|-|\.|_|~|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])|(%[\da-f]{2})|[!\$&'\(\)\*\+,;=]|:|@)|[\uE000-\uF8FF]|\/|\?)*)?(\#(((\w|-|\.|~|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])|(%[\da-f]{2})|[!\$&'\(\)\*\+,;=]|:|@)|\/|\?)*)?$/i;if(k.test(h)){var i=h.split("://")[1],j=i.indexOf("/");if(j>-1){i=i.substr(0,j);}return e.formUtils.validators.validate_domain.validatorFunction(i);}return false;},errorMessage:"",errorMessageKey:"badUrl"});e.formUtils.addValidator({name:"number",validatorFunction:function(i,q,l){if(i!==""){var m=q.valAttr("allowing")||"",p=q.valAttr("decimal-separator")||l.decimalSeparator,o=false,j,k,n=q.valAttr("step")||"",h=false;if(m.indexOf("number")===-1){m+=",number";}if(m.indexOf("negative")===-1&&i.indexOf("-")===0){return false;}if(m.indexOf("range")>-1){j=parseFloat(m.substring(m.indexOf("[")+1,m.indexOf(";")));k=parseFloat(m.substring(m.indexOf(";")+1,m.indexOf("]")));o=true;}if(n!==""){h=true;}if(p===","){if(i.indexOf(".")>-1){return false;}i=i.replace(",",".");}if(m.indexOf("number")>-1&&i.replace(/[0-9-]/g,"")===""&&(!o||(i>=j&&i<=k))&&(!h||(i%n===0))){return true;}if(m.indexOf("float")>-1&&i.match(new RegExp("^([0-9-]+)\\.([0-9]+)$"))!==null&&(!o||(i>=j&&i<=k))&&(!h||(i%n===0))){return true;}}return false;},errorMessage:"",errorMessageKey:"badInt"});e.formUtils.addValidator({name:"alphanumeric",validatorFunction:function(i,p,l,k){var o="^([a-zA-Z0-9",n="]+)$",h=p.valAttr("allowing"),m="";if(h){m=o+h+n;var j=h.replace(/\\/g,"");if(j.indexOf(" ")>-1){j=j.replace(" ","");j+=k.andSpaces||e.formUtils.LANG.andSpaces;}this.errorMessage=k.badAlphaNumeric+k.badAlphaNumericExtra+j;}else{m=o+n;this.errorMessage=k.badAlphaNumeric;}return new RegExp(m).test(i);},errorMessage:"",errorMessageKey:""});e.formUtils.addValidator({name:"custom",validatorFunction:function(j,h){var i=new RegExp(h.valAttr("regexp"));return i.test(j);},errorMessage:"",errorMessageKey:"badCustomVal"});e.formUtils.addValidator({name:"date",validatorFunction:function(j,k,i){var h=k.valAttr("format")||i.dateFormat||"yyyy-mm-dd";return e.formUtils.parseDate(j,h)!==false;},errorMessage:"",errorMessageKey:"badDate"});e.formUtils.addValidator({name:"year",validatorFunction:function(k,j,i,l,h){return((new Date()).getFullYear()>=parseInt(k)&&k.length==4);},errorMessage:"",errorMessageKey:"badYear"});e.formUtils.addValidator({name:"ckeditor",validatorFunction:function(k,j,i,m,h){var l=j.contents().find(".cke_editable").text();return e.trim(l)!="";},errorMessage:"",errorMessageKey:function(h){if(h.errorMessagePosition==="top"||h.errorMessagePosition==="custom"){return"requiredFields";}else{return"requiredField";}}});e.formUtils.addValidator({name:"checkbox_group",validatorFunction:function(j,s,n,i,t){var r=true,o=s.attr("name"),p=e('input[type=checkbox][name^="'+o+'"]',t),l=p.filter(":checked").length,k=s.valAttr("qty");if(k===undefined){var m=s.get(0).nodeName;alert('Attribute "data-validation-qty" is missing from '+m+" named "+s.attr("name"));}var q=e.formUtils.numericRangeCheck(l,k);switch(q[0]){case"out":this.errorMessage=i.groupCheckedRangeStart+k+i.groupCheckedEnd;r=false;break;case"min":this.errorMessage=i.groupCheckedTooFewStart+q[1]+i.groupCheckedEnd;r=false;break;case"max":this.errorMessage=i.groupCheckedTooManyStart+q[1]+i.groupCheckedEnd;r=false;break;default:r=true;}if(!r){var h=function(){p.unbind("click",h);p.filter("*[data-validation]").validateInputOnBlur(i,n,false,"blur");};p.bind("click",h);}return r;}});})(jQuery);