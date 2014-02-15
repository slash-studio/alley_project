$(function(){

  function checkDisable() {
    $('button.upload').each(function() {
      $btnUpload = $(this);
      $data = JSON.parse($btnUpload.attr('data'));
      if ($btnUpload.siblings('ul').children('li').length >= $data.count) {
        $btnUpload.hide();
      } else {
        $btnUpload.show();
      }
    });
  }
  
  checkDisable();
  
  $array = [];
  $('button.upload').each(function() {
    $btnUpload = $(this);
    $data = JSON.parse($btnUpload.attr('data'));
    $array[$data.buttonId] = $(this);
    new AjaxUpload($btnUpload, {
      action: '/scripts/uploadimage.php',
      name: 'uploadimage',
      data: $data,
      onSubmit: function(file, ext) {
        $photosCount = this._settings.data.count;
        $buttonId = this._settings.data.buttonId;
        if ($array[$buttonId].siblings('ul').children('li').length >= $photosCount) {
          alert('Нельзя загрузить больше чем ' + $photosCount + ' фотографий!');
          return false;
        }
        if (!(ext && /^(jpg|jpeg)$/.test(ext))) {
          // extension is not allowed
          alert('Это разрешение не поддерживается. Только JPG.');
          return false;
        }
      },
      onComplete: function(file, response) {
        $response = JSON.parse(response);
        if ($response.result) {
          $.colorbox({width:"600px", height:"500px", href:"/admin/resize_photo/?id=" + $response.file, iframe: true});
          /*
          $buttonId = this._settings.data.buttonId;
          $sizes = this._settings.data.sizes;
          $count = this._settings.data.count;
          $fileName = $response.file;
          $fileTmpName = $response.file_tmp;
          $makeMain = "";
          if (this._settings.data.makeMain == true) {
            $makeMain = '<div><input type="radio" name="make_main" value="' + $fileName + '" /><label for="make_main">Сделать главной</label></div>';
          }
          $.post(
            "/scripts/rename.php",
            {
              file: $fileName,
              sizes: $sizes
            },
            function(data){
              $array[$buttonId].siblings('ul').append('<li><a href="/scripts/uploads/' + $fileName + '_b.jpg"><img src="/scripts/uploads/' + $fileName + '_s.jpg" /></a><button class="x" data="' + $fileName + '">x</button>' + $makeMain + '</li>');
              checkDisable();
            }
          );*/
        } else {
          alert('Файл ' + $fileTmpName + ' не может быть загружен. ' + $response.message);
        }
      }
    });
  });
  

    
  $(document).on('click', 'div.upload_photos ul li button', function(){
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
  
  $(document).on('change', 'div.upload_photos ul li input[name="make_main"]', function(){
    var $input = $(this);
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

