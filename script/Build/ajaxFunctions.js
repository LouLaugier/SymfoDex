//update subForm when a pokemon is selected
function setSubForm() {
	$('.choixPokemon').on('change', function() {	
		var data = {};
		if($('.choixPokemon').val()) {
			data['pokemonId'] = $('.choixPokemon').val();
		} else {
			return;
		}
		
		$.ajax({
			type: 'POST',
			data: data,
			dataType: 'text'
		}).done(function (response) {
			var found = $('#subFormcontent', response);
			$('#subFormulaire').html(found);
			setFormValidationEventListener();
			setNatureBonusEventListener();
			setAllTotStat(true);
			setStatBar(true);
		}).fail(function () {
			console.log('error'); //To do : manage error.
		});
	});
}

//update natureBonus depending on value parameter 
function setNatureBonus(value) {
	var data = {};
	data['natureId'] = value;
	
	$.ajax({
		type: 'POST',
		url: '/SymfoDex/public/index.php/symfodex/setNature',
		data: data,
		dataType: 'json'
	}).done(function (response) {
		natureBonus = $.parseJSON(response); 
		setAllTotStat();
		setStatBar();
	}).fail(function () {
		console.log('error'); //To do : manage error.
	});
}

