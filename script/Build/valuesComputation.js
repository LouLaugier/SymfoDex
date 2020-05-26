//To do : move magic numbers to constant file

//default nature bonus
var natureBonus = {'Atk':1,'Def':1,'Spa':1,'Spd':1,'Spe':1};

//Pv calculation function
function calculTotPv(base, iv, ev, lv) {
	let totPv = 0;
	
	base = parseInt(base);
	iv = parseInt(iv);
	ev = parseInt(ev);
	lv = parseInt(lv); 
	
	totPv = 2 * base;
	totPv = totPv + iv;
	totPv = totPv + (ev/4);
	totPv = totPv * lv;
	totPv = totPv / 100;
	totPv = totPv + lv + 10;
	return parseInt(totPv);
}

//other stat calculation function
function calculTotStat(base, iv, ev, lv, natBonus = 1) {
	let totStat = 0;
	
	base = parseInt(base);
	iv = parseInt(iv);
	ev = parseInt(ev);
	lv = parseInt(lv); 
	
	totStat = 2 * base;
	totStat = totStat + iv;
	totStat = totStat + (ev/4);
	totStat = totStat * lv;
	totStat = totStat / 100;
	totStat = totStat + 5;
	totStat = totStat * natBonus;
	return parseInt(totStat);
}

//set totalstat balise value  
function setAllTotStat(setPv = false, fromForm = true){
	let ivPv;
	let evPv;
	let ivAtk;
	let evAtk;
	let ivDef;
	let evDef;
	let ivSpa;
	let evSpa;
	let ivSpd;
	let evSpd;
	let ivSpe;
	let evSpe;
	
	if(fromForm) {
		//use in form
		ivPv = $('.iv.pv').val();
		evPv = $('.ev.pv').val();
		ivAtk = $('.iv.atk').val();
		evAtk = $('.ev.atk').val();
		ivDef = $('.iv.def').val();
		evDef = $('.ev.def').val();
		ivSpa = $('.iv.spa').val();
		evSpa = $('.ev.spa').val();
		ivSpd = $('.iv.spd').val();
		evSpd = $('.ev.spd').val();
		ivSpe = $('.iv.spe').val();
		evSpe = $('.ev.spe').val();
	} else {
		//use in view
		ivPv = $('.iv.pv').text();
		evPv = $('.ev.pv').text();
		ivAtk = $('.iv.atk').text();
		evAtk = $('.ev.atk').text();
		ivDef = $('.iv.def').text();
		evDef = $('.ev.def').text();
		ivSpa = $('.iv.spa').text();
		evSpa = $('.ev.spa').text();
		ivSpd = $('.iv.spd').text();
		evSpd = $('.ev.spd').text();
		ivSpe = $('.iv.spe').text();
		evSpe = $('.ev.spe').text();
	}
	
	if(setPv) {
		$('#totalPv').text(calculTotPv($('#basePv').text(), ivPv, evPv, 100));
	}
	$('#totalAtk').text(calculTotStat($('#baseAtk').text(), ivAtk, evAtk, 100, natureBonus['Atk']));
	$('#totalDef').text(calculTotStat($('#baseDef').text(), ivDef, evDef, 100, natureBonus['Def']));
	$('#totalSpa').text(calculTotStat($('#baseSpa').text(), ivSpa, evSpa, 100, natureBonus['Spa']));
	$('#totalSpd').text(calculTotStat($('#baseSpd').text(), ivSpd, evSpd, 100, natureBonus['Spd']));
	$('#totalSpe').text(calculTotStat($('#baseSpe').text(), ivSpe, evSpe, 100, natureBonus['Spe']));
}

//statBar size calculation function
function calculBarValue(totPv, pxMax = 220, maxStat = 714) {
	totPv = parseInt(totPv);
	return (totPv*pxMax/maxStat);
}

//set statBar width value
function setStatBar(setPv = false, pxMax = 220) {
	if(setPv) {
		$('#barPv').css("width", calculBarValue($('#totalPv').text(), pxMax)+'px');
	}
	$('#barAtk').css("width", calculBarValue($('#totalAtk').text(), pxMax)+'px');
	$('#barDef').css("width", calculBarValue($('#totalDef').text(), pxMax)+'px');
	$('#barSpa').css("width", calculBarValue($('#totalSpa').text(), pxMax)+'px');
	$('#barSpd').css("width", calculBarValue($('#totalSpd').text(), pxMax)+'px');
	$('#barSpe').css("width", calculBarValue($('#totalSpe').text(), pxMax)+'px');
}

//update nature bonus when a nature is selected
function setNatureBonusEventListener() {
	$('.choixNature').on('change', function() {
		setNatureBonus($('.choixNature').val());
	});
}
