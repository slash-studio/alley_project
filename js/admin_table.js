$(function(){
   $('a.add').click(function(){
      var $this = $(this);
      var $button = $('#add_course button.save.normal');
      $button.attr('data-day-id', $this.attr('data-day-id'));
      $button.attr('data-time-id', $this.attr('data-time-id'));
      $this.colorbox({inline:true, width:"400px", height:"250px"});
   });
   $('#timetable button.delete').click(function(){
      var $this = $(this);
      $.post(
         "/scripts/handlers/handler.Timetable.php",
         {
            mode: 'Delete',
            params: {
               id: $this.attr('data-id')
            }
         },
         function(data) {
            if (data.result) {
               location.reload()
            } else {
               alert(data.message);
            }
         },
         "json"
      );
      return false;
   });
   $('#add_course button.save').click(function(){
      var $this = $(this);
      $.post(
         "/scripts/handlers/handler.Timetable.php",
         {
            mode: $this.attr('data-mode'),
            params: {
               id: $this.attr('data-id'),
               course_id: $('#select_course').val(),
               day_id: $this.attr('data-day-id'),
               time_id: $this.attr('data-time-id'),
            }
         },
         function(data) {
            if (data.result){
               //dynamicly add content;
               location.reload();
            } else {
               alert(data.message);
            }
         },
         "json"
      );
      return false;
   });
   $('#times_block button.times').click(function(){
      var $this = $(this);
      var num = $this.attr('data-num');
      $.post(
         "/scripts/handlers/handler.Time.php",
         {
            mode: $this.attr('data-mode'),
            params: {
               id: $this.attr('data-id'),
               start: $('#time_begin_' + num).val(),
               end: $('#time_end_' + num).val()
            }
         },
         function(data) {
            if (data.result) {
               location.reload()
            } else {
               alert(data.message);
            }
         },
         "json"
      );
      return false;
   });
});