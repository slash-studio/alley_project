<?php
require_once $_SERVER['DOCUMENT_ROOT'] . '/scripts/classes/class.MasterClass.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/scripts/handlers/handler.php';

if (isset($_POST['mode'])) {
   $post = GetPOST();
   $id   = isset($post['id'])          ? $post['id']          : '';
   $name = isset($post['name'])        ? $post['name']        : '';
   $date = isset($post['date'])        ? $post['date']        : '';
   $desc = isset($post['description']) ? $post['description'] : '';
   $post['params'] = Array(
      MasterClass::ID_FLD          => $id,
      MasterClass::NAME_FLD        => $name,
      MasterClass::DATE_FLD        => DateToMySqlDate($date),
      MasterClass::DESCRIPTION_FLD => $desc
   );
   HandleAdminData($_masterClass, $post, 'masterclasses');
}
$smarty->assign('classes', $_masterClass->ResetDateOfInterval()->GetAll())
       ->display('admin.masterclasses.tpl');