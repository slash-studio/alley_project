<?php
require_once $_SERVER['DOCUMENT_ROOT'] . '/scripts/classes/class.Course.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/scripts/classes/class.Texts.php';

$smarty->assign('courses_text', $_texts->GetById(Texts::COURSE_TEXT_ID))
       ->assign('courses', $_course->SetSamplingScheme(Course::ALL_COURSES_SCHEME)->GetAll())
       ->display('courses.tpl');