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
             ->assign('articles', $_news->CreateSearchYM($year, $month)->AddOrder(News::PUBLICATION_DATE_FLD, OT_ASC)->GetAll());
   } elseif (empty($_POST['mode']) || $_POST['mode'] != 'Insert') {
      header("Location: /admin/articles/$year/1");
   }
}

if (isset($_POST['mode'])) {
   $post = GetPOST();
   $id   = isset($_POST['id']) ? $_POST['id'] : null;
   $post['params'] = Array(
         'id'        => $id,
         'text_head' => $text_head = isset($post['text_head']) ? $post['text_head'] : null,
         'text_body' => $text_body = isset($post['text_body']) ? $post['text_body'] : null
   );
   if ($post['mode'] != 'Insert') {
      $_SESSION['last_viewed_news_id'] = $id;
   }
   if (empty($text_head)) {
      $smarty->assign('error_txt', 'Заголовок новости не может быть пустым!');
   } elseif (empty($text_body)) {
      $smarty->assign('error_txt', 'Описание новости не может быть пустым!');
   } else {
      HandleAdminData($_news, $post, "articles/$year/$month");
   }
}
if (isset($_SESSION['last_viewed_news_id'])) {
   $smarty->assign('last_viewed_id', $_SESSION['last_viewed_news_id']);
   unset($_SESSION['last_viewed_news_id']);
}

$smarty->assign('article_level', $level)
       ->assign('article_menu', $_news->GetAdminMenu())
       ->display('admin.articles.tpl');
?>