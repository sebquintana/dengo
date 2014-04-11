$(document).ready(function() {
    $('.acordeon').accordion({
    	collapsible: true,
    	active: 0, 
    	header: 'h4',
    	heightStyle: "content",
    	icons: { "header": "ui-icon-circle-plus", "activeHeader": "ui-icon-circle-minus" }
    	 });
});