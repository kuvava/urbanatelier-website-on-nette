$(document).ready(function(){
	$('#frm-chooseUrlForEditForm-preview').click(function(){
		var cislo = $('#frm-chooseUrlForEditForm-url').val();
		if (cislo > 0) {
			window.open(function(){return '/-nahled/' + cislo + '/';}(), '_blank');
		} else {
			alert('Vyber prosím konkrétní článek k přechodu na náhled.');
		}	
	});
});
