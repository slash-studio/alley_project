<?php
require_once $_SERVER['DOCUMENT_ROOT'] . '/scripts/classes/class.Timetable.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/scripts/handlers/handler.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/scripts/utils.php';

class TimetableHandler extends Handler
{
   public function __construct()
   {
      $this->entity = new Timetable();
   }
}

try {
   $post = GetPOST();
   $handler = new TimetableHandler();
   $handler->Handle($post);
} catch (Exception $e) {
   $ajaxResult['result'] = false;
   $ajaxResult['message'] = $e->getMessage();
}
echo json_encode($ajaxResult);