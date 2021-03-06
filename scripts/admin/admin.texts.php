<?php
require_once $_SERVER['DOCUMENT_ROOT'] . '/scripts/classes/class.Texts.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/scripts/handlers/handler.php';

SetLastViewedID(Texts::LAST_VIEWED_ID);

if (isset($_POST['save'])) {
   $post = GetPOST();
   $post['mode']   = 'Update';
   $post['params'] = Array(
         Texts::ID_FLD        => $post['id'],
         Texts::TEXT_BODY_FLD => $post['text_body'],
         Texts::TEXT_HEAD_FLD => $text_head = isset($post['text_head']) ? $post['text_head'] : null
   );
   $_texts->SetLastViewedID($post['id']);
   HandleAdminData($_texts, $post, 'texts');
   SetLastViewedID(Texts::LAST_VIEWED_ID);
}
$smarty->assign('item_id', !empty($_GET['item_id']) ? $_GET['item_id'] : null)
       ->assign('texts', $_texts->AddOrder(Texts::NAME_FLD, OT_ASC)->GetAll())
       ->display('admin.texts.tpl');