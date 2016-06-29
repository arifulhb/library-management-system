/**
 * Created by ariful on 6/24/16.
 */
'use strict';
var authorForm = $('.author-form, .publisher-form').length;
if ( authorForm > 0 ) {

	$.get('/admin/countries', function ( data ) {
		var $input = $('#aCountry');
		$input.attr('disabled', false);
		$input.attr('placeholder', 'Country');
		$('#faCountry').removeClass('fa-spinner');
		$('#faCountry').removeClass('fa-pulse');
		$('#faCountry').addClass('fa-globe');
		$input.typeahead({
											 minLength   : 2,
											 delay       : 0,
											 source      : data.result,
											 displayText : function ( item ) {
												 return item.name;
											 },
											 autoSelect  : true,
										 });
	});

}