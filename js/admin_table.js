$(function(){
   $('#timetable button.delete').click(function(){
		$td = JSON.parse($(this).attr('data'));
		if (confirm('Вы уверены?')) {
			 $.post(
				 "/scripts/handlers/handler.Table.php",
				 {
					mode: 'Delete',
					params: $td
				 },
				 function(data) {
					alert(data);
				 },
				 "json"
			 );
		}
   });
   
});