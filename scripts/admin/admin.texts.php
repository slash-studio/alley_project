<?php
require_once $_SERVER['DOCUMENT_ROOT'] . '/scripts/classes/class.Texts.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/scripts/handlers/handler.php';

if (isset($_POST['save'])) {
   $post = GetPOST();
   $post['mode']   = 'Update';
   $post['params'] = Array(
         'id'        => $post['text_id'],
         'text_body' => $post['text_body'],
         'text_head' => isset($post['text_head']) ? $post['text_head'] : null);
   $handler = new Handler($_texts);
   HandleAdminData('texts');
   try {
      
   } catch (Exception $e) {
      
   }
   $handler->Handle($post);
   header('Location: /admin/texts');
}
$result = $_competitiveButton->GetAll();
$smarty->assign('competitiveStatus', $result[0]['competitive_button_status'])
       ->assign('texts', $_texts->GetAll())
       ->display('admin.text.tpl');
?>