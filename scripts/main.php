<?php
require_once $_SERVER['DOCUMENT_ROOT'] . '/scripts/classes/class.Texts.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/scripts/classes/class.Course.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/scripts/classes/class.News.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/scripts/classes/class.MasterClass.php';

$smarty->assign('main_text', $_texts->GetById(Texts::MAIN_TEXT_ID))
       ->assign('courses', $_course->SetSamplingScheme(Course::MAIN_PAGE_SCHEME)->GetAll())
       ->assign('news', $_news->SetSamplingScheme(MasterClass::MAIN_PAGE_SCHEME)->GetAll())
       ->assign('class', $_masterClass->SetSamplingScheme(MasterClass::MAIN_PAGE_SCHEME)->GetPart())
       ->display('index.tpl');