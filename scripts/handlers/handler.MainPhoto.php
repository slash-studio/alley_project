<?php
require_once $_SERVER['DOCUMENT_ROOT'] . '/scripts/classes/class.Course.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/scripts/classes/class.News.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/scripts/handlers/handler.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/scripts/utils.php';

class MainPhotoHandler extends Handler
{
   public function __construct($entity)
   {
      $this->entity = $entity;
   }
}

$ajaxResult = Array('result' => true, 'message' => 'Операция прошла успешно!');

try {
   $post = GetPOST();
   $obj = null;
   switch ($post['type']) {
      case 'course':
         $obj = new Course();
         break;

      case 'news':
         $obj = new News();
         break;
   }
   $handler = new MainPhotoHandler($obj);
   $handler->Handle($post);
} catch (Exception $e) {
   $ajaxResult['result'] = false;
   $ajaxResult['message'] = $e->getMessage();
}
echo json_encode($ajaxResult);