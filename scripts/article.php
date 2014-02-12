<?php
require_once $_SERVER['DOCUMENT_ROOT'] . '/scripts/classes/class.News.php';

$id = !empty($request[1]) ? $request[1] : null;
if (!empty($id)) {
   $article = $_news->SetSamplingScheme(News::INFO_SCHEME)->GetById($id);
}
if (empty($id) || empty($article)) {
   header('Location: /articles');
}
$smarty->assign('article', $article)
       ->assign('news', $_news->SetSamplingScheme(News::OTHER_SCHEME)->GetAll())
       ->display('article.tpl');