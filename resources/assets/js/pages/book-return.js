/**
 * Created by ariful on 6/24/16.
 */
'use strict';
var bookReturn = $('#book-return').length;

if ( bookReturn > 0 ) {

	$('.btn-book-return').attr('disabled', false);
	/**
	 * Return a books in list
	 */
	$('.btn-book-return').click(function () {

		var token = $('#token').val();
		var reservationId = $(this).val();
		var fine = $('#fine-for-'+reservationId).val();

		$(this).html('<i class="fa fa-spinner fa-plus"></i> Processing');
		$(this).attr('disabled', true);

		$.ajax({
						 'method'  : "POST",
						 'url'     : '/return-books/'+reservationId,
						 'data'    : { '_token' : token, 'fine': fine },
						 'success' : function ( response, statusText, xhr ) {

							 if ( xhr.status == 200 ) {

								 var message = '<div class="alert alert-success alert-dismissible fade in" role="alert">';
								 message += ' <button type="button" class="close" data-dismiss="alert" aria-label="Close">';
								 message += '<span aria-hidden="true">×</span></button>';
								 message += ' <strong>Success! </strong> Books are returned successfully.';
								 message += '</div>';
								 $('#message').append(message);

								// remove the row
								 $('#reservation-id-'+reservationId).remove();

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