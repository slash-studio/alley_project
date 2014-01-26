$(function(){
	$('#choose_text').change(function(){
		$('.text_edit').hide();
		$('#' + $('#choose_text option:selected').val()).show();
	});

});