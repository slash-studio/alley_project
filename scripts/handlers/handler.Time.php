<?php
require_once $_SERVER['DOCUMENT_ROOT'] . '/scripts/classes/class.Time.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/scripts/handlers/handler.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/scripts/utils.php';

class TimeHandler extends Handler
{
   public function __construct()
   {
      $this->entity = new DBTime;
   }
}

try {
   $post = GetPOST();
   $handler = new TimeHandler();
   $handler->Handle($post);
} catch (Exception $e) {
   $ajaxResult['result'] = false;
   $ajaxResult['message'] = $e->getMessage();
}
echo json_encode($ajaxResult);