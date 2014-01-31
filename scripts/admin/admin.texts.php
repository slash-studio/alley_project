<?php
require_once $_SERVER['DOCUMENT_ROOT'] . '/scripts/classes/class.Texts.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/scripts/handlers/handler.php';

if (isset($_POST['save'])) {
   $post = GetPOST();
   $post['mode']   = 'Update';
   $post['params'] = Array(
         'id'        => $post['id'],
         'text_body' => $post['text_body'],
         'text_head' => $text_head = isset($post['text_head']) ? $post['text_head'] : null);
   $_SESSION['last_viewed_text_id'] = $post['id'];
   if (!empty($text_head)) {
      HandleAdminData($_texts, $post, 'texts');
   } else {
      $smarty->assign('error_txt', 'Заголовок не может быть пустым!');
   }
}
if (isset($_SESSION['last_viewed_text_id'])) {
   $smarty->assign('last_viewed_id', $_SESSION['last_viewed_text_id']);
   unset($_SESSION['last_viewed_text_id']);
}
$smarty->assign('texts', $_texts->AddOrder(Texts::NAME_FLD, OT_ASC)->GetAll())
       ->display('admin.texts.tpl');
?>