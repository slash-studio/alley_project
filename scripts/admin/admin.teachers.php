<?php
require_once $_SERVER['DOCUMENT_ROOT'] . '/scripts/classes/class.Teachers.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/scripts/handlers/handler.php';

if (isset($_POST['mode'])) {
   $post = array_map('trim', $_POST);
   $id   = isset($_POST['id'])   ? $_POST['id'] : '';
   $name = isset($_POST['name']) ? $_POST['name'] : '';
   $info = isset($_POST['info']) ? $_POST['info'] : '';
   $post['params'] = Array('name' => $name, 'info' => $info, 'id' => $id);
   $handler = new Handler($_teachers);
   try {
      $handler->Handle($post);
      header('Location: /admin/teachers');
   } catch (Exception $e) {
      $smarty->assign('error_txt', $e->getMessage());
   }
}
$smarty->assign('teachers', $_teachers->GetAll())
       ->display('admin.teachers.tpl');
?>