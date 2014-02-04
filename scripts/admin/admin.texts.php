<?php
require_once $_SERVER['DOCUMENT_ROOT'] . '/scripts/classes/class.Texts.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/scripts/handlers/handler.php';

define('TEXT_ID', LAST . 'text_id');
SetLastViewedID(TEXT_ID);

if (isset($_POST['save'])) {
   $post = GetPOST();
   $post['mode']   = 'Update';
   $post['params'] = Array(
         Texts::ID_FLD        => $post['id'],
         Texts::TEXT_BODY_FLD => $post['text_body'],
         Texts::TEXT_HEAD_FLD => $text_head = isset($post['text_head']) ? $post['text_head'] : null
   );
   $_SESSION[TEXT_ID] = $post['id'];
   if (!empty($text_head)) {
      HandleAdminData($_texts, $post, 'texts');
   } else {
      SetRequiredFieldError('Заголовок');
      SetLastViewedID(TEXT_ID);
   }
}
$smarty->assign('texts', $_texts->AddOrder(Texts::NAME_FLD, OT_ASC)->GetAll())
       ->display('admin.texts.tpl');
?>