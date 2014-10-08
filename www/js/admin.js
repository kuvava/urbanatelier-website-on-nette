$(document).ready(function(){
$(':button.nahled').click(function(){
	var cislo = $(this).closest('form').find('select.nahled:first').val();
	if (cislo > 0) {
		window.open(function(){return '/-nahled/' + cislo + '/';}(), '_blank');
	} else {
		alert('Vyber prosím konkrétní článek k přechodu na náhled.');
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
