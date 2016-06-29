/**
 * Created by ariful on 6/24/16.
 */
'use strict';
var bookForm = $('.book-form').length;
console.log("book form: ", bookForm);
var typeHead = require('./../common/typehead.js');
if ( bookForm > 0 ) {

	var token  = $('#token').val();
	var bookId = $('#book-id').val();

	/**
	 * Authors
	 */
	var authorDisplayText = function ( item ) {
		return item.name + ' (' + item.country + ')';
	};

	var author1        = $('#bookAuthor1');
	var author1Updater = function ( item ) {
		$('#author1').val(item.id);
		return item;
	}
	typeHead.autoComplete(author1, 'author', authorDisplayText, author1Updater);

	var author2        = $('#bookAuthor2');
	var author2Updater = function ( item ) {
		$('#author2').val(item.id);
		return item;
	}
	typeHead.autoComplete(author2, 'author', authorDisplayText, author2Updater);

	var author3        = $('#bookAuthor3');
	var author3Updater = function ( item ) {
		$('#author3').val(item.id);
		return item;
	}
	typeHead.autoComplete(author3, 'author', authorDisplayText, author3Updater);

	/**
	 * Publisher
	 */
	var publisher        = $('#bookPublisher');
	var publisherUpdater = function ( item ) {
		$('#publisherId').val(item.id);
		return item;
	}
	typeHead.autoComplete(publisher, 'publisher', authorDisplayText, publisherUpdater);

	/**
	 * Clear Author
	 */
	$('.clear-author').click(function () {
		var authorSn = $(this).val();
		var authorId = $('#author'+authorSn).val();
		$('#author' + authorSn).val('');
		$('#bookAuthor' + authorSn).val('');
		$.ajax({
						 url     : '/admin/book/' + bookId + '/author/' + authorId,
						 type    : 'DELETE',
						 data    : { '_token' : token },
					 });
	});

	/**
	 * Category
	 */
	var categoryDisplayText = function ( item ) {
		return item.title + ' (' + item.categoryCode + ')';
	};
	var category1           = $('#bookCategory1');
	var category1Updater    = function ( item ) {
		$('#category1').val(item.id);
		return item;
	}
	typeHead.autoComplete(category1, 'category', categoryDisplayText, category1Updater);

	var category2        = $('#bookCategory2');
	var category2Updater = function ( item ) {
		$('#category2').val(item.id);
		return item;
	}
	typeHead.autoComplete(category2, 'category', categoryDisplayText, category2Updater);

	var category3        = $('#bookCategory3');
	var category3Updater = function ( item ) {
		$('#category3').val(item.id);
		return item;
	}
	typeHead.autoComplete(category3, 'category', categoryDisplayText, category3Updater);

	$('.clear-category').click(function () {
		var categorySn = $(this).val();
		var categoryId = $('#category'+categorySn).val();
		$('#category' + categorySn).val('');
		$('#bookCategory' + categorySn).val('');
		$.ajax({
						 url     : '/admin/book/' + bookId + '/category/' + categoryId,
						 type    : 'DELETE',
						 data    : { '_token' : token },
					 });
	});



	$(document).ajaxStart(function () {
		$('#publiserLabel').html('Publisher <i class="fa fa-spinner fa-pulse"></i>');
	});
	$(document).ajaxComplete(function () {
		$('#publiserLabel').html('Publisher');
	});

}