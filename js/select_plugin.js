$(function(){
   $('#choose_item').change(function(){
      $('.item_edit').hide();
      $('#' + $('#choose_item option:selected').val()).show();
   });
   $('#choose_item').change();
});