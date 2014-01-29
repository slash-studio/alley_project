$(function(){
   $('#choose_text').change(function(){
      $('.text_edit').hide();
      $('#' + $('#choose_text option:selected').val()).show();
   });
   // $('#choose_text').val($('#choose_text option:first').val());
   $('#choose_text').change();
   // $('#' + $('#choose_text option:selected').val()).show();
});