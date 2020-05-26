//To do : move magic numbers to constant file

function setFormValidationEventListener() {
	$('.ev').on('keyup mouseup', function() {
		//validation de la valeur max du champ (252 max)
		if($(this).val() > 252) {
			$(this).val(252);
		}
		
		//validation de la valeur en fonction de la sum de chaque valeur (510 max)
		var sum = 0;
		$('.ev').each(function() {
			sum = sum + parseInt($(this).val());
		});
		if(sum > 510) {
			$(this).val(510 - (sum - parseInt($(this).val())));
			$('#evRemaining').text(0);
		} else {
			$('#evRemaining').text(510 - sum);
		}
		
	});
	
	//select input on click
	$('.ev').on('click', function() {
		$(this).select();
	});
	
	$('.iv').on('keyup mouseup', function() {
		//validation de la valeur max du champ (31 max)
		if($(this).val() > 31) {
			$(this).val(31);
		}
	});
	
	//select input on click
	$('.iv').on('click', function() {
		$(this).select();
	});
	
	//calc tot pv
	$('.pv').on('keyup mouseup', function() {
		$('#totalPv').text(calculTotPv($('#basePv').text(), $('.iv.pv').val(), $('.ev.pv').val(), 100));
		$('#barPv').css("width", calculBarValue($('#totalPv').text())+'px');
	});
	
	//calc tot atk
	$('.atk').on('keyup mouseup', function() {
		$('#totalAtk').text(calculTotStat($('#baseAtk').text(), $('.iv.atk').val(), $('.ev.atk').val(), 100, natureBonus['Atk']));
		$('#barAtk').css("width", calculBarValue($('#totalAtk').text())+'px');
	});
	
	//calc tot def
	$('.def').on('keyup mouseup', function() {
		$('#totalDef').text(calculTotStat($('#baseDef').text(), $('.iv.def').val(), $('.ev.def').val(), 100, natureBonus['Def']));
		$('#barDef').css("width", calculBarValue($('#totalDef').text())+'px');
	});
	
	//calc tot spa
	$('.spa').on('keyup mouseup', function() {
		$('#totalSpa').text(calculTotStat($('#baseSpa').text(), $('.iv.spa').val(), $('.ev.spa').val(), 100, natureBonus['Spa']));
		$('#barSpa').css("width", calculBarValue($('#totalSpa').text())+'px');
	});
	
	//calc tot spd
	$('.spd').on('keyup mouseup', function() {
		$('#totalSpd').text(calculTotStat($('#baseSpd').text(), $('.iv.spd').val(), $('.ev.spd').val(), 100, natureBonus['Spd']));
		$('#barSpd').css("width", calculBarValue($('#totalSpd').text())+'px');
	});
	
	//calc tot spe
	$('.spe').on('keyup mouseup', function() {
		$('#totalSpe').text(calculTotStat($('#baseSpe').text(), $('.iv.spe').val(), $('.ev.spe').val(), 100, natureBonus['Spe']));
		$('#barSpe').css("width", calculBarValue($('#totalSpe').text())+'px');
	});

};