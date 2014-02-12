<?php
$uploaddir  = 'uploads/';
preg_match('/(.*)(\..*)/', basename($_FILES['uploadimage']['name']), $arr);
$ext        = $arr[2];
$filetypes  = Array('.jpg', '.JPG', '.jpeg', '.JPEG');
$ajaxResult = Array('result' => true, 'message' => 'Загрузка прошла успешно!', 'file_tmp' => $_FILES['uploadimage']['name']);
$_POST['__file'] = 'upload';

if (!in_array($ext, $filetypes)) {
  $ajaxResult['result'] = false;
  $ajaxResult['message'] = 'Это разрешение не поддерживается. Только JPG.';
  echo json_encode($ajaxResult);
  exit;
}

$arr = getimagesize($_FILES['uploadimage']['tmp_name']);
if ($_POST['width'] && $arr[0] != $_POST['width']) {
  $ajaxResult['result'] = false;
  $ajaxResult['message'] = 'Ширина изображения не соответствует заданному шаблону!';
  echo json_encode($ajaxResult);
  exit;
}

if ($_POST['height'] && $arr[1] != $_POST['height']) {
  $ajaxResult['result'] = false;
  $ajaxResult['message'] = 'Высота изображения не соответствует заданному шаблону!';
  echo json_encode($ajaxResult);
  exit;
}

if ($_FILES['uploadimage']['size'] > $_POST['maxSize']) {
  $ajaxResult['result'] = false;
  $ajaxResult['message'] = 'Размер изображения превышает максимальный!';
  echo json_encode($ajaxResult);
  exit;
}  

require_once $_SERVER['DOCUMENT_ROOT'] . '/php_for_upload.php';

$ajax_other_res = checkOther();
if ($ajax_other_res['result']) {
  $ajaxResult['result'] = $ajax_other_res['result'];
  $ajaxResult['message'] = $ajax_other_res['message'];
  echo json_encode($ajaxResult);
  exit;
} 

$path = $uploaddir . $_POST['__file'] . '.jpg';
if (move_uploaded_file($_FILES['uploadimage']['tmp_name'], $path)) {
  $ajaxResult['file'] = $_POST['__file'];
} else {
  $ajaxResult['result'] = false;
  $ajaxResult['message'] = 'Ошибка при загрузке файла на сервер!';
}
echo json_encode($ajaxResult);

?>