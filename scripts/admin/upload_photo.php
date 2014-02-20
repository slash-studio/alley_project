<?php
if (empty($_SERVER['HTTP_REFERER'])) {
   header('Location: /admin/texts');
   exit;
}
$referer = explode('?', $_SERVER['HTTP_REFERER']);
if (isset($referer[1])) {
 $referer = mb_substr($referer[0], 0, -1);
} else {
 $referer = $referer[0];
}
$smarty->assign('referer', $referer)
      ->assign('photo_data', $_POST['data'])
      ->display('upload_photo.tpl');