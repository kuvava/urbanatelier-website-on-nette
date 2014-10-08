$(document).ready(function(){
$(':button.nahled').click(function(){
	var cislo = $(this).closest('form').find('select.nahled:first').val();
	if (cislo > 0) {
		window.open(function(){return '/-nahled/' + cislo + '/';}(), '_blank');
	} else {
		alert('Vyber prosím konkrétní článek k přechodu na náhled.');
	}	
});
$('select.ah1').change(function(){
	var cislo = $(this).val();
	var menenyStrong = $(this).closest('form').find('strong.ah1:first');
	menenyStrong.find('span:first').text('').append('vlož do textu:&nbsp;&nbsp; ');
	menenyStrong.find('span.ah1').text('').append('"klikací slova":[xxx' + cislo + ']');
	var menenyDiv = $(this).closest('form').find('div.ah1:first');
	if (menenyDiv.find('span.ah1').text() == ''){
		console.log('ano');
		var text1 = '<p><strong>Ukázka:</strong></p><p>Článek si plyne veselým tempem. A teď si vzpomenu, že za chvíli bych mohl upozornit čtenáře na jiný článek svého webu. Takže to nějak uvedu. A potom <span>"</span><span class="ah1"><a href="/-nahled/' + cislo + '/" target="_blank">přesně tato slova v uvozovkách jsou klikací odkaz</a></span><span>":[xxx</span><span class="ah2">' + cislo + '</span><span>]</span> toto už odkazovací slova nejsou...</p><p>A ty uvozovky kolem těch klikacích slov i ta hranatá závorka se třemi iksky a číslem z textu zmizí, protože editor pochopí, že z toho má vyrobit klikací odkaz. A to číslo u těch třech iks editoru řekne, kde ten odkazovaný článek v místní databázi najde a jakou tomu aktivnímu odkazu má přiřadit internetovou adresu...</p>';
		menenyDiv.text('').append(text1);
	} else {
		menenyDiv.find('span.ah2:last').text('').append(cislo);
		menenyDiv.find('span.ah1:first').text('').append('<a href="/-nahled/' + cislo + '/" target="_blank">přesně tato slova v uvozovkách jsou klikací odkaz</a>');
	}
});
var selMaxInput = null;
$('input[maxlength]').focus(function(){
	selMaxInput = $(this);
	var d1 = $(this).offset();
	var maxL = $(this).prop('maxlength');
	var actL = $(this).val().length;
	var obj2 = $('#ah1');
	obj2.css("display", "block");
	var v2 = obj2.height();
	obj2.find('span:first').text('').append(' ' + maxL + ' znaků');
	obj2.find('span:last').text('').append(' ' + actL);
	obj2.css({
		"visibility": "visible"
		})
	obj2.stop();
	obj2.animate({
		"top": (d1.top - 20 - v2) + "px",
		"left": d1.left + "px",
		"opacity": 1
		}, 1000)		
}).blur(function(){
	selMaxInput = null;
	$('#ah1').animate({"opacity" : 0}, 700, function(){$(this).css("display", "none");});
});
$('#ah1').click(function(){
	$(this).animate({"opacity" : 0}, 700, function(){$(this).css("display", "none");});
});
$('input').keyup(function(){
	if(selMaxInput != null){
	$('#ah1').find('span:last').text('').append(' ' + selMaxInput.val().length);
	}
});
$('input').bind('paste', function(){
	window.setTimeout(function(){
		if(selMaxInput != null){
		$('#ah1').find('span:last').text('').append(' ' + selMaxInput.val().length);
		}
	}, 200);
});
});
