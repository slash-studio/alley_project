<?php
require_once $_SERVER['DOCUMENT_ROOT'] . '/scripts/classes/class.Teachers.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/scripts/handlers/handler.php';

if (isset($_POST['mode'])) {
   $post = GetPOST();
   $id   = isset($_POST['id'])   ? $_POST['id'] : '';
   $name = isset($_POST['name']) ? $_POST['name'] : '';
   $info = isset($_POST['info']) ? $_POST['info'] : '';
   $post['params'] = Array('name' => $name, 'info' => $info, 'id' => $id);
   $_SESSION['last_viewed_teacher_id'] = $post['id'];
   if (!empty($name)) {
      HandleAdminData($_teachers, $post, 'teachers');
   } else {
      $smarty->assign('error_txt', 'Имя преподавателя не может быть пустым!');
   }
}
if (isset($_SESSION['last_viewed_teacher_id'])) {
   $smarty->assign('last_viewed_id', $_SESSION['last_viewed_teacher_id']);
   unset($_SESSION['last_viewed_teacher_id']);
}
$smarty->assign('teachers', $_teachers->AddOrder(Teachers::NAME_FLD)->GetAll())
       ->display('admin.teachers.tpl');
?>