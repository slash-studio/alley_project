$(function(){
  $array = [];
  $('.upload').each(function() {
    $btnUpload = $(this);
    $data = JSON.parse($btnUpload.attr('data'));
    $array[$data.buttonId] = $(this);
    new AjaxUpload($btnUpload, {
      action: '/scripts/uploadimage.php',
      name: 'uploadimage',
      data: $data,
      onSubmit: function(file, ext) {
        $photosCount = this._settings.data.count;
        if ($('div.upload_photos ul li').length >= $photosCount) {
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
        document.innerHTML = response;
        alert(response);
        //Add uploaded file to list
        $buttonId = this._settings.data.buttonId;
        $response = JSON.parse(response);
        $fileName = $response.file;
        $fileTmpName = $response.file_tmp;
        $makeMain = "";
        if (this._settings.data.makeMain) {
          $makeMain = '<div><input type="radio" name="make_main" value="' + $fileName + '" /><label for="make_main">Сделать главной</label></div>';
        }
        if ($response.result) {
          $.post(
            "/scripts/rename.php",
            {
              file: fileName,
              sizes: this._settings.data.sizes
            },
            function(data){
              $array[$buttonId].siblings('ul').append('<li><a href="/scripts/uploads/' + $fileName + '_b.jpg"><img src="/scripts/uploads/' + $fileName + '_s.jpg" /></a><button class="x" data="' + $fileName + '">x</button>' + $make_main + '</li>');
              if ($array[$buttonId].siblings('ul').siblings('li').length >= this._settings.data.count) {
                $array[$buttonId].hide();
              }
            }
          );
        } else {
          alert('Файл ' + $fileTmpName + ' не может быть загружен. ' + $response.message);
        }
      }
    });
  });

  $(document).on('click', 'ul.imgs li button', function(){
    $button = $(this);
    $data = JSON.parse($btnUpload.attr('data'));
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
          if ($button.siblings('ul').siblings('li').length < $data.count) {
            $button.show();
          }
        } else {
          alert(data.message);
        }
      },
       "json"
    );
    return false;
  });

  $(document).on('change', 'ul.imgs li input[name="make_main"]', function(){
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

