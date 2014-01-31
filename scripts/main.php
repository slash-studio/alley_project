<?php
require_once $_SERVER['DOCUMENT_ROOT'] . '/scripts/classes/class.Texts.php';

$smarty->assign('main_text', $_texts->GetById(MAIN_TEXT_ID))
       ->display('index.tpl');
?>