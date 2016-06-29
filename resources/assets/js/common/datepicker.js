/**
 * Created by ariful on 6/24/16.
 */
'use strict';

var datePicker = $('.date-picker').length;
if ( datePicker > 0 ) {
	$('.date-picker').datepicker({
																 format         : "d MM yyyy",
																 maxViewMode    : 3,
																 todayBtn       : "linked",
																 clearBtn       : true,
																 todayHighlight : true})
																.change(dateChanged)
																.on('changeDate', dateChanged)

}

function dateChanged(ev) {
	$('.date-picker').attr('value', $(this).val());
}