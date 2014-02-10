<?php
require_once $_SERVER['DOCUMENT_ROOT'] . '/scripts/classes/class.Texts.php';

$smarty->assign('about', $_texts->SetSamplingScheme(Texts::ABOUT_SCHEME)->GetAll())
       ->display('about.tpl');