$(document).ready(function(){
	$(':button.nahled').click(function(){
		var cislo = $(this).closest('form').find('select.nahled:first').val();
		if (cislo > 0) {
			window.open(function(){return '/-nahled/' + cislo + '/';}(), '_blank');
		} else {
			alert('Vyber prosím konkrétní článek k přechodu na náhled.');
		}	
	});
});
