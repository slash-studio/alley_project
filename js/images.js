$(function(){

  function checkDisable() {
    $('button.upload').each(function() {
      $btnUpload = $(this);
      $data = JSON.parse($btnUpload.siblings('input').val());
      if ($btnUpload.parent('form').siblings('ul').children('li').length >= $data.count) {
        $btnUpload.hide();
      } else {
        $btnUpload.show();
      }
    });
  }
  
  checkDisable();
    
  $('div.upload_photos ul li button').click(function() {
    $button = $(this);
    $.post(
      "/scripts/handlers/handler.Image.php",
      {
        type: 'Image',
        mode: 'Delete',
        params:
          {
            id: $button.attr('data')
          }
      },
      function(data) {
        if (data.result) {
          $button.parent().empty().remove();
          checkDisable();
        } else {
          alert(data.message);
        }
      },
       "json"
    );
    return false;
  });
  
  $('div.upload_photos ul li input[name="make_main"]').change(function(){
    $input = $(this);
    $.post(
      "/scripts/handlers/handler.MainPhoto.php",
      {
        type: $input.attr('data-table'),
        mode: 'Update',
        params:
          {
            id:  $input.attr('data-id'),
            photo_id: $input.val()
          }
      },
      function(data) {
        if (!data.result) {
          alert(data.message);
        }
      },
      "json"
    );
  });
});

