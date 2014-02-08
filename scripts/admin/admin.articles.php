<?php
require_once $_SERVER['DOCUMENT_ROOT'] . '/scripts/classes/class.News.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/scripts/handlers/handler.php';

$level = 1;
$year = !empty($request[2]) ? $request[2] : null;
if (!empty($year)) {
   $level = 2;
   $month = $request[3];
   if (!empty($month)) {
      print_r($_news->CreateSearchYM($year, $month)->SetSamplingScheme(News::WITH_PHOTOS_SCHEME)->AddOrder(News::PUBLICATION_DATE_FLD, OT_ASC)->GetAll());
      $smarty->assign('year', $year)
             ->assign('month', $month)
             ->assign('articles', $_news->CreateSearchYM($year, $month)->AddOrder(News::PUBLICATION_DATE_FLD, OT_ASC)->GetAll());
   } elseif (empty($_POST['mode']) || $_POST['mode'] != 'Insert') {
      header("Location: /admin/articles/$year/1");
   }
}

define('CID', LAST . 'news_id');
SetLastViewedID(CID);

if (isset($_POST['mode'])) {
   $post = GetPOST();
   $id   = isset($_POST['id']) ? $_POST['id'] : null;
   $post['params'] = Array(
         News::ID_FLD        => $id,
         News::TEXT_HEAD_FLD => $text_head = isset($post['text_head']) ? $post['text_head'] : null,
         News::TEXT_BODY_FLD => $text_body = isset($post['text_body']) ? $post['text_body'] : null
   );
   if ($post['mode'] != 'Insert') {
      $_SESSION[CID] = $id;
   }
   if (empty($text_head)) {
      SetRequiredFieldError('Заголовок новости');
      SetLastViewedID(CID);
   } elseif (empty($text_body)) {
      SetRequiredFieldError('Описание новости');
      SetLastViewedID(CID);
   } else {
      HandleAdminData($_news, $post, "articles/$year/$month");
   }
}

$smarty->assign('article_level', $level)
       ->assign('article_menu', $_news->GetAdminMenu())
       ->display('admin.articles.tpl');