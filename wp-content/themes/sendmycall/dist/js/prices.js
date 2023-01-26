/******/ (function(modules) { // webpackBootstrap
/******/ 	// The module cache
/******/ 	var installedModules = {};
/******/
/******/ 	// The require function
/******/ 	function __webpack_require__(moduleId) {
/******/
/******/ 		// Check if module is in cache
/******/ 		if(installedModules[moduleId]) {
/******/ 			return installedModules[moduleId].exports;
/******/ 		}
/******/ 		// Create a new module (and put it into the cache)
/******/ 		var module = installedModules[moduleId] = {
/******/ 			i: moduleId,
/******/ 			l: false,
/******/ 			exports: {}
/******/ 		};
/******/
/******/ 		// Execute the module function
/******/ 		modules[moduleId].call(module.exports, module, module.exports, __webpack_require__);
/******/
/******/ 		// Flag the module as loaded
/******/ 		module.l = true;
/******/
/******/ 		// Return the exports of the module
/******/ 		return module.exports;
/******/ 	}
/******/
/******/
/******/ 	// expose the modules object (__webpack_modules__)
/******/ 	__webpack_require__.m = modules;
/******/
/******/ 	// expose the module cache
/******/ 	__webpack_require__.c = installedModules;
/******/
/******/ 	// define getter function for harmony exports
/******/ 	__webpack_require__.d = function(exports, name, getter) {
/******/ 		if(!__webpack_require__.o(exports, name)) {
/******/ 			Object.defineProperty(exports, name, { enumerable: true, get: getter });
/******/ 		}
/******/ 	};
/******/
/******/ 	// define __esModule on exports
/******/ 	__webpack_require__.r = function(exports) {
/******/ 		if(typeof Symbol !== 'undefined' && Symbol.toStringTag) {
/******/ 			Object.defineProperty(exports, Symbol.toStringTag, { value: 'Module' });
/******/ 		}
/******/ 		Object.defineProperty(exports, '__esModule', { value: true });
/******/ 	};
/******/
/******/ 	// create a fake namespace object
/******/ 	// mode & 1: value is a module id, require it
/******/ 	// mode & 2: merge all properties of value into the ns
/******/ 	// mode & 4: return value when already ns object
/******/ 	// mode & 8|1: behave like require
/******/ 	__webpack_require__.t = function(value, mode) {
/******/ 		if(mode & 1) value = __webpack_require__(value);
/******/ 		if(mode & 8) return value;
/******/ 		if((mode & 4) && typeof value === 'object' && value && value.__esModule) return value;
/******/ 		var ns = Object.create(null);
/******/ 		__webpack_require__.r(ns);
/******/ 		Object.defineProperty(ns, 'default', { enumerable: true, value: value });
/******/ 		if(mode & 2 && typeof value != 'string') for(var key in value) __webpack_require__.d(ns, key, function(key) { return value[key]; }.bind(null, key));
/******/ 		return ns;
/******/ 	};
/******/
/******/ 	// getDefaultExport function for compatibility with non-harmony modules
/******/ 	__webpack_require__.n = function(module) {
/******/ 		var getter = module && module.__esModule ?
/******/ 			function getDefault() { return module['default']; } :
/******/ 			function getModuleExports() { return module; };
/******/ 		__webpack_require__.d(getter, 'a', getter);
/******/ 		return getter;
/******/ 	};
/******/
/******/ 	// Object.prototype.hasOwnProperty.call
/******/ 	__webpack_require__.o = function(object, property) { return Object.prototype.hasOwnProperty.call(object, property); };
/******/
/******/ 	// __webpack_public_path__
/******/ 	__webpack_require__.p = "";
/******/
/******/
/******/ 	// Load entry module and return exports
/******/ 	return __webpack_require__(__webpack_require__.s = 15);
/******/ })
/************************************************************************/
/******/ ({

/***/ "./modules/prices/prices.js":
/*!**********************************!*\
  !*** ./modules/prices/prices.js ***!
  \**********************************/
/*! no static exports found */
/***/ (function(module, exports) {

(function ($) {
  $(document).ready(function () {
    var cities = $('#cities').select2();
    var type = $('#type').select2();
    var destination = $('#destination').select2();
    var country_from = $('#country_from').select2();
    $(country_from).select2({
      templateResult: add_image_for_option,
      templateSelection: add_image_for_option
    });
    function add_image_for_option(opt) {
      if (!opt.id) {
        return opt.text;
      }
      var optimage = $(opt.element).attr('data-image');
      if (!optimage) {
        return opt.text;
      } else {
        var $opt = $('<span><img src="' + optimage + '" width="30px" /> ' + opt.text + '</span>');
        return $opt;
      }
    }
    $(destination).select2({
      templateResult: add_image_for_option_destination,
      templateSelection: add_image_for_option_destination
    });
    function add_image_for_option_destination(opt) {
      if (!opt.id) {
        return opt.text;
      }
      var optimage = $(opt.element).attr('data-image');
      if (!optimage) {
        return opt.text;
      } else {
        var $opt = $('<span><img src="' + optimage + '" width="30px" /> ' + opt.text + '</span>');
        return $opt;
      }
    }
    $(cities).on('select2:select', function (e) {
      var price = e.params.data.monthly_price;
      var sale_array = [{
        month: 3,
        percentage: 10
      }, {
        month: 6,
        percentage: 15
      }, {
        month: 12,
        percentage: 25
      }];
      sale_array.forEach(function (item) {
        var economy = item.percentage / 100 * price;
        $(".subscription_price_".concat(item.month)).html((price - economy).toFixed(2) + '/');
        $(".subscription_economy_".concat(item.month)).html((economy * item.month).toFixed(2));
      });
      $('.subscription_price').html(price + '/');
    });
    $(cities).prop('disabled', true);
    $(type).prop('disabled', true);
    $(destination).prop('disabled', true);
    $(country_from).on('change', function () {
      $('#type').prop('disabled', false);
      var post_id = $(this).val();
      var $form = $('#filter');
      $.ajax({
        url: $form.attr('action'),
        data: {
          country_post_id: post_id,
          action: 'filter_cities'
        },
        type: $form.attr('method'),
        success: function success(data) {
          var posts = JSON.parse(data);
          $('#cities').select2({
            data: posts
          }).trigger({
            type: 'select2:select',
            params: {
              data: {
                monthly_price: posts[0].monthly_price
              }
            }
          });
        }
      });
    });
    $(type).on('change', function () {
      if ($(this).val() === 'toll_free') {
        $(cities).prop('disabled', true);
        $(destination).prop('disabled', false);
      } else {
        $(cities).prop('disabled', false);
      }
    });
    $(cities).on('change', function () {
      $(destination).prop('disabled', false);
      $('.section-prices-subscription').show();
      var post_id = $(this).val();
      var $form = $('#filter');
      $.ajax({
        url: $form.attr('action'),
        data: {
          country_post_id: post_id,
          action: 'filter_cities'
        },
        type: $form.attr('method'),
        success: function success(data) {
          var posts = JSON.parse(data);
          $(cities).select2({
            data: posts
          });
        }
      });
    });
    $(destination).on('change', function () {
      var term_id = $(this).val();
      var $form = $('#filter');
      var tbody = $('#countries');
      var slug = $(this).find(":selected").data("slug");
      var toll_free_price = $('.section-prices-notification-rate');
      $.ajax({
        url: $form.attr('action'),
        data: {
          term_id: term_id,
          action: 'filter_forwarding_rates'
        },
        type: $form.attr('method'),
        success: function success(data) {
          $(tbody).html(data);
          $.ajax({
            url: $form.attr('action'),
            data: {
              slug: slug,
              action: 'filter_toll_free'
            },
            type: $form.attr('method'),
            success: function success(data) {
              $(toll_free_price).html(data);
            }
          });
        }
      });
    });
  });
})(jQuery);

/***/ }),

/***/ 15:
/*!****************************************!*\
  !*** multi ./modules/prices/prices.js ***!
  \****************************************/
/*! no static exports found */
/***/ (function(module, exports, __webpack_require__) {

module.exports = __webpack_require__(/*! ./modules/prices/prices.js */"./modules/prices/prices.js");


/***/ })

/******/ });
//# sourceMappingURL=prices.js.map