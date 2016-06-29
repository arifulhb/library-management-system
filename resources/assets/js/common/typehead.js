/**
 * Created by ariful on 6/24/16.
 */
'use strict';
module.exports = {
	autoComplete : function ( element, model, displayText, updater ) {
		var url    = '/admin/' + model + '/search?q=';
		var $input = $(element);
		$input.typeahead({
											 minLength   : 3,
											 delay       : 1000,
											 source      : function ( query, process ) {
												 return $.get(url + query, function ( data ) {
													 return process(data.result);
												 });
											 },
											 displayText : displayText,
											 autoSelect  : true,
											 updater     : updater
										 });
	}
}