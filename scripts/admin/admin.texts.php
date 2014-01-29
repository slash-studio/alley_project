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
   if (!empty($text_head)) {
      $_SESSION['text_id'] = $post['id'];
      HandleAdminData($_texts, $post, 'texts');
   } else {
      $smarty->assign('error_txt', 'Заголовок не может быть пустым!');
   }
} elseif (isset($_SESSION['text_id'])) {
   $smarty->assign('last_viewed_text_id', $_SESSION['text_id']);
   unset($_SESSION['text_id']);
}
$smarty->assign('texts', $_texts->AddOrder('name', OT_ASC)->GetAll())
       ->display('admin.texts.tpl');
?>