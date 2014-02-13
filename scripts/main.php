<?php
require_once $_SERVER['DOCUMENT_ROOT'] . '/scripts/classes/class.Texts.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/scripts/classes/class.Course.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/scripts/classes/class.News.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/scripts/classes/class.MasterClass.php';

$master_class = $_masterClass->SetSamplingScheme(MasterClass::MAIN_PAGE_SCHEME)->GetPart();

function CutClassBody($class, $delimiter = ' ')
{
  $amount = $delimiter == ' ' ? 10 : 1;
  $arr = explode($delimiter, $class);
  $result = implode($delimiter, array_slice($arr, 0, $amount));
  $result .= $delimiter == '' && count($arr) >= 10 ? '...' : '';
  return $result;
}

$master_class['cut_body'] = CutClassBody($master_class['master_class_description']);

$smarty->assign('main_text', $_texts->GetById(Texts::MAIN_TEXT_ID))
       ->assign('courses', $_course->SetSamplingScheme(Course::MAIN_PAGE_SCHEME)->GetAll())
       ->assign('news', $_news->SetSamplingScheme(News::MAIN_PAGE_SCHEME)->GetAll())
       ->assign('class', $master_class)
       ->display('index.tpl');