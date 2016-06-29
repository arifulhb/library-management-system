/**
 * Created by ariful on 6/24/16.
 */
'use strict';
var bookBorrow = $('#search-book').length;
var typeHead   = require('./../common/typehead.js');

if ( bookBorrow > 0 ) {

	$('#borrow-now').val(0);

	var bookDisplayText = function ( item ) {
		var availability   = '';
		var availableClass = '';
		if ( item.copyStatus === '0' ) {
			availability   = ' [not available]';
			availableClass = 'text-muted';
		}
		var name = item.title + ' - ' + item.edition + ' (' + item.bookCode + ') - By ' + item.authorName + availability
		return name;
	};

	var book        = $('#search-book');
	var bookUpdater = function ( item ) {
		$('#selected-book-id').val(item.id);
		$('#selected-book-copy-id').val(item.copyId);
		$('#selected-book-status').val(item.copyStatus);
		$('#selected-book-title').val(item.title);
		$('#selected-book-code').val(item.bookCode);
		$('#selected-book-edition').val(item.edition);
		$('#selected-book-author').val(item.authorName);
		return item;
	}
	typeHead.autoComplete(book, 'book', bookDisplayText, bookUpdater);

	$('#btn-add-to-borrow').click(function () {

		var bookCopyStatus = parseInt($('#selected-book-status').val());

		if(bookCopyStatus == 0){
			var message = '<div class="alert alert-warning alert-dismissible fade in" role="alert">';
			message += ' <button type="button" class="close" data-dismiss="alert" aria-label="Close">';
			message += '<span aria-hidden="true">×</span></button>';
			message += ' <strong>Sorry! </strong> This book is already checked out by someone else!';
			message += '</div>';
			$('#message').append(message);
				return 0;
		}
		var maxLimitNow = $('#max-limit-now').val();
		var totalInCart   = parseInt($('#borrow-now').val());
		if ( totalInCart < maxLimitNow ) {
			$('#message div').remove();
			var row = '<tr id="row-' + $('#selected-book-copy-id').val() + '">';
			row += '<td>' + $('#selected-book-code').val() + '</td>';
			row += '<input type="hidden" class="selected-book" value="' + $('#selected-book-copy-id').val() + '"/>'
			row += '<td>' + $('#selected-book-title').val() + ' - ' + $('#selected-book-edition').val() + '</td>';
			row += '<td>' + $('#selected-book-author').val() + '</td>';
			row += '<td><button class="btn btn-sm btn-link remove-book" type="button" value="' + $('#selected-book-copy-id').val() + '"><i class="fa fa-close"></i></button></td>';
			row += '</tr>';
			$('#book-borrow-list').append(row);

			//Update total list value
			updateAddBook();

			$('#search-book').val('');
			$('#search-book').focus();

		}
		else {
			alert('You\'ve reached your Maximum Limit');
		}
	});

	/**
	 * Update borrow-now variable and total selected text
	 */
	var updateAddBook      = function (  ) {
		var totalInCart   = parseInt($('#borrow-now').val());
		totalInCart     = totalInCart + 1;

		$('#borrow-now').val(totalInCart);
		$('#show-current-total').html(parseInt(totalInCart) + ' books selected.');

		updateBorrowButton(totalInCart);
	}

	var updateBorrowButton = function ( totalInCart) {
		var maxLimitNow = parseInt($('#max-limit-now').val());
		$('#max-limit-badge').html( maxLimitNow - totalInCart);

		if ( totalInCart > 0 ) {
			$('#borrow-books').attr('disabled', false);
		}
		else {
			$('#borrow-books').attr('disabled', true);
		}

	}

	/**
	 * Remove selected book
	 */
	$('#book-borrow-list').on('click', '.remove-book', function () {
		var bookId = $(this).val();
		$('#row-' + bookId).remove();

		updateRemoveBook();

	});
	/**
	 * decrease borrow-now value
	 * Update borrow-now variable and total selected text

	 */
	var updateRemoveBook = function () {

		var totalInCart = parseInt($('#borrow-now').val());
		totalInCart     = totalInCart - 1;
		$('#borrow-now').val(totalInCart);
		$('#show-current-total').html(parseInt(totalInCart) + ' books selected.');

		updateBorrowButton(totalInCart);

	};

	/**
	 * Borrow a books in list
	 */
	$('#borrow-books').click(function () {

		var token = $('#token').val();
		var books = [];
		$('.selected-book').each(function ( index ) {
			books.push($(this).val());
		});

		$(this).attr('disabled', true);
		$.ajax({
						 'method'  : "POST",
						 'url'     : '/admin/borrow',
						 'data'    : { 'books' : books, '_token' : token },
						 'success' : function ( response, statusText, xhr ) {

							 if ( xhr.status == 201 ) {

								 var message = '<div class="alert alert-success alert-dismissible fade in" role="alert">';
								 message += ' <button type="button" class="close" data-dismiss="alert" aria-label="Close">';
								 message += '<span aria-hidden="true">×</span></button>';
								 message += ' <strong>Success! </strong> Books are checked-out successfully.';
								 message += '</div>';
								 $('#message').append(message);

								 $('#book-borrow-list tr').remove();
								 $('#show-current-total').html('0');
								 $('#borrow-books').attr('disabled', true);
								 updateLimits();
							 }
							 else {
								 var message = '<div class="alert alert-warning alert-dismissible fade in" role="alert">';
								 message += ' <button type="button" class="close" data-dismiss="alert" aria-label="Close">';
								 message += '<span aria-hidden="true">×</span></button>';
								 message += ' <strong><i class="fa fa-warning"></i>! </strong> Something went wrong.';
								 message += '</div>';
								 $('#message').append(message);
							 }
						 },
						 error     : function ( xhr, statusText ) {
							 var message = '<div class="alert alert-danger alert-dismissible fade in" role="alert">';
							 message += ' <button type="button" class="close" data-dismiss="alert" aria-label="Close">';
							 message += '<span aria-hidden="true">×</span></button>';
							 message += ' <strong><i class="fa fa-warning"></i>! </strong> There\'s some error.';
							 message += '</div>';
							 $('#message').append(message);
						 }
					 });
	});

	/**
	 * Update after successful borrow
	 */
	var updateLimits = function () {

		var totalInCart = parseInt($('#borrow-now').val());
		var currentLoan = parseInt($('#current-loan').val());
		var maxLimitNow = parseInt($('#max-limit-now').val());

		$('#max-limit-badge').html(maxLimitNow - totalInCart);
		$('#max-limit-now').val(maxLimitNow - totalInCart);

		$('#current-loan').val(currentLoan + totalInCart);
		$('#current-loan-badge').html(currentLoan + totalInCart);

		$('#borrow-now').val(0);

	}

	$(document).ajaxStart(function () {
		$('#borrow-fa').removeClass('fa-plus');
		$('#borrow-fa').addClass('fa-spinner');
		$('#borrow-fa').addClass('fa-pulse');
	});
	$(document).ajaxComplete(function () {
		$('#borrow-fa').addClass('fa-plus');
		$('#borrow-fa').removeClass('fa-spinner');
		$('#borrow-fa').removeClass('fa-pulse');
	});

}