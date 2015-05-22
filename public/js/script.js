/* jslint browser:true */
/* global $:true, confirm:true */
$(document).on('ready', function(){
	'use strict';
	$.extend($.tablesorter.themes.bootstrap, {
		sortNone: 'glyphicon glyphicon-filter',
		sortAsc: 'glyphicon glyphicon-chevron-up',
		sortDesc: 'glyphicon glyphicon-chevron-down'
	});
	$('table').tablesorter({
		theme: 'bootstrap',
		headerTemplate: '{content} {icon}',
		widgets: ['uitheme', 'zebra'],
		widgetOptions: {
			zebra: ['even', 'odd'],
		}
	});

	$('.btn-danger').click(function(e){
		var r = confirm('Are you sure you want to delete this record?');
		if(r !== true){
			e.preventDefault();
		}
	});
});
