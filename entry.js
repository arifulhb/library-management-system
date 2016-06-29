/**
 * Created by ariful on 6/23/16.
 */
'use strict';

var datePicker = require('./resources/assets/js/common/datepicker.js');

/**
 * Page
 */
var bookForm   = require('./resources/assets/js/pages/book-form.js');
var authorForm = require('./resources/assets/js/pages/author-form.js');
var bookBorrow = require('./resources/assets/js/pages/book-borrow.js');
var bookReturn = require('./resources/assets/js/pages/book-return.js');

/**
 * Update pagination class
 */
$('.pagination').addClass('pagination-sm no-margin');

/**
 * Popover initialization
 */
$("[data-toggle=popover]").popover();