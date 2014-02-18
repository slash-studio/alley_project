<?php
require_once $_SERVER['DOCUMENT_ROOT'] . '/scripts/classes/class.News.php';

$id = !empty($request[1]) ? $request[1] : null;
if (!empty($id)) {
   $article = $_news->SetSamplingScheme(News::INFO_SCHEME)->GetById($id);
}
if (empty($id) || empty($article)) {
   header('Location: /articles');
}
$_news->SetSamplingScheme(News::OTHER_SCHEME)->search->AddClause(
   CCond(
      CF(News::TABLE, $_news->GetFieldByName(News::ID_FLD)),
      CVP($id),
      'AND',
      '!='
   )
);
$smarty->assign('article', $article)
       ->assign('news', $_news->GetAll())
       ->display('article.tpl');