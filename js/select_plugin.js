$(function(){
   $('#choose_item').change(function(){
      $('.item_edit').hide();
      $('div.upload_photos').hide();
      $('#item' + $('#choose_item option:selected').val()).show();
      $('#div_upload' + $('#choose_item option:selected').val()).show();
   });
   $('#choose_item').change();
});