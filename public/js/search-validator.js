$('#search').submit(function(event) {
	var query = $('input[name="q"]').val().trim();
	var rooms = $('select[name="br"]').val();

	var queryRegex = /^([ a-zA-Z'\-])+|[0-9]{5}$/
	// Uses String.prototype.match to check if the whole input matches the regex and
	// the number of bedrooms is greater than or equal to 0
	// Rejects/halts form submission if it fails
	if (query.match(queryRegex)[0].length !== query.length || rooms < 0) {
		if (query.match(queryRegex)[0].length !== query.length) {
			$('input[name="q"]').addClass("invalid-input");
			$('#query-error').removeClass("hidden");
		} else {
			$('input[name="q"]').removeClass("invalid-input");
			$('#query-error').addClass("hidden");
		}

		if (rooms < 0) {
			$('select[name="br"]').addClass("invalid-input");
			$('#room-error').removeClass("hidden");
		} else {
			$('select[name="br"]').removeClass("invalid-input");
			$('#room-error').addClass("hidden");
		}

		event.preventDefault();
	}
});

$('input[name="q"]').change(function() {
	$('input[name="q"]').removeClass("invalid-input");
	$('#query-error').addClass("hidden");
});

$('select[name="br"]').change(function() {
	$('select[name="br"]').removeClass("invalid-input");
	$('#room-error').addClass("hidden");
});
