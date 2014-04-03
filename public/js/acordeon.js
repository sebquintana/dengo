$(document).ready(function() {
    $('.acordeon').accordion({
    	collapsible: true,
    	active: 0, 
    	header: 'h3',
    	heightStyle: "content",
    	icons: { "header": "ui-icon-circle-plus", "activeHeader": "ui-icon-circle-minus" }
    	 });
});