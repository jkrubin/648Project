$('#search').submit(function(event) {
	var query = $('input[name="q"]').text().trim();
	var rooms = $('select[name="br"]').val();

	var queryRegex = "^([ \u00c0-\u01ffa-zA-Z'\-])+|[0-9]{5}$";
	if (!queryRegex.test(query) || ! rooms >= 0) {
		if (!queryRegex.test(query)) {
			$('input[name="q"]').toggleClass("invalid-input");
			$('#queryError').toggleClass("hidden");
		}
		if (!rooms >= 0) {
			$('select[name="br"]').toggleClass("invalid-input");
			$('#roomError').toggleClass("hidden");
		}
		event.preventDefault();
	}
});
