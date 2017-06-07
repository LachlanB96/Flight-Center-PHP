$(document).ready(function() {

	$('.table-row').click(function() {
		var href = $(this).attr("href");
		if(href) {
			window.location = href;
		}
	});

});
