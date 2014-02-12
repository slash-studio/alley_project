<?php
require_once $_SERVER['DOCUMENT_ROOT'] . '/scripts/classes/class.News.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/scripts/classes/class.DataHandling.php';

$page = 0;
$data_h = new DataHandling();
if (isset($_GET['page'])) {
   try {
      $data_h->validatePositiveNum($_GET['page']);
      $page = $_GET['page'] - 1; //в гет запрос передаем страницы начиная с единицы а не с нуля
   } catch (Exception $e) {}
}
// print_r($_news->GetNews($page));
// exit;
$newsOnPage = News::NEWS_ON_PAGE;
$pagesAmount = $newsOnPage != 0 ? ceil($_news->GetAllAmount() / $newsOnPage) : 0;
$pagesNum = GeneratePages($pagesAmount, $page + 1);
$smarty->assign('pagesAmount', $pagesAmount)
       ->assign('pagesNum', GeneratePages($pagesAmount, $page + 1))
       ->assign('curPage', $page)
       ->assign('news', $_news->GetNews($page))
       ->display('articles.tpl');