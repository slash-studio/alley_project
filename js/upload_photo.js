$(function(){
  $array = [];
  $('.upload').each(function() {
    $btnUpload = $(this);
    $data = JSON.parse($btnUpload.attr('data'));
    $array[$data.item_id] = $(this);
    new AjaxUpload($btnUpload, {
      action: '/scripts/uploadimage.php',
      name: 'uploadimage',
      data: $data,
      onSubmit: function(file, ext) {
          if (!(ext && /^(jpg|jpeg)$/.test(ext))) {
          // extension is not allowed
          alert('This extension is not allowed. Only JPG.');
          return false;
        }
      },
      onComplete: function(file, response) {
        // document.body.innerHTML = response;
        // alert(response);
        //Add uploaded file to list
        $btn = this._settings.data.item_id;
        if(response != "error") {
          file_name = response;
          $.post(
            "/scripts/rename.php",
            {
              name: file_name,
              sizes: this._settings.data.sizes
            },
            function(data){
              $array[$btn].siblings('ul').append('<li><a href="/scripts/uploads/' + file_name + '_s.jpg" class="block"><img src="/scripts/uploads/' + file_name + '_s.jpg" /></a><button class="x" data="' + file_name + '">x</button></li>');
            }
          );
        } else {
          alert('File cannot be download ' + file);
        }
      }
    });
  });
  $(document).on('click', 'ul.imgs li button', function(){
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
        } else {
          alert(data.message);
        }
      },
       "json"
    );
    return false;
  });
});

