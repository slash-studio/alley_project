<?php
  $referer = explode('?', $_SERVER['HTTP_REFERER']);
  if ($referer[1]) {
    $referer = mb_substr($referer[0], 0, -1);
  } else {
    $referer = $referer[0];
  }
  $smarty->assign('referer', $referer)
         ->assign('photo_data', $_POST['data'])
         ->display('upload_photo.tpl');