<?php
require_once $_SERVER['DOCUMENT_ROOT'] . '/scripts/classes/class.News.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/scripts/handlers/handler.php';

$level = 1;
$year = !empty($request[2]) ? $request[2] : null;
if (!empty($year)) {
   $level = 2;
   $month = $request[3];
   if (!empty($month)) {
      $smarty->assign('year', $year)
             ->assign('month', $month)
             ->assign('articles', $_news->CreateSearchYM($year, $month)->SetSamplingScheme(News::WITH_PHOTOS_SCHEME)->AddOrder(News::PUBLICATION_DATE_FLD, OT_ASC)->GetAll());
   } elseif (empty($_POST['mode']) || $_POST['mode'] != 'Insert') {
      header("Location: /admin/articles/$year/1");
      exit;
   }
}

SetLastViewedID(News::LAST_VIEWED_ID);

if (isset($_POST['mode'])) {
   $post = GetPOST();
   $id   = isset($_POST['id']) ? $_POST['id'] : null;
   $post['params'] = Array(
         News::ID_FLD               => $id,
         News::TEXT_HEAD_FLD        => isset($post['text_head']) ? $post['text_head']             : null,
         News::TEXT_BODY_FLD        => isset($post['text_body']) ? $post['text_body']             : null,
         News::PUBLICATION_DATE_FLD => isset($post['date'])      ? DateToMySqlDate($post['date']) : null
   );
   if ($post['mode'] != 'Insert') {
      $_news->SetLastViewedID($id);
   } else {
      $date = new DateTime();
      $year = $date->format('Y');
      $month = $date->format('n');
   }
   HandleAdminData($_news, $post, "articles/$year/$month");
   SetLastViewedID(News::LAST_VIEWED_ID);
}

$smarty->assign('item_id', $_GET['item_id'])
       ->assign('article_level', $level)
       ->assign('article_menu', $_news->GetAdminMenu())
       ->display('admin.articles.tpl');