<?php
require_once $_SERVER['DOCUMENT_ROOT'] . '/scripts/classes/class.Teachers.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/scripts/handlers/handler.php';

define('TID', LAST . 'teacher_id');
SetLastViewedID(TID);

if (isset($_POST['mode'])) {
   $post = GetPOST();
   $id   = isset($post['id'])   ? $post['id'] : '';
   $name = isset($post['name']) ? $post['name'] : '';
   $info = isset($post['info']) ? $post['info'] : '';
   $post['params'] = Array(
      Teachers::NAME_FLD => $name,
      Teachers::INFO_FLD => $info,
      Teachers::ID_FLD   => $id
   );
   $_SESSION[TID] = $id;
   if (!empty($name)) {
      HandleAdminData($_teachers, $post, 'teachers');
   } else {
      SetRequiredFieldError('Имя преподавателя');
      SetLastViewedID(TID);
   }
}

$smarty->assign('teachers', $_teachers->AddOrder(Teachers::NAME_FLD)->GetAll())
       ->display('admin.teachers.tpl');
?>