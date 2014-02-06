<?php
require_once $_SERVER['DOCUMENT_ROOT'] . '/scripts/classes/class.MasterClass.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/scripts/handlers/handler.php';

if (isset($_POST['mode'])) {
   $post = GetPOST();
   $id   = isset($post['id'])          ? $post['id']          : '';
   $name = isset($post['name'])        ? $post['name']        : '';
   $date = isset($post['date'])        ? $post['date']        : '';
   $desc = isset($post['description']) ? $post['description'] : '';
   $date = new DateTime();
   $date->modify("+2 minute");
   $date = $date->format("Y-m-d H:i:s");

   $post['params'] = Array(
      MasterClass::ID_FLD          => $id,
      MasterClass::NAME_FLD        => $name,
      MasterClass::DATE_FLD        => $date,
      MasterClass::DESCRIPTION_FLD => $desc
   );
   if (empty($name)) {
      SetRequiredFieldError('Название мастер-класса');
   } elseif (empty($date)) {
      SetRequiredFieldError(null, 'Вы не указали дату мастер-класса');
   } else {
      HandleAdminData($_masterClass, $post, 'masterclasses');
   }
}

$smarty->assign('classes', $_masterClass->GetAll())
       ->display('admin.masterclasses.tpl');
?>